<?php
	$payload = file_get_contents("php://input");
	$data = json_decode($payload, true);

	if (isset($data['transaction_id'])) {
		$trx = $data['transaction_id'];

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
				'transaction_id' => $trx
			])
		));
		$verify_response = curl_exec($curl);
		curl_close($curl);

		$verify_data = json_decode($verify_response, true);

		if ($verify_data['status'] == 'success') {
			$user_id = $verify_data['metadata']['user_id'] ?? null;
			$amount = $verify_data['amount'] ?? 0;

			if ($user_id) {
				include_once('db/index.php');
				$stmt = $pdo->prepare("UPDATE balance SET total_balance = total_balance + ? WHERE user_id = ?");
				$stmt->execute([$amount, $user_id]);

				file_put_contents("webhook_success.txt", "User $user_id got $amount via TRX $trx\n", FILE_APPEND);
			}
		}
	}

/*

    if ($verify_data['status'] == 'success') {
        $sql = "INSERT INTO deposite(user_id, deposite_number, deposite_method, deposite_amount, transaction_id) VALUES (?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$user_id, $number, $method, $amount, $trn_id]);
		
		file_put_contents("webhook_success.txt", "Verified TRX: $trx\n", FILE_APPEND);
		
		header("Location: deposite.php?success=1");
		exit;
    }
	*/
?>

