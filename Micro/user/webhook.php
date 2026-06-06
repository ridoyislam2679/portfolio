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
				'API-KEY: vb2lyOWwjUyflaBa7zHmv6Q7WW2OKhMr6zFa0hx0twuwnpraDH',
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
			
			$amount = $verify_data['amount'] ?? 0;
			$metadata = $verify_data['metadata'] ?? [];

			$user_id = $metadata['user_id'] ?? null;
			$method  = $metadata['method'] ?? '';
			$number  = $metadata['sender'] ?? '';
			$trn_id  = $verify_data['transaction_id'] ?? '';

			if ($user_id) {
				include_once('../db/index.php');
				$stmt = $pdo->prepare("UPDATE blance SET main_blance = main_blance + ? WHERE user_id = ?");
				$stmt->execute([$amount, $user_id]);

				file_put_contents("webhook_success.txt", "User $user_id got $amount via TRX $trx\n", FILE_APPEND);
			}
		}
	}

    if ($verify_data['status'] == 'success') {
        $sql = "INSERT INTO deposite(user_id, deposite_number, deposite_method, deposite_amount, transaction_id) VALUES (?, ?, ?, ?, ?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$user_id, $number, $method, $amount, $trn_id]);
		
		file_put_contents("webhook_success.txt", "Verified TRX: $trx\n", FILE_APPEND);
		
		header("Location: deposite.php?success=1");
		exit;
    }
	
?>

