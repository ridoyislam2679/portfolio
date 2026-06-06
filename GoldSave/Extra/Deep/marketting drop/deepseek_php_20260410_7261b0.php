<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_kinen');

// Get user data from database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT fullname, mobile, balance, coins FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get today's marketing post
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT * FROM marketing_posts WHERE post_date = ? AND status = 'active' LIMIT 1");
$stmt->bind_param("s", $today);
$stmt->execute();
$postResult = $stmt->get_result();
$todayPost = $postResult->fetch_assoc();

// If no post for today, get the latest active post
if (!$todayPost) {
    $stmt = $conn->prepare("SELECT * FROM marketing_posts WHERE status = 'active' ORDER BY post_date DESC LIMIT 1");
    $stmt->execute();
    $postResult = $stmt->get_result();
    $todayPost = $postResult->fetch_assoc();
}

// Get user's today submission status
$stmt = $conn->prepare("SELECT * FROM marketing_submissions WHERE user_id = ? AND DATE(submitted_at) = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$submissionResult = $stmt->get_result();
$hasSubmitted = $submissionResult->num_rows > 0;
$submission = $submissionResult->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Marketing Drop - Gold Kinen</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #0a0a1a 0%, #0f0f2a 50%, #1a1a3e 100%);
            min-height: 100vh;
            color: #fff;
            padding-bottom: 30px;
        }
        
        /* Main Container */
        .main-content {
            max-width: 500px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        /* Top Header */
        .top-header {
            padding: 20px 0 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .logo i {
            color: #FFD700;
        }
        
        .back-btn {
            background: rgba(255, 215, 0, 0.15);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #FFD700;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .back-btn:active {
            transform: scale(0.95);
        }
        
        /* Today's Post Card */
        .post-card {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(255, 165, 0, 0.08));
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 215, 0, 0.2);
            text-align: center;
        }
        
        .post-badge {
            background: #ff4444;
            display: inline-block;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .post-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #FFD700;
        }
        
        .post-description {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
            margin-bottom: 15px;
        }
        
        .post-hashtags {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }
        
        .hashtag {
            background: rgba(255, 215, 0, 0.15);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            color: #FFD700;
        }
        
        /* Reward Card */
        .reward-card {
            background: rgba(255, 215, 0, 0.08);
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 215, 0, 0.15);
        }
        
        .reward-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .reward-amount {
            font-size: 24px;
            font-weight: 800;
            color: #FFD700;
        }
        
        /* Conditions Card */
        .conditions-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 215, 0, 0.1);
        }
        
        .conditions-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .conditions-title i {
            color: #FFD700;
            margin-right: 8px;
        }
        
        .condition-list {
            list-style: none;
            padding: 0;
        }
        
        .condition-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .condition-list li i {
            color: #FFD700;
            font-size: 14px;
            margin-top: 2px;
        }
        
        /* Form Card */
        .form-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 24px 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 215, 0, 0.1);
        }
        
        .form-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .form-title i {
            color: #FFD700;
            margin-right: 8px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .form-group label i {
            color: #FFD700;
            margin-right: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 12px;
            font-size: 14px;
            color: #fff;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #FFD700;
            background: rgba(255, 215, 0, 0.05);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        
        /* Platform Buttons */
        .platform-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .platform-btn {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 215, 0, 0.2);
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .platform-btn i {
            font-size: 24px;
            display: block;
            margin-bottom: 5px;
        }
        
        .platform-btn span {
            font-size: 11px;
        }
        
        .platform-btn.active {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 165, 0, 0.15));
            border-color: #FFD700;
        }
        
        .platform-btn.facebook { color: #1877f2; }
        .platform-btn.instagram { color: #e4405f; }
        .platform-btn.twitter { color: #1da1f2; }
        
        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            padding: 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 18px;
            color: #0a0a1a;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .submit-btn:active {
            transform: scale(0.98);
        }
        
        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* Already Submitted Card */
        .submitted-card {
            background: rgba(40, 167, 69, 0.1);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(40, 167, 69, 0.3);
            margin-bottom: 20px;
        }
        
        .submitted-card i {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 10px;
        }
        
        .submitted-card h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .submitted-card p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }
        
        /* Message Styles */
        .form-message {
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 15px;
            display: none;
            font-size: 14px;
        }
        
        .form-message.error {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ff6b6b;
            display: block;
        }
        
        .form-message.success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #6bff8b;
            display: block;
        }
        
        .info-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
            text-align: center;
            margin-top: 15px;
        }
        
        @media (max-width: 480px) {
            .platform-buttons {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .post-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="dashboard.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                <i class="fas fa-coins"></i> Gold Kinen
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <?php if ($hasSubmitted): ?>
            <!-- Already Submitted Today -->
            <div class="submitted-card">
                <i class="fas fa-check-circle"></i>
                <h3>আজকে আপনি ইতিমধ্যে সাবমিট করেছেন!</h3>
                <p>আপনার সাবমিট করা লিংক: <?php echo htmlspecialchars($submission['post_link']); ?></p>
                <p style="margin-top: 10px;">আপনি <?php echo $submission['reward_coins']; ?> কয়েন পেয়েছেন!</p>
                <p>আগামীকাল আবার চেষ্টা করুন।</p>
            </div>
        <?php else: ?>
        
        <!-- Today's Post Card -->
        <div class="post-card">
            <div class="post-badge">
                <i class="fas fa-calendar-day"></i> আজকের পোস্ট
            </div>
            <div class="post-title">
                <?php echo $todayPost ? htmlspecialchars($todayPost['title']) : 'আজকের জন্য কোন পোস্ট নেই'; ?>
            </div>
            <div class="post-description">
                <?php echo $todayPost ? nl2br(htmlspecialchars($todayPost['description'])) : 'দয়া করে পরে আবার চেষ্টা করুন।'; ?>
            </div>
            <?php if ($todayPost && $todayPost['hashtags']): ?>
            <div class="post-hashtags">
                <?php 
                $hashtags = explode(',', $todayPost['hashtags']);
                foreach ($hashtags as $tag): ?>
                    <span class="hashtag">#<?php echo trim(htmlspecialchars($tag)); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Reward Card -->
        <div class="reward-card">
            <div class="reward-label">
                <i class="fas fa-gift"></i> সফল সাবমিটে পুরস্কার
            </div>
            <div class="reward-amount">
                + <?php echo $todayPost ? $todayPost['reward_coins'] : 0; ?> কয়েন
            </div>
        </div>
        
        <!-- Conditions Card -->
        <div class="conditions-card">
            <div class="conditions-title">
                <i class="fas fa-clipboard-list"></i> পোস্ট করার শর্তাবলী
            </div>
            <ul class="condition-list">
                <li><i class="fas fa-check-circle"></i> পোস্টটি আপনার ফেসবুক/ইনস্টাগ্রাম/টুইটার একাউন্টে পাবলিক করতে হবে</li>
                <li><i class="fas fa-check-circle"></i> পোস্টের ক্যাপশনে <span class="hashtag" style="background: rgba(255,215,0,0.2);">#GoldKinen</span> এবং <span class="hashtag" style="background: rgba(255,215,0,0.2);">#GoldKinenBangladesh</span> হ্যাশট্যাগ ব্যবহার করতে হবে</li>
                <li><i class="fas fa-check-circle"></i> পোস্টের স্ক্রিনশট বা লিংক সঠিকভাবে দিতে হবে</li>
                <li><i class="fas fa-check-circle"></i> প্রতিদিন শুধুমাত্র ১ বার পোস্ট সাবমিট করা যাবে</li>
                <li><i class="fas fa-check-circle"></i> পোস্টটি ২৪ ঘন্টা পর্যন্ত পাবলিক রাখতে হবে</li>
                <li><i class="fas fa-check-circle"></i> এডমিন দ্বারা ভেরিফাই করার পর কয়েন প্রদান করা হবে</li>
            </ul>
        </div>
        
        <!-- Message Container -->
        <div id="formMessage" class="form-message"></div>
        
        <!-- Submit Form -->
        <form id="marketingForm" method="POST" action="process_marketing.php" autocomplete="off">
            <input type="hidden" name="csrf_token" id="csrfToken" value="">
            <input type="hidden" name="post_id" id="postId" value="<?php echo $todayPost ? $todayPost['id'] : 0; ?>">
            <input type="hidden" name="reward_coins" id="rewardCoins" value="<?php echo $todayPost ? $todayPost['reward_coins'] : 0; ?>">
            
            <div class="form-card">
                <div class="form-title">
                    <i class="fas fa-share-alt"></i> আপনার পোস্টের লিংক সাবমিট করুন
                </div>
                
                <div class="form-group">
                    <label><i class="fab fa-facebook"></i> সোশ্যাল মিডিয়া প্ল্যাটফর্ম</label>
                    <div class="platform-buttons">
                        <div class="platform-btn facebook" data-platform="facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>ফেসবুক</span>
                        </div>
                        <div class="platform-btn instagram" data-platform="instagram">
                            <i class="fab fa-instagram"></i>
                            <span>ইনস্টাগ্রাম</span>
                        </div>
                        <div class="platform-btn twitter" data-platform="twitter">
                            <i class="fab fa-twitter"></i>
                            <span>টুইটার</span>
                        </div>
                    </div>
                    <input type="hidden" name="platform" id="platform" value="facebook">
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
                
                <div class="form-group">
                    <label><i class="fas fa-image"></i> পোস্টের স্ক্রিনশট (ঐচ্ছিক)</label>
                    <input type="text" 
                           name="screenshot_url" 
                           id="screenshotUrl" 
                           class="form-control" 
                           placeholder="ছবির লিংক দিন (যদি থাকে)">
                </div>
                
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> সাবমিট করুন
                </button>
            </div>
        </form>
        
        <div class="info-text">
            <i class="fas fa-clock"></i> সাবমিট করার পর এডমিন আপনার পোস্ট ভেরিফাই করে কয়েন প্রদান করবেন। দয়া করে পোস্টটি ২৪ ঘন্টা পাবলিক রাখুন।
        </div>
        
        <?php endif; ?>
    </div>
    
    <script>
        // Platform selection
        const platformBtns = document.querySelectorAll('.platform-btn');
        const platformInput = document.getElementById('platform');
        
        platformBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                platformBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const platform = this.getAttribute('data-platform');
                platformInput.value = platform;
            });
        });
        
        // Generate CSRF token
        function generateCSRFToken() {
            return Math.random().toString(36).substring(2) + Date.now().toString(36);
        }
        document.getElementById('csrfToken').value = generateCSRFToken();
        
        // Form submission
        const form = document.getElementById('marketingForm');
        const submitBtn = document.getElementById('submitBtn');
        const messageDiv = document.getElementById('formMessage');
        
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
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const postLink = document.getElementById('postLink').value.trim();
            const platform = platformInput.value;
            
            if (!postLink) {
                showMessage('দয়া করে আপনার পোস্টের লিংক দিন', 'error');
                return;
            }
            
            // Basic URL validation
            if (!postLink.startsWith('http://') && !postLink.startsWith('https://')) {
                showMessage('দয়া করে সম্পূর্ণ লিংক দিন (http:// অথবা https:// সহ)', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> সাবমিট হচ্ছে...';
            
            // Update CSRF token
            document.getElementById('csrfToken').value = generateCSRFToken();
            
            // Submit to PHP (uncomment in production)
            // this.submit();
            
            // Demo simulation (remove in production)
            setTimeout(() => {
                showMessage(`সফলভাবে সাবমিট হয়েছে! আপনার পোস্টটি পর্যালোচনা করা হবে এবং ${document.getElementById('rewardCoins').value} কয়েন প্রদান করা হবে।`, 'success');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> সাবমিট করুন';
                document.getElementById('postLink').value = '';
                
                setTimeout(() => {
                    // window.location.reload();
                }, 2000);
            }, 1500);
        });
    </script>
</body>
</html>