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
	
	$stmt = $pdo->prepare("SELECT marketing_id, marketing_title, marketing_dsc, marketing_image, coin FROM marketing_drop WHERE  marketing_status = 'active' ORDER BY marketing_id DESC LIMIT 1");
	$stmt->execute();
	$todayPost = $stmt->fetch();
	
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
    <title>Marketing Drop - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/marketting.css">
	
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                Marketing Post
            </div>
            <div style="width: 40px;"></div>
        </div>
		
		<!-- Today's Post Card -->
        <div class="post-card">
            <div class="post-badge">
                <i class="fas fa-calendar-day"></i> আজকের পোস্ট
            </div>
			<div class="post-image">
				<?php if ($todayPost && $todayPost['marketing_image']): ?>
					<img src="assets/<?php echo htmlspecialchars($todayPost['marketing_image']); ?>" alt="Post Image">
				<?php else: ?>
					<div class="post-image-placeholder">
						<i class="fas fa-chart-line"></i>
						<span>মার্কেটিং পোস্ট</span>
					</div>
				<?php endif; ?>
			</div>
			
            <div class="post-title">
                <?php echo $todayPost ? htmlspecialchars($todayPost['marketing_title']) : 'আজকের জন্য কোন পোস্ট নেই'; ?>
            </div>
            <div class="post-description">
                <?php echo $todayPost ? nl2br(htmlspecialchars($todayPost['marketing_dsc'])) : 'দয়া করে পরে আবার চেষ্টা করুন।'; ?>
            </div>
			
			<?php if ($todayPost): ?>
			<!-- Reward Card -->
			<div class="reward-card">
				<div class="reward-label">
					<i class="fas fa-gift"></i> সফল সাবমিটে পুরস্কার
				</div>
				<div class="reward-amount">
					<?php echo $todayPost['coin']; ?> ডায়মন্ড
				</div>
			</div>
			<?php endif; ?>
        </div>
		
		<!-- Message Container -->
        <div id="formMessage" class="form-message">
			<?php echo $hasSubmitted; ?>
		</div>
		
        <!-- Submit Form -->
        <form id="marketingForm" method="POST" action="" autocomplete="off">
            <input type="hidden" name="csrf_token" id="csrfToken" value="">
            <input type="hidden" name="post_id" id="postId" value="<?php echo $todayPost ? $todayPost['marketing_id'] : 0; ?>">
            <input type="hidden" name="reward_coins" id="rewardCoins" value="<?php echo $todayPost ? $todayPost['coin'] : 0; ?>">
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-share-alt"></i> আপনার পোস্টের লিংক সাবমিট করুন
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-link"></i> পোস্টের লিংক</label>
                    <input type="url" 
                           name="post_link" 
                           id="postLink" 
                           class="form-control" 
                           placeholder="https://facebook.com/your-post-link"
                           required>
                    <small style="font-size: 11px; color: rgba(255,255,255,0.4);">পোস্টটির সরাসরি লিংক দিন</small>
                </div>
                
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> সাবমিট করুন
                </button>
            </div>
        </form>		
		
		<?php 
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$post_link = $_POST['post_link'];
				
				if($verify_user == 'active'){
				
					if (empty($post_link)) {
						echo 'Please provide your post link';
						exit;
					}else{
						$stmt = $pdo->prepare("SELECT post_link FROM marketing_submissions WHERE user_id = ? AND DATE(submission_date) = CURDATE() LIMIT 1");
						$stmt->execute([$id]);
						$link = $stmt->fetch();

						if($link){
							echo '<span id="copyMsg" style="color: green;">You are already submited this link. </span>';
						}else{
							$stmt = $pdo->prepare("INSERT INTO marketing_submissions (post_link, user_id) VALUES (?, ?)");
							$stmt->execute([$post_link, $id]);
							echo '<span id="copyMsg" style="color: green;">submite sucessful </span>';
						}
					}
				}else{
					echo '<span id="copyMsg" style="color: green;">You are not verify user please verify frist</span>';
				}
			}		
		?>
		
		<!-- Conditions Card -->
        <div class="conditions-card">
            <div class="conditions-title">
                <i class="fas fa-clipboard-list"></i> পোস্ট করার শর্তাবলী
            </div>
            <ul class="condition-list">
                <li><i class="fas fa-check-circle"></i> পোস্টটি আপনার ফেসবুক/ইনস্টাগ্রাম/টুইটার একাউন্টে পাবলিক করতে হবে</li>
				
                <li><i class="fas fa-check-circle"></i> পোস্টের ক্যাপশনে <span class="hashtag" style="background: rgba(255,215,0,0.2);">#GoldSaveWould</span> হ্যাশট্যাগ ব্যবহার করতে হবে</li>
				
                <li><i class="fas fa-check-circle"></i> পোস্টের লিংক সঠিকভাবে দিতে হবে</li>
                <li><i class="fas fa-check-circle"></i> প্রতিদিন শুধুমাত্র ১ বার পোস্ট সাবমিট করা যাবে</li>
                <li><i class="fas fa-check-circle"></i> পোস্টটি ২৪ ঘন্টা পর্যন্ত পাবলিক রাখতে হবে</li>
                <li><i class="fas fa-check-circle"></i> এডমিন দ্বারা ভেরিফাই করার পর ডায়মন্ড প্রদান করা হবে</li>
            </ul>
        </div>
        
        <div class="info-text">
            <i class="fas fa-clock"></i> সাবমিট করার পর এডমিন আপনার পোস্ট ভেরিফাই করে ডায়মন্ড প্রদান করবেন। দয়া করে পোস্টটি ২৪ ঘন্টা পাবলিক রাখুন।
        </div>
		
    </div>
</body>
</html>