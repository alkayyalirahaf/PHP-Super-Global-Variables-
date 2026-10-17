<?php
// No form or complex logic is needed here. 
// We just access the $_SERVER superglobal array directly to fetch server and request details.
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Server Information</title>
</head>
<body>
    <h2>Server and Request Information</h2>

    <ul>
        <!-- 1. The server's IP address -->
        <li><strong>Server IP Address:</strong> <?php echo $_SERVER['SERVER_ADDR']; ?></li>

        <!-- 2. The current script file name -->
        <li><strong>Current Script Name:</strong> <?php echo $_SERVER['PHP_SELF']; ?></li>

        <!-- 3. The browser (User Agent) making the request -->
        <li><strong>Browser (User Agent):</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>

        <!-- 4. The request method used (GET, POST, etc.) -->
        <li><strong>Request Method:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?></li>

        <!-- 5. The client's (visitor's) IP address -->
        <li><strong>Client IP Address:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
    </ul>
</body>
</html>