<?php


if ($_SERVER['HTTP_HOST'] == 'share.liveblog365.com')
    $conn = new mysqli('sql100.ezyro.com', 'ezyro_37285465', 'b529bd163d7', 'ezyro_37285465_skillshare');
else
    $conn = new mysqli('localhost', 'root', '', 'skillshare');

function query($q)
{
    global $conn;
    $result = $conn->query($q);
    if (is_bool($result))
        return $result;
    return $result->fetch_all(MYSQLI_ASSOC);
}



?>