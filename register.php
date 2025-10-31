<?php

require "query.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'] ?? '';
    $user_type = $_POST['user_type'] ?? 'learner';
    $bio = $_POST['bio'] ?? '';

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $existingUsers = query("SELECT * FROM users WHERE email = '$email'");

    if (count($existingUsers) > 0) {
        header('Location: message.php?text=User already exists! <a href="register.php">Back</a>');
    } else {
        query("INSERT INTO users (name, email, password, phone, user_type, bio) VALUES ('$name', '$email', '$hashed_password', '$phone', '$user_type', '$bio')");
        session_start();
        $_SESSION['user'] = query("SELECT * FROM users WHERE email = '$email'")[0];
        header('Location: message.php?text=Registered successfully! <a href="feed.php">Home</a>');
    }
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
                            <a class="nav-link page-scroll">
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
            <h2 class="text-2xl font-semibold text-center mb-4">Create a new account</h2>
            <p class="text-gray-600 text-center mb-6">Enter your details to register.</p>
            <form method="POST" action="register.php">
                <div class="mb-4">
                    <label for="fullName" class="block text-gray-700 text-sm font-semibold mb-2">Full Name *</label>
                    <input type="text" id="fullName" name="name"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required
                        placeholder="James Brown">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address *</label>
                    <input type="email" id="email" name="email"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required
                        placeholder="hello@skillshare.com">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500"
                        placeholder="01712345678">
                </div>
                <div class="mb-4">
                    <label for="user_type" class="block text-gray-700 text-sm font-semibold mb-2">I want to *</label>
                    <select id="user_type" name="user_type"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required>
                        <option value="learner">Learn new skills</option>
                        <option value="tutor">Teach my skills</option>
                        <option value="both">Both learn and teach</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700 text-sm font-semibold mb-2">Bio</label>
                    <textarea id="bio" name="bio" rows="3"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500"
                        placeholder="Tell us about yourself and your interests..."></textarea>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password *</label>
                    <input type="password" id="password" name="password"
                        class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required
                        placeholder="••••••••">
                    <p class="text-gray-600 text-xs mt-1">Must contain 1 uppercase letter, 1 number, min. 8 characters.
                    </p>
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Register</button>
                <div class="text-center mt-6">
                    <p class="text-gray-600 text-xs">already have an account?
                        <a href="login.php" class="text-blue-500 hover:underline">Login</a>
                    </p>
                </div>
                <p class="text-gray-600 text-xs text-center mt-4">
                    By clicking Register, you agree to accept Apex Financial's
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