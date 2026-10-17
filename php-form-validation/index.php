
<?php

// 1. Start the session
session_start();

// 2. Load required files

require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/functions.php";


// 3. Logout
if (isset($_GET["action"]) && $_GET["action"] == "logout") {

    session_unset();
    session_destroy();

    header("Location: index.php");
    exit;
}



?>




<?php

include __DIR__ . "/includes/header.php"; 
?>

<div class="mobile-screen d-flex flex-column align-items-center justify-content-center" style="text-align: center; padding-top: 80px;">
    
    <h1 style="font-weight: 700; color: #222; margin-bottom: 15px;">Hello There!</h1>
    
    <p style="color: #888; font-size: 14px; line-height: 1.6; margin-bottom: 40px;">
        Automatic identity verification which enable you to<br>verify your identity
    </p>

    <img src="student.jpg" alt="Welcome" style="width: 200px; margin-bottom: 50px;">

    <div style="width: 100%; padding: 0 30px; display: flex; flex-direction: column; gap: 15px;">
        <a href="login.php" class="btn-blue text-decoration-none d-block w-100">Login</a>
        <a href="signup.php" class="btn-red text-decoration-none d-block w-100">Sign UP</a>
    </div>

</div>

