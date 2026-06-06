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
	
	$stmt = $pdo->prepare("SELECT total_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$total_balance = $balance['total_balance']?? 0;	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Donate - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/donate.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                Donate
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Balance Card -->
        <div class="balance-card">
            <div class="balance-label">
                <i class="fas fa-wallet"></i> আপনার বর্তমান ব্যালেন্স
            </div>
            <div class="balance-amount" id="userBalance">৳ <?php echo $balance['total_balance']?? 0; ?></div>
        </div>
        
        <!-- Message Container 
        <div id="formMessage" class="form-message">
			<?php //if (isset($error)) echo $report_message; ?>
		</div>
		-->
        
        <!-- Donate Form -->
        <form id="donateForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="csrf_token" id="csrfToken" value="">
            <input type="hidden" name="campaign_id" id="campaignId" value="0">
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-hand-holding-heart heart-icon"></i> দান করুন
                </div>
                <div class="form-group">
                    <label><i class="fas fa-money-bill-wave"></i> দানের পরিমাণ (৳)</label>
                    <input type="number" 
                           name="donate_amount" 
                           id="donateAmount" 
                           class="form-control" 
                           placeholder="টাকার পরিমান লিখুন"
                           min="10"
                           autocomplete="off"
						   required
                           style="margin-top: 10px;">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> আপনার বার্তা (ঐচ্ছিক)</label>
                    <textarea name="message" id="message" class="form-control" placeholder="আপনার মূল্যবান মতামত দিন..."></textarea>
                </div>
				
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-heart"></i> দান করুন
                </button>
            </div>
        </form>
		
		<?php 			
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$amount  = $_POST['donate_amount'];
				$message  = $_POST['message'];
				
				if (empty($amount)){
					echo "<h2 style='color:red;'> Invalid Amount </h2>";
				}else{
					if($amount <= $total_balance){
						$stmt = $pdo->prepare("INSERT INTO donate (user_id, donate_amount, donate_dsc) VALUES (?, ?, ?)");
						$donate = $stmt->execute([$id, $amount, $message]);
						
						$sql ="UPDATE balance SET total_balance = total_balance - ? WHERE user_id = ?";
						$update_blance = $pdo->prepare($sql);
						$update_blance->execute([$amount, $id]);
						header("Location: ".$_SERVER['PHP_SELF']);
					}else{
						echo "Insufficient Balance";
					}
				}
			}
		?>
        
        <div class="info-text">
            <i class="fas fa-shield-alt"></i> আপনার দান সম্পূর্ণ নিরাপদে গ্রহণ করা হবে। দান করার পর টাকা আপনার ব্যালেন্স থেকে কেটে নেওয়া হবে।
        </div>
    </div>
    
    <script>
        // PHP data passed to JavaScript
        const USER_BALANCE = <?php echo $balance['total_balance']; ?>;
		
        function showMessage(message, type) {
            messageDiv.innerHTML = `<i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i> ${message}`;
            messageDiv.className = `form-message ${type}`;
            messageDiv.style.display = 'block';
            
            setTimeout(() => {
                if (messageDiv.style.display === 'block') {
                    messageDiv.style.display = 'none';
                }
            }, 5000);
        }
    </script>
</body>
</html>