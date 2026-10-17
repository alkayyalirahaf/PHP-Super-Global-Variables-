<?php
session_start();
if (!isset($_SESSION["user_data"])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION["user_data"];
include __DIR__ . "/includes/header.php"; 
?>

<div class="mobile-screen text-center d-flex flex-column align-items-center justify-content-center">
    
    <h2 class="page-title" style="color: #4a67ff;">Welcome!</h2>
    <p class="page-subtitle">We're glad to have you on board 🎉</p>

    <?php if(!empty($user["image"])): ?>
        <img src="<?php echo htmlspecialchars($user["image"]); ?>" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
    <?php endif; ?>

    <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; width: 100%;">
        <p class="mb-1"><strong>Name:</strong> <?php echo htmlspecialchars($user["name"]); ?></p>
        <p class="mb-0"><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
    </div>

    <div style="width: 100%; margin-top: 30px;">
        <a href="index.php?action=logout" class="btn-red text-decoration-none d-block w-100">Logout</a>
    </div>

</div>

<?php include __DIR__ . "/includes/footer.php"; ?>