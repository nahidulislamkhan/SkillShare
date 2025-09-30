<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <!-- Webpage Title -->
    <title>SkillShare Webpage Title</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <script src="js/tailwind.js"></script>

    <link href="css/swiper.css" rel="stylesheet" />
    <link href="css/magnific-popup.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.png" />
</head>

<body data-spy="scroll" data-target=".fixed-top">

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

            <button
                class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400"
                type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center"
                id="navbarsExampleDefault">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row gap-2">
                    <li>
                        <a class="nav-link page-scroll" href="feed.php">Home</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#features">Features</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#details">Details</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="#pricing">Pricing</a>
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
                <!-- <span class="block lg:ml-3.5">
                    <a class="no-underline" href="#your-link">
                        <i
                            class="fa fa-sign-out-alt text-indigo-600 hover:text-pink-500 text-xl transition-all duration-200 mr-1.5"></i>
                    </a>
                </span> -->
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
            <div class="mb-16 lg:mt-32 xl:mt-32 xl:mr-12">
                <h1 class="h1-large mb-5">Platform for Tutors and Learners</h1>
                <p class="p-large mb-8">A convenient platform for teachers and learners to connect, communicate and
                    collaborate effectively.</p>
                <a class="btn-solid-lg" href="login.php">Login</a>
                <a class="btn-solid-lg secondary" href="register.php">Register</a>
            </div>
            <div class="xl:text-right">
                <img class="inline" src="images/1.png" alt="alternative" />
            </div>
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Introduction -->
    <div class="pt-4 pb-14 text-center">
        <div class="container px-4 sm:px-8 xl:px-4">
            <p class="mb-4 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto">A convenient platform for
                teachers and learners to connect, communicate and collaborate effectively. Explore
                its features today.</p>
        </div> <!-- end of container -->
    </div>
    <!-- end of introduction -->


    <!-- Features -->
    <div id="features" class="cards-1">
        <div class="container px-4 sm:px-8 xl:px-4 flex flex-wrap gap-4 justify-center">
            <!-- Card -->
            <div class="p-6 shadow border rounded max-w-sm">
                <div class="card-image">
                    <img src="images/features-icon-1.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Find Tutors</h5>
                    <p class="mb-4">Find the best tutors for your skills and needs</p>
                </div>
            </div>
            <!-- end of card -->
            <!-- Card -->
            <div class="p-6 shadow border rounded max-w-sm">
                <div class="card-image">
                    <img src="images/features-icon-2.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Easy Learning</h5>
                    <p class="mb-4">Learn new skills with online courses and tutorials</p>
                </div>
            </div>
            <!-- end of card -->
            <!-- Card -->
            <div class="p-6 shadow border rounded max-w-sm">
                <div class="card-image">
                    <img src="images/features-icon-3.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Share Your Skills</h5>
                    <p class="mb-4">Teach others and earn money while sharing your knowledge and skills</p>
                </div>
            </div>
            <!-- end of card -->
            <!-- Card -->
            <div class="p-6 shadow border rounded max-w-sm">
                <div class="card-image">
                    <img src="images/features-icon-4.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Community Support</h5>
                    <p class="mb-4">Join a community of learners and tutors to help you on your learning journey</p>
                </div>
            </div>
            <!-- end of card -->
            <!-- Card -->
            <div class="p-6 shadow border rounded max-w-sm">
                <div class="card-image">
                    <img src="images/features-icon-5.svg" alt="alternative" />
                </div>
                <div class="card-body">
                    <h5 class="card-title">Personalized Learning</h5>
                    <p class="mb-4">Get personalized learning recommendations based on your skills and progress</p>
                </div>
            </div>
            <!-- end of card -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of features -->


    <!-- Details 1 -->
    <div id="details" class="pt-12 pb-16 lg:pt-16">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
            <div class="lg:col-span-5">
                <div class="mb-16 lg:mb-0 xl:mt-16">
                    <h2 class="mb-6">Sharing knowledge made easy</h2>
                    <p class="mb-4">Based on our team's extensive experience in developing educational applications
                        and constructive user feedback we reached a new level of user engagement.</p>
                    <p class="mb-4">We enjoy helping individual learners and educators take a shot at sharing their
                        knowledge with the community</p>
                </div>
            </div> <!-- end of col -->
            <div class="lg:col-span-7">
                <div class="xl:ml-14">
                    <img class="inline" src="images/details-1.jpg" alt="alternative" />
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of container -->
    </div>
    <!-- end of details 1 -->


    <!-- Details 2 -->
    <div class="py-24">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
            <div class="lg:col-span-7">
                <div class="mb-12 lg:mb-0 xl:mr-14">
                    <img class="inline" src="images/details-2.jpg" alt="alternative" />
                </div>
            </div> <!-- end of col -->
            <div class="lg:col-span-5">
                <div class="xl:mt-12">
                    <h2 class="mb-6">Learn and share with ease</h2>
                    <ul class="list mb-7 space-y-2">
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Features that will help you and your students</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Easy learning curve due to the tutorials and guides</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Ready out-of-the-box with minor setup settings</div>
                        </li>
                    </ul>
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of container -->
    </div>
    <!-- end of details 2 -->

    <!-- Details Lightbox -->
    <!-- Lightbox -->
    <div id="details-lightbox" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="lg:col-span-8">
                <div class="mb-12 text-center lg:mb-0 lg:text-left xl:mr-6">
                    <img class="inline rounded-lg" src="images/details-lightbox.jpg" alt="alternative" />
                </div>
            </div> <!-- end of col -->
            <div class="lg:col-span-4">
                <h3 class="mb-2">Goals Setting</h3>
                <hr class="w-11 h-0.5 mt-0.5 mb-4 ml-0 border-none bg-indigo-600" />
                <p>The app can easily help you track your personal development evolution if you take the time to set it
                    up.</p>
                <h4 class="mt-7 mb-2.5">User Feedback</h4>
                <p class="mb-4">This is a great app which can help you save time and make your live easier. And it will
                    help improve your productivity.</p>
                <ul class="list mb-6 space-y-2">
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Splash screen panel</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Statistics graph report</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Events calendar layout</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Location details screen</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Onboarding steps interface</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Share your skills</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Community support</div>
                    </li>
                    <li class="flex">
                        <i class="fas fa-chevron-right"></i>
                        <div>Personalized learning</div>
                    </li>
                </ul>
                <a class="btn-solid-reg mfp-close page-scroll" href="#download">Download</a>
                <button class="btn-outline-reg mfp-close as-button" type="button">Back</button>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of lightbox-basic -->
    <!-- end of lightbox -->
    <!-- end of details lightbox -->

    <!-- Details 3 -->
    <div class="pt-16 pb-12">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
            <div class="lg:col-span-5">
                <div class="mb-16 lg:mb-0 xl:mt-16">
                    <h2 class="mb-6">Find the best tutors and courses</h2>
                    <p class="mb-4">Get a glimpse of what this app can do for your skill sharing and understand
                        why current users are so excited when using SkillShare
                        together with their teams.</p>
                    <p class="mb-4">We will promptly answer any questions and honor your requests based on the service
                        level agreement</p>
                </div>
            </div> <!-- end of col -->
            <div class="lg:col-span-7">
                <div class="ml-14">
                    <img class="inline" src="images/details-3.jpg" alt="alternative" />
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of container -->
    </div>
    <!-- end of details 3 -->


    <!-- Statistics -->
    <div class="counter">
        <div class="container px-4 sm:px-8">
            <!-- Counter -->
            <div id="counter">
                <div class="cell">
                    <div class="counter-value number-count" data-count="231">1</div>
                    <p class="counter-info">Tutors Found</p>
                </div>
                <div class="cell">
                    <div class="counter-value number-count" data-count="385">1</div>
                    <p class="counter-info">Courses Created</p>
                </div>
                <div class="cell">
                    <div class="counter-value number-count" data-count="159">1</div>
                    <p class="counter-info">Learners Enrolled</p>
                </div>
                <div class="cell">
                    <div class="counter-value number-count" data-count="127">1</div>
                    <p class="counter-info">Reviews Received</p>
                </div>
                <div class="cell">
                    <div class="counter-value number-count" data-count="211">1</div>
                    <p class="counter-info">Skills Shared</p>
                </div>
            </div>
            <!-- end of counter -->
        </div> <!-- end of container -->
    </div> <!-- end of counter -->
    <!-- end of statistics -->


    <!-- Testimonials -->
    <div class="slider-1 py-32 bg-gray">
        <div class="container px-4 sm:px-8">
            <h2 class="mb-12 text-center lg:max-w-xl lg:mx-auto">What do users think about SkillShare</h2>

            <!-- Card Slider -->
            <div class="slider-container">
                <div class="swiper-container card-slider">
                    <div class="swiper-wrapper" <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-1.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">I've been using SkillShare for the past weeks and I have to
                                        say that it's been a game changer for me. I've been able to share my skills with
                                        people all over the world and get help from others when I need it</p>
                                    <p class="testimonial-author">Jude Thorn - Developer</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-2.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">I've been using SkillShare to find tutors for my children and
                                        I have to say that it's been a lifesaver. The tutors are all very qualified and
                                        the app is very easy to use</p>
                                    <p class="testimonial-author">Roy Smith - Parent</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-3.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">I've been using SkillShare to teach my skills to others and I
                                        have to say that it's been a great experience. The app is very easy to use and
                                        the
                                        community is very supportive</p>
                                    <p class="testimonial-author">Marsha Singer - Tutor</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-4.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">SkillShare has been a game changer for me. I've been able to
                                        learn new skills and get help from others when I need it. The app is very easy
                                        to
                                        use and the community is very supportive</p>
                                    <p class="testimonial-author">Tim Shaw - Learner</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-5.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">I've been using SkillShare to find people to help me with my
                                        projects and I have to say that it's been a lifesaver. The app is very easy to
                                        use
                                        and the community is very supportive</p>
                                    <p class="testimonial-author">Lindsay Spice - Project Manager</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                            <div class="card">
                                <img class="card-image" src="images/testimonial-6.jpg" alt="alternative" />
                                <div class="card-body">
                                    <p class="italic mb-3">The app support team is amazing. They've helped me with some
                                        issues and I am so grateful to the entire team</p>
                                    <p class="testimonial-author">Ann Blake - Learner</p>
                                </div>
                            </div>
                        </div> <!-- end of swiper-slide -->
                        <!-- end of slide -->
                    </div> <!-- end of swiper-wrapper -->

                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <!-- end of add arrows -->

                </div> <!-- end of swiper-container -->
            </div> <!-- end of slider-container -->
            <!-- end of card slider -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of testimonials -->


    <!-- Pricing -->
    <div id="pricing" class="cards-2">
        <div class="absolute bottom-0 h-40 w-full bg-white"></div>
        <div class="container px-4 pb-px sm:px-8">
            <h2 class="mb-2.5 text-white lg:max-w-xl lg:mx-auto">Pricing plans that fit your needs</h2>
            <p class="mb-16 text-white lg:max-w-3xl lg:mx-auto"> Our pricing plans are designed to help you learn and
                teach
                without worrying about costs. They are flexible and work for any type of skill </p>

            <!-- Card-->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">STANDARD</div>
                    <div class="price"><span class="currency">$</span><span class="value">29</span></div>
                    <div class="frequency">monthly</div>
                    <p>This basic package covers the learning needs of small learners</p>
                    <ul class="list mb-7 space-y-2 text-left">
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Share skills</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Multiple devices</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Community support and videos</div>
                        </li>
                    </ul>
                    <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" href="#download">Purchase</a>
                    </div>
                </div>
            </div> <!-- end of card -->
            <!-- end of card -->
            <!-- Card-->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">ADVANCED</div>
                    <div class="price"><span class="currency">$</span><span class="value">39</span></div>
                    <div class="frequency">monthly</div>
                    <p>This is a more advanced package suited for medium learners</p>
                    <ul class="list mb-7 space-y-2 text-left">
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Share skills</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Multiple devices</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Community support and videos</div>
                        </li>
                    </ul>
                    <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" href="#download">Purchase</a>
                    </div>
                </div>
            </div> <!-- end of card -->
            <!-- end of card -->
            <!-- Card-->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">COMPLETE</div>
                    <div class="price"><span class="currency">$</span><span class="value">49</span></div>
                    <div class="frequency">monthly</div>
                    <p>This is a comprehensive package designed for big learners</p>
                    <ul class="list mb-7 text-left space-y-2">
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Share skills</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Multiple devices</div>
                        </li>
                        <li class="flex">
                            <i class="fas fa-chevron-right"></i>
                            <div>Community support and videos</div>
                        </li>
                    </ul>
                    <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" href="#download">Purchase</a>
                    </div>
                </div>
            </div> <!-- end of card -->
            <!-- end of card -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of pricing -->


    <!-- Conclusion -->
    <div id="download" class="basic-5">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2">
            <div class="mb-16 lg:mb-0">
                <img src="images/conclusion-smartphone.png" alt="alternative" />
            </div>
            <div class="lg:mt-24 xl:mt-44 xl:ml-12">
                <p class="mb-9 text-gray-800 text-3xl leading-10">Skill sharing platforms don’t get much
                    better than SkillShare. Download it today</p>
                <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Download</a>
                <a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Download</a>
            </div>
        </div> <!-- end of container -->
    </div> <!-- end of basic-5 -->
    <!-- end of conclusion -->


    <!-- Footer -->
    <div class="footer">
        <div class="container px-4 sm:px-8">
            <h4 class="mb-8 lg:max-w-3xl lg:mx-auto">SkillShare is a platform for sharing skills and you can
                reach the team at <a class="text-indigo-600 hover:text-gray-500"
                    href="mailto:email@domain.com">email@domain.com</a></h4>
            <div class="social-container">
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-pinterest-p fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-youtube fa-stack-1x"></i>
                    </a>
                </span>
            </div> <!-- end of social-container -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-3">
            <ul class="mb-4 list-unstyled p-small">
                <li class="mb-2"><a href="article.html">Article Details</a></li>
                <li class="mb-2"><a href="terms.html">Terms & Conditions</a></li>
                <li class="mb-2"><a href="privacy.html">Privacy Policy</a></li>
            </ul>
            <p class="pb-2 p-small statement">Copyright © <a href="#your-link" class="no-underline">2024</a></p>

            <p class="pb-2 p-small statement">Distributed by :<a href="https://themewagon.com/"
                    class="no-underline">Themewagon</a></p>
        </div>

        <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for JavaScript plugins -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script>setInterval(async () => { if (window.lastCode && window.lastCode != await (await fetch(location.href)).text()) location.reload(); window.lastCode = await (await fetch(location.href)).text(); }, 500);</script>

</body>

</html>