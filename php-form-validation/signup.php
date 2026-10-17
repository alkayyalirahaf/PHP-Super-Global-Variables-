<?php

session_start();

require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/functions.php";

if (isset($_SESSION["user_data"])) {
    header("Location: index.php");
    exit;
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $error_message = validateSignup($_POST, $_FILES["profile_img"] ?? []);

    if (empty($error_message)) {

        $imagePath = uploadImage($_FILES["profile_img"]);

        if ($imagePath === false) {
            $error_message = "Please upload a valid image.";
        } else {

            $userData = [
                "name"       => trim($_POST["full_name"]),
                "email"      => trim($_POST["email"]),
                "mobile"     => trim($_POST["mobile"]),
                "password"   => password_hash($_POST["password"], PASSWORD_DEFAULT),
                "dob"        => sprintf("%04d-%02d-%02d", $_POST["year"], $_POST["month"], $_POST["day"]),
                "image"      => $imagePath,
                "created_at" => date("Y-m-d H:i:s"),
                "last_login" => null
            ];

            if (!saveUser($userData)) {
                $error_message = "Could not save user data.";
            } else {
                $_SESSION["user_data"] = $userData;

                header("Location: welcome.php");
                exit;
            }
        }
    }
}

?>


<?php
include __DIR__ . "/includes/header.php"; 
?>

<div class="mobile-screen">
    
    <a href="index.php" class="back-arrow"><i class="bi bi-chevron-left"></i></a>

    <h2 class="page-title">Sign up</h2>
    <p class="page-subtitle">Create an Account, it's free</p>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger" style="font-size: 13px; padding: 10px;">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="signup.php" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobile (14 digits)</label>
            <input type="text" name="mobile" class="form-control" pattern="\d{14}" maxlength="14" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Full Name (4 parts)</label>
            <input type="text" name="full_name" class="form-control" placeholder="First Middle Last Family" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" minlength="8" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Date of Birth</label>
            <div class="d-flex gap-2">
                <input type="number" name="day" class="form-control" placeholder="DD" min="1" max="31" required>
                <input type="number" name="month" class="form-control" placeholder="MM" min="1" max="12" required>
                <input type="number" name="year" class="form-control" placeholder="YYYY" min="1900" max="<?php echo date('Y'); ?>" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_img" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn-red">Sign Up</button>

        <p class="bottom-text">
            Already have an account? <a href="login.php">Login</a>
        </p>

    </form>
</div>

