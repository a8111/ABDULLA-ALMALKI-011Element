<?php

//db connection params
$servername = "localhost:8889";
$dbusername = "root";
$password = "root";
$dbname = "flights";

// Create new connection
$connection = mysqli_connect($servername, $dbusername, $password, $dbname);

// Confirm valid connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>