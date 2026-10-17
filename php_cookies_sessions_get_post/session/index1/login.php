<?php
// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($_POST['username'] === "admin" && $_POST['password'] === "12345") {
        // Store username in session and redirect to the protected page
        $_SESSION['username'] = $_POST['username'];
        header("Location: protected.php");
        exit();
    }
     else {
        $error = "Invalid username or password!";
    }}

    
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <h2>Login Form</h2>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>