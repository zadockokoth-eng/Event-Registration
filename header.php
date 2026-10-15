<?php
// header.php
// Shared page layout and navigation. Each page sets $page_title and $current_page first.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> | ClubBoard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="layout">

    <nav class="sidebar" aria-label="Main navigation">
        <h1 class="logo">Club<span>Board</span></h1>
        <a href="index.php" class="<?php if ($current_page == 'home') echo 'active'; ?>">Dashboard</a>
        <a href="signup.php" class="<?php if ($current_page == 'signup') echo 'active'; ?>">Sign Up</a>
        <a href="signups.php" class="<?php if ($current_page == 'signups') echo 'active'; ?>">Who Joined</a>
    </nav>

    <main class="content">
        <div class="page-topline">
            <span>ClubBoard</span>
            <span><?php echo htmlspecialchars($page_title); ?></span>
        </div>
