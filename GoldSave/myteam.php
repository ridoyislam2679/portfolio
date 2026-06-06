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
	
	$stmt = $pdo->prepare("SELECT COUNT(*) AS total_referrals FROM user WHERE referred_id = ?;");
	$stmt->execute([$id]);
	$reffer = $stmt->fetch();

	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$stmt = $pdo->prepare("SELECT user_id, user_name, userId, profile_picture, created_at FROM user WHERE referred_id = ? ORDER BY user_id DESC");
	$stmt->execute([$id]);
	$reffer_user = $stmt->fetchAll();	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>My Team - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/team.css">
    <style>
        
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                <i class="fas fa-users"></i> My Team
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-row">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <div class="profile-name"><?php echo $user['user_name']; ?></div>
                    <div class="profile-join-date">
                        <i class="fas fa-calendar-alt"></i> যোগদান: <?php echo $user['created_at']; ?>
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
        
        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value"><?php echo $reffer['total_referrals'] ?? 0; ?></div>
                <div class="stat-label">মোট রেফার</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-value"><?php echo $balance['total_balance'] ?? 0; ?>৳</div>
                <div class="stat-label">মোট ব্যালেন্স</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value"><?php echo $balance['coin_balance'] ?? 0; ?></div>
                <div class="stat-label">মোট ডায়মন্ড</div>
            </div>
        </div>
        
        <!-- Team List Section -->
        <div class="team-section">
            <div class="section-title">
                <i class="fas fa-user-friends"></i> আমার রেফার করা সদস্যবৃন্দ
            </div>
            
            <div class="table-responsive">
				<?php 
					if($reffer_user){
					?>
						<table class="team-table">
							<thead>
								<tr>
									<th>ক্রমিক নং</th>
									<th>নাম</th>
									<th>যোগদানের তারিখ</th>
								</tr>
							</thead>
							<tbody>
								 <?php 
								$i = 1;
								foreach($reffer_user as $user){
								?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo htmlspecialchars($user['user_name']); ?></td>
									<td><?php echo date('d-m-Y', strtotime($user['created_at'])); ?></td>
								</tr>
								<?php } ?>                      
							</tbody>
						</table>
					<?php
					}else{
						?>
						<div class="empty-message">
							<i class="fas fa-user-friends"></i>
							<p>আপনি এখনো কাউকে রেফার করেননি</p>
							<small style="font-size: 12px;">আপনার ইউজার আইডি শেয়ার করে বন্ধুদের আমন্ত্রণ জানান</small>
						</div>
						<?php 
					}
				?>
            </div>
        </div>
    </div>
    <?php include_once("bottom.php"); ?>
    
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
    </script>
</body>
</html>