<?php 
	include_once('../db/index.php');
	session_start();
	
	if (!isset($_SESSION['admin_id'])) {
		header('Location: login.php');
		exit();
	}
	
	$admin_id = $_SESSION['admin_id'];
	
	$stmt = $pdo->prepare("SELECT admin_name FROM admin_login WHERE admin_id = ?");
	$stmt->execute([$admin_id]);
	$admin = $stmt->fetch();
	
	$admin_name = $admin['admin_name'];
	
	/*
	$timeout = 600;

	if (isset($_SESSION['last_activity'])) {
		if (time() - $_SESSION['last_activity'] > $timeout) {
			session_unset();
			session_destroy();
			header("Location: login.php?msg=timeout");
			exit();
		}
	}

	$_SESSION['last_activity'] = time();
	*/
?>