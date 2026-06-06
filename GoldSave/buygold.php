<?php
    session_start();
	ob_start();
	include_once('header.php');
	include_once('db/index.php');
	
	// maintenance.php
    $isMaintenance = false; // true kortay hobay sms dily করলে আবার চালু হবে
    
    if ($isMaintenance) {
        echo "<h2 style='color:red;text-align:center;'>Website is under maintenance. Please try again later.</h2>";
        exit();
    }
	
	if (!isset($_SESSION['userId'])) {
		header('Location: login.php');
		exit();
	}
	
	$userId = $_SESSION['userId'];
	
	$stmt = $pdo->prepare("SELECT user_id, user_name, userId, profile_picture, created_at FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	
	$id = $user['user_id'];
	
	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$total_balance = $balance['total_balance']?? 0;
	
	$stmt = $pdo->prepare("SELECT gold_price FROM gold_price ORDER BY gold_price_id DESC LIMIT 1");
	$stmt->execute();
	$gold_price = $stmt->fetch();
	
	$gold_price = $gold_price['gold_price']?? 0;
	
	$stmt = $pdo->prepare("SELECT verify_status FROM verify WHERE user_id = ? ORDER BY verify_id DESC LIMIT 1");
	$stmt->execute([$id]);
	$verify = $stmt->fetch();
	
	if($verify){
		$verify_user =  $verify['verify_status'];
	}else{
		$verify_user =  'deactive';
	}
	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Buy Gold - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/buy.css">
	
</head>
<body>
    <div class="main-content">
        <!-- Top Header - Without Login/Register -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
				Buy Gold
				 <!-- <img src="logo/3532A.png" alt="Logo"> -->
            </div>
            <div style="width: 40px;"></div> <!-- Spacer for alignment -->
        </div>
        
        <!-- Gold Price Card -->
        <div class="gold-price-card">
            <div class="price-label">বর্তমান সোনার দাম</div>
            <div class="current-price" id="currentPrice">৳ <?php echo $gold_price; ?></div>
			<!--
            <div class="price-range">
                <span>২৪ ঘন্টা নিম্ন: <span class="low" id="lowPrice">৳ 7,600</span></span>
                <span>২৪ ঘন্টা উচ্চ: <span class="high" id="highPrice">৳ 7,900</span></span>
            </div>
			!-->
            <div class="info-text">
                <i class="fas fa-info-circle"></i> ১ ডায়মন্ড = ৳ 0.5
            </div>
        </div>
		
		<!-- Gold Balance Card -->
        <div class="gold-balance-card">
            <div class="gold-balance-label">
                <i class="fas fa-gem"></i> আপনার মোট সোনা
            </div>
            <div class="gold-balance-amount" id="userGold"><?php echo number_format($balance['gold_balance'], 8)?? 0; ?> গ্রাম</div>
            <div class="gold-balance-sub">সোনা সেল করে টাকা নিন</div>
        </div>
        
        <!-- Message Container -->
        <div id="formMessage" class="form-message"></div>
        
        <!-- BUY GOLD FORM -->
        <form id="buyForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="action" value="buy">
            <input type="hidden" name="csrf_token" id="csrfTokenBuy" value="">
            
            <div class="form-group">
                <label><i class="fas fa-money-bill-wave"></i> টাকার পরিমাণ লিখুন (৳)</label>
                <div class="amount-buttons" id="amountPresets">
                    <div class="amount-btn" data-amount="500">৳ ৫০০</div>
                    <div class="amount-btn" data-amount="1000">৳ ১,০০০</div>
                    <div class="amount-btn" data-amount="5000">৳ ৫,০০০</div>
                    <div class="amount-btn" data-amount="10000">৳ ১০,০০০</div>
                    <div class="amount-btn" data-amount="25000">৳ ২৫,০০০</div>
                    <div class="amount-btn" data-amount="50000">৳ ৫০,০০০</div>
                </div>
                <div class="custom-label">অথবা নিজের মত টাকা লিখুন:</div>
                <input type="number" 
                       name="amount" 
                       id="buyAmount" 
                       class="amount-input" 
                       placeholder="যেমন: ৭৫০"
                       autocomplete="off">
            </div>
			
            <input type="hidden" name="quantity" id="quantityInput">
			
            <div class="result-card">
                <div class="result-row">
                    <span class="result-label">
                        <i class="fas fa-gem"></i> আপনি পাবেন (সোনা)
                    </span>
                    <span class="result-value" id="goldToGet">০ গ্রাম</span>
                </div>
                <div class="result-row">
                    <span class="result-label">
                        <i class="fas fa-gift"></i> ফ্রি বোনাস ডায়মন্ড
                    </span>
                    <span class="result-value" id="bonusCoins">০ টি</span>
                </div>
            </div>
            
            <div class="balance-info">
                <span><i class="fas fa-wallet"></i> আপনার ব্যালেন্স</span>
                <span id="userBalance">৳ <?php echo $balance['total_balance']?? 0; ?></span>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="fas fa-shopping-cart"></i> সোনা কিনুন
            </button>
            <div class="secure-text">
                <i class="fas fa-lock"></i> নিরাপদ লেনদেন
            </div>
        </form>
		
		<?php 
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$buy_amount = $_POST['amount'];
				$buy_quantity = $_POST['quantity'];
				
				if($verify_user == 'active'){
				
					if (empty($buy_amount)) {
						echo 'Invalid Amount!';
						exit;
					}else{
						$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM buygold WHERE user_id = ?");
						$stmt->execute([$id]);
						$result = $stmt->fetch();

						$isFirstBuy = ($result['total'] == 0);
						if($buy_amount <= $total_balance){
							$buy_quantity = $buy_amount / $gold_price;
							
							// 👉 check first buy
							if($isFirstBuy){
								// first buy → bonus
								if($buy_amount >= 500 && $buy_amount <= 1000){
									$bonus_coin = 10;
								}elseif($buy_amount > 1000){
									$bonus_coin = 10;
								}else{
									$bonus_coin = 0;
								}
							} else {
								// 👉 not first buy → no bonus
								$bonus_coin = 0;
							}

							// insert
							$stmt = $pdo->prepare("INSERT INTO buygold (user_id, amount, quantity, bonus_coin) VALUES (?, ?, ?, ?)");
							$stmt->execute([$id, $buy_amount, $buy_quantity, $bonus_coin]);
							
							$sql ="UPDATE balance SET total_balance = total_balance - ?, gold_balance = gold_balance + ?, coin_balance = coin_balance + ? WHERE user_id = ?";
							$update_blance = $pdo->prepare($sql);
							$update_blance->execute([$buy_amount, $buy_quantity, $bonus_coin, $id]);
							echo '<span id="copyMsg" style="color: green;">Buy sucessful </span>'; 
						}else{
							echo '<span id="copyMsg" style="color: green;">অপর্যাপ্ত ব্যালেন্স!</span>'; 
						}
					}
				}else{
					echo '<span id="copyMsg" style="color: green;">You are not verify user please verify frist</span>';
				}
			}		
		?>
        
        <!-- Offer Banner -->
        <div class="offer-banner">
            <i class="fas fa-tags"></i> বিশেষ অফার:
            <span style="color: #FFD700;">৳৫০০+ সোনা কিনলে → ১০টি ফ্রি ডায়মন্ড</span>
            <span style="color: #FFD700; margin-left: 8px;">৳১০০০+ সোনা কিনলে → ২০টি ফ্রি ডায়মন্ড</span>
        </div>
		<!-- Offer Banner -->
        <div class="offer-banner">
            <i class="fas fa-tags"></i> বিশেষ অফার শর্ত:
            <span style="color: #FFD700;">বিনামূল্যে বোনাস ডায়মন্ড শুধুমাত্র প্রথম কিনার সময় পাওয়া যাবে </span>
        </div>
    </div>
    
    <script>
        // Configuration
        const GOLD_PRICE = <?php echo $gold_price; ?>; // ৳ per gram
        
        // User data (will come from PHP session in real implementation)
        const userData = {
           // balance: 5250, // ৳
            balance: <?php echo $balance['total_balance']; ?> // ৳
        };
        
        // Free coin calculation based on purchase amount
        function getFreeCoins(amount) {
            if (amount >= 1000) {
                return 20; // 1000+ Taka = 20 free coins
            } else if (amount >= 500) {
                return 10; // 500+ Taka = 10 free coins
            }
            return 0;
        }
        
        // Generate CSRF token
        function generateCSRFToken() {
            return Math.random().toString(36).substring(2) + Date.now().toString(36);
        }
        
        document.getElementById('csrfTokenBuy').value = generateCSRFToken();
        
        // Update user balance display
        document.getElementById('userBalance').innerHTML = `৳ ${userData.balance.toLocaleString('bn-BD')}`;
        
        // DOM Elements
        const buyAmountInput = document.getElementById('buyAmount');
        const goldToGetSpan = document.getElementById('goldToGet');
        const bonusCoinsSpan = document.getElementById('bonusCoins');
        const submitBtn = document.getElementById('submitBtn');
        const messageDiv = document.getElementById('formMessage');
        
        // Calculate everything
        function calculateBuy() {
            let amount = parseFloat(buyAmountInput.value);
            
            if (isNaN(amount) || amount <= 0) {
                goldToGetSpan.innerHTML = '০ গ্রাম';
                bonusCoinsSpan.innerHTML = '০ টি';
                return;
            }
            
            // Calculate gold grams: amount / price per gram
            const goldGram = amount / GOLD_PRICE;
            
            // Get free bonus coins
            const freeCoins = getFreeCoins(amount);
            
            // Update display - Format with Bengali numbers
            goldToGetSpan.innerHTML = `${goldGram.toFixed(8)} গ্রাম`;
            bonusCoinsSpan.innerHTML = freeCoins > 0 ? `<span class="bonus-badge">+${freeCoins} টি ফ্রি!</span>` : '০ টি';
            
            // Check if amount exceeds balance
            if (amount > userData.balance) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                showMessage(`অপর্যাপ্ত ব্যালেন্স! আপনার ব্যালেন্স ৳ ${userData.balance.toLocaleString('bn-BD')}`, 'error');
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                messageDiv.style.display = 'none';
            }
        }
        
        // Show message function
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
        
        // Input event listener
        buyAmountInput.addEventListener('input', calculateBuy);
        
        // Amount preset buttons
        document.querySelectorAll('.amount-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const amount = this.getAttribute('data-amount');
                buyAmountInput.value = amount;
                calculateBuy();
                // Clear any previous error messages
                if (parseFloat(amount) <= userData.balance) {
                    messageDiv.style.display = 'none';
                }
            });
        });
        
        // Form submission
        const buyForm = document.getElementById('buyForm');
        
        buyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const amount = parseFloat(buyAmountInput.value);
            
            if (isNaN(amount) || amount <= 0) {
                showMessage('দয়া করে একটি বৈধ পরিমাণ লিখুন', 'error');
                return;
            }
            
            if (amount < 100) {
                showMessage('সর্বনিম্ন কেনার পরিমাণ ৳ ১০০', 'error');
                return;
            }
            
            if (amount > userData.balance) {
                showMessage(`অপর্যাপ্ত ব্যালেন্স! আপনার ব্যালেন্স ৳ ${userData.balance.toLocaleString('bn-BD')}`, 'error');
                return;
            }
            
            // Calculate values for confirmation
            const goldGram = amount / GOLD_PRICE;
            const freeCoins = getFreeCoins(amount);
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> প্রসেসিং...';
            
            // Update CSRF token
            document.getElementById('csrfTokenBuy').value = generateCSRFToken();
            
            // Create form data for submission
            const formData = new FormData();
            formData.append('amount', amount);
            formData.append('gold_gram', goldGram);
            formData.append('free_coins', freeCoins);
            formData.append('csrf_token', document.getElementById('csrfTokenBuy').value);
            
            // For demo: Simulate PHP processing
            // In production, uncomment the line below to submit to PHP
            this.submit();
            
            // Demo simulation (remove in production)
            setTimeout(() => {
                showMessage(`সফলভাবে কেনা হয়েছে! আপনি ${goldGram.toFixed(4)} গ্রাম সোনা কিনেছেন এবং ${freeCoins} টি ফ্রি ডায়মন্ড পেয়েছেন!`, 'success');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> সোনা কিনুন';
                
                // Update balance (demo only)
                userData.balance -= amount;
                document.getElementById('userBalance').innerHTML = `৳ ${userData.balance.toLocaleString('bn-BD')}`;
                buyAmountInput.value = '';
                calculateBuy();
                
                setTimeout(() => {
                    // window.location.href = 'dashboard.html';
                }, 2000);
            }, 1500);
        });
        
        // Initialize calculation
        calculateBuy();
        
        // Add CSS for spinner
        const style = document.createElement('style');
        style.textContent = `
            .fa-spin {
                animation: fa-spin 1s infinite linear;
            }
            @keyframes fa-spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>