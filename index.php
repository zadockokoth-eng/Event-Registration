<?php
// index.php - the Dashboard (home page)
// Shows a few numbers and all activities.

include "config.php";

$page_title   = "Dashboard";
$current_page = "home";
include "header.php";

// 1. Count how many activities exist
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM activities");
$row = mysqli_fetch_assoc($result);
$total_activities = $row['total'];

// 2. Count how many sign-ups exist
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM signups");
$row = mysqli_fetch_assoc($result);
$total_signups = $row['total'];

// 3. Find the next activity that has not happened yet
$result = mysqli_query($conn, "SELECT title FROM activities WHERE activity_date >= CURDATE() ORDER BY activity_date LIMIT 1");
$next = mysqli_fetch_assoc($result);
if ($next) {
    $next_activity = $next['title'];
} else {
    $next_activity = "Nothing planned";
}

// 4. Get every activity, plus how many students joined each one
$sql = "SELECT activities.*, COUNT(signups.id) AS joined
        FROM activities
        LEFT JOIN signups ON signups.activity_id = activities.id
        GROUP BY activities.id
        ORDER BY activities.activity_date";
$activities = mysqli_query($conn, $sql);
?>

<h2>Welcome to ClubBoard Event Registration</h2>
<p class="subtitle">Find a club activity and sign up in less than a minute.</p>

<!-- Three number boxes -->
<div class="stats">
    <div class="stat-box">
        <span class="stat-number"><?php echo $total_activities; ?></span>
        <span class="stat-label">Activities</span>
    </div>
    <div class="stat-box">
        <span class="stat-number"><?php echo $total_signups; ?></span>
        <span class="stat-label">Sign-ups</span>
    </div>
    <div class="stat-box">
        <span class="stat-text"><?php echo htmlspecialchars($next_activity); ?></span>
        <span class="stat-label">Next up</span>
    </div>
</div>

<h3>All Activities</h3>

<div class="cards">
    <?php while ($activity = mysqli_fetch_assoc($activities)) { ?>
        <div class="card">
            <p class="card-date"><?php echo date("D, d M", strtotime($activity['activity_date'])); ?></p>
            <h4><?php echo htmlspecialchars($activity['title']); ?></h4>
            <p><?php echo htmlspecialchars($activity['description']); ?></p>
            <p class="card-place">Place: <?php echo htmlspecialchars($activity['place']); ?></p>
            <p class="card-joined"><?php echo $activity['joined']; ?> joined</p>
            <a class="button" href="signup.php?activity=<?php echo $activity['id']; ?>">Sign up</a>
        </div>
    <?php } ?>
</div>

<?php include "footer.php"; ?>
