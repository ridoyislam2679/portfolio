<?php
    session_start();
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
	
	// maintenance.php
    $isMaintenance = false; // true kortay hobay sms dily করলে আবার চালু হবে
    
    if ($isMaintenance) {
        echo "<h2 style='color:red;text-align:center;'>Website is under maintenance. Please try again later.</h2>";
        exit();
    }
	
	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}

	$user_id = $_SESSION['user_id'];
	//$user_id = 1;
	// Get user data
	$stmt = $pdo->prepare("SELECT username, referral_code, referred_by, account_type, account_rank, active_status ,image, created_at FROM users WHERE id = ?");
	$stmt->execute([$user_id]);
	$user = $stmt->fetch();
	
	$refer_user_id = $user['referred_by'];
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT total_earning, main_blance, total_coin, rit_coin, free_spain FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();

	// Get referral stats
	$stmt = $pdo->prepare("SELECT COUNT(*) as referral_count FROM referrals WHERE referrer_id = ?");
	$stmt->execute([$user_id]);
	$stats = $stmt->fetch();
	
	$referCount = $stats['referral_count'];
	
	if($referCount >= 500 ){
		$updateAccount = $pdo->prepare("UPDATE users SET account_type = 'DAIMOND MEMBER' WHERE id = ?");
		$updateAccount->execute([$user_id]);
	}elseif($referCount >= 100){
		$updateAccount = $pdo->prepare("UPDATE users SET account_type = 'GOLD MEMBER' WHERE id = ?");
		$updateAccount->execute([$user_id]);
	}else{
		// No Change
	}
	
	// Get Rit Coin Price
	$stmt = $pdo->prepare("SELECT rit_coin_price FROM rit_coin ORDER BY rit_id DESC LIMIT 1");
	$stmt->execute();
	$ritPrice = $stmt->fetch();
	$rit_price = $ritPrice['rit_coin_price'];
	
	// expire martix
	$expire_martix = $pdo->prepare("UPDATE user_slots SET status = 0 WHERE expire_time <= NOW() AND status = 1");
	$expire_martix->execute();

	$today = date('Y-m-d');
	$check = $pdo->prepare("SELECT id FROM daily_earn_log WHERE user_id = ? AND earn_date = ?");
	$check->execute([$user_id, $today]);

	if ($check->rowCount() == 0) {
		// 2. Count active slots
		$stmt = $pdo->prepare("SELECT SUM(slot_count) as total_slots FROM user_slots WHERE user_id = ? AND status = 1 AND expire_time > NOW()");
		$stmt->execute([$user_id]);
		$active_slots = $stmt->fetch(PDO::FETCH_ASSOC)['total_slots'] ?? 0;

		// 3. Calculate income
		$income = $active_slots * 5;

		if($income > 0){
			// 4. Add to blance
			$update = $pdo->prepare("UPDATE blance SET main_blance = main_blance + ?, total_earning = total_earning + ? WHERE user_id = ?");
			$update->execute([$income, $income, $user_id]);

			// 5. Insert earn log
			$insertLog = $pdo->prepare("INSERT INTO daily_earn_log (user_id, earn_date, active_slot, amount) VALUES (?, ?, ?, ?)");
			$insertLog->execute([$user_id, $today, $active_slots, $income]);
		}
	}
	
	// chack vip Account
	$chackSlot = $pdo->prepare("SELECT SUM(slot_count) as total_slots FROM user_slots WHERE user_id = ? AND status = 1 AND expire_time > NOW()");
	$chackSlot->execute([$user_id]);
	$activeSlot = $chackSlot->fetch();
	$totalSlot = $activeSlot['total_slots'];
	
	if($totalSlot >= 24){
		$updateRank = $pdo->prepare("UPDATE users SET account_rank = 'vip account' WHERE id = ?");
		$updateRank->execute([$user_id]);
	}
	
	
	// Get referral stats
	$refferList = "SELECT 
    users.id,
    users.username,
    users.image,
    COUNT(referrals.id) AS total_referrals
	FROM 
		users
	LEFT JOIN
		referrals ON users.id = referrals.referrer_id
	GROUP BY 
		users.id, users.username
	ORDER BY 
		total_referrals DESC, username ASC LIMIT 10";
	
	$stmt2 = $pdo->prepare($refferList);
	$stmt2->execute();
	$reffers = $stmt2->fetch();
	
	// Get Earning List
	$earningList = "SELECT 
    users.id,
    users.username,
    users.image,
	blance.total_earning
	FROM 
		users
	INNER JOIN 
		blance ON users.id = blance.user_id
	ORDER BY 
		total_earning DESC, username ASC LIMIT 10";
	
	$stmt3 = $pdo->prepare($earningList);
	$stmt3->execute();
	$earning = $stmt3->fetch();
	
	$referral_link = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/register.php?ref=" . $user['referral_code'];
	
