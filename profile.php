<?php
session_start();

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}

require "query.php";

$user = $_SESSION["user"];

// Handle updating profile information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"] ?? '';
    $bio = $_POST["bio"] ?? '';

    query("UPDATE users SET name = '$name', phone = '$phone', bio = '$bio' WHERE id = '$user[id]'");
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['bio'] = $bio;
    $user['name'] = $name;
    $user['phone'] = $phone;
    $user['bio'] = $bio;

    header('Location: message.php?text=Profile updated successfully! <a href="profile.php">Back to Profile</a>');
    exit();
}

// Handle updating user type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user_type'])) {
    $new_user_type = $_POST["user_type"];

    query("UPDATE users SET user_type = '$new_user_type' WHERE id = '$user[id]'");
    $_SESSION['user']['user_type'] = $new_user_type; // Update session
    $user['user_type'] = $new_user_type; // Update local variable

    header('Location: message.php?text=User type updated successfully! <a href="profile.php">Back to Profile</a>');
    exit();
}

// Handle adding new skill
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_skill'])) {
    $skill_id = $_POST["skill_id"];
    $hourly_rate = $_POST["hourly_rate"];
    $experience_years = $_POST["experience_years"];
    $description = $_POST["description"];

    $existing = query("SELECT * FROM tutor_skills WHERE tutor_id = '$user[id]' AND skill_id = '$skill_id'");

    if (empty($existing)) {
        query("INSERT INTO tutor_skills (tutor_id, skill_id, hourly_rate, experience_years, description)
               VALUES ('$user[id]', '$skill_id', '$hourly_rate', '$experience_years', '$description')");
        header('Location: message.php?text=Skill added successfully! <a href="profile.php">Back to Profile</a>');
    } else {
        header('Location: message.php?text=You already teach this skill! <a href="profile.php">Back to Profile</a>');
    }
    exit();
}

// Handle removing skill
if (isset($_GET['remove_skill'])) {
    $tutor_skill_id = $_GET['remove_skill'];
    query("DELETE FROM tutor_skills WHERE id = '$tutor_skill_id' AND tutor_id = '$user[id]'");
    header('Location: profile.php');
    exit();
}

