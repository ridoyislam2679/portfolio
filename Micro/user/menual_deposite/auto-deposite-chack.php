<?php 
	include_once('../db/index.php');
	file_put_contents("chack.txt", json_encode($_GET) . "\n", FILE_APPEND);
	$trxid = $_GET['trxid'] ?? '';
	$amount = $_GET['amount'] ?? '';
	$number = $_GET['sender'] ?? '';
	
	// Validate
	if (!$trxid || !$amount || !$number) {
		echo "Missing fields.";
		exit;
	}
	
	$sql = "SELECT * FROM deposite 
			WHERE transaction_id = '$trxid'
			AND deposite_amount = $amount 
			AND deposite_number = '$number'
			AND approve_status = '0' 
			LIMIT 1";
	$result = $pdo->query($sql);

	if ($result && $result->rowCount() > 0) {
		// Approve the deposit
		$pdo->query("UPDATE deposite SET approve_status='1' WHERE transaction_id = '$trxid'");
		echo "Approved";
	}else {
		echo "No matching pending deposit.";
	}
?>
