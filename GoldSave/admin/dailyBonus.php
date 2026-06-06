<?php 
	ob_start();
	include_once('security.php');
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Marketing Posts - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/markettingPost.css">
	<link rel="stylesheet" href="CSS/header.css">
    </style>
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
                <h1>ডেইলি বোনাস</h1>
                <p>ভেরিফ্যাই ইউজারদের জন্য বোনাস কয়েন</p>
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
        
        <!-- Marketing Post Form -->
        <div class="settings-card">
            <div class="settings-header">
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h2>ডেইলি বোনাস</h2>
                <p>ভেরিফ্যাই ইউজারদের জন্য বোনাস কয়েন</p>
            </div>
            
            <!-- Post Form -->
            <form id="postForm" method="POST" action="">
				<div class="form-group">
                    <label><i class="fas fa-coins"></i> ডেইলি বোনাস </label>
                    <input type="number" id="rewardCoins" name="reward_coins" class="form-control" placeholder="20" required>
                </div>
                
                <button type="submit" name="bonusBTN" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> submit
                </button>
            </form>
			<?php
				if(isset($_POST['bonusBTN'])){
					$reward_coins = $_POST['reward_coins'];
					
					if(empty($reward_coins)){
						echo '<span id="copyMsg" style="color: green;">Invalid!</span>'; 
						exit();
					}
					
					if($reward_coins){
						$stmt = $pdo->prepare("INSERT INTO bonus_coin (bonus_coin, date) VALUES (?, CURDATE())");
						$stmt->execute([$reward_coins]);
						echo '<span id="copyMsg" style="color: green;">Updated Sucessful!</span>';
					}
				}
			?>
        </div>
    </div>
    <script src="JS/menu.js"> </script>
</body>
</html>