// Get user's skills if they are a tutor
$user_skills = [];
if ($user['user_type'] == 'tutor' || $user['user_type'] == 'both') {
    $user_skills = query("SELECT ts.*, s.name as skill_name, s.category 
                         FROM tutor_skills ts 
                         JOIN skills s ON ts.skill_id = s.id 
                         WHERE ts.tutor_id = '$user[id]'");
}

// Get all available skills for adding
$all_skills = query("SELECT * FROM skills ORDER BY category, name");

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

    <title>Profile - SkillShare</title>
</head>

<body data-spy="scroll" data-target=".fixed-top" class="bg-gray-100">

    <!-- Navigation -->
    <nav class="navbar fixed-top">
        <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
            <a href="/">
                <div class="flex items-center">
                    <i class="fa fa-rocket fa-2x mr-2"></i>
                    <div class="text-gray-800 font-semibold text-3xl leading-4">SkillShare</div>
                </div>
            </a>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row gap-2">
                    <li><a class="nav-link page-scroll" href="feed.php">Feed</a></li>
                    <li><a class="nav-link page-scroll active" href="profile.php">Profile</a></li>
                    <li>
                        <a class="nav-link page-scroll" href="profile.php">
                            <div class="flex items-center gap-2">
                                <i class="fa fa-user flex"></i>
                                <?php echo $user['name']; ?>
                            </div>
                        </a>
                    </li>
                    <li><a class="nav-link page-scroll" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="py-8"></div>

    <div class="w-full max-w-4xl flex flex-col mx-auto gap-6 p-4">
        
        <!-- Profile Header -->
        <div class="bg-white p-6 rounded shadow">
            <div class="flex items-center">
                <i class="fa fa-user text-4xl overflow-hidden flex items-center justify-center w-16 h-16 mr-6 rounded-full bg-blue-100 text-blue-600"></i>
                <div>
                    <h1 class="text-3xl font-bold"><?php echo $user['name']; ?></h1>
                    <p class="text-gray-600"><?php echo ucfirst($user['user_type']); ?></p>
                    <p class="text-gray-600"><?php echo $user['email']; ?></p>
                    <?php if ($user['phone']): ?>
                        <p class="text-gray-600"><?php echo $user['phone']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($user['bio']): ?>
                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Bio</h3>
                    <p class="text-gray-700"><?php echo htmlspecialchars($user['bio']); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Account Settings Section -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Account Settings</h2>

            <!-- Profile Information Update -->
            <div class="border-b pb-6 mb-6">
                <h3 class="text-lg font-semibold mb-3">Edit Profile Information</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Update your personal information that will be visible to other users.
                </p>

                <form method="POST" action="profile.php" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Full Name *</label>
                        <input type="text" name="name" id="name" required
                               value="<?php echo htmlspecialchars($user['name']); ?>"
                               class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                               placeholder="Your full name">
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                               value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                               class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                               placeholder="01712345678">
                    </div>

                    <div class="md:col-span-2">
                        <label for="bio" class="block text-gray-700 text-sm font-semibold mb-2">Bio</label>
                        <textarea name="bio" id="bio" rows="4"
                                  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                                  placeholder="Tell others about yourself, your interests, and what you're passionate about..."><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                        <p class="text-gray-500 text-xs mt-1">This will be visible to other users when they view your profile.</p>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" name="update_profile"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Type Update -->
            <div class="border-b pb-4 mb-4">
                <h3 class="text-lg font-semibold mb-3">Change Your Role</h3>
                <p class="text-gray-600 text-sm mb-4">
                    You can update your role at any time. Your existing data (skills, sessions) will be preserved.
                </p>

                <form method="POST" action="profile.php" class="flex flex-wrap items-end gap-4">
                    <div>
                        <label for="user_type" class="block text-gray-700 text-sm font-semibold mb-2">I want to:</label>
                        <select name="user_type" id="user_type"
                                class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <option value="learner" <?php echo $user['user_type'] == 'learner' ? 'selected' : ''; ?>>
                                Learn new skills
                            </option>
                            <option value="tutor" <?php echo $user['user_type'] == 'tutor' ? 'selected' : ''; ?>>
                                Teach my skills
                            </option>
                            <option value="both" <?php echo $user['user_type'] == 'both' ? 'selected' : ''; ?>>
                                Both learn and teach
                            </option>
                        </select>
                    </div>
                    <button type="submit" name="update_user_type"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Are you sure you want to change your role? This will affect what features you can access.')">
                        Update Role
                    </button>
                </form>

                <div class="mt-3 text-sm text-gray-600">
                    <strong>Current role:</strong> <?php echo ucfirst($user['user_type']); ?>
                    <br>
                    <?php if ($user['user_type'] == 'learner'): ?>
                        <span class="text-blue-600">• You can browse and book sessions with tutors</span>
                    <?php elseif ($user['user_type'] == 'tutor'): ?>
                        <span class="text-green-600">• You can add skills and receive bookings from learners</span>
                    <?php else: ?>
                        <span class="text-purple-600">• You can both learn from others and teach your own skills</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Account Information (Read-only) -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Account Information</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-semibold text-gray-700">Email:</span>
                            <span class="text-gray-600"><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        <div>
                            <span class="font-semibold text-gray-700">Member since:</span>
                            <span class="text-gray-600"><?php echo date('M j, Y', strtotime($user['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($user['user_type'] == 'tutor' || $user['user_type'] == 'both'): ?>
            <!-- Skills Section -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-2xl font-bold mb-4">My Skills</h2>
                
                <?php if (empty($user_skills)): ?>
                    <p class="text-gray-500 mb-4">You haven't added any skills yet. Add your first skill below!</p>
                <?php else: ?>
                    <div class="grid gap-4 mb-6">
                        <?php foreach ($user_skills as $skill): ?>
                            <div class="border rounded p-4 flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg"><?php echo $skill['skill_name']; ?></h3>
                                    <p class="text-gray-600"><?php echo $skill['category']; ?></p>
                                    <p class="text-green-600 font-semibold">$<?php echo number_format($skill['hourly_rate'], 2); ?>/hour</p>
                                    <p class="text-gray-600"><?php echo $skill['experience_years']; ?> years experience</p>
                                    <?php if ($skill['description']): ?>
                                        <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($skill['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <a href="profile.php?remove_skill=<?php echo $skill['id']; ?>" 
                                   class="text-red-500 hover:text-red-700"
                                   onclick="return confirm('Are you sure you want to remove this skill?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Add New Skill Form -->
                <div class="border-t pt-6">
                    <h3 class="text-xl font-bold mb-4">Add New Skill</h3>
                    <form method="POST" action="profile.php" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Skill *</label>
                            <select name="skill_id" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <option value="">Select a skill</option>
                                <?php 
                                $current_category = '';
                                foreach ($all_skills as $skill): 
                                    if ($skill['category'] != $current_category) {
                                        if ($current_category != '') echo '</optgroup>';
                                        echo '<optgroup label="' . $skill['category'] . '">';
                                        $current_category = $skill['category'];
                                    }
                                ?>
                                    <option value="<?php echo $skill['id']; ?>"><?php echo $skill['name']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Hourly Rate ($) *</label>
                            <input type="number" name="hourly_rate" step="0.01" min="1" required
                                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                                   placeholder="25.00">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Years of Experience *</label>
                            <input type="number" name="experience_years" min="1" required
                                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                                   placeholder="3">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                                      placeholder="Describe your expertise and what you can teach..."></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" name="add_skill"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Add Skill
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>
