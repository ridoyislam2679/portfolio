<?php
session_start();
include "db.index/php";

if (isset($_POST['update'])) {
    foreach ($_POST['qty'] as $cart_id => $qty) {
        $qty = max(1, intval($qty));
        $update = $pdo->prepare("UPDATE cart SET quantity=? WHERE cart_id=?");
        $update->execute([$qty, $cart_id]);
    }
}
header("Location: cart.php");
