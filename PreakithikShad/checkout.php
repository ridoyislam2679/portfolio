<?php
session_start();
include "db/index.php";
// Determine which identifier to use
if (isset($_SESSION['user_id'])) {
    $field = "user_id";
    $value = $_SESSION['user_id'];
} else {
    $field = "session_id";
    $value = session_id();
}

// Get cart items
$query = $pdo->prepare("
    SELECT c.cart_id, c.product_id, p.product_price, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.$field=?
");
$query->execute([$value]);
$cart = $query->fetchAll();

if (empty($cart)) {
	echo '';
    die("<h3 style='color: #a38019; font-size: 1.5rem; text-align: center; display: block; background: antiquewhite; padding: 20px; margin-top: 20px; margin-bottom: -20px;'>Cart is empty!</h3> <br> <a href='index.php' style='text-align: center; display: block; background: antiquewhite; padding: 20px; margin-top: 20px; margin-bottom: -20px; font-size: 50px; color: green; text-decoration: none;'>Continue Shopping</a>");
	
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['product_price'] * $item['quantity'];
}

// Insert into orders table
$order = $pdo->prepare("
    INSERT INTO orders (user_id, session_id, total, status) 
    VALUES (?, ?, ?, 'pending')
");
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$order->execute([$user_id, $value, $total]);
$order_id = $pdo->lastInsertId();

foreach ($cart as $item) {
    $oi = $pdo->prepare("INSERT INTO order_items (order_id, product_id, price, quantity) VALUES (?, ?, ?, ?)");
    $oi->execute([$order_id, $item['product_id'], $item['product_price'], $item['quantity']]);
}

// Delete cart items for this user/session
$delete = $pdo->prepare("DELETE FROM cart WHERE $field=?");
$delete->execute([$value]);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center mt-5">
    <div class="alert alert-success p-4 rounded shadow">
        <h3>🎉 Order Placed Successfully!</h3>
        <p>Your Order ID: <strong>#<?= $order_id ?></strong></p>
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
    </div>
</div>
</body>
</html>
