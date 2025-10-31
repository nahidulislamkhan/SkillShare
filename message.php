<?php
session_start();

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

    <title>Message - SkillShare</title>
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
                            <a class="nav-link page-scroll" href="feed.php">Feed</a>
                        </li>
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

    <div class="py-8"></div>

    <div class="w-full max-w-2xl flex flex-col mx-auto gap-4 p-4">

        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-white shadow w-full mx-auto max-w-xl"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-bold">Info: </span><?php echo $_GET['text']; ?>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for JavaScript plugins -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>