<?php 
    ob_start();
	include_once('../db/index.php');
	
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	
	file_put_contents("chack.txt", json_encode($_GET) . "\n", FILE_APPEND);
	
	$user_id = $_GET['user_id'] ?? '';
	$trxid = $_GET['transactionId'] ?? '';
    $amount = $_GET['paymentAmount'] ?? '';
    $method = $_GET['paymentMethod'] ?? '';
    $status = $_GET['status'] ?? '';
    
    $deposite_number = $_GET['sender'] ?? 'N/A';
    
    $date = date("Y-m-d H:i:s");
	
	// Validate
	if (!$trxid || !$amount || !$method || !$user_id) {
		echo "Missing fields.";
		exit;
	}
	
	if ($status == 'completed') {
        $sql = "INSERT INTO deposite(user_id, deposite_number, deposite_method, deposite_amount, transaction_id, deposite_date, approve_status) VALUES (?, ?, ?, ?, ?, ?, 'approved')";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$user_id, $deposite_number, $method, $amount, $trxid, $date]);
		
		$stmt = $pdo->prepare("UPDATE blance SET main_blance = main_blance + ? WHERE user_id = ?");
		$stmt->execute([$amount, $user_id]);
		
		file_put_contents("webhook_success.txt", "Verified TRX: $trxid\n", FILE_APPEND);
		
		header("Location: deposite.php?success=1");
		exit;
    }
?>
