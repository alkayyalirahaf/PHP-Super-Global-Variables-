<?php
$name = "";
$message = "";

// Check if the form has been submitted (either via GET or POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    
    // Use $_REQUEST to retrieve data regardless of whether GET or POST was used
    if (isset($_REQUEST['username']) && isset($_REQUEST['message'])) {
        $name = $_REQUEST['username'];
        $message = $_REQUEST['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>
<body>
    <h2>Contact Us</h2>

    <form method="POST" action="">
        <label>Your Name:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Your Message:</label><br>
        <textarea name="message" required></textarea><br><br>

        <button type="submit">Send</button>
    </form>

    <hr>

    <?php if (!empty($name) && !empty($message)): ?>
        <h3>Submitted Information:</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>