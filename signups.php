<?php
// signups.php - shows everyone who has signed up.

include "config.php";

$page_title   = "Who Joined";
$current_page = "signups";
include "header.php";

// Join the two tables so we can show the activity NAME instead of its number
$sql = "SELECT signups.student_name, signups.email, signups.signed_up_at, activities.title
        FROM signups
        JOIN activities ON signups.activity_id = activities.id
        ORDER BY signups.signed_up_at DESC";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
?>