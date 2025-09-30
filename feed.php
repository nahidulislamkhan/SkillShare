<?php
session_start();

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}

require "query.php";

// Handle session booking
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_session'])) {
    $tutor_skill_id = $_POST["tutor_skill_id"];
    $session_date = $_POST["session_date"];
    $session_time = $_POST["session_time"];
    $duration = $_POST["duration"] ?? 60;
    $notes = $_POST["notes"] ?? '';
    $user = $_SESSION["user"];

    // Get tutor and skill info from tutor_skills table
    $tutor_skill = query("SELECT * FROM tutor_skills WHERE id = '$tutor_skill_id'")[0];

    $results = query("INSERT INTO sessions (tutor_id, learner_id, skill_id, session_date, session_time, duration, notes, payment_status)
                     VALUES ('$tutor_skill[tutor_id]', '$user[id]', '$tutor_skill[skill_id]', '$session_date', '$session_time', '$duration', '$notes', 'unpaid')");

    if (!isset($results)) {
        header('Location: message.php?text=Failed to book session! <a href="feed.php">Back</a>');
    } else {
        // Get the ID of the newly created session
        $new_session_id = $conn->insert_id;
        // Redirect to payment page
        header('Location: payment.php?session_id=' . $new_session_id);
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
                        <a class="nav-link page-scroll active" href="feed.php">Feed</a>
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
    <!-- end of navigation -->
    <div class="py-8"></div>


    <div class="w-full max-w-4xl flex flex-col mx-auto gap-4 p-4">

        <div class="text-3xl font-bold">
            Find Tutors & Skills
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded shadow">
            <div class="flex flex-wrap gap-4 items-center">
                <div>
                    <label for="category-filter" class="block text-gray-700 text-sm font-semibold mb-2">Category</label>
                    <select id="category-filter" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="">All Categories</option>
                        <option value="Technology">Technology</option>
                        <option value="Business">Business</option>
                        <option value="Arts">Arts</option>
                        <option value="Languages">Languages</option>
                        <option value="Music">Music</option>
                        <option value="Communication">Communication</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Health & Fitness">Health & Fitness</option>
                        <option value="Education">Education</option>
                    </select>
                </div>
                <div>
                    <label for="skill-search" class="block text-gray-700 text-sm font-semibold mb-2">Search Skills</label>
                    <input type="text" id="skill-search" placeholder="Search for skills..."
                           class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <div class="text-2xl font-bold">Available Tutors</div>

            <label for="my-sessions" class="inline-flex relative items-center cursor-pointer">
                <input type="checkbox" id="my-sessions" name="my" value="1" class="sr-only peer"
                    onchange="if (this.checked) window.location.href = 'feed.php?my=true'; else window.location.href = 'feed.php';"
                    <?php echo isset($_GET['my']) ? 'checked' : ''; ?>>
                <div
                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
                <span class="ml-2 text-sm font-medium text-gray-900 font-semibold">My Sessions</span>
            </label>
        </div>



        <?php

        if (isset($_GET['my'])) {
            // Show user's sessions
            $sessions = query("SELECT s.*, sk.name as skill_name, sk.category,
                              t.name as tutor_name, t.email as tutor_email, t.phone as tutor_phone,
                              l.name as learner_name,
                              ts.hourly_rate
                              FROM sessions s
                              JOIN skills sk ON s.skill_id = sk.id
                              JOIN users t ON s.tutor_id = t.id
                              JOIN users l ON s.learner_id = l.id
                              LEFT JOIN tutor_skills ts ON s.tutor_id = ts.tutor_id AND s.skill_id = ts.skill_id
                              WHERE s.learner_id = " . $_SESSION['user']['id'] . " OR s.tutor_id = " . $_SESSION['user']['id'] . "
                              ORDER BY s.session_date DESC, s.session_time DESC");

            if (empty($sessions)) {
                echo '<div class="bg-white p-8 rounded shadow text-center text-gray-500">
                        <i class="fa fa-calendar-alt text-4xl mb-4"></i>
                        <p>No sessions booked yet. Browse available tutors to book your first session!</p>
                      </div>';
            }

            foreach ($sessions as $session) {
                $is_tutor = $session['tutor_id'] == $_SESSION['user']['id'];
                $other_user = $is_tutor ? $session['learner_name'] : $session['tutor_name'];
                $role = $is_tutor ? 'Teaching' : 'Learning';

                $status_colors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'confirmed' => 'bg-blue-100 text-blue-800',
                    'completed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800'
                ];
                ?>

                <div class="bg-white p-4 rounded shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <i class="fa fa-graduation-cap text-2xl overflow-hidden flex items-center justify-center w-12 h-12 mr-4 rounded-full bg-blue-100 text-blue-600"></i>
                            <div>
                                <div class="font-bold"><?php echo $session['skill_name']; ?></div>
                                <div class="text-gray-600"><?php echo $role . ' with ' . $other_user; ?></div>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo $status_colors[$session['status']]; ?>">
                            <?php echo ucfirst($session['status']); ?>
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-semibold">Date:</span> <?php echo date('M j, Y', strtotime($session['session_date'])); ?>
                        </div>
                        <div>
                            <span class="font-semibold">Time:</span> <?php echo date('g:i A', strtotime($session['session_time'])); ?>
                        </div>
                        <div>
                            <span class="font-semibold">Duration:</span> <?php echo $session['duration']; ?> minutes
                        </div>
                        <div>
                            <span class="font-semibold">Category:</span> <?php echo $session['category']; ?>
                        </div>
                    </div>

                    <?php if ($session['notes']): ?>
                        <div class="mt-3">
                            <span class="font-semibold">Notes:</span> <?php echo htmlspecialchars($session['notes']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!$is_tutor): ?>
                        <div class="mt-3 text-sm text-gray-600">
                            <span class="font-semibold">Contact:</span> <?php echo $session['tutor_email']; ?>
                            <?php if ($session['tutor_phone']): ?>
                                | <?php echo $session['tutor_phone']; ?>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ((!isset($session['payment_status']) || $session['payment_status'] == 'unpaid') && ($session['status'] == 'pending' || $session['status'] == 'confirmed')): ?>
                            <div class="mt-3">
                                <a href="payment.php?session_id=<?php echo $session['id']; ?>" 
                                   class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm">
                                    Pay Now
                                </a>
                            </div>
                        <?php elseif (isset($session['payment_status']) && $session['payment_status'] == 'paid'): ?>
                            <div class="mt-3">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Payment Completed
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($is_tutor): ?>
                        <?php if ((isset($session['payment_status']) && $session['payment_status'] == 'paid') || $session['status'] == 'completed'): ?>
                            <div class="mt-3">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Payment Completed
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($session['payment_status']) && $session['payment_status'] == 'unpaid'): ?>
                            <div class="mt-3">
                                <span class="px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Payment Pending
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php
            }
        } else {
            // Show available tutors and their skills
            $tutor_skills = query("SELECT ts.*, s.name as skill_name, s.category, s.description as skill_description,
                                  u.name as tutor_name, u.bio, u.email, u.phone,
                                  AVG(r.rating) as avg_rating, COUNT(r.id) as review_count
                                  FROM tutor_skills ts
                                  JOIN skills s ON ts.skill_id = s.id
                                  JOIN users u ON ts.tutor_id = u.id
                                  LEFT JOIN sessions sess ON ts.tutor_id = sess.tutor_id AND ts.skill_id = sess.skill_id
                                  LEFT JOIN reviews r ON sess.id = r.session_id AND r.reviewed_id = ts.tutor_id
                                  WHERE ts.tutor_id != " . $_SESSION['user']['id'] . "
                                  GROUP BY ts.id
                                  ORDER BY avg_rating DESC, ts.hourly_rate ASC");

            if (empty($tutor_skills)) {
                echo '<div class="bg-white p-8 rounded shadow text-center text-gray-500">
                        <i class="fa fa-users text-4xl mb-4"></i>
                        <p>No tutors available at the moment. Check back later!</p>
                      </div>';
            }

            foreach ($tutor_skills as $tutor_skill) {
                ?>
                <div class="bg-white p-6 rounded shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start">
                            <i class="fa fa-user-graduate text-2xl overflow-hidden flex items-center justify-center w-12 h-12 mr-4 rounded-full bg-green-100 text-green-600"></i>
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-bold text-lg"><?php echo $tutor_skill['tutor_name']; ?></h3>
                                    <?php if ($tutor_skill['avg_rating']): ?>
                                        <div class="flex items-center text-yellow-500">
                                            <i class="fa fa-star text-sm"></i>
                                            <span class="text-sm ml-1"><?php echo number_format($tutor_skill['avg_rating'], 1); ?></span>
                                            <span class="text-gray-500 text-sm ml-1">(<?php echo $tutor_skill['review_count']; ?>)</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-blue-600 font-semibold"><?php echo $tutor_skill['skill_name']; ?></div>
                                <div class="text-gray-600 text-sm mb-2"><?php echo $tutor_skill['category']; ?></div>
                                <?php if ($tutor_skill['bio']): ?>
                                    <p class="text-gray-700 text-sm mb-2"><?php echo htmlspecialchars($tutor_skill['bio']); ?></p>
                                <?php endif; ?>
                                <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($tutor_skill['description']); ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-green-600">$<?php echo number_format($tutor_skill['hourly_rate'], 2); ?></div>
                            <div class="text-gray-500 text-sm">per hour</div>
                            <div class="text-gray-500 text-sm"><?php echo $tutor_skill['experience_years']; ?> years exp.</div>
                        </div>
                    </div>

                    <!-- Book Session Form -->
                    <div class="mt-4 pt-4 border-t">
                        <form method="POST" action="feed.php" class="flex flex-wrap gap-3 items-end">
                            <input type="hidden" name="tutor_skill_id" value="<?php echo $tutor_skill['id']; ?>">
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-1">Date</label>
                                <input type="date" name="session_date" required min="<?php echo date('Y-m-d'); ?>"
                                       class="px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-1">Time</label>
                                <input type="time" name="session_time" required
                                       class="px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-1">Duration</label>
                                <select name="duration" class="px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    <option value="60">1 hour</option>
                                    <option value="90">1.5 hours</option>
                                    <option value="120">2 hours</option>
                                </select>
                            </div>
                            <div class="flex-grow">
                                <label class="block text-gray-700 text-sm font-semibold mb-1">Notes (optional)</label>
                                <input type="text" name="notes" placeholder="What would you like to learn?"
                                       class="w-full px-3 py-2 border rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                            <button type="submit" name="book_session"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Book Session
                            </button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for JavaScript plugins -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <script>setInterval(async () => { if (window.lastCode && window.lastCode != await (await fetch(location.href)).text()) location.reload(); window.lastCode = await (await fetch(location.href)).text(); }, 500);</script>

</body>

</html>