<?php
	session_start();
	ob_start();
	include_once('db/index.php');

	// 🔥 maintenance mode
	$isMaintenance = false;

	if ($isMaintenance) {
		echo "<h2 style='color:red;text-align:center;'>Website is under maintenance</h2>";
		exit();
	}

	// 🔒 check login FIRST
	if (!isset($_SESSION['userId'])) {
		header('Location: login.php');
		exit();
	}

	$userId = $_SESSION['userId']; // ✔️ correct session

	// 🔍 status check
	$stmt = $pdo->prepare("SELECT status FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();

	if (!$user || $user['status'] !== 'active') {
		session_destroy();
		header("Location: login.php?msg=deactivated");
		exit();
	}

	// ✔️ only AFTER security
	include_once('header.php');


	
	$stmt = $pdo->prepare("SELECT user_id, user_name, userId, referred_id, profile_picture, created_at FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	
	$id = $user['user_id'];
	$referred_id = $user['referred_id'];
	
	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$stmt = $pdo->prepare("SELECT marque_text FROM marque ORDER BY marque_id DESC LIMIT 1");
	$stmt->execute([]);
	$marque = $stmt->fetch();
	
	$stmt = $pdo->prepare("SELECT verify_date, verify_expair, verify_status FROM verify WHERE user_id = ? ORDER BY verify_id DESC LIMIT 1");
	$stmt->execute([$id]);
	$verify = $stmt->fetch();
	
	$today = date("Y-m-d");
	
	if($verify){
		if($verify['verify_status'] === "active" && $verify['verify_expair'] >= $today){
			$status = "active";
		} else {
			$status = "deactive";
		}
	} else {
		$status = "deactive";
	}
	
	$stmt = $pdo->prepare("UPDATE verify SET verify_status = 'deactive' WHERE verify_expair < ? AND verify_status = 'active'
");
	$stmt->execute([$today]);
	
	
	// daily package income collect automaticly

	$stmt = $pdo->prepare("
		SELECT p.*, s.daily_income, s.daily_coin 
		FROM p2p p
		JOIN p2p_sevings s ON p.package_id = s.package_id
		WHERE p.p2p_status = 'active'
		AND (p.last_collect_date IS NULL OR p.last_collect_date < ?)
		AND p.expair_date >= ?
	");
	$stmt->execute([$today, $today]);

	$packages = $stmt->fetchAll();
	
	foreach($packages as $pkg){

		$user_id = $pkg['user_id'];
		$income  = $pkg['daily_income'];
		$coin    = $pkg['daily_coin'];

		// balance update
		$stmt = $pdo->prepare("
			UPDATE balance 
			SET total_balance = total_balance + ?, 
				coin_balance = coin_balance + ?
			WHERE user_id = ?
		");
		$stmt->execute([$income, $coin, $user_id]);

		// last collect update
		$stmt = $pdo->prepare("
			UPDATE p2p 
			SET last_collect_date = ?
			WHERE user_id = ?
		");
		$stmt->execute([$today, $user_id]);
	}
	

	// last Friday
	$start = date('Y-m-d', strtotime('last friday', strtotime($today)));

	// next Thursday
	$end = date('Y-m-d', strtotime($start . ' +6 days'));

	$stmt = $pdo->prepare("
		SELECT SUM(donate_amount) as total 
		FROM donate 
		WHERE DATE(donate_date) BETWEEN ? AND ?
	");
	$stmt->execute([$start, $end]);

	$result = $stmt->fetch();

	//echo "From $start to $end = " . $result['total'];
	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Dashboard - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="CSS/index.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Top Header -->
        <div class="top-header">
			<div class="logo-area">
                <a href="home.php" style="text-decoration: none;">
                    <span class="logo">
                        <!--<i class="fas fa-coins"></i> Gold Kinen !-->
						<img src="logo/3532A.png" alt="Logo">
                    </span>
                </a>
            </div>
			<!--
            <div class="logo">
                <a href=""> <i class="fas fa-coins"></i> Gold Kinen </a>
            </div>
			
            <div class="notification-icon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>
			!-->
        </div>
        
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-row">
                <div class="profile-image">
                    <div class="default-avatar">
                        <img src="assets/<?php echo $user['profile_picture']; ?>" class="profile-pic">
                    </div>
                    <div class="join-date">
                        <i class="fas fa-calendar-alt"></i> <?php echo $user['created_at']; ?>
                    </div>
                </div>
				
				
                <div class="profile-info">
					<?php if($status === "active") {
						?>
							<div class="user-name">
								<?php echo $user['user_name']; ?>
								<span id="verifiedBadge" class="verified-badge"">
									<i class="fas fa-check"></i>
								</span>
							</div>
						<?php
					}else{
						?>
							<div class="user-name">
								<?php echo $user['user_name']; ?>
								<span id="verifiedBadge" class="verified-badge" style="display: none;">
									<i class="fas fa-check"></i>
								</span>
							</div>
							<div class="mb-2">
								<form action="" method="POST">
									<button type="submit" name="verifyBtn" id="verifyBtn" class="verify-btn">
										<i class="fas fa-shield-alt"></i> Verify Account
									</button>
								</form>
								<?php 
									if(isset($_POST['verifyBtn'])){
										$total_balance = $balance['total_balance'];
										$verify_amount = 100;
										$refer_amount = 20;										
										
										$verify_date   = date("Y-m-d");
										$duration_date = 30;
										$expair_date  = date("Y-m-d", strtotime("+$duration_date days"));
										
										
										if($total_balance >= 100){
											 try {

												$pdo->beginTransaction();

												// ✅ check already verified
												$stmt = $pdo->prepare("SELECT verify_id FROM verify WHERE user_id = ? 
														AND verify_status = 'active' AND verify_expair >= ?");
												$stmt->execute([$id, $verify_date]);
												$alreadyVerified = $stmt->fetch();

												if($alreadyVerified){
													throw new Exception("Already verified");
												}

												// ✅ safe balance deduct
												$stmt = $pdo->prepare("
													UPDATE balance 
													SET total_balance = total_balance - ? 
													WHERE user_id = ? AND total_balance >= ?
												");
												$stmt->execute([$verify_amount, $id, $verify_amount]);

												if($stmt->rowCount() == 0){
													throw new Exception("Insufficient balance");
												}

												// ✅ referral bonus (add, not deduct)
												if(!empty($referred_id) && $referred_id != $id){
													$stmt = $pdo->prepare("
														UPDATE balance 
														SET total_balance = total_balance + ? 
														WHERE user_id = ?
													");
													$stmt->execute([$refer_amount, $referred_id]);
												}

												// ✅ insert verify
												$stmt = $pdo->prepare("
													INSERT INTO verify (user_id, verify_date, verify_expair, verify_status) 
													VALUES (?, ?, ?, 'active')
												");
												$stmt->execute([$id, $verify_date, $expair_date]);

												$pdo->commit();

												header("Location: ".$_SERVER['PHP_SELF']);
												exit();

											} catch(Exception $e){
												$pdo->rollBack();
												echo '<span style="color:red;">'.$e->getMessage().'</span>';
											}
										}else{
											echo '<span id="copyMsg" style="color: green;">অপর্যাপ্ত ব্যালেন্স!</span>'; 
										}
									}
								?>
							</div>
						<?php
					}						
					?>
                    
                    
                    <div class="balance-info">
                        <div class="balance-label">Total Balance</div>
                        <div class="balance-amount"><?php echo $balance['total_balance']?? 0; ?></div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- User ID Card with Copy Button -->
		<div class="userid-card">
			<div>
				<div class="userid-label">
					<i class="fas fa-id-card"></i> আপনার ইউজার আইডি
				</div>
				<div class="userid-value" id="userId"><?php echo $user['userId']; ?></div>
			</div>
			<button class="copy-btn" id="copyUserIdBtn">
				<i class="fas fa-copy"></i> কপি
			</button>
		</div>
        
		<!-- withdraw Row -->
        <div class="coin-row">
            <div class="coin-info">
                <div class="coin-icon">
                    <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                </div>
                <div>
                    <div class="coin-amount"><?php echo $balance['total_balance']?? 0; ?> </div>
                </div>
            </div>
            <button class="verify-bonus-btn" onclick="location.href='withdraw.php'">
                <i class="fa-solid fa-paper-plane"></i> Withdraw
            </button>
        </div>
		
        <!-- Gold Card -->
        <div class="gold-card">
            <div class="gold-icon">
                <!--<i class="fas fa-gem"></i>-->
                <img src="assets/goldbar.png">
            </div>
            <div class="gold-amount"><?php echo $balance['gold_balance']?? 0; ?> Gram</div>
            <div class="gold-label">Total Gold</div>
            <div class="action-buttons">
                <button class="action-btn btn-buy" onclick="location.href='buygold.php'">
                    <i class="fas fa-shopping-cart"></i> Buy Gold
                </button>
                <button class="action-btn btn-sell" onclick="location.href='sellgold.php'">
                    <i class="fas fa-exchange-alt"></i> Sell Gold
                </button>
                <button class="action-btn btn-collect" onclick="location.href='collectgold.php'">
                    <i class="fas fa-shipping-fast"></i> Collect
                </button>
            </div>
        </div>
        
        <!-- Coin Row -->
        <div class="coin-row">
            <div class="coin-info">
                <div class="coin-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <div class="coin-amount"><?php echo $balance['coin_balance']?? 0; ?> Diamond</div>
                    <div style="font-size: 11px; color: rgba(255,255,255,0.5);">1 Diamond = 0.5 TK</div>
                </div>
            </div>
            <button class="mobile-recharge-btn" onclick="location.href='recharge.php'">
                <i class="fas fa-mobile-alt"></i> Mobile Recharge
            </button>
        </div>
		
		<!-- Coin Row -->
        <div class="coin-row">
			<button class="verify-bonus-btn" onclick="location.href='bonus.php'">
                <i class="fas fa-mobile-alt"></i> Bonus Diamond
            </button>
            <div class="coin-info">
                <div class="coin-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <span class="bonus-title">আইডি অ্যাক্টিভ বোনাস </span>
                </div>
            </div>            
        </div>
        
        <!-- Donation Section with Home Page Style Slider -->
        <div class="donation-section">
            <div class="donation-header">
                <div class="donation-title">
                    <i class="fas fa-hand-holding-heart" style="color: #ff4444;"></i> Help Others
                </div>
                <div class="total-donors">
                    <div class="total-donors-count"><?php echo $result['total']; ?></div>
                    <div style="font-size: 10px;">Total Donate</div>
                </div>
            </div>
            
            <!-- Donation Slider - Like Home Page -->
            <div class="donation-slider-container">
                <div class="donation-shape-card">
                    <div class="donation-slider">
                        <div class="donation-slide active" data-dindex="0">
                            <div class="donation-slide-icon">
                                <!--  <i class="fas fa-child"></i> !-->
								<image src="Image/Donate1.jpg" height="60px" width="100%">
                            </div>
                            <div class="donation-slide-title">ত্রাণ বিতরণ</div>
                            <div class="donation-slide-desc">অসহায় মানুষদের মাঝে ত্রাণ বিতরণ</div>
                            <div class="donation-slide-goal">ЁЯОп Goal: 50,000 Tk | Raised: 25,000 TK</div>
                        </div>
                        <div class="donation-slide" data-dindex="1">
                            <div class="donation-slide-icon">
                                <!--  <i <i class="fas fa-home"></i> !-->
								<image src="Image/Donate3.jpg" height="60px" width="100%">
                            </div>
                            <div class="donation-slide-title">ত্রাণ বিতরণ</div>
                            <div class="donation-slide-desc">বন্যায় ক্ষতিগ্রস্তদের মাঝে ত্রাণ বিতরণ </div>
                            <div class="donation-slide-goal">ЁЯОп Goal: 30,000 | Raised: 15,000 Tk</div>
                        </div>
                        <div class="donation-slide" data-dindex="2">
                            <div class="donation-slide-icon">
                                <!--  <i class="fas fa-wheelchair"></i> !-->
								<image src="Image/Donate2.jpg" height="60px" width="100%">
                            </div>
                            <div class="donation-slide-title">ত্রাণ বিতরণ</div>
                            <div class="donation-slide-desc">বয়স্ক অসচল ব্যক্তিদের মাঝে ত্রাণ বিতরণ</div>
                            <div class="donation-slide-goal">ЁЯОп Goal: 20,000 TK | Raised: 8,000 TK</div>
                        </div>
                        <div class="donation-slide" data-dindex="3">
                            <div class="donation-slide-icon">
                                <!-- <i class="fas fa-book"></i> !-->
								<image src="Image/Donate4.jpg" height="60px" width="100%">
                            </div>
                            <div class="donation-slide-title">ত্রাণ বিতরণ</div>
                            <div class="donation-slide-desc">এতিম ছাত্রদের মাঝে খাবার বিতরণ</div>
                            <div class="donation-slide-goal">ЁЯОп Goal: 100,000 TK | Raised: 45,000 Tk</div>
                        </div>
                    </div>
                    
                    <div class="donation-slider-controls">
                        <button class="donation-nav-btn" id="donationPrevBtn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="donation-dots" id="donationDots">
                            <span class="donation-dot active" data-ddot="0"></span>
                            <span class="donation-dot" data-ddot="1"></span>
                            <span class="donation-dot" data-ddot="2"></span>
                            <span class="donation-dot" data-ddot="3"></span>
                        </div>
                        <button class="donation-nav-btn" id="donationNextBtn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
			
            <button class="donate-btn" onclick="location.href='donate.php'">
                <i class="fas fa-heart"></i> Donate Now
            </button>
        </div>
		
		
		<!-- Coin Row -->
        <div class="coin-row">
			<button class="mobile-recharge-btn" onclick="location.href='transfer.php'">
                <i class="fa-solid fa-right-left"></i> Transfer Diamond
            </button>
            <div class="coin-info">
                <div class="coin-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <div class="coin-amount"><?php echo $balance['coin_balance']?? 0; ?> Diamond</div>
                    <div style="font-size: 11px; color: rgba(255,255,255,0.5);">1 Diamond = 0.5 TK</div>
                </div>
            </div>
        </div>
		
		
		<!-- P2P Card -->
        <div class="p2p-card">
            <div class="p2p-icon">
                <i class="fas fa-gem"></i>
            </div>
            <div class="p2p-amount">Buy P2P Plan Earn Money</div>
            <div class="p2p-label"></div>
            <div class="action-buttons">
                <button class="action-btn btn-p2p" onclick="location.href='p2p.php'">
                    <i class="fas fa-shopping-cart"></i> P2P Plan
                </button>
            </div>
        </div>
        
        <!-- Scrolling Text / Live Offers -->
        <div class="scrolling-text">
			<?php 
				if($marque){
					echo '<marquee behavior="scroll" direction="left" scrollamount="5">'.$marque['marque_text'].'</marquee>';
				}else{
					?>
						<marquee behavior="scroll" direction="left" scrollamount="5">
							🎉 Special Offer: Spacial Offer Not Available Right Now|
							⚡ First Gold Purchase : If you are purchasing gold for the first time, you will receive some Diamond gift free. | 🔥 Daily Check-in Bonus Available!
						</marquee>
					<?php 
				}
			?>
        </div>
        
        <!-- Social Links -->
        <div class="social-links">
            <a href="https://www.facebook.com/share/p/1Hp5TY7Vzj/" target="_blank" class="social-icon fb">
				<i class="fab fa-facebook-f"></i>
			</a>
            <a href="https://api.whatsapp.com/send?phone=8801795978580" target="_blank" class="social-icon whatsapp">
				<i class="fab fa-whatsapp"></i>
			</a>
            <a href="https://t.me/Goldsaveworld" target="_blank" class="social-icon telegram"><i class="fab fa-telegram-plane"></i></a>
            <!-- <a href="#" class="social-icon youtube"><i class="fab fa-youtube"></i></a> -->
        </div>
        
        <!-- Marketing Drop Button -->
        <button class="marketing-drop" onclick="location.href='marketing.php'">
            <i class="fas fa-chart-line"></i> Marketing & Drops
        </button>
    </div>
    
    <!-- Fixed Help Desk - Bottom Right -->
	<div class="help-desk-fixed" id="helpDeskBtn">
		<div class="help-desk-container">
			<!--
			<div class="help-desk-text">
				Help Desk
				<small>24/7 Support</small>
			</div>
			-->
			<div class="help-desk-image" id="helpDeskImage">
				<a href="https://t.me/Goldsaveworld" target="_blank">
					<img id="helpDeskImg" src="assets/male.jpg" alt="Support">
				</a>
			</div>
		</div>
	</div>
	
    <?php include_once("bottom.php"); ?>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
	
		// Copy User ID Function
        const copyUserIdBtn = document.getElementById('copyUserIdBtn');
        const userId = document.getElementById('userId').innerText;
        
        copyUserIdBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(userId).then(function() {
                showToast('ইউজার আইডি কপি হয়েছে!');
            });
        });
                
        // Toast Message Function
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast-message';
            toast.innerHTML = '<i class="fas fa-check-circle"></i> ' + message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 2000);
        }
                
        // ========== DONATION SLIDER (Like Home Page) ==========
        const donationSlides = document.querySelectorAll('.donation-slide');
        const donationDots = document.querySelectorAll('.donation-dot');
        const donationPrevBtn = document.getElementById('donationPrevBtn');
        const donationNextBtn = document.getElementById('donationNextBtn');
        let donationCurrentIndex = 0;
        let donationAutoInterval;
        
        function showDonationSlide(index) {
            donationSlides.forEach(slide => slide.classList.remove('active'));
            donationDots.forEach(dot => dot.classList.remove('active'));
            
            if (index < 0) index = donationSlides.length - 1;
            if (index >= donationSlides.length) index = 0;
            donationCurrentIndex = index;
            
            donationSlides[donationCurrentIndex].classList.add('active');
            donationDots[donationCurrentIndex].classList.add('active');
        }
        
        function nextDonationSlide() { showDonationSlide(donationCurrentIndex + 1); }
        function prevDonationSlide() { showDonationSlide(donationCurrentIndex - 1); }
        
        function startDonationAutoSlide() {
            if (donationAutoInterval) clearInterval(donationAutoInterval);
            donationAutoInterval = setInterval(nextDonationSlide, 4000);
        }
        
        function stopDonationAutoSlide() {
            if (donationAutoInterval) clearInterval(donationAutoInterval);
        }
        
        if (donationPrevBtn) {
            donationPrevBtn.addEventListener('click', () => {
                stopDonationAutoSlide();
                prevDonationSlide();
                startDonationAutoSlide();
            });
        }
        
        if (donationNextBtn) {
            donationNextBtn.addEventListener('click', () => {
                stopDonationAutoSlide();
                nextDonationSlide();
                startDonationAutoSlide();
            });
        }
        
        donationDots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                stopDonationAutoSlide();
                showDonationSlide(idx);
                startDonationAutoSlide();
            });
        });
        
        startDonationAutoSlide();
        
        // ========== HELP DESK - 5 SECONDS IMAGE CHANGE ==========
        const helpDeskImg = document.getElementById('helpDeskImg');
        let helpImageIndex = 0;
        let helpImageInterval;
		
		// Array of image sources (Replace with your actual image paths)
		const helpImages = [
			"assets/male.jpg", // Your custom image 1
			"assets/female.jpg"   // Your custom image 2
		];
        
        // Array of image sources (Boy and Girl emojis / images)
		/*
        const helpImages = [
            "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%23FFD700'/%3E%3Ctext x='50' y='67' text-anchor='middle' font-size='45' fill='%230a0a1a'%3E👦%3C/text%3E%3C/svg%3E",
            "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%23FFA500'/%3E%3Ctext x='50' y='67' text-anchor='middle' font-size='45' fill='%230a0a1a'%3E👧%3C/text%3E%3C/svg%3E",
            "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%23FFD700'/%3E%3Ctext x='50' y='67' text-anchor='middle' font-size='45' fill='%230a0a1a'%3E🙋‍♂️%3C/text%3E%3C/svg%3E",
            "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='50' fill='%23FFA500'/%3E%3Ctext x='50' y='67' text-anchor='middle' font-size='45' fill='%230a0a1a'%3E🙋‍♀️%3C/text%3E%3C/svg%3E"
        ];
		*/
        
        function changeHelpDeskImage() {
            helpImageIndex = (helpImageIndex + 1) % helpImages.length;
            if (helpDeskImg) {
                helpDeskImg.src = helpImages[helpImageIndex];
            }
        }
        
        // Start interval for help desk image change every 5 seconds
        if (helpDeskImg) {
            helpImageInterval = setInterval(changeHelpDeskImage, 4000);
        }
        
        // Help desk click handler
        const helpDeskBtn = document.getElementById('helpDeskBtn');
        if (helpDeskBtn) {
            helpDeskBtn.addEventListener('click', () => {
                showToast('Help Desk: Contact us at support@goldkinen.com', 'info');
            });
        }
        
        // ========== TOAST FUNCTION ==========
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 160px;
                left: 50%;
                transform: translateX(-50%);
                background: ${type === 'success' ? '#28a745' : type === 'info' ? '#17a2b8' : '#dc3545'};
                color: white;
                padding: 12px 24px;
                border-radius: 50px;
                font-size: 14px;
                z-index: 9999;
                animation: fadeInUp 0.3s ease;
                white-space: nowrap;
                max-width: 90%;
                white-space: normal;
                text-align: center;
            `;
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-circle'}"></i> ${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'fadeOutDown 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        // Add animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
            @keyframes fadeOutDown {
                from {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(-50%) translateY(20px);
                }
            }
        `;
        document.head.appendChild(style);
        
        // Bottom Navigation Active State
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Cleanup interval on page unload
        window.addEventListener('beforeunload', () => {
            if (donationAutoInterval) clearInterval(donationAutoInterval);
            if (helpImageInterval) clearInterval(helpImageInterval);
        });
        
        console.log('Dashboard loaded - Ready for PHP integration');
    </script>
</body>
</html>