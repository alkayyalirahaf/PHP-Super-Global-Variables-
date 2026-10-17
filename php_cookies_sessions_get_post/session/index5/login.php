<?php
// Start the session
session_start();

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hardcoded credentials for simplicity
    if ($_POST['username'] === "admin" && $_POST['password'] === "12345") {
        // Store username in session if credentials are correct
        $_SESSION['username'] = $_POST['username'];
        
        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login Page</h2>
    
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>