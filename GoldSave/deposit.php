<?php 
	session_start();
	ob_start();
	include_once('header.php');
	include_once('db/index.php');
	
	if (!isset($_SESSION['userId'])) {
		header('Location: login.php');
		exit();
	}
	
	$userId = $_SESSION['userId'];
	
	$stmt = $pdo->prepare("SELECT user_id FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	
	$id = $user['user_id'];
	
	$stmt = $pdo->prepare("SELECT total_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Deposit - Gold Save World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/deposit.css">
</head>
<body>
    <div class="main-content">
        <div class="top-header">
            <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            <div class="logo"><i class="fas fa-plus-circle"></i> Deposit </div>
            <div style="width: 40px;"></div>
        </div>
        
        <div class="balance-card">
            <div class="balance-amount">৳ <?php echo $balance['total_balance']?? 0; ?>TK</div>
            <div style="font-size: 14px; margin-top: 5px;">বর্তমান ব্যালেন্স</div>
        </div>
        
        <div class="form-card">
            <h4 style="margin-bottom: 20px;">ডিপোজিট করুন</h4>
			<form action="" method="POST">
				<div class="mb-3">
					<label>Amount (৳)</label>
					<input type="number" name="amount" class="form-control" placeholder="minimum deposit 100" min="100">
				</div>
				<div class="mb-3">
					<label>Deposit Number</label>
					<input type="number" name="number" class="form-control" placeholder="Inter your number..." min="100">
				</div>
				<div class="mb-3">
					<label>Deposit Metod</label>
					<select class="form-control" name="method">
						<option value="none"> Select Method </option>
						<option value="Bkash">বিকাশ</option>
						<option value="nagod">নগদ</option>
						<option value="rocket">রকেট</option>
						<option value="binance">বাইনান্স </option>
					</select>
				</div>
				<button class="submit-btn">ডিপোজিট করুন</button>
			</form>
			<?php
				if($_SERVER['REQUEST_METHOD'] === 'POST'){
					$amount = $_POST['amount'];
					$method = $_POST['method'];
					$number = $_POST['number'];
					
					$user_id = $id;
					$total_balance = $balance['total_balance']?? 0;
					
					if(empty($amount) || empty($method) || empty($number)){
						echo "Plese Select Properly";
						exit();
					}
					
					if($method == 'none'){
						echo "Plese Select Method Properly";
						exit();
					}
					
					if($method == 'binance'){
						if($amount <= $total_balance){
							if($amount >= 600){
								$stmt = $pdo->prepare("INSERT INTO deposit (user_id, deposit_amount, deposit_number, deposit_method) VALUES (?, ?, ?, ?)");
								$stmt->execute([$user_id, $amount, $number, $method]); 
								
								echo "Your Deposit Request Submited";
							}else{
								echo "Minimum Deposit 100Tk";
							}
						}else{
							echo "Insufficient Balance";
						}
					}else{
						if($amount >= 100){
							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_URL => 'https://secure-pay.nagorikpay.com/api/payment/create',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_POST => true,
								CURLOPT_HTTPHEADER => array(
									'API-KEY: y88CorgKyk0nV4ZVuUcWuMRmcPDVQ57vvXpYq7zZaZt6JMXVZu',
									'Content-Type: application/json'
								),
								CURLOPT_POSTFIELDS => json_encode([
									'amount' => $amount,
									'success_url' => 'https://goldsaveworld.com/auto_deposite_check_nagorik.php?user_id=' . $user_id . '&sender=' . urlencode($number),
									'cancel_url' => 'https://goldsaveworld.com/deposit.php',
									'webhook_url' => 'https://goldsaveworld.com/webhook.php',
									'metadata' => [
										'user_id' => $user_id,
										'method' => $method,
										'sender' => $number
									]
								])

							));

							$response = curl_exec($curl);
							curl_close($curl);
							
							$data = json_decode($response, true);
							if (isset($data['payment_url'])) {
								header("Location: " . $data['payment_url']);
								exit;
							} else {
								echo "Payment initialization failed.";
							}
						}else{
							echo "Minimum Deposit 100Tk";
						}
					}
					
				}
			?>
			<p style="text-align: center; color: green; margin-top: 10px;">
				বাইনান্স এর মাধ্যমে টাকা জমা দেওয়ার আইডি 1236632065 । ১ ডলার = ১২০ টাকা । 
			</p>
        </div>
    </div>
	
	<?php include_once("bottom.php"); ?>
	
</body>
</html>