<?php
session_start();
include "db/index.php";

$id = $_GET['id'];
$delete = $pdo->prepare("DELETE FROM cart WHERE cart_id=?");
$delete->execute([$id]);

header("Location: cart.php");
