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
	
	$stmt = $pdo->prepare("SELECT user_id, user_name, userId, referred_id, profile_picture, created_at FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	
	$id = $user['user_id'];
	$referred_id = $user['referred_id'];
	
	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$total_balance = $balance['total_balance']?? 0;
	
	$today = date("Y-m-d");
	
	$stmt = $pdo->prepare("UPDATE p2p SET p2p_status = 'deactive' WHERE expair_date < ? AND p2p_status = 'active'
");
	$stmt->execute([$today]);
	
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
    <title>P2P Investment - Gold Save Would</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap 5 JS Bundle (for Modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/p2p.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                <i class="fas fa-chart-line"></i> P2P Plan
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Header Section -->
        <div class="p2p-header">
            <h1>ছোট জমায় বড় রিটার্ন</h1>
            <p>বিনিয়োগ করুন, প্রতিদিন লাভ তুলুন</p>
        </div>
        
        <!-- Balance Card -->
        <div class="balance-card">
            <div class="balance-label">
                <i class="fas fa-wallet"></i> আপনার ব্যালেন্স
            </div>
            <div class="balance-amount">৳ <?php echo $total_balance; ?></div>
            <div class="balance-sub">প্যাকেজ কিনতে এই ব্যালেন্স ব্যবহার করুন</div>
        </div>
		
		<!-- Package: Basic (300 TK) -->
		<div class="package-card">
			<div class="package-header basic">
				<div class="package-icon">
					<i class="fas fa-star"></i>
				</div>
				<div class="package-name">বেসিক প্ল্যান</div>
                <div class="package-price">৳ 300</div>
                <div class="package-badge">জনপ্রিয়</div>
			</div>
			<div class="package-details">
				<div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-day"></i> মেয়াদ</span>
                    <span class="detail-value">৭ দিন</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-money-bill-wave"></i> দৈনিক আয়</span>
                    <span class="detail-value">৳ ৪০</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-coins"></i> দৈনিক বোনাস ডায়মন্ড</span>
                    <span class="detail-value">৪০ টি ডায়মন্ড</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-chart-line"></i> মোট আয়</span>
                    <span class="detail-value">৳ ২৮০ + ২৮০ ডায়মন্ড</span>
                </div>
                <div class="daily-profit">
                    <div class="label">প্রতিদিন লাভ</div>
                    <div class="value">৳ ৪০ + ৪০ ডায়মন্ড</div>
                </div>
				<form class="buy-form" method="POST">
					<input type="hidden" name="package_id" value="1">
					<button type="submit" name="basicPlan" class="buy-btn">
						<i class="fas fa-shopping-cart"></i> প্যাকেজ কিনুন
					</button>
				</form>
				
			</div>
		</div> 
		
        <!-- Package: Standard (500 TK) -->
        <div class="package-card">
            <div class="package-header standard">
                <div class="package-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="package-name">স্ট্যান্ডার্ড প্ল্যান</div>
                <div class="package-price">৳ ১০০০</div>
                <div class="package-badge">সুপার হিট</div>
            </div>
            <div class="package-details">
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-day"></i> মেয়াদ</span>
                    <span class="detail-value">১৫ দিন</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-money-bill-wave"></i> দৈনিক আয়</span>
                    <span class="detail-value">৳ ৬০</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-coins"></i> দৈনিক বোনাস ডায়মন্ড</span>
                    <span class="detail-value">৬০ টি ডায়মন্ড</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-chart-line"></i> মোট আয়</span>
                    <span class="detail-value">৳ ৯০০ + ৯০০ ডায়মন্ড</span>
                </div>
                <div class="daily-profit">
                    <div class="label">প্রতিদিন লাভ</div>
                    <div class="value">৳ ৬০ + ৬০ ডায়মন্ড</div>
                </div>
                <form class="buy-form" method="POST">
					<input type="hidden" name="package_id" value="2">
                    <button type="submit" name="standardPlan" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> প্যাকেজ কিনুন
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Package: Premium (1000 TK) -->
        <div class="package-card">
            <div class="package-header premium">
                <div class="package-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="package-name">প্রিমিয়াম প্ল্যান</div>
                <div class="package-price">৳ ৩,০০০</div>
                <div class="package-badge">বেস্ট ভ্যালু</div>
            </div>
            <div class="package-details">
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-calendar-day"></i> মেয়াদ</span>
                    <span class="detail-value">৩০ দিন</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-money-bill-wave"></i> দৈনিক আয়</span>
                    <span class="detail-value">৳ ১০০</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-coins"></i>দৈনিক বোনাস ডায়মন্ড</span>
                    <span class="detail-value">৭০ টি ডায়মন্ড</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="fas fa-chart-line"></i> মোট আয়</span>
                    <span class="detail-value">৳ ৩০০০ + ২১০০ ডায়মন্ড</span>
                </div>
                <div class="daily-profit">
                    <div class="label">প্রতিদিন লাভ</div>
                    <div class="value">৳ ১০০ + ৭০ ডায়মন্ড</div>
                </div>
                <form class="buy-form" method="POST">
					<input type="hidden" name="package_id" value="3">
                    <button type="submit" name="premiumPlan" class="buy-btn">
                        <i class="fas fa-shopping-cart"></i> প্যাকেজ কিনুন
                    </button>
                </form>
            </div>
        </div> 
		<?php
			/*
			if(isset($_POST['basicPlan'])){
				$package_id   = $_POST['package_id'];
			}elseif(isset($_POST['standardPlan'])){
				$package_id   = $_POST['package_id'];
			}
			elseif(isset($_POST['premiumPlan'])){
				$package_id   = $_POST['package_id'];
			}else{
				exit();
			}
			echo $package_id;
			*/
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($verify_user == 'active'){
					if(isset($_POST['basicPlan']) || isset($_POST['standardPlan']) || isset($_POST['premiumPlan'])){
						$package_id = $_POST['package_id'];
					} else {
						exit();
					}
					
					$stmt = $pdo->prepare("SELECT * FROM p2p_sevings WHERE package_id = ?");
					$stmt->execute([$package_id]);	
					$p2p = $stmt->fetch();
					
					if(!$p2p){
						die("Invalid package");
					}
					
					$package_price = $p2p['package_price'];
					$refer_bonus = $p2p['package_price'] * 0.10;
					$duration_date = $p2p['duration_date'];

					$current_date = date("Y-m-d");
					$expair_date  = date("Y-m-d", strtotime("+$duration_date days"));
											
					$last_collect_date = NULL;
					
					if($total_balance < $package_price){
						echo '<span id="copyMsg" style="color: green;">অপর্যাপ্ত ব্যালেন্স! </span>';
					}else{	

						$stmt = $pdo->prepare("
							SELECT p2p_id 
							FROM p2p 
							WHERE user_id = ? 
							AND package_id = ? 
							AND p2p_status = 'active'
							AND expair_date >= ?
						");
						$stmt->execute([$id, $package_id, $current_date]);

						$alreadyActive = $stmt->fetch();

						if($alreadyActive){
							echo '<span style="color:red;">Same package already active</span>';
							exit();
						}

						$pdo->beginTransaction();

						try {

							// insert
							$stmt = $pdo->prepare("INSERT INTO p2p (user_id, package_id, purchase_date, expair_date, last_collect_date, p2p_status) VALUES (?, ?, ?, ?, ?, 'active')");
							$stmt->execute([$id, $package_id, $current_date, $expair_date, $last_collect_date]);

							// deduct
							$stmt = $pdo->prepare("
								UPDATE balance 
								SET total_balance = total_balance - ? 
								WHERE user_id = ? AND total_balance >= ?
							");
							$stmt->execute([$package_price, $id, $package_price]);

							if($stmt->rowCount() == 0){
								throw new Exception("Insufficient balance");
							}

							// referral bonus
							if(!empty($referred_id) && $referred_id != $id){
								$stmt = $pdo->prepare("UPDATE balance SET total_balance = total_balance + ? WHERE user_id = ?");
								$stmt->execute([$refer_bonus, $referred_id]);
							}

							$pdo->commit();
							//echo '<span id="copyMsg" style="color: green;">submite sucessful </span>';
							header("Location: ".$_SERVER['PHP_SELF']);

						} catch(Exception $e){
							$pdo->rollBack();
							error_log($e->getMessage());
							echo "Something went wrong!";
						}
					}
				}else{
					echo '<span id="copyMsg" style="color: green;">You are not verify user please verify frist</span>';
				}
			}
		?>
    </div>
    
    <!-- ==================== MODALS ==================== -->
    
    <!-- Basic Package Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> প্যাকেজ কেনার নিশ্চয়তা</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-package-icon">
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                    </div>
                    <div class="modal-package-name">বেসিক প্ল্যান</div>
                    <table class="modal-detail-table">
                        <tr>
                            <td>প্যাকেজ মূল্য</td>
                            <td>৳ ৩০০</td>
                        </tr>
                        <tr>
                            <td>দৈনিক লাভ</td>
                            <td>৳ ১৫</td>
                        </tr>
                        <tr>
                            <td>দৈনিক বোনাস ডায়মন্ড</td>
                            <td>৩ টি</td>
                        </tr>
						<tr>
                            <td>মেয়াদ</td>
                            <td>২০ দিন</td>
                        </tr>
                        <tr>
                            <td>মোট লাভ</td>
                            <td>৳ ৩০০ + ৯০ ডায়মন্ড</td>
                        </tr>
                    </table>
                    <div class="modal-warning">
                        <i class="fas fa-info-circle"></i> প্যাকেজ কেনার পর টাকা কেটে নেওয়া হবে। আপনি কি নিশ্চিত?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <form method="POST" action="buy_package.php" style="display: inline;">
                        <input type="hidden" name="package" value="basic">
                        <input type="hidden" name="price" value="300">
                        <button type="submit" class="btn btn-confirm">নিশ্চিত করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Standard Package Modal -->
    <div class="modal fade" id="standardModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> প্যাকেজ কেনার নিশ্চয়তা</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-package-icon">
                        <i class="fas fa-gem" style="color: #FFD700;"></i>
                    </div>
                    <div class="modal-package-name">স্ট্যান্ডার্ড প্ল্যান</div>
                    <table class="modal-detail-table">
                        <tr>
                            <td>প্যাকেজ মূল্য</td>
                            <td>৳ ৫০০</td>
                        </tr>
                        <tr>
                            <td>দৈনিক লাভ</td>
                            <td>৳ ৩৫</td>
                        </tr>
						<tr>
                            <td>দৈনিক বোনাস ডায়মন্ড</td>
                            <td>৫ টি</td>
                        </tr>
                        <tr>
                            <td>মেয়াদ</td>
                            <td>২০ দিন</td>
                        </tr>
                        <tr>
                            <td>মোট লাভ</td>
                            <td>৳ ৬০০ + ১০০ ডায়মন্ড</td>
                        </tr>
                    </table>
                    <div class="modal-warning">
                        <i class="fas fa-info-circle"></i> প্যাকেজ কেনার পর টাকা কেটে নেওয়া হবে। আপনি কি নিশ্চিত?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <form method="POST" action="buy_package.php" style="display: inline;">
                        <input type="hidden" name="package" value="standard">
                        <input type="hidden" name="price" value="500">
                        <button type="submit" class="btn btn-confirm">নিশ্চিত করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Premium Package Modal -->
    <div class="modal fade" id="premiumModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-shopping-cart"></i> প্যাকেজ কেনার নিশ্চয়তা</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-package-icon">
                        <i class="fas fa-crown" style="color: #FFD700;"></i>
                    </div>
                    <div class="modal-package-name">প্রিমিয়াম প্ল্যান</div>
                    <table class="modal-detail-table">
                        <tr>
                            <td>প্যাকেজ মূল্য</td>
                            <td>৳ ১,০০০</td>
                        </tr>
                        <tr>
                            <td>দৈনিক লাভ</td>
                            <td>৳ ৬০</td>
                        </tr>
						<tr>
                            <td>দৈনিক বোনাস ডায়মন্ড</td>
                            <td>১০ টি</td>
                        </tr>
                        <tr>
                            <td>মেয়াদ</td>
                            <td>২০ দিন</td>
                        </tr>
                        <tr>
                            <td>মোট লাভ</td>
                            <td>৳ ১,২০০ + ২০০ ডায়মন্ড</td>
                        </tr>
                    </table>
                    <div class="modal-warning">
                        <i class="fas fa-info-circle"></i> প্যাকেজ কেনার পর টাকা কেটে নেওয়া হবে। আপনি কি নিশ্চিত?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল</button>
                    <form method="POST" action="buy_package.php" style="display: inline;">
                        <input type="hidden" name="package" value="premium">
                        <input type="hidden" name="price" value="1000">
                        <button type="submit" class="btn btn-confirm">নিশ্চিত করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once("bottom.php"); ?>
	
</body>
</html>