<?php 

    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "ce056";

    $link = mysqli_connect($server, $username, $password, $db_name);

    if (!$link)
    {
        die("connection failed");
    }

?>