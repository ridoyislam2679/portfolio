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
	
	$stmt = $pdo->prepare("SELECT verify_status FROM verify WHERE user_id = ? ORDER BY verify_id DESC LIMIT 1");
	$stmt->execute([$id]);
	$verify = $stmt->fetch();
	
	if($verify){
		$verify_user =  $verify['verify_status'];
	}else{
		$verify_user =  'deactive';
	}
	
	$today = date("Y-m-d");

	$stmt = $pdo->prepare("
		SELECT COUNT(*) 
		FROM withdraw 
		WHERE userr_id = ? 
		AND DATE(withdraw_date) = ?
	");
	$stmt->execute([$id, $today]);

	$todayWithdraw = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Withdraw - Gold Save World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/deposit.css">
</head>
<body>
    <div class="main-content">
        <div class="top-header">
            <a href="home.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            <div class="logo"><i class="fas fa-plus-circle"></i> Withdraw </div>
            <div style="width: 40px;"></div>
        </div>
        
        <div class="balance-card">
            <div class="balance-amount">৳ <?php echo number_format($balance['total_balance'], 2); ?>TK</div>
            <div style="font-size: 14px; margin-top: 5px;">বর্তমান ব্যালেন্স</div>
        </div>
        
        <div class="form-card">
            <h4 style="margin-bottom: 20px;">টাকা উত্তোলন করুন</h4>
			<form action="" method="POST">
				<div class="mb-3">
					<label>Amount (৳)</label>
					<input type="number" name="amount" class="form-control" placeholder="minimum deposit 100" min="100" required>
				</div>
				<div class="mb-3">
					<label>Withdraw Number</label>
					<input type="number" name="number" class="form-control" placeholder="Inter your number..." required>
				</div>
				<div class="mb-3">
					<label>Withdraw Metod</label>
					<select class="form-control" name="method">
						<option value="none"> Select Method </option>
						<option value="Bkash">বিকাশ</option>
						<option value="nagod">নগদ</option>
						<option value="rocket">রকেট</option>
						<option value="binance">বাইনান্স </option>
					</select>
				</div>
				<button class="submit-btn">টাকা উত্তোলন করুন</button>
			</form>
			<?php
				if($_SERVER['REQUEST_METHOD'] === 'POST'){

					$amount = (float) $_POST['amount'];
					$method = $_POST['method'];
					$number = trim($_POST['number']);

					$user_id = $id;
					$total_balance = $balance['total_balance'] ?? 0;
					$today = date("Y-m-d");

					// ✅ basic validation
					if(empty($amount) || empty($method) || empty($number)){
						echo "Please fill all fields";
						exit();
					}

					if($method == 'none'){
						echo "Please select method properly";
						exit();
					}

					// ✅ check today's withdraw
					$stmt = $pdo->prepare("
						SELECT COUNT(*) 
						FROM withdraw 
						WHERE userr_id = ? 
						AND DATE(withdraw_date) = ?
					");
					$stmt->execute([$user_id, $today]);
					$todayWithdraw = $stmt->fetchColumn();

					if($verify_user !== 'active'){
						echo '<span style="color:red;">You are not verified user</span>';
						exit();
					}

					if($todayWithdraw > 0){
						echo '<span style="color:red;">You already withdrew today</span>';
						exit();
					}

					if($amount > $total_balance){
						echo '<span style="color:red;">Insufficient balance</span>';
						exit();
					}

					// ✅ method wise validation
					if($method == 'binance' && $amount < 600){
						echo '<span style="color:red;">Minimum Binance Withdraw 600Tk</span>';
						exit();
					}

					if($method != 'binance' && $amount < 100){
						echo '<span style="color:red;">Minimum Withdraw 100Tk</span>';
						exit();
					}

					try{
						$pdo->beginTransaction();

						// ✅ safe balance deduct
						$stmt = $pdo->prepare("
							UPDATE balance 
							SET total_balance = total_balance - ? 
							WHERE user_id = ? AND total_balance >= ?
						");
						$stmt->execute([$amount, $user_id, $amount]);

						if($stmt->rowCount() == 0){
							throw new Exception("Balance error");
						}

						// ✅ insert withdraw
						$stmt = $pdo->prepare("
							INSERT INTO withdraw 
							(userr_id, withdraw_amount, withdraw_number, withdraw_method, withdraw_date) 
							VALUES (?, ?, ?, ?, NOW())
						");
						$stmt->execute([$user_id, $amount, $number, $method]);

						$pdo->commit();

						echo '<span style="color:green;">Withdraw request submitted</span>';

					} catch(Exception $e){
						$pdo->rollBack();
						echo '<span style="color:red;">Error: '.$e->getMessage().'</span>';
					}
				}
			?>
			<p style="text-align: center; color: green; margin-top: 10px;">
				বাইনান্স এর মাধ্যমে টাকা উত্তোলন ১২০ টাকা = ১ ডলার । 
			</p>
        </div>
		
		<!-- Pending Withdraw Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-money-bill-wave"></i> withdraw request
            </div>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Amount</th>
                        <th>Number</th>
                        <th>Mathod</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
					$select = "SELECT * FROM withdraw WHERE userr_id = ? ORDER BY withdraw_date";
					$new_withdraw = $pdo->prepare($select);
					$new_withdraw->execute([$id]);
					
					$user_count = 1;
					
					while($withdraw = $new_withdraw->fetch()){
						
						?>
							<tr>
								<td><?php echo $user_count ?></td>
								<td><?php echo $withdraw['withdraw_amount']; ?></td>
								<td><?php echo $withdraw['withdraw_number']; ?></td>
								<td><?php echo $withdraw['withdraw_method'] ?></td>
								<td><?php echo $withdraw['withdraw_date']; ?></td>
								<td><?php echo $withdraw['withdraw_status']; ?></td>
							</tr>
						<?php	
						$user_count++;
					}
				?>
                </tbody>
            </table>
        </div>
		
    </div>
	
	<?php include_once("bottom.php"); ?>
	
</body>
</html>