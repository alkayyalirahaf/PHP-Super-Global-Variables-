<?php


$products = [

    ["id" => 1 , "name"=>"laptop" , "price" => 500],
    ["id" => 2, "name" => "Mouse", "price" => 20], 
    ["id" => 3, "name" => "Keyboard", "price" => 35]

];


if (isset($_POST['add_to_cart'])) {
    $productName = $_POST['product_name'];


 if (isset($_COOKIE['cart'])) {
$cart = json_decode($_COOKIE['cart'], true);}

else {

    $cart = array();
}


$cart[] = $productName;
setcookie('cart', json_encode($cart), time() + 3600, "/");

header("Location: products.php");
exit();
}

?>



<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>products</title>
</head>
<body>
    <h2>products list</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <strong><?php echo $product['name']; ?></strong> - $<?php echo $product['price']; ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <br>
    <a href="cart.php">view cart (Cart Page)</a>
</body>
</html>