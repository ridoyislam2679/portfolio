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
	$gold_balance = $balance['gold_balance']?? 0;
	
	$stmt = $pdo->prepare("SELECT gold_price FROM gold_price ORDER BY gold_price_id DESC LIMIT 1");
	$stmt->execute();
	$gold_price = $stmt->fetch();
	
	$gold_price = $gold_price['gold_price']?? 0;
	
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Sell Gold - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/sell.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                Sell Gold
            </div>
            <div style="width: 40px;"></div> <!-- Spacer for alignment -->
        </div>
        
        <!-- Gold Price Card -->
        <div class="gold-price-card">
            <div class="price-label">বর্তমান সোনার দাম</div>
            <div class="current-price" id="currentPrice">৳ <?php echo $gold_price; ?></div>
        </div>
        
        <!-- Gold Balance Card -->
        <div class="gold-balance-card">
            <div class="gold-balance-label">
                <i class="fas fa-gem"></i> আপনার মোট সোনা
            </div>
            <div class="gold-balance-amount" id="userGold"><?php echo $gold_balance; ?> গ্রাম</div>
            <div class="gold-balance-sub">সোনা সেল করে টাকা নিন</div>
        </div>
        
        <!-- Message Container -->
        <div id="formMessage" class="form-message"></div>
        
        <!-- SELL GOLD FORM -->
        <form id="sellForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="action" value="sell">
            <input type="hidden" name="csrf_token" id="csrfTokenSell" value="">
            
            <div class="form-group">
                <label><i class="fas fa-gem"></i> সোনার পরিমাণ লিখুন (গ্রাম)</label>
                <div class="amount-buttons" id="amountPresets">
                    <div class="amount-btn" data-gram="0.5">০.৫ গ্রাম</div>
                    <div class="amount-btn" data-gram="1">১ গ্রাম</div>
                    <div class="amount-btn" data-gram="2">২ গ্রাম</div>
                    <div class="amount-btn" data-gram="5">৫ গ্রাম</div>
                    <div class="amount-btn" data-gram="10">১০ গ্রাম</div>
                    <div class="amount-btn" data-gram="25">২৫ গ্রাম</div>
                </div>
                <div class="custom-label">অথবা নিজের মত পরিমাণ লিখুন:</div>
                <input type="number" 
                       name="gold_gram" 
                       id="sellGoldGram" 
                       class="gram-input" 
                       placeholder="যেমন: ১.৫"
                       min="0.1"
                       step="0.1"
                       autocomplete="off">
            </div>
            
            <div class="result-card">
                <div class="result-row">
                    <span class="result-label">
                        <i class="fas fa-money-bill-wave"></i> আপনি পাবেন (টাকা)
                    </span>
                    <span class="result-value" id="moneyToGet">৳ ০</span>
                </div>
                <div class="result-row">
                    <span class="result-label">
                        <i class="fas fa-chart-line"></i> বর্তমান দর
                    </span>
                    <span class="result-value" id="currentRate">৳ <?php echo $gold_price; ?>/গ্রাম</span>
                </div>
            </div>
            
            <div class="balance-info">
                <span><i class="fas fa-wallet"></i> আপনার ব্যালেন্স </span>
                <span id="newBalance">৳ <?php echo $balance['total_balance']?? 0; ?></span>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="fas fa-exchange-alt"></i> সোনা সেল করুন
            </button>
            <div class="secure-text">
                <i class="fas fa-lock"></i> নিরাপদ লেনদেন
            </div>
        </form>
		
		<?php 
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$sell_quantity = $_POST['gold_gram'];
				
				if (empty($sell_quantity)) {
					echo 'Invalid Quantity!';
					exit;
				}else{
					if($sell_quantity <= $gold_balance){
						$sell_price = $sell_quantity * $gold_price;
						
						$stmt = $pdo->prepare("INSERT INTO sellgold (user_id, amount, quantity) VALUES (?, ?, ?)");
						$stmt->execute([$id, $sell_price, $sell_quantity]);
						
						$sql ="UPDATE balance SET total_balance = total_balance + ?, gold_balance = gold_balance - ? WHERE user_id = ?";
						$update_blance = $pdo->prepare($sql);
						$update_blance->execute([$sell_price, $sell_quantity, $id]);
						echo '<span id="copyMsg" style="color: green;">Sell sucessful </span>'; 
					}else{
						echo '<span id="copyMsg" style="color: green;">অপর্যাপ্ত ব্যালেন্স!</span>'; 
					}
				}
			}		
		?>
        
        <div class="warning-text">
            <i class="fas fa-info-circle"></i> সোনা সেল করার পর টাকা আপনার ব্যালেন্সে যোগ হবে
        </div>
    </div>
    
    <script>
        // Configuration
        const GOLD_PRICE = <?php echo $gold_price; ?>; // ৳ per gram
        
        // User data (will come from PHP session in real implementation)
        const userData = {
            balance: <?php echo $balance['total_balance']; ?>, // ৳ current balance
            gold: <?php echo $balance['gold_balance']; ?>     // grams
        };
        
        // Generate CSRF token
        function generateCSRFToken() {
            return Math.random().toString(36).substring(2) + Date.now().toString(36);
        }
        
        document.getElementById('csrfTokenSell').value = generateCSRFToken();
        
        // Update user displays
        document.getElementById('userGold').innerHTML = `${userData.gold.toLocaleString('bn-BD')} গ্রাম`;
        document.getElementById('newBalance').innerHTML = `৳ ${userData.balance.toLocaleString('bn-BD')}`;
        
        // DOM Elements
        const sellGoldGramInput = document.getElementById('sellGoldGram');
        const moneyToGetSpan = document.getElementById('moneyToGet');
        const newBalanceSpan = document.getElementById('newBalance');
        const submitBtn = document.getElementById('submitBtn');
        const messageDiv = document.getElementById('formMessage');
        
        // Calculate everything
        function calculateSell() {
            let gram = parseFloat(sellGoldGramInput.value);
            
            if (isNaN(gram) || gram <= 0) {
                moneyToGetSpan.innerHTML = '৳ ০';
                newBalanceSpan.innerHTML = `৳ ${userData.balance.toLocaleString('bn-BD')}`;
                return;
            }
            
            // Calculate money: gram * price per gram
            const moneyToGet = gram * GOLD_PRICE;
            const newBalance = userData.balance + moneyToGet;
            
            // Update display - Format with Bengali numbers
            moneyToGetSpan.innerHTML = `৳ ${moneyToGet.toFixed(2)}`;
            newBalanceSpan.innerHTML = `৳ ${newBalance.toLocaleString('bn-BD')}`;
            
            // Check if user has enough gold
            if (gram > userData.gold) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                showMessage(`অপর্যাপ্ত সোনা! আপনার কাছে ${userData.gold.toLocaleString('bn-BD')} গ্রাম সোনা আছে`, 'error');
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
        sellGoldGramInput.addEventListener('input', calculateSell);
        
        // Amount preset buttons
        document.querySelectorAll('.amount-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const gram = this.getAttribute('data-gram');
                sellGoldGramInput.value = gram;
                calculateSell();
                // Clear any previous error messages
                if (parseFloat(gram) <= userData.gold) {
                    messageDiv.style.display = 'none';
                }
            });
        });
        
        // Form submission
        const sellForm = document.getElementById('sellForm');
        
        sellForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const gram = parseFloat(sellGoldGramInput.value);
            
            if (isNaN(gram) || gram <= 0) {
                showMessage('দয়া করে একটি বৈধ পরিমাণ লিখুন', 'error');
                return;
            }
            
            if (gram < 0.1) {
                showMessage('সর্বনিম্ন সেল করার পরিমাণ ০.১ গ্রাম', 'error');
                return;
            }
            
            if (gram > userData.gold) {
                showMessage(`অপর্যাপ্ত সোনা! আপনার কাছে ${userData.gold.toLocaleString('bn-BD')} গ্রাম সোনা আছে`, 'error');
                return;
            }
            
            // Calculate values
            const moneyToGet = gram * GOLD_PRICE;
            const newBalance = userData.balance + moneyToGet;
            const newGold = userData.gold - gram;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> প্রসেসিং...';
            
            // Update CSRF token
            document.getElementById('csrfTokenSell').value = generateCSRFToken();
            
            // Create form data for submission
            const formData = new FormData();
            formData.append('gold_gram', gram);
            formData.append('money_amount', moneyToGet);
            formData.append('csrf_token', document.getElementById('csrfTokenSell').value);
            
            // For demo: Simulate PHP processing
            // In production, uncomment the line below to submit to PHP
            this.submit();
            
            // Demo simulation (remove in production)
            setTimeout(() => {
                showMessage(`সফলভাবে সেল করা হয়েছে! আপনি ${gram.toFixed(4)} গ্রাম সোনা সেল করেছেন এবং ৳ ${moneyToGet.toFixed(2)} পেয়েছেন!`, 'success');
                
                // Update user data (demo only)
                userData.gold = newGold;
                userData.balance = newBalance;
                
                // Update displays
                document.getElementById('userGold').innerHTML = `${userData.gold.toLocaleString('bn-BD')} গ্রাম`;
                document.getElementById('newBalance').innerHTML = `৳ ${userData.balance.toLocaleString('bn-BD')}`;
                
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-exchange-alt"></i> সোনা সেল করুন';
                sellGoldGramInput.value = '';
                calculateSell();
                
                setTimeout(() => {
                    // window.location.href = 'dashboard.html';
                }, 2000);
            }, 1500);
        });
        
        // Initialize calculation
        calculateSell();
        
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