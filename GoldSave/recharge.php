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
	
	$stmt = $pdo->prepare("SELECT coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$coin = $balance['coin_balance']?? 0;
	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Mobile Recharge - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="CSS/recharge.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                Mobile Recharge
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Coin Balance Card -->
        <div class="coin-balance-card">
            <div class="coin-icon">
                <i class="fas fa-coins"></i>
            </div>
            <div class="coin-balance-label">আপনার মোট ডায়মন্ড</div>
            <div class="coin-balance-amount" id="userCoins"><?php echo $coin; ?></div>
            <div class="coin-rate">
                <i class="fas fa-exchange-alt"></i> 1 Diamond = ৳ 1
            </div>
        </div>
        
        <!-- Operator Icons (Just for design) -->
        <div class="operator-icons">
            <div class="operator-item">
                <i class="fas fa-signal"></i>
                <span>গ্রামীণ</span>
            </div>
            <div class="operator-item">
                <i class="fas fa-mobile-alt"></i>
                <span>রবি</span>
            </div>
            <div class="operator-item">
                <i class="fas fa-tower-cell"></i>
                <span>বাংলালিংক</span>
            </div>
            <div class="operator-item">
                <i class="fas fa-wifi"></i>
                <span>টেলিটক</span>
            </div>
            <div class="operator-item">
                <i class="fas fa-broadcast-tower"></i>
                <span>এয়ারটেল</span>
            </div>
        </div>
        
        <!-- Message Container -->
        <div id="formMessage" class="form-message"></div>
        
        <!-- Recharge Form -->
        <form id="rechargeForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="csrf_token" id="csrfToken" value="">
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-mobile-alt"></i> মোবাইল রিচার্জ
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-phone-alt"></i> মোবাইল নম্বর</label>
                    <input type="tel" 
                           name="mobile_number" 
                           id="mobileNumber" 
                           class="form-control" 
                           placeholder="০১XXXXXXXXX"
                           maxlength="11"
						   minlength ="11"
						   required
                           autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-money-bill-wave"></i> রিচার্জের পরিমাণ (৳)</label>
                    <input type="number" 
                           name="recharge_amount" 
                           id="rechargeAmount" 
                           class="form-control" 
                           placeholder="টাকার পরিমান লিখুন"
                           min="10"
                           step="10"
                           autocomplete="off"
                           style="margin-top: 10px;">
                </div>
                                
                <button type="submit" name="RechargeBtn" class="submit-btn" id="submitBtn">
                    <i class="fas fa-check-circle"></i> রিচার্জ করুন
                </button>
            </div>
        </form>
		
		<?php 
			if(isset($_POST['RechargeBtn'])){
				$number		 = $_POST['mobile_number'];
				$amount		 = $_POST['recharge_amount'];
				$requre_coin = ($amount * 2);
				
				if (empty($number) || empty($amount)){
					echo "<h2 style='color:red;'> Invalid Amount Or Number!</h2>";
				}else{
					$checkReacharge = $pdo->prepare("SELECT COUNT(*) FROM recharge WHERE user_id = ? AND recharge_date >= NOW() - INTERVAL 7 DAY");
					$checkReacharge->execute([$id]);
					$alreadyReachargeToday = $checkReacharge->fetchColumn();
					
					if($number && $amount && $coin >= $requre_coin){
						if($amount >= 50 && $amount <= 100){
							if($alreadyReachargeToday < 1){
								$sql = "INSERT INTO recharge(user_id, mobile_number, recharge_amount) VALUES (?, ?, ?)";
								$stmt = $pdo->prepare($sql);
								$stmt->execute([$id, $number, $amount]);
								
								$sql ="UPDATE balance SET coin_balance = coin_balance - ?, total_balance = total_balance + ? WHERE user_id = ?";
								$update_blance = $pdo->prepare($sql);
								$update_blance->execute([$requre_coin, $amount ,$id]);
								
								header("Location: ".$_SERVER['PHP_SELF']);
								exit();	
							}else{
								echo '<span id="copyMsg" style="color: green;">You are already recharged in last 7 days. </span>';
							}
						}else{
							echo '<span id="copyMsg" style="color: green;">Minimum Recharge 50Tk & Maximum Recharge 100TK</span>';
						}		
					}else{
						echo '<span id="copyMsg" style="color: green;">Insufficient Coin</span>';
					}
				}
			}
		?>
        
        <div class="info-text">
            <i class="fas fa-info-circle"></i> ১ ডায়মন্ড = ৳ ০.৫ টাকা। রিচার্জ সম্পন্ন হলে আপনার মোবাইল ব্যালেন্স যোগ হবে।
        </div>
    </div>
    
</body>
</html>