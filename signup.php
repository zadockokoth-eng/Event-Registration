<?php
// signup.php - the sign-up form.
// The same file shows the form AND saves it when the form is sent.

include "config.php";

$page_title   = "Sign Up";
$current_page = "signup";

$message = "";          // text shown to the user after submitting
$message_type = "";   