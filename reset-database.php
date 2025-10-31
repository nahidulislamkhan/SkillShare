<?php


set_exception_handler(function ($exception) {
    echo '' . $exception;
});

if ($_SERVER['HTTP_HOST'] == 'share.liveblog365.com')
    $conn = new mysqli('sql100.ezyro.com', 'ezyro_37285465', 'b529bd163d7', 'ezyro_37285465_skillshare');
else {
    $conn = new mysqli('localhost', 'root', '');
    $conn->query('CREATE DATABASE IF NOT EXISTS skillshare');
    $conn->query('USE skillshare');
}

$conn->multi_query(file_get_contents('query.txt'));
echo 'Database reset successfully!';


?>