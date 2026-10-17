<?php
// Start the session
session_start();

// Destroy the session completely to log the user out
session_unset();
session_destroy();

// Redirect back to the login page
header("Location: login.php");
exit();
?>