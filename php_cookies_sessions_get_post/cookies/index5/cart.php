<?php
$cartItems = [];
if (isset($_COOKIE['cart'])) {
    $cartItems = json_decode($_COOKIE['cart'], true);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>document</title>
</head>
<body>
    
    <?php if (!empty($cartItems)): ?>
        <ul>
            <?php foreach ($cartItems as $item): ?>
                <li><?php echo htmlspecialchars($item); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>empty</p>
    <?php endif; ?>

    <br>
    <a href="products.php">products page</a>
</body>
</html>