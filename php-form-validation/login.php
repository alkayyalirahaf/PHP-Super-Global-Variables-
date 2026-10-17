<?php

// Start session
session_start();

// Load required files
require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/functions.php";

// Initialize error message
$errorMessage = "";

// Redirect if already logged in
if (isset($_SESSION["user_data"])) {
    header("Location: welcome.php"); 
    exit;
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form data
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Validate empty fields
    if (empty($email) || empty($password)) {
        $errorMessage = "Please fill in all required fields.";
    } else {
        // Get all registered users
        $users = getUser();
        $authenticatedUser = null;

        // Search for matching email and password
        foreach ($users as $user) {
            if (
                isset($user["email"], $user["password"]) &&
                strcasecmp($user["email"], $email) === 0 &&
                password_verify($password, $user["password"])
            ) {
                $authenticatedUser = $user;
                break;
            }
        }

        // Check authentication result
        if ($authenticatedUser !== null) {
            // Regenerate session ID
            session_regenerate_id(true);

            updateUser($authenticatedUser["email"], ["last_login" => date("Y-m-d H:i:s")]);

            // Save user data in session
            $_SESSION["user_data"] = [
                "name"  => $authenticatedUser["name"] ?? "",
                "email" => $authenticatedUser["email"],
                "image" => $authenticatedUser["image"] ?? ""
            ];

            // Redirect to welcome page
            header("Location: welcome.php");
            exit;

        } else {
            $errorMessage = "Invalid email or password.";
        }
    }
}
?>
<?php
include __DIR__ . "/includes/header.php"; 
?>

<div class="mobile-screen">
    
    <a href="index.php" class="back-arrow"><i class="bi bi-chevron-left"></i></a>

    <h2 class="page-title">Login</h2>
    <p class="page-subtitle">Welcome back ! Login with your credentials</p>

    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger" style="font-size: 13px; padding: 10px;">
            <?php echo htmlspecialchars($errorMessage); ?>
        </div>
    <?php endif; ?>

    <!--  -->
    <form action="" method="POST">
        
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="abc@gmail.com" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-blue">Login</button>

        <p class="bottom-text">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </p>

    </form>
</div>

