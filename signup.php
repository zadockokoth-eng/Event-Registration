<?php
// signup.php - the sign-up form.
// The same file shows the form AND saves it when the form is sent.

include "config.php";

$page_title   = "Sign Up";
$current_page = "signup";

$message = "";          // text shown to the user after submitting
$message_type = "";     // "success" or "error" (used for the colour)

// If the form was submitted (the browser sent POST data)...
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Read what the student typed (trim removes extra spaces)
    $student_name = trim($_POST['student_name']);
    $email        = trim($_POST['email']);
    $activity_id  = (int) $_POST['activity_id'];

    // Check the data (the server must always check, even if JavaScript did)
    if ($student_name == "" || $email == "" || $activity_id == 0) {
        $message = "Please fill in every field.";
        $message_type = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "That email address does not look right.";
        $message_type = "error";
    } else {
        // Save to the database. The ? marks are filled in safely below.
        $stmt = mysqli_prepare($conn, "INSERT INTO signups (student_name, email, activity_id) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $student_name, $email, $activity_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Thank you, " . htmlspecialchars($student_name) . "! You are signed up.";
            $message_type = "success";
        } else {
            $message = "Sorry, something went wrong. Please try again.";
            $message_type = "error";
        }
    }