?>
<?php
// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $content = trim($_POST['comment']);
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;
    $user_id = $_SESSION['user_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO comments (user_id, content, parent_id) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $content, $parent_id]);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        $error = "Error posting comment: " . $e->getMessage();
    }
}

// Fetch all comments with replies
function getComments($pdo) {
    $stmt = $pdo->query("
        SELECT c.*, u.username, u.image 
        FROM comments c
        JOIN users u ON c.user_id = u.id
        ORDER BY c.created_at DESC LIMIT 5
    ");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Organize comments with replies
    $organized = [];
    foreach ($comments as $comment) {
        if ($comment['parent_id'] === null) {
            $comment['replies'] = [];
            $organized[$comment['id']] = $comment;
        }
    }
    
    foreach ($comments as $comment) {
        if ($comment['parent_id'] !== null && isset($organized[$comment['parent_id']])) {
            $organized[$comment['parent_id']]['replies'][] = $comment;
        }
    }
    
    return array_values($organized);
}

$comments = getComments($pdo);
?>

		<div class="chat-ai">
			 <a href="https://t.me/Refonexxofficial" target="_blank" class="ai-link"><img src="assets/help.png" class="assistent-image" alt="assitant"></a>
		</div>
		
		<div class="dashboard-container">
			<!-- Main Content -->
			<div class="main-content">            
				<!-- Badge and Balance Section -->
				<div class="main-card">
					<div class="mobile-profile-section">
						<img src="assets/<?php echo $user['image'] ?>" alt="Profile" class="mobile-profile-image">
						<div class="mobile-profile-logo">
							<img src="assets/PNG-File-9.png" class="profile-logo" alt="Logo">
						</div>
						<h1 class=""> <?php echo $user['username'] ?> </h1>
						<p class="user-id"> ID: <?php echo $user['referral_code'] ?> </p>
						<span> Joined Date: <?php echo $user['created_at'] ?> </span>
						<p class="badge-label"> <?php echo $user['account_type'] ?> </p>
						<p class="badge-label"> <?php echo $user['account_rank'] ?> </p>
					</div>
					
					<div class="balance-info">
						<div class="balance-item">
							<p class="balance-label">Main Balance Coin</p>
							<p class="balance-value" style="color: #10b981;"> 
								<?php echo $blance['total_coin']; ?> 
							</p>
						</div>
						<div class="balance-item">
							<p class="balance-label">Rit Coin</p>
							<p class="balance-value" style="color: #3b82f6;">
								<?php echo $blance['rit_coin']; ?>
							</p>
						</div>
					</div>	
					<?php 
						if($user['active_status'] == 1){
							$active_btn = 'Activeted';
						}else{
							$active_btn = 'Active';
						}
					?>
					<div class="user-btn-group">
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activedeModal">
							<?php echo $active_btn; ?>
						</button>
						<input type="text" id="referralLink" class="copy-link-input" value="<?php echo $referral_link ?>" readonly />
						<button class="btn btn-primary" onclick="copyReferralLink()">
							<i>📋</i> Copy Refer Link
						</button>
						<span id="copyMsg" style="color: green; display: none;">Copied!</span>
					</div>
				</div>
				
				<!--Active Modal -->
				<div class="modal fade" id="activedeModal" tabindex="-1" aria-labelledby="activeModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content text-dark">
							<div class="modal-header">
								<h5 class="modal-title" id="activeModalLabel">Sell Coin</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									X
								</button>
							</div>
							<div class="modal-body">
								<form id="sellForm" method="POST">
									<div class="mb-3">
										<label for="gridCount" class="form-label">Are You Active Your Account?</label>
										<input type="number" class="form-control" id="gridCount" value="100" min="100" max="100" required>
									</div>
									<div class="mb-3">
										<label class="note-label">*Active Account Charge BDT:100TK</label>
									</div>
									<button type="submit" name="active_submit" class="btn btn-success">Active</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<?php 
					if(isset($_POST['active_submit'])){
						if($user['active_status'] !== '1'){
							if($blance['main_blance'] >= 100){
								$sql ="UPDATE blance SET main_blance = main_blance-100 WHERE user_id = ?";
								$update_blance = $pdo->prepare($sql);
								$update_blance->execute([$user_id]);
								
								$active_account = $pdo->prepare("UPDATE users SET active_status = '1' WHERE id = ?");
								$active_account->execute([$user_id]);
								
								$sql ="UPDATE blance SET main_blance = main_blance+10, total_earning = total_earning+10 WHERE user_id = ?";
								$refferBlance_update = $pdo->prepare($sql);
								$refferBlance_update->execute([$refer_user_id]);
								
								header("Location: ".$_SERVER['PHP_SELF']);
								exit();	
							}else{
								echo '<span id="copyMsg" style="color: green;">Insufficient Coin</span>';
							}
						}else{
							echo '<span id="copyMsg" style="color: green;">Already Activated</span>';
						}						
					}
				
				?>
				
				<!-- Stats Grid -->
				<div class="stats-grid">
					<div class="stat-card">
						<p class="stat-label">Total Earn</p>
						<p class="stat-value" style="color: #10b981;"><?php echo $blance['total_earning'];?>TK</p>
						<p class="stat-change up">↑ 12.5%</p>
					</div>
					<div class="stat-card">
						<p class="stat-label">Main Balance</p>
						<p class="stat-value" style="color: #3b82f6;"><?php echo $blance['main_blance'];?>TK</p>
						<p class="stat-change up">↑ 3.2%</p>
					</div>
					<div class="stat-card">
						<p class="stat-label">Free Spain</p>
						<p class="stat-value" style="color: #ec4899;"><?php echo $blance['free_spain']; ?></p>
						<p class="stat-change up">↑ 8</p>
					</div>
					<div class="stat-card">
						<p class="stat-label">Partner</p>
						<p class="stat-value" style="color: #f59e0b;"><?php echo $stats['referral_count']; ?></p>
						<p class="stat-change up">↑ 2</p>
					</div>
				</div>
				
				<!-- Matrix Section -->
				<div class="container martix-container py-5">
					<div class="green-matrix-card text-center">
						<div class="d-flex justify-content-between">
							<span class="fw-bold">CoreX Matrix</span>
							<span class="fw-bold">100 TK</span>
						</div>
		
						<div class="grid" id="matrixGrid">
						<!-- 12 grid blocks -->
						<?php
							$stmt = $pdo->prepare("SELECT SUM(slot_count) as core_martix FROM user_slots WHERE user_id = ? AND slot_type = 'core' AND status = 1");
							$stmt->execute([$user_id]);
							$coreXMartix = $stmt->fetch(PDO::FETCH_ASSOC);

							$upgradeCount = $coreXMartix['core_martix'] ?? 0;

							$totalBlocks = 12;
							for ($i = 1; $i <= $totalBlocks; $i++) {
								$class = ($i <= $upgradeCount) ? "block_upgraded" : "block";
								echo "<div class='$class'></div>";
							}
						?>
						
						</div>
		
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coreXupgradeModal">Preview</button>
					</div>
					
					<!-- Vip Martix -->
					<div class="red-matrix-card text-center">
						<div class="d-flex justify-content-between">
						<span class="fw-bold">Vip X Matrix</span>
						<span class="fw-bold">100TK</span>
						</div>
		
						<div class="grid" id="matrixGrid">
							<!-- 12 grid blocks -->
							<?php
								$stmt = $pdo->prepare("SELECT SUM(slot_count) as core_martix FROM user_slots WHERE user_id = ? AND slot_type = 'vip' AND status = 1");
								$stmt->execute([$user_id]);
								$coreXMartix = $stmt->fetch(PDO::FETCH_ASSOC);

								$upgradeCount = $coreXMartix['core_martix'] ?? 0;

								$totalBlocks = 12;
								for ($i = 1; $i <= $totalBlocks; $i++) {
									$class = ($i <= $upgradeCount) ? "block_upgraded" : "block";
									echo "<div class='$class'></div>";
								}
							?>						
						</div>
		
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vipXupgradeModal">Preview</button>
					</div>
				</div>
				
				<!-- Core X Martix Upgrade Modal -->
				<div class="modal fade" id="coreXupgradeModal" tabindex="-1" aria-labelledby="coreXupgradeModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content text-dark">
					  <div class="modal-header">
						<h5 class="modal-title" id="coreXupgradeModalLabel">Core X Martix Upgrade</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="upgradeForm" method="POST">
						  <div class="mb-3">
							<label for="gridCount" class="form-label">How many grids to upgrade?</label>
							<input type="number" name="martixNumber" class="form-control" id="gridCount" min="1" max="12" required>
						  </div>
						  <div class="mb-3">
							<label class="note-label">*Per Grids BDT:100TK</label>
						  </div>
						  <button type="submit" name="coreXbtn" class="btn btn-success">Upgrade Now</button>
						</form>
					  </div>
					</div>
				  </div>
				</div>
				
				<?php 
					if(isset($_POST['coreXbtn'])){
						$slot_type = 'core';
						
						$coreStmt = $pdo->prepare("SELECT SUM(slot_count) as core_martix FROM user_slots WHERE user_id = ? AND status = 1 AND slot_type = 'core'");
						$coreStmt->execute([$user_id]);
						$core_slot = $coreStmt->fetch();
						
						$AcoreMartix = $core_slot['core_martix'];
						
						$martix = $_POST['martixNumber'];
						$martix_price = (100*$martix);
						$refered_earn = ((10*$martix_price)/100);
						$expire_time = date('Y-m-d H:i:s', strtotime('+1 month'));
						
						if($blance['main_blance'] >= $martix_price){
							if($AcoreMartix < 12){
								if($user['active_status'] == '1'){	
									$stmt = $pdo->prepare("INSERT INTO user_slots (user_id, slot_type, slot_count, price, expire_time, status) VALUES (?, ?, ?, ?, ?, 1)");
									$stmt->execute([$user_id, $slot_type, $martix, $martix_price, $expire_time]);
									
									$sql ="UPDATE blance SET main_blance = main_blance-'".$martix_price."' WHERE user_id = ?";
									$update_blance = $pdo->prepare($sql);
									$update_blance->execute([$user_id]);
									
									$sql ="UPDATE blance SET main_blance = main_blance+?, total_earning = total_earning+? WHERE user_id = ?";
									$refferCore_Blance = $pdo->prepare($sql);
									$refferCore_Blance->execute([$refered_earn, $refered_earn, $refer_user_id]);
									
									header("Location: ".$_SERVER['PHP_SELF']);							
									exit();								
								}else{
									echo '<span id="copyMsg" style="color: red;">You are not active member</span>';
								}
							}else{
								echo '<span id="copyMsg" style="color: red;">You are Already Active All Martix</span>';
							}								
						}else{
							echo '<span id="copyMsg" style="color: red;">insufficient balance</span>';
						}
					}		
				
				?>
				
				<!-- Vip X Martix Upgrade Modal -->
				<div class="modal fade" id="vipXupgradeModal" tabindex="-1" aria-labelledby="vipXupgradeModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content text-dark">
					  <div class="modal-header">
						<h5 class="modal-title" id="vipXupgradeModalLabel">Vip X Martix Upgrade</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form id="upgradeForm" method="POST">
						  <div class="mb-3">
							<label for="gridCount" class="form-label">How many grids to upgrade?</label>
							<input type="number" name="vipNumber" class="form-control" id="gridCount" min="1" max="12" required>
						  </div>
						  <div class="mb-3">
							<label class="note-label">*Per Grids BDT:100TK</label>
						  </div>
						  <button type="submit" name="vipXbtn" class="btn btn-success">Upgrade Now</button>
						</form>
					  </div>
					</div>
				  </div>
				</div>
				
				<?php 
					if(isset($_POST['vipXbtn'])){
						$slot_type = 'vip';
						
						$vipStmt = $pdo->prepare("SELECT SUM(slot_count) as vip_martix FROM user_slots WHERE user_id = ? AND status = 1 AND slot_type = 'vip'");
						$vipStmt->execute([$user_id]);
						$vip_slot = $vipStmt->fetch();
						
						$AvipMartix = $vip_slot['vip_martix'];
						
						$martix = $_POST['vipNumber'];
						$martix_price = (100*$martix);
						$refered_earn = ((10*$martix_price)/100);
						$expire_time = date('Y-m-d H:i:s', strtotime('+1 month'));
						
						if($blance['main_blance'] >= $martix_price){
							if($AvipMartix < 12){
								if($user['active_status'] == '1'){							
									$stmt = $pdo->prepare("INSERT INTO user_slots (user_id, slot_type, slot_count, price, expire_time, status) VALUES (?, ?, ?, ?, ?, 1)");
									$stmt->execute([$user_id, $slot_type, $martix, $martix_price, $expire_time]);
									
									$sql ="UPDATE blance SET main_blance = main_blance-'".$martix_price."' WHERE user_id = ?";
									$update_blance = $pdo->prepare($sql);
									$update_blance->execute([$user_id]);
									
									$sql ="UPDATE blance SET main_blance = main_blance+?, total_earning = total_earning+? WHERE user_id = ?";
									$refferVipx_Blance = $pdo->prepare($sql);
									$refferVipx_Blance->execute([$refered_earn, $refered_earn, $refer_user_id]);
									
									header("Location: ".$_SERVER['PHP_SELF']);							
									exit();								
								}else{
									echo '<span id="copyMsg" style="color: red;">You are not active member</span>';
								}	
							}else{
								echo '<span id="copyMsg" style="color: red;">You Are Alredy Active All Slot</span>';
							}							
						}else{
							echo '<span id="copyMsg" style="color: red;">insufficient balance</span>';
						}
					}		
				
				?>
				
				
				<!-- Quick Actions -->
				<div class="quick-actions">
					<a href="deposite.php">
						<div class="action-btn steelblue">
							Deposit <span class="arrow">&#8594<span>
						</div>
					</a>
					<a href="withdraw.php">
						<div class="action-btn chocolate">
							Withdraw <span class="arrow">&#8594<span>
						</div>
					</a>
					<a href="spain-game.php">
						<div class="action-btn spin">
							Spin Game <span class="arrow">&#8594<span>
						</div>
					</a>
					<a href="shop.php">
						<div class="action-btn shop">
							Shop <span class="arrow">&#8594<span>
						</div>
					</a>
					<!--
					<a href="mobile-recharge.php">
						<div class="action-btn recharge">
							Mobile Recharge <span class="arrow">&#8594<span>
						</div>
					</a>
					-->
					
					<a href="exchange.php">
						<div class="action-btn exchange">
							Exchange <span class="arrow">&#8594<span>
						</div>
					</a>
				    
				    <!--
					<a href="transfer.php">
						<div class="action-btn transfer">
							Transfer <span class="arrow">&#8594<span>
						</div>
					</a>
					-->
					<a href="news.php">
						<div class="action-btn news">
							Offer <span class="arrow">&#8594<span>
						</div>
					</a>
					<a href="profile-edit.php">
						<div class="action-btn edit">
							Edit <span class="arrow">&#8594<span>
						</div>
					</a>
				</div>
				
				<!-- Shear Market -->
				<img src="assets/rit-coin-chart.png" class="img-fluid w-100" alt="rit coin image chart">
				<!-- Coin Info and Chart -->
				<div class="chart-card">
					<h3 class="card-title">📈 Share Market Price Chart</h3>
					<div class="chart-container">
						<canvas id="marketChart"></canvas>
					</div>
				</div>				
				
				<!-- Coin Buy/Sell Section -->				
				<div class="coin-section">
					<div class="coin-header">
						<div class="coin-title"><img src="assets/rit-coin.jpeg" class="rit-coin"> Rit Coin</div>
						<div class="coin-value"><?php echo $rit_price ?></div>
					</div>
					<div class="coin-actions">
						<button class="btn-coin btn-buy" data-bs-toggle="modal" data-bs-target="#buyModal">Buy</button>
						<button class="btn-coin btn-sell" data-bs-toggle="modal" data-bs-target="#selldeModal">Sell</button>
					</div>
				</div>
				
				<!-- Buy Modal -->
				<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="BuyModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content text-dark">
							<div class="modal-header">
								<h5 class="modal-title" id="BuyModalLabel">Buy Coin</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form id="buyForm" method="POST">
									<div class="mb-3">
										<label for="gridCount" class="form-label">How many Coin Buy?</label>
										<input type="number" name="coin" class="form-control" id="gridCount" min="1" max="100" required>
									</div>
									<div class="mb-3">
										<label class="note-label">*Per Coin BDT:<?php echo $rit_price; ?>TK</label>
									</div>
									<button type="submit" name="buy_coin" class="btn btn-success">Buy Now</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
					if(isset($_POST['buy_coin'])){
						$rit_coin = $_POST['coin'];
						$buy_blance = ($rit_price*$rit_coin);
						
						if($blance['main_blance'] >= $buy_blance){
							if($user['active_status'] == '1'){							
								$sql ="UPDATE blance SET rit_coin = rit_coin+'".$rit_coin."' WHERE user_id = ?";
								$update_rit = $pdo->prepare($sql);
								$update_rit->execute([$user_id]);
								
								$sql ="UPDATE blance SET main_blance = main_blance-'".$buy_blance."' WHERE user_id = ?";
								$update_blance = $pdo->prepare($sql);
								$update_blance->execute([$user_id]);
								
								header("Location: ".$_SERVER['PHP_SELF']);							
								exit();								
							}else{
								echo '<span id="copyMsg" style="color: red;">You are not active member</span>';
							}	
						}else{
							echo '<span id="copyMsg" style="color: red;">insufficient balance</span>';
						}
					}				
				?>
				<!--Sell Modal -->
				<div class="modal fade" id="selldeModal" tabindex="-1" aria-labelledby="sellModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content text-dark">
							<div class="modal-header">
								<h5 class="modal-title" id="sellModalLabel">Sell Coin</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form id="sellForm" method="POST">
									<div class="mb-3">
										<label for="gridCount" class="form-label">How many Coin Sell?</label>
										<input type="number" name="sCoin" class="form-control" id="gridCount" min="1" max="100" required>
									</div>
									<div class="mb-3">
										<label class="note-label">*Per Coin BDT:<?php echo $rit_price ?>TK</label>
									</div>
									<button type="submit" name="sell_coin" class="btn btn-success">Sell Now</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php 
					if(isset($_POST['sell_coin'])){
						$rit_coin = $_POST['sCoin'];
						
						if($blance['rit_coin'] >= $rit_coin){
							$sell_blance = ($rit_price*$rit_coin);
							
							if($user['active_status'] == '1'){							
								$sql ="UPDATE blance SET rit_coin = rit_coin-'".$rit_coin."' WHERE user_id = ?";
								$update_rit = $pdo->prepare($sql);
								$update_rit->execute([$user_id]);
								
								$sql ="UPDATE blance SET main_blance = main_blance+'".$sell_blance."' WHERE user_id = ?";
								$update_blance = $pdo->prepare($sql);
								$update_blance->execute([$user_id]);
								
								$sql ="UPDATE blance SET total_earning = total_earning+'".$sell_blance."' WHERE user_id = ?";
								$Up_T_blance = $pdo->prepare($sql);
								$Up_T_blance->execute([$user_id]);
								
								header("Location: ".$_SERVER['PHP_SELF']);							
								exit();								
							}else{
								echo '<span id="copyMsg" style="color: red;">You are not active member</span>';
							}	
						}else{
							echo '<span id="copyMsg" style="color: red;">Insufficient Coin</span>';
						}
					}				
				?>
				
				<!-- ladder Board Section -->
				<div class="container-fluid">
					<div class="text-center mb-4">
						<h2 class="text-white">🏆 Weekly Highlights</h2>
					</div>

					<div class="row g-4 mb-4">
						<div class="col-md-6">
							<div class="highlight-card text-center">
								<img src="assets/<?php echo $earning['image']; ?>" class="top-user-img">
								<div class="highlight-detail">
									<?php echo $earning['username']; ?> - <?php echo $earning['total_earning']; ?>TK
								</div>
								<div class="highlight-title">Top Earner</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="highlight-card text-center">
								<img src="assets/<?php echo $reffers['image']; ?>" class="top-user-img">
								<div class="highlight-detail">
									<?php echo $reffers['username']; ?> - <?php echo $reffers['total_referrals']; ?>Referrals
								</div>
								<div class="highlight-title">Top Referrer</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="table-section">
								<h3>🏆 Top Earners</h3>
								<table>
									<thead>
										<tr>
										<th>Rank</th>
										<th>User</th>
										<th>Earnings</th>
										</tr>
									</thead>
									<tbody>
										<?php 	
											$rank = 2;
											while($earning = $stmt3->fetch()){
												?>
													<tr>
														<td><?php echo $rank ?></td>
														<td>
															<img src="assets/<?php echo $earning['image']; ?>" class="user-img"><?php echo $earning['username']; ?>
														</td>
														<td><?php echo $earning['total_earning']; ?>Tk</td>
													</tr>
												<?php
												$rank++;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="table-section">
								<h3>👥 Top Referrers</h3>
								<table>
									<thead>
										<tr>
										<th>Rank</th>
										<th>User</th>
										<th>Total Referrals</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$rank = 2;
											while($reffers = $stmt2->fetch()){
												?>
													<tr>
														<td><?php echo $rank ?></td>
														<td>
															<img src="assets/<?php echo $reffers['image']; ?>" class="user-img"><?php echo $reffers['username']; ?>
														</td>
														<td><?php echo $reffers['total_referrals']; ?>Referrals</td>
													</tr>
												<?php
												$rank++;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				
				
				<!-- Comment Section
				<div class="comment-section">
					<h3 class="section-title">💬 Comments</h3>
					<?php foreach ($comments as $comment): ?>
					<div class="comment-list">
						<div class="comment">
							<div class="comment-header">
								<div class="comment-user"><?= htmlspecialchars($comment['username']) ?></div>
								<div class="comment-time">
									<?= date('M j, Y g:i a', strtotime($comment['created_at'])) ?>
								</div>
							</div>
							<div class="comment-content">
								<?= (htmlspecialchars($comment['content'])) ?>
							</div>
							<div class="comment-actions">
								<button class="comment-action btn-like" onclick="incrementLike(this)">👍 Like (<span class="like-count">3</span>)</button>
								<button class="comment-action btn-reply-btn reply-btn" onclick="showReplyForm(<?= $comment['id'] ?>)">💬 Reply</button>								
							</div>
							<div class="reply-form" id="reply-form-<?= $comment['id'] ?>">
								<form method="post">
									<input type="hidden" name="parent_id" value="<?= $comment['id'] ?>">
									<textarea class="reply-input" name="comment" placeholder="Write your reply..."></textarea>
									<button type="submit" class="btn-reply">Post Reply</button>
								</form>
							</div>	
							
							<?php foreach ($comment['replies'] as $reply): ?>
								<div class="comment-reply">
									<div class="comment-header">
										<div class="comment-user"><?= htmlspecialchars($reply['username']) ?></div>
										<div class="comment-time">
											<?= date('M j, Y g:i a', strtotime($reply['created_at'])) ?>
										</div>
									</div>
									<div class="comment-content">
										<?= nl2br(htmlspecialchars($reply['content'])) ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>						
					</div>
					<?php endforeach; ?>					
					<div class="comment-form">
						<form method="POST">
							<textarea class="comment-input" placeholder="Write your comment..." name=
							"comment"></textarea>
							<button type="submit" class="btn-comment">Post Comment</button>
						</form>
					</div>
				</div>	
				 -->
            </div>		
        </div>		
	</div>
	
	<?php 
		ob_end_flush();
		include_once('footer.php'); 
	?>