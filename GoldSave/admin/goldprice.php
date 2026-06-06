<?php 
	ob_start();
	include_once('security.php');
	$stmt = $pdo->prepare("SELECT gold_price, date FROM gold_price ORDER BY gold_price_id DESC LIMIT 1");
	$stmt->execute();
	$price = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Gold Price Settings - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/goldprice.css">
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
                <h1>সোনার দাম সেটিংস</h1>
                <p>গোল্ড প্রাইস আপডেট করুন</p>
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
        
        <!-- Settings Form -->
        <div class="settings-card">
            <div class="settings-header">
                <div class="icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h2>গোল্ড প্রাইস সেটিংস</h2>
                <p>বর্তমান সোনার দাম নির্ধারণ করুন</p>
            </div>
            
            <!-- Current Price Display -->
            <div class="current-price">
                <div class="label">বর্তমান সোনার দাম</div>
                <div class="value" id="currentPriceDisplay">৳ <?php echo $price['gold_price']?? 0;?></div>
                <div class="update-info">শেষ আপডেট: <?php echo $price['date']?? 'No Date';?></div>
            </div>
            
            <!-- Alert Message -->
            <div id="alertMessage" class="alert-message"></div>
            
            <!-- Price Update Form -->
            <form id="goldPriceForm" method="POST" action="">
                <div class="form-group">
                    <label><i class="fas fa-money-bill-wave"></i> সোনার দাম (প্রতি গ্রাম)</label>
                    <input type="number" 
                           id="goldPrice" 
                           name="gold_price" 
                           class="form-control" 
                           placeholder="যেমন: 7850"
                           min="1000"
                           step="10"
                           required>
                </div>
                
                <button type="submit" name="priceSetting" class="submit-btn">
                    <i class="fas fa-save"></i> দাম আপডেট করুন
                </button>
            </form>
			<?php 
				if(isset($_POST['priceSetting'])){
					$gold_price = $_POST['gold_price'];
					
					if(empty($gold_price)){
						echo '<span id="copyMsg" style="color: green;">Invalid!</span>'; 
						exit();
					}
					
					if($gold_price){
						$stmt = $pdo->prepare("INSERT INTO gold_price (gold_price, date) VALUES (?, CURDATE())");
						$stmt->execute([$gold_price]);
						echo '<span id="copyMsg" style="color: green;">Updated Sucessful!</span>'; 
						header("Location: ".$_SERVER['PHP_SELF']);
					}
				}
			?>
        </div>
    </div>
    <script src="JS/menu.js"> </script>
</body>
</html>