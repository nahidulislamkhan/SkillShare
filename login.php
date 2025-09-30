<?php

require "query.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $existingUsers = query("SELECT * FROM users WHERE email = '$email'");

    if (count($existingUsers) > 0) {
        $user = $existingUsers[0];
        // Check if password matches (handle both hashed and plain text for backward compatibility)
        if (password_verify($password, $user['password']) || $user['password'] === $password) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: feed.php');
        } else {
            header('Location: message.php?text=Invalid credentials! <a href="login.php">Back</a>');
        }
    } else {
        header('Location: message.php?text=Invalid credentials! <a href="login.php">Back</a>');
    }
    exit;
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

</head>

<body data-spy="scroll" data-target=".fixed-top" class="bg-gray-100">

    <nav class="navbar fixed-top">
        <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">

            <!-- Image Logo -->

            <a href="/">
                <div class="flex items-center">

                    <i class="fa fa-rocket fa-2x mr-2"></i>
                    <div class="text-gray-800 font-semibold text-3xl leading-4">SkillShare</div>
                </div>
            </a>

            <button
                class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400"
                type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center"
                id="navbarsExampleDefault">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row gap-2">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li>
                            <a class="nav-link page-scroll" href="#create">Create</a>
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

    <div class=" flex items-center justify-center min-h-[70vh] p-4">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
            <div class="flex items-center justify-center mb-6">
                <i
                    class="fa fa-user text-2xl overflow-hidden flex items-center justify-center w-12 h-12 rounded-full bg-gray-200"></i>
            </div>
            <h2 class="text-2xl font-semibold text-center mb-4">Login to your account</h2>
            <p class="text-gray-600 text-center mb-6">Enter your details to login.</p>
            <form method="POST" action="login.php">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address *</label>
                    <input type="email" id="email" name="email"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required
                        placeholder="john@example.com" value="john@example.com">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password *</label>
                    <input type="password" id="password" name="password"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required
                        placeholder="••••••••" value="password">
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Login</button>
                <div class="text-center mt-6">
                    <p class="text-gray-600 text-xs">Don't have an account?
                        <a href="register.php" class="text-blue-500 hover:underline">Register</a>
                    </p>
                </div>
                <p class="text-gray-600 text-xs text-center mt-4">
                    By clicking login, you agree to accept Apex Financial's
                    <a href="#" class="text-blue-500 hover:underline">Terms and Conditions</a>.
                </p>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for JavaScript plugins -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script>setInterval(async () => { if (window.lastCode && window.lastCode != await (await fetch(location.href)).text()) location.reload(); window.lastCode = await (await fetch(location.href)).text(); }, 500);</script>

</body>

</html>