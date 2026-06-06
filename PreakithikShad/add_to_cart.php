<?php
	session_start();
	include "db/index.php";
	
	// Debugging on
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//$user_id = 1; // Demo user (later আপনি $_SESSION['user_id'] ব্যবহার করবেন)
	//$_SESSION['user_id'] = 10;

	// login check
	if (isset($_SESSION['user_id'])) {
		$field = "user_id";
		$value = $_SESSION['user_id'];
	} else {
		$field = "session_id";
		$value = session_id();
	}
	
	$product_id = $_GET['id'];

	// Check if already in cart

	$check = $pdo->prepare("SELECT cart_id, quantity FROM cart WHERE $field=? AND product_id=?");
	$check->execute([$value, $product_id]);

	if ($check->rowCount() > 0) {
		$row = $check->fetch();
		$new_qty = $row['quantity'] + 1;
		$update = $pdo->prepare("UPDATE cart SET quantity=? WHERE cart_id=?");
		$update->execute([$new_qty, $row['car_id']]);
	} else {
		$insert = $pdo->prepare("INSERT INTO cart ($field, product_id, quantity) VALUES (?, ?, 1)");
		$insert->execute([$value, $product_id]);
	}

	header("Location: cart.php");

?>

