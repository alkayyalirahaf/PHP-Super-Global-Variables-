<?php
session_start();
require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/functions.php";

$err = "";

if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $pass  = trim($_POST["password"] ?? "");

    if ($email === ADMIN_EMAIL && password_verify($pass, ADMIN_PASSWORD_HASH)) {
        session_regenerate_id(true);
        $_SESSION["admin"] = true;
        header("Location: admin.php");
        exit;
    }
    $err = "Invalid admin credentials.";
}

include __DIR__ . "/includes/header.php"; 
?>

<div class="mobile-screen">
    
    <a href="index.php" class="back-arrow"><i class="bi bi-chevron-left"></i></a>

    <h2 class="page-title" style="color: #ff7900;">Admin Login</h2>
    <p class="page-subtitle">Superuser Access Only</p>

    <?php if ($err): ?>
        <div class="alert alert-danger" style="font-size: 13px; padding: 10px;">
            <?php echo htmlspecialchars($err); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Admin Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn-blue" style="background-color: #333;">Login as Admin</button>
    </form>
    
    <p class="bottom-text mt-3">
        <a href="index.php">Back to Home</a>
    </p>
</div>

