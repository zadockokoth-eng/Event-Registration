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
}

// If we came from the dashboard button, ?activity=3 pre-selects that activity
$chosen = 0;
if (isset($_GET['activity'])) {
    $chosen = (int) $_GET['activity'];
}

// Get the activities for the drop-down list
$activities = mysqli_query($conn, "SELECT id, title, activity_date FROM activities ORDER BY activity_date");

include "header.php";
?>

<h2>Sign Up for an Activity</h2>
<p class="subtitle">Fill in the form and pick an activity.</p>

<?php if ($message != "") { ?>
    <div class="message <?php echo $message_type; ?>"><?php echo $message; ?></div>
<?php } ?>

<!-- Space for JavaScript messages (see script.js) -->
<div id="js-error" class="message error" style="display:none;"></div>

<form method="POST" action="signup.php" id="signup-form" class="form-box">

    <label for="student_name">Your name</label>
    <input type="text" name="student_name" id="student_name">

    <label for="email">Your email</label>
    <input type="text" name="email" id="email">

    <label for="activity_id">Activity</label>
    <select name="activity_id" id="activity_id">
        <option value="0">-- Choose an activity --</option>
        <?php while ($a = mysqli_fetch_assoc($activities)) { ?>
            <option value="<?php echo $a['id']; ?>" <?php if ($a['id'] == $chosen) echo "selected"; ?>>
                <?php echo htmlspecialchars($a['title']) . " (" . date("d M", strtotime($a['activity_date'])) . ")"; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" class="button">Sign me up</button>
</form>

<script src="script.js"></script>

<?php include "footer.php"; ?>
