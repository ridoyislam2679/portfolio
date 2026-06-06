<?php
session_start();
include "db/index.php";

// login check
if (isset($_SESSION['user_id'])) {
    $field = "user_id";
    $value = $_SESSION['user_id'];
} else {
    $field = "session_id";
    $value = session_id();
}

if (isset($_POST['id']) && isset($_POST['qty'])) {
    $id = (int)$_POST['id'];
    $qty = max(1, (int)$_POST['qty']);

    $update = $pdo->prepare("UPDATE cart SET quantity=? WHERE cart_id=? AND $field=?");
    $update->execute([$qty, $id, $value]);

    echo "success";
} else {
    echo "error";
}