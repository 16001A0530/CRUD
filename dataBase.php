<?php
    $server = "localhost";
    $username = "root";
    $pwd = "";
    $dbname = "StudentDetails";
    $connection = new mysqli($server, $username, $pwd, $dbname);

    if(!$connection->connect_errno) {
        
    } else {
        echo $connection->error;
    }
?>