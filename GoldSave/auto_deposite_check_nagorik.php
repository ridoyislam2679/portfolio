<?php
	$transaction_id = $_GET['transaction_id'] ?? null;
	$user_id = $_GET['user_id'] ?? null;
	
	if ($transaction_id && $user_id) {
		// Verify API Call
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://secure-pay.nagorikpay.com/api/payment/verify',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_HTTPHEADER => array(
				'API-KEY: y88CorgKyk0nV4ZVuUcWuMRmcPDVQ57vvXpYq7zZaZt6JMXVZu',
				'Content-Type: application/json'
			),
			CURLOPT_POSTFIELDS => json_encode([
				'transaction_id' => $transaction_id
			])
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$data = json_decode($response, true);
		
		echo "<pre>";
		echo "RAW RESPONSE: \n";
		print_r($response);
		echo "</pre>";

		if (isset($data['status']) && $data['status'] === 'success') {
			// ✅ DB update (example only, customize as needed)
			include_once('../db/index.php');
			
			$user_id = $data['metadata']['user_id'];
			$method = $data['metadata']['method'] ?? 'Unknown';
			$number = $data['metadata']['sender'] ?? 'Unknown';
			$amount = $data['amount'];
			$trx = $data['transaction_id'];
			$date = date("Y-m-d H:i:s");

			// ✅ Insert into deposit table
			$stmt = $pdo->prepare("INSERT INTO deposit (user_id, deposit_amount, deposit_number, deposit_method, deposit_date, deposit_status) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->execute([$user_id, $amount, $number, $method, $date, 'pending']); // approve_status = 1 = success

			$stmt = $pdo->prepare("UPDATE balance SET total_balance = total_balance + ? WHERE user_id = ?");
			$stmt->execute([$amount, $user_id]);

			header("Location: deposit.php?status=success&amount=" . $amount);
			//echo "✅ Payment Successful! Amount: $amount";
		} else {
			//echo "❌ Payment verification failed.";
			header("Location: deposit.php?status=failed");
		}
	} else {
		header("Location: deposit.php?status=failed");
		//echo "❗ Required data missing.";
	}
?>
