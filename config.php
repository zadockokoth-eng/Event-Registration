<?php
// config.php
// Connects to the database. Every page that needs data includes this file.
// If your MySQL password is not empty, change $password below.

$host     = "localhost";
$username = "root";
$password = "";
$database = "club_board";

// Turn off PHP's automatic exceptions so our own message below is shown
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect($host, $username, $password, $database);

// If the connection fails, stop and show the reason
if (!$conn) {
    die("Could not connect to the database: " . mysqli_connect_error());
}
