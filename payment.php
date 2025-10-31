<?php
session_start();

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}

require "query.php";

$user = $_SESSION["user"];
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : null;

// If no session ID is provided, redirect to feed
if (!$session_id) {
    header('Location: feed.php');
    exit();
}

// Get session details
$session = query("SELECT s.*, ts.hourly_rate, ts.skill_id, sk.name as skill_name, 
                  u.name as tutor_name, u.email as tutor_email
                  FROM sessions s 
                  JOIN tutor_skills ts ON s.tutor_id = ts.tutor_id AND s.skill_id = ts.skill_id
                  JOIN skills sk ON s.skill_id = sk.id
                  JOIN users u ON s.tutor_id = u.id
                  WHERE s.id = '$session_id' AND s.learner_id = '{$user['id']}'")[0] ?? null;

// If session doesn't exist or doesn't belong to the user, redirect to feed
if (!$session) {
    header('Location: message.php?text=Session not found or you do not have permission to access it. <a href="feed.php">Back to Feed</a>');
    exit();
}

// Calculate total amount
$hourly_rate = $session['hourly_rate'];
$duration_hours = $session['duration'] / 60; // Convert minutes to hours
$total_amount = $hourly_rate * $duration_hours;

// Process payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'];
    $card_number = $_POST['card_number'] ?? '';
    $card_expiry = $_POST['card_expiry'] ?? '';
    $card_cvv = $_POST['card_cvv'] ?? '';
    
    // In a real application, you would integrate with a payment gateway here
    // For this simple example, we'll just mark the payment as completed
    
    // Generate a fake transaction ID
    $transaction_id = 'txn_' . time() . rand(1000, 9999);
    
    // Update session payment status
    query("UPDATE sessions SET payment_status = 'paid' WHERE id = '$session_id'");
    
    // Insert payment record
    query("INSERT INTO payments (session_id, amount, payment_status, payment_method, transaction_id, notes) 
           VALUES ('$session_id', '$total_amount', 'completed', '$payment_method', '$transaction_id', 'Payment for session with {$session['tutor_name']}')");
    
    // Redirect to success message
    header('Location: message.php?text=Payment successful! Your session has been confirmed. <a href="feed.php">Back to Feed</a>');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <script src="js/tailwind.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <title>Payment - SkillShare</title>
</head>

<body data-spy="scroll" data-target=".fixed-top" class="bg-gray-100">
    <!-- Navigation -->
    <nav class="navbar fixed-top">
        <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">

            <!-- Image Logo -->

            <a href="/">
                <div class="flex items-center">
                    <i class="fa fa-rocket fa-2x mr-2"></i>
                    <div class="text-gray-800 font-semibold text-3xl leading-4">SkillShare</div>
                </div>
            </a>

            <button class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400"
                type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row gap-2">
                    <li>
                        <a class="nav-link page-scroll" href="feed.php">Feed</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li>
                            <a class="nav-link page-scroll" href="profile.php">Profile</a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="profile.php">
                                <div class="flex items-center gap-2">
                                    <i class="fa fa-user flex"></i>
                                    <?php echo $_SESSION['user']['name']; ?>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a class="nav-link page-scroll" href="login.php">Login</a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <div class="py-12"></div>

    <div class="flex items-center justify-center min-h-[70vh] p-4">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-semibold text-center mb-4">Payment for Session</h2>
            
            <div class="mb-6 bg-gray-100 p-4 rounded-lg">
                <h3 class="font-semibold text-lg mb-2">Session Details</h3>
                <p><strong>Tutor:</strong> <?php echo $session['tutor_name']; ?></p>
                <p><strong>Skill:</strong> <?php echo $session['skill_name']; ?></p>
                <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($session['session_date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($session['session_time'])); ?></p>
                <p><strong>Duration:</strong> <?php echo $session['duration']; ?> minutes</p>
                <p><strong>Hourly Rate:</strong> $<?php echo number_format($hourly_rate, 2); ?></p>
                <p class="font-bold mt-2">Total Amount: $<?php echo number_format($total_amount, 2); ?></p>
            </div>
            
            <form method="POST" action="payment.php?session_id=<?php echo $session_id; ?>">
                <div class="mb-4">
                    <label for="payment_method" class="block text-gray-700 text-sm font-semibold mb-2">Payment Method *</label>
                    <select id="payment_method" name="payment_method" 
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                
                <div id="credit_card_fields">
                    <div class="mb-4">
                        <label for="card_number" class="block text-gray-700 text-sm font-semibold mb-2">Card Number *</label>
                        <input type="text" id="card_number" name="card_number" 
                            class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500"
                            placeholder="1234 5678 9012 3456">
                    </div>
                    
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label for="card_expiry" class="block text-gray-700 text-sm font-semibold mb-2">Expiry Date *</label>
                            <input type="text" id="card_expiry" name="card_expiry" 
                                class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500"
                                placeholder="MM/YY">
                        </div>
                        <div class="w-1/2">
                            <label for="card_cvv" class="block text-gray-700 text-sm font-semibold mb-2">CVV *</label>
                            <input type="text" id="card_cvv" name="card_cvv" 
                                class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500"
                                placeholder="123">
                        </div>
                    </div>
                </div>
                
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-4">
                    Pay $<?php echo number_format($total_amount, 2); ?>
                </button>
                
                <div class="text-center mt-6">
                    <a href="feed.php" class="text-blue-500 hover:underline">Cancel and return to feed</a>
                </div>
                
                <p class="text-gray-600 text-xs text-center mt-4">
                    By clicking Pay, you agree to the SkillShare
                    <a href="#" class="text-blue-500 hover:underline">Terms and Conditions</a>.
                </p>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for JavaScript plugins -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script>
        // Simple script to toggle payment method fields
        document.getElementById('payment_method').addEventListener('change', function() {
            const creditCardFields = document.getElementById('credit_card_fields');
            if (this.value === 'credit_card') {
                creditCardFields.style.display = 'block';
            } else {
                creditCardFields.style.display = 'none';
            }
        });
    </script>
</body>

</html>