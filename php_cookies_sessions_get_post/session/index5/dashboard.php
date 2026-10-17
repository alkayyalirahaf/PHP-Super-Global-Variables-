<?php
// Start the session
session_start();

// Check if the user is logged in by verifying the session data
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect back to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to your Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
    <p>You have successfully logged in using sessions.</p>

    <!-- Logout link or button pointing to logout page -->
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>