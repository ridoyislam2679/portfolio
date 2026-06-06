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
	
	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$total_balance = $balance['total_balance']?? 0;
	$gold_balance = $balance['gold_balance']?? 0;
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Collect Gold - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/collectgold.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                Collect Gold
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Gold Balance Card -->
        <div class="gold-balance-card">
            <div class="gold-balance-label">
                <i class="fas fa-gem"></i> আপনার মোট সোনা
            </div>
            <div class="gold-balance-amount" id="userGold"><?php echo number_format($gold_balance, 8)?? 0; ?> গ্রাম</div>
            <div class="gold-balance-sub">সোনা কালেক্ট করে নিন আপনার ঠিকানায়</div>
            <div class="min-requirement">
                <i class="fas fa-info-circle"></i> ন্যূনতম ১ গ্রাম সোনা কালেক্ট করতে পারবেন
            </div>
        </div>
        
        <!-- Message Container -->
        <div id="formMessage" class="form-message"></div>
        
        <!-- Collect Gold Form -->
        <form id="collectForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="action" value="collect">
            <input type="hidden" name="csrf_token" id="csrfToken" value="">
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-gem"></i> সোনার পরিমাণ
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-weight-hanging"></i> কত গ্রাম সোনা কালেক্ট করবেন?</label>
                    <div class="gold-input-wrapper">
                        <input type="number" 
                               name="gold_gram" 
                               id="collectGoldGram" 
                               class="form-control" 
                               placeholder="যেমন: ১.৫"
                               min="1"
                               step="0.1"
                               autocomplete="off">
                        <span class="gold-unit">গ্রাম</span>
                    </div>
                    <div class="preset-buttons">
                        <div class="preset-btn" data-gram="1">১ গ্রাম</div>
                        <div class="preset-btn" data-gram="2">২ গ্রাম</div>
                        <div class="preset-btn" data-gram="5">৫ গ্রাম</div>
                        <div class="preset-btn" data-gram="10">১০ গ্রাম</div>
                    </div>
                </div>
                
                <div class="result-card">
                    <div class="result-row">
                        <span class="result-label">কালেক্ট করতে চান</span>
                        <span class="result-value" id="collectAmount">০ গ্রাম</span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">কালেক্টের পর বাকি থাকবে</span>
                        <span class="result-value" id="remainingGold"><?php echo number_format($gold_balance, 8)?? 0; ?> গ্রাম</span>
                    </div>
                </div>
            </div>
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-user"></i> আপনার তথ্য
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-user-circle"></i> সম্পূর্ণ নাম</label>
                    <input type="text" 
                           name="fullname" 
                           id="fullname" 
                           class="form-control" 
                           placeholder="আপনার সম্পূর্ণ নাম লিখুন"
                           autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-phone-alt"></i> মোবাইল নম্বর</label>
                    <input type="tel" 
                           name="mobile" 
                           id="mobile" 
                           class="form-control" 
                           placeholder="০১XXXXXXXXX"
                           autocomplete="off">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt"></i> সম্পূর্ণ ঠিকানা</label>
                    <textarea name="address" 
                              id="address" 
                              class="form-control" 
                              placeholder="বাড়ির ঠিকানা, জেলা, পোস্ট কোড"></textarea>
                </div>
            </div>
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-truck"></i> সোনা কীভাবে নিবেন?
                </div>
                
                <div class="form-group">
                    <div class="option-group" id="deliveryOption">
                        <div class="option-item">
                            <input type="radio" name="delivery_method" id="optionCoin" value="coin" checked>
                            <label for="optionCoin">
                                <i class="fas fa-coins"></i>
                                <span>কয়েন</span>
                            </label>
                        </div>
                        <div class="option-item">
                            <input type="radio" name="delivery_method" id="optionBiscuit" value="biscuit">
                            <label for="optionBiscuit">
                                <i class="fas fa-cube"></i>
                                <span>বিস্কুট বার</span>
                            </label>
                        </div>
                        <div class="option-item">
                            <input type="radio" name="delivery_method" id="optionJewelry" value="jewelry">
                            <label for="optionJewelry">
                                <i class="fas fa-ring"></i>
                                <span>গহনা</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">
                <i class="fas fa-hand-holding-heart"></i> সোনা কালেক্ট করুন
            </button>
            <div class="info-text">
                <i class="fas fa-shield-alt"></i> আপনার তথ্য নিরাপদে রাখা হবে। কালেক্ট করতে ৭-১০ কার্যদিবস সময় লাগতে পারে।
            </div>
        </form>
		<?php 
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$gold_gram = $_POST['gold_gram'];
				$fullname  = $_POST['fullname'];
				$mobile	   = $_POST['mobile'];
				$address   = $_POST['address'];
				$delivery_method   = $_POST['delivery_method'];
				
				if (empty($gold_gram) || empty($fullname) || empty($mobile) || empty($address) ||  empty($delivery_method)) {
					echo '<span id="copyMsg" style="color: green;">Invalid Submited!</span>';
					exit;
				}else{
					if($gold_balance >= $gold_gram){
						if($gold_gram < 1){
							echo '<span id="copyMsg" style="color: green;">ন্যূনতম ১ গ্রাম সোনা কালেক্ট করতে পারবেন </span>';
						}else{
							$stmt = $pdo->prepare("INSERT INTO collectgold (user_id, quantity, method, delivery_user, delivery_user_number, delivery_address) VALUES (?, ?, ?, ?, ?, ?)");
							$stmt->execute([$id, $gold_gram, $delivery_method, $fullname, $mobile, $address]);
							
							$stmt = $pdo->prepare("UPDATE balance SET gold_balance = gold_balance - ? WHERE user_id = ?");
							$stmt->execute([$gold_gram, $id]);
							
							echo '<span id="copyMsg" style="color: green;">submite sucessful </span>';
						}	
					}else{
						echo '<span id="copyMsg" style="color: green;">অপর্যাপ্ত সোনা! </span>';
					}	
				}
			}

		?>
		
    </div>
    
    <script>
        // User data (will come from PHP session in real implementation)
        const userData = {
            gold: <?php echo number_format($gold_balance, 8)?? 0; ?>,      // grams
            
        };
        
        // Generate CSRF token
        function generateCSRFToken() {
            return Math.random().toString(36).substring(2) + Date.now().toString(36);
        }
        
        document.getElementById('csrfToken').value = generateCSRFToken();
        
        // Pre-fill user data (in real implementation, these will come from PHP session)
        //document.getElementById('fullname').value = userData.fullname;
        //document.getElementById('mobile').value = userData.mobile;
        //document.getElementById('address').value = userData.address;
        
        // Update gold display
        function updateGoldDisplay() {
            document.getElementById('userGold').innerHTML = `${userData.gold.toFixed(3)} গ্রাম`;
            document.getElementById('remainingGold').innerHTML = `${userData.gold.toFixed(3)} গ্রাম`;
        }
        updateGoldDisplay();
        
        // DOM Elements
        const collectGoldGramInput = document.getElementById('collectGoldGram');
        const collectAmountSpan = document.getElementById('collectAmount');
        const remainingGoldSpan = document.getElementById('remainingGold');
        const submitBtn = document.getElementById('submitBtn');
        const messageDiv = document.getElementById('formMessage');
        
        // Calculate function
        function calculateCollect() {
            let gram = parseFloat(collectGoldGramInput.value);
            const userGold = userData.gold;
            
            if (isNaN(gram) || gram <= 0) {
                collectAmountSpan.innerHTML = '০ গ্রাম';
                remainingGoldSpan.innerHTML = `${userGold.toFixed(3)} গ্রাম`;
                return;
            }
            
            collectAmountSpan.innerHTML = `${gram.toFixed(3)} গ্রাম`;
            const remaining = userGold - gram;
            
            if (remaining < 0) {
                remainingGoldSpan.innerHTML = `০ গ্রাম <span style="color: #ff6b6b;">(অপর্যাপ্ত)</span>`;
            } else {
                remainingGoldSpan.innerHTML = `${remaining.toFixed(3)} গ্রাম`;
            }
            
            // Validation
            if (gram < 1) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                showMessage('ন্যূনতম ১ গ্রাম সোনা কালেক্ট করতে পারবেন', 'error');
            } else if (gram > userGold) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                showMessage(`অপর্যাপ্ত সোনা! আপনার কাছে ${userGold.toFixed(3)} গ্রাম সোনা আছে`, 'error');
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                messageDiv.style.display = 'none';
            }
        }
        
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
        
        // Event listeners
        collectGoldGramInput.addEventListener('input', calculateCollect);
        
        // Preset buttons
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const gram = this.getAttribute('data-gram');
                collectGoldGramInput.value = gram;
                calculateCollect();
                if (parseFloat(gram) <= userData.gold && parseFloat(gram) >= 1) {
                    messageDiv.style.display = 'none';
                }
            });
        });
        
        // Form submission
        const collectForm = document.getElementById('collectForm');
        
        collectForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const gram = parseFloat(collectGoldGramInput.value);
            const fullname = document.getElementById('fullname').value.trim();
            const mobile = document.getElementById('mobile').value.trim();
            const address = document.getElementById('address').value.trim();
            const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked').value;
			
            
            // Validation
            if (isNaN(gram) || gram <= 0) {
                showMessage('দয়া করে সোনার পরিমাণ লিখুন', 'error');
                return;
            }
            
            if (gram < 1) {
                showMessage('ন্যূনতম ১ গ্রাম সোনা কালেক্ট করতে পারবেন', 'error');
                return;
            }
            
            if (gram > userData.gold) {
                showMessage(`অপর্যাপ্ত সোনা! আপনার কাছে ${userData.gold.toFixed(3)} গ্রাম সোনা আছে`, 'error');
                return;
            }
            
            if (!fullname) {
                showMessage('দয়া করে আপনার সম্পূর্ণ নাম লিখুন', 'error');
                return;
            }
            
            if (!mobile) {
                showMessage('দয়া করে মোবাইল নম্বর লিখুন', 'error');
                return;
            }
            
            if (mobile.length < 11) {
                showMessage('দয়া করে সঠিক মোবাইল নম্বর লিখুন', 'error');
                return;
            }
            
            if (!address) {
                showMessage('দয়া করে আপনার সম্পূর্ণ ঠিকানা লিখুন', 'error');
                return;
            }
            
            // Get delivery method text
            let deliveryText = '';
            switch(deliveryMethod) {
                case 'coin': deliveryText = 'কয়েন'; break;
                case 'biscuit': deliveryText = 'বিস্কুট বার'; break;
                case 'bar': deliveryText = 'বার'; break;
                case 'jewelry': deliveryText = 'গহনা'; break;
                case 'gram': deliveryText = 'গ্রাম পিস'; break;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> প্রসেসিং...';
            
            // Update CSRF token
            document.getElementById('csrfToken').value = generateCSRFToken();
            
            // Create form data
            const formData = new FormData();
            formData.append('gold_gram', gram);
            formData.append('fullname', fullname);
            formData.append('mobile', mobile);
            formData.append('address', address);
            formData.append('delivery_method', deliveryMethod);
            formData.append('csrf_token', document.getElementById('csrfToken').value);
            
			this.submit(); 
			
            // Demo simulation (remove in production and use this.submit())
            setTimeout(() => {
                showMessage(`সফলভাবে কালেক্ট রিকোয়েস্ট জমা হয়েছে! আপনি ${gram.toFixed(3)} গ্রাম সোনা ${deliveryText} আকারে কালেক্ট করবেন।`, 'success');
                
                // Update user gold (demo only)
                userData.gold -= gram;
                updateGoldDisplay();
                collectGoldGramInput.value = '';
                calculateCollect();
                
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-hand-holding-heart"></i> সোনা কালেক্ট করুন';
                
                setTimeout(() => {
                    // window.location.href = 'dashboard.html';
                }, 2000);
            }, 1500);
        });
        
        // Initialize
        calculateCollect();
        
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