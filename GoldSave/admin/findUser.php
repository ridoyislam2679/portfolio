<?php 
	include_once('security.php');
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Find User Details - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/findUser.css">
	<link rel="stylesheet" href="CSS/header.css">
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <?php include_once('header.php'); ?>
	
    <!-- Main Content -->
    <div class="main-content">
        <!-- Fixed Top Header with Logout Form -->
        <div class="top-header">
            <div class="page-title">
                <h1>ফাইন্ড ইউজার</h1>
                <p>ইউজার আইডি দিয়ে ইউজার খুঁজুন</p>
            </div>
            <div class="admin-info">
                <div class="admin-name">
                    <div class="name"><?php echo $admin_name; ?></div>
                    <div class="role">সুপার অ্যাডমিন</div>
                </div>
                <form class="logout-form" method="POST" action="logout.php">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        লগআউট
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Search Card -->
        <div class="search-card">
            <div class="search-header">
                <div class="icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2>ইউজার খুঁজুন</h2>
                <p>ইউজার আইডি লিখে সার্চ করুন</p>
            </div>
            
            <!-- Search Form -->
            <form class="search-form" method="POST" action="">
                <div class="search-input-group">
                    <i class="fas fa-id-card"></i>
                    <input type="text" 
                           name="userId" 
                           class="search-input" 
                           placeholder="0215244..."
                           required>
                </div>
                <button type="submit" name="findBTN" class="search-btn">
                    <i class="fas fa-search"></i> সার্চ
                </button>
            </form>
        </div>
        
		<?php 
			if(isset($_POST['findBTN'])){
				$search_id = $_POST['userId'];
				
				if(empty($search_id)){
					// Show not found message
					?>
					<!-- Not Found Card -->
					<div class="not-found-card" style="display: block;">
						<i class="fas fa-user-slash"></i>
						<h3>ইউজার পাওয়া যায়নি!</h3>
						<p>"<?php echo htmlspecialchars($search_id); ?>" এই আইডির কোন ইউজার নেই।</p>
						<p style="margin-top: 10px; font-size: 12px;">সঠিক ইউজার আইডি দিয়ে আবার চেষ্টা করুন।</p>
					</div>
					<?php
					exit();
				}
				if($search_id){
					$stmt = $pdo->prepare("SELECT * FROM user WHERE userId = ?");
					$stmt->execute([$search_id]);
					$user = $stmt->fetch();
					
					if(!$user){
						?>
						<div class="not-found-card" style="display: block;">
							<i class="fas fa-user-slash"></i>
							<h3>ইউজার পাওয়া যায়নি!</h3>
							<p>"<?php echo htmlspecialchars($search_id); ?>" এই আইডির কোন ইউজার নেই।</p>
						</div>
						<?php
						exit();
					}
				}
				
				$id = $user['user_id'];
				
				$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
				$stmt->execute([$id]);
				$balance = $stmt->fetch();				
				
				if(!$balance){
					$balance = [
						'total_balance' => 0,
						'gold_balance' => 0,
						'coin_balance' => 0
					];
				}
				
				$stmt = $pdo->prepare("SELECT COUNT(*) as total_ref FROM user WHERE referred_id = ?");
				$stmt->execute([$id]);
				$refer = $stmt->fetch();
				/*
				$stmt = $pdo->prepare("SELECT COUNT(*) as user_id FROM user WHERE userId = ?");
				$stmt->execute([$id]);
				$refer = $stmt->fetch();
				*/
				
				?>
                <!-- User Details Card -->
                <div class="user-details-card" style="display: block;">
                    <div class="user-details-header">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3><?php echo $user['user_name']; ?></h3>
                        <div class="user-id">আইডি: <?php echo $user['userId']; ?></div>
                    </div>
                    <div class="user-details-body">
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i> ইমেইল
                            </div>
                            <div class="info-value"><?php echo $user['email']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-phone-alt"></i> মোবাইল
                            </div>
                            <div class="info-value"><?php echo $user['number']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-calendar-alt"></i> যোগদানের তারিখ
                            </div>
                            <div class="info-value"><?php echo $user['created_at']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-coins"></i> মোট কয়েন
                            </div>
                            <div class="info-value balance"><?php echo $balance['coin_balance']; ?> কয়েন</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-money-bill-wave"></i> মোট ব্যালেন্স
                            </div>
                            <div class="info-value balance">৳ <?php echo $balance['total_balance']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-gem"></i> মোট সোনা
                            </div>
                            <div class="info-value"><?php echo $balance['gold_balance']; ?> গ্রাম</div>
                        </div>
						<!--
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-users"></i> রেফারেল কোড
                            </div>
                            <div class="info-value"><?php echo $user['userId']; ?></div>
                        </div>
						-->
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-user-friends"></i> রেফার করা ইউজার
                            </div>
                            <div class="info-value"><?php echo $refer['total_ref']; ?> জন</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-toggle-on"></i> স্ট্যাটাস
                            </div>
                            <div class="info-value">
                                <span class="status-badge status-active"><?php echo $user['status']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<!-- Post Form -->
				<div class="search-card mt-4">
					<div class="search-header">
						<div class="icon">
							<i class="fas fa-search"></i>
						</div>
						<h2>Balance Update</h2>
					</div>
					
					<!-- Search Form -->
					<form class="search-form" method="POST" action="">
						<div class="search-input-group">
							<i class="fas fa-id-card"></i>
							<input type="hidden" name="user_id" value="<?php echo $id; ?>">
							<input type="text" 
								   name="update_balance" 
								   class="search-input" 
								   placeholder="750..."
								   value="<?php echo $balance['total_balance']; ?>"
								   required>
						</div>
						<button type="submit" name="updateBalance" class="search-btn">
							<i class="fas fa-search"></i> Update
						</button>
					</form>
				</div>
				
                <?php
			}
			if(isset($_POST['updateBalance'])){
				$newBalance = $_POST['update_balance'];
				$user_id = (int) $_POST['user_id'];
				
				if(empty($newBalance)){
					echo "Invalid Amount";
				}else{
					$stmt = $pdo->prepare("
						UPDATE balance 
						SET total_balance = ? 
						WHERE user_id = ?
					");
					$stmt->execute([$newBalance, $user_id]);
					
					echo "Balance Update Successfully";
				}
			}
		?>
		
    </div>
    
    <!-- Mobile Menu Script (only for menu toggle) -->
    <script src="JS/menu.js"> </script>
</body>
</html>