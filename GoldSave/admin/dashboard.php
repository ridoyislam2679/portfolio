<?php 
	include_once('security.php');
	
	// Get referral stats
	$stmt = $pdo->prepare("SELECT COUNT(*) as user_id FROM user");
	$stmt->execute();
	$user = $stmt->fetch();
	
	// Get Panding withdrawal Requests
	$stmt = $pdo->prepare("SELECT COUNT(*) as collect_id FROM collectGold");
	$stmt->execute();
	$collect_gold = $stmt->fetch();
	
	// Get Panding Task
	$stmt = $pdo->prepare("SELECT COUNT(*) as submission_id FROM marketing_submissions");
	$stmt->execute();
	$submission = $stmt->fetch();
	
	// Get Panding Task
	$stmt = $pdo->prepare("SELECT COUNT(*) as recharge_id FROM recharge");
	$stmt->execute();
	$recharge = $stmt->fetch();
	
	// Get Rit Coin Price
	$stmt = $pdo->prepare("SELECT gold_price FROM gold_price ORDER BY gold_price_id DESC LIMIT 1");
	$stmt->execute();
	$rit_coin = $stmt->fetch();
	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Admin Dashboard - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="CSS/dashboard.css">
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
                <h1>Dashboard</h1>
                <p>Welcome! Your platform's overall status</p>
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
        
        <!-- Stats Cards - Row 1 -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo $user['user_id']; ?></div>
                <div class="stat-label">Total User</div>
            </div>
			<div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="stat-value"><?php echo $recharge['recharge_id']; ?></div>
                <div class="stat-label">Panding Mobile Recharge</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-value"><?php echo $submission['submission_id']; ?></div>
                <div class="stat-label">Panding Marketting Submission</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="stat-value"><?php echo $collect_gold['collect_id']; ?></div>
                <div class="stat-label">Panding Collect Gold</div>
            </div>
        </div>
        
        <!-- Recent Users Table -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-users"></i> New User
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User No.</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Gander</th>
                        <th>Mobile Number</th>
                        <th>Joinig Date</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
					$select = "SELECT user_name, gender, number, userId, created_at FROM user ORDER BY created_at DESC LIMIT 10";
					$new_user = $pdo->prepare($select);
					$new_user->execute();
					
					$user_count = 1;
					
					while($newUser = $new_user->fetch()){
						
						?>
							<tr>
								<td><?php echo $user_count ?></td>
								<td><?php echo $newUser['userId'] ?></td>
								<td><?php echo $newUser['user_name'] ?></td>
								<td><?php echo $newUser['gender'] ?></td>
								<td><span class="prize-won"><?php echo $newUser['number']; ?></span></td>
								<td><span class="prize-won"><?php echo $newUser['created_at']; ?></span></td>
							</tr>
						<?php	
						$user_count++;
					}							
				?>
                </tbody>
            </table>
        </div>
        
        <!-- Pending Marketing Submissions -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-file-alt"></i> Panding Marketting Submissions Post Request
            </div>
            <table class="custom-table">
                <thead>
					<tr>
                        <th>Post No.</th>
                        <th>User ID</th>
                        <th>Post Link</th>
                        <th>Post Date</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "SELECT post_link, submission_date, userId FROM marketing_submissions JOIN user ON marketing_submissions.user_id = user.user_id WHERE submission_status = 'pending' ORDER BY submission_date DESC LIMIT 10";
						$submission_post = $pdo->prepare($select);
						$submission_post->execute();
						
						$submission_id = 1;
						
						while($submission = $submission_post->fetch()){
							
							?>
								<tr>
									<td><?php echo $submission_id ?></td>
									<td><?php echo $submission['userId'] ?></td>
									<td><?php echo $submission['post_link'] ?></td>
									<td><?php echo $submission['submission_date'] ?></td>
								</tr>
							<?php
							$submission_id++;
						}							
					?>
                </tbody>
            </table>
        </div>
        
        <!-- Pending Gold Collect Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-hand-holding-heart"></i> Panding Collect Gold
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Collect No.</th>
                        <th>User ID</th>
                        <th>Collect User</th>
                        <th>User Number</th>
                        <th>User Address</th>
                        <th>Quantity</th>
                        <th>Method</th>
                        <th>Request Date</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "
								SELECT 
									c.quantity,
									c.method,
									c.delivery_user,
									c.delivery_user_number,
									c.delivery_address,
									c.collect_date,
									u.userId
								FROM collectGold c
								JOIN user u ON c.user_id = u.user_id
								WHERE c.collect_status = 'pending'
								ORDER BY c.collect_date DESC
								LIMIT 10
								";

								$collect_gold = $pdo->prepare($select);
								$collect_gold->execute();
						
						$collect_id = 1;
						
						while($gold = $collect_gold->fetch()){
							
							?>
								<tr>
									<td><?php echo $collect_id ?></td>
									<td><?php echo $gold['userId'] ?></td>
									<td><?php echo $gold['delivery_user'] ?></td>
									<td><?php echo $gold['delivery_user_number'] ?></td>
									<td><?php echo $gold['delivery_address'] ?></td>
									<td><?php echo $gold['quantity'] ?></td>
									<td><?php echo $gold['method'] ?></td>
									<td><?php echo $gold['collect_date'] ?></td>
								</tr>
							<?php
							$collect_id++;
						}							
					?>
                </tbody>
            </table>
        </div>
        
        <!-- Pending Mobile Recharge Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-mobile-alt"></i> পেন্ডিং মোবাইল রিচার্জ রিকোয়েস্ট
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Recharge No.</th>
                        <th>User ID</th>
                        <th>Mobile Number</th>
                        <th>Amount</th>
                        <th>Request Date</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "SELECT mobile_number, recharge_amount, recharge_date, userId FROM recharge JOIN user ON recharge.user_id = user.user_id WHERE recharge_status = 'pending' ORDER BY recharge_date DESC LIMIT 10";
						$recharge_rqt = $pdo->prepare($select);
						$recharge_rqt->execute();
						
						$recharge_no = 1;
						
						while($recharge = $recharge_rqt->fetch()){
							
							?>
								<tr>
									<td><?php echo $recharge_no ?></td>
									<td><?php echo $recharge['userId'] ?></td>
									<td><?php echo $recharge['mobile_number'] ?></td>
									<td><?php echo $recharge['recharge_amount'] ?></td>
									<td><?php echo $recharge['recharge_date'] ?></td>
								</tr>
							<?php
							$submission_id++;
						}							
					?>
                </tbody>
            </table>
        </div>
    </div>
	<script src="JS/menu.js"> </script>
</body>
</html>