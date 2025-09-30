<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

header('Location: message.php?text=Logged Out Successfully! <a href="login.php">Login</a>');

?>