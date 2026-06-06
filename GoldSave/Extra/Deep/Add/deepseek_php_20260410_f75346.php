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

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user_id = $_SESSION['user_id'];

// Get user data
$stmt = $conn->prepare("SELECT fullname, coins, balance FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Get today's watched ads count
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT COUNT(*) as watched_count FROM ad_watch_history WHERE user_id = ? AND DATE(watched_at) = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$watchedCount = $stmt->get_result()->fetch_assoc()['watched_count'];

$maxAdsPerDay = 30;
$remainingAds = $maxAdsPerDay - $watchedCount;

// Get today's earnings from ads
$stmt = $conn->prepare("SELECT SUM(reward_coins) as today_earnings FROM ad_watch_history WHERE user_id = ? AND DATE(watched_at) = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$todayEarnings = $stmt->get_result()->fetch_assoc()['today_earnings'] ?? 0;

$conn->close();

// Generate ads array (30 ads)
$ads = [];
for ($i = 1; $i <= 30; $i++) {
    $ads[] = [
        'id' => $i,
        'title' => 'বিজ্ঞাপন দেখুন এবং আয় করুন',
        'reward' => 1,
        'icon' => 'fa-solid fa-video'
    ];
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Free Earning - Gold Kinen</title>
    
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
            padding-bottom: 80px;
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
        
        /* Header Section */
        .ads-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .ads-header h1 {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 5px;
        }
        
        .ads-header p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* Earnings Card */
        .earnings-card {
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(255, 165, 0, 0.08));
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .earnings-card h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .earnings-stats {
            display: flex;
            gap: 15px;
        }
        
        .stat-item {
            flex: 1;
            text-align: center;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 16px;
            padding: 15px;
        }
        
        .stat-item .label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 8px;
        }
        
        .stat-item .value {
            font-size: 24px;
            font-weight: 800;
            color: #FFD700;
        }
        
        /* Daily Limit Card */
        .daily-limit-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 215, 0, 0.1);
        }
        
        .limit-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .limit-info i {
            font-size: 24px;
            color: #FFD700;
        }
        
        .limit-text {
            font-size: 14px;
        }
        
        .limit-count {
            font-size: 20px;
            font-weight: 700;
            color: #FFD700;
        }
        
        .limit-warning {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
        }
        
        /* Ads Grid */
        .ads-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .ads-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 16px 12px;
            text-align: center;
            border: 1px solid rgba(255, 215, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        .ads-card i {
            font-size: 32px;
            color: #FFD700;
            margin-bottom: 8px;
        }
        
        .ads-card h5 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .ads-card p {
            font-size: 11px;
            color: #FFD700;
            margin-bottom: 12px;
        }
        
        .watch-btn {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 12px;
            color: #0a0a1a;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }
        
        .watch-btn:active {
            transform: scale(0.96);
        }
        
        .watch-btn:disabled {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.3);
            cursor: not-allowed;
            transform: none;
        }
        
        /* Modal Styles */
        .modal-content {
            background: linear-gradient(180deg, #0f0f2a 0%, #1a1a3e 100%);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 24px;
            color: #fff;
        }
        
        .modal-header {
            border-bottom: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .modal-header .btn-close {
            filter: invert(1);
        }
        
        .modal-footer {
            border-top: 1px solid rgba(255, 215, 0, 0.2);
        }
        
        .modal-footer .btn-success {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            color: #0a0a1a;
            font-weight: 600;
        }
        
        .timer {
            font-size: 48px;
            font-weight: 800;
            color: #FFD700;
        }
        
        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(10, 10, 26, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 215, 0, 0.15);
            padding: 10px 20px;
            max-width: 500px;
            margin: 0 auto;
            z-index: 1000;
        }
        
        .nav-items {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-item {
            text-align: center;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.2s ease;
            flex: 1;
        }
        
        .nav-item i {
            font-size: 22px;
            display: block;
            margin-bottom: 4px;
        }
        
        .nav-item span {
            font-size: 11px;
        }
        
        .nav-item.active {
            color: #FFD700;
        }
        
        .nav-item:active {
            transform: scale(0.95);
        }
        
        /* Toast Message */
        .toast-message {
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            z-index: 9999;
            animation: fadeInUp 0.3s ease;
        }
        
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
        
        @media (max-width: 480px) {
            .stat-item .value {
                font-size: 18px;
            }
            
            .ads-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
            
            .ads-card {
                padding: 12px 8px;
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
                <i class="fas fa-gift"></i> ফ্রি আর্নিং
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Header Section -->
        <div class="ads-header">
            <h1>বিজ্ঞাপন দেখুন ও আয় করুন</h1>
            <p>প্রতিটি বিজ্ঞাপন দেখে ১ কয়েন আয় করুন</p>
        </div>
        
        <!-- Earnings Stats -->
        <div class="earnings-card">
            <h3><i class="fas fa-chart-line"></i> আপনার আয়</h3>
            <div class="earnings-stats">
                <div class="stat-item">
                    <div class="label">মোট কয়েন</div>
                    <div class="value" id="totalCoins"><?php echo number_format($user['coins'], 2); ?></div>
                </div>
                <div class="stat-item">
                    <div class="label">আজকের আয়</div>
                    <div class="value" id="todayEarnings"><?php echo number_format($todayEarnings, 2); ?> কয়েন</div>
                </div>
            </div>
        </div>
        
        <!-- Daily Limit Card -->
        <div class="daily-limit-card">
            <div class="limit-info">
                <i class="fas fa-calendar-day"></i>
                <div>
                    <div class="limit-text">আজকের বাকি বিজ্ঞাপন</div>
                    <div class="limit-warning">প্রতিদিন সর্বোচ্চ ৩০টি</div>
                </div>
            </div>
            <div class="limit-count" id="remainingAds"><?php echo $remainingAds; ?> / <?php echo $maxAdsPerDay; ?></div>
        </div>
        
        <!-- Ads Grid -->
        <div class="ads-grid" id="adsGrid">
            <?php for ($i = 1; $i <= 30; $i++): ?>
            <div class="ads-card">
                <i class="fas fa-video"></i>
                <h5>বিজ্ঞাপন <?php echo $i; ?></h5>
                <p>আয়: ১ কয়েন</p>
                <button class="watch-btn" id="ad-<?php echo $i; ?>" onclick="watchAd(<?php echo $i; ?>)">
                    <i class="fas fa-play"></i> দেখুন
                </button>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="adModal" tabindex="-1" aria-labelledby="adModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-play-circle"></i> বিজ্ঞাপন চলছে...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>বিজ্ঞাপন দেখার জন্য দয়া করে অপেক্ষা করুন</p>
                    <div class="timer" id="timer">5</div>
                    <p class="mt-2" style="font-size: 12px;">সেকেন্ড বাকি</p>
                </div>
                <div class="modal-footer">
                    <button id="okBtn" class="btn btn-success" disabled onclick="adCompleted()">
                        <i class="fas fa-check"></i> সম্পন্ন হয়েছে
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="nav-items">
            <a href="dashboard.php" class="nav-item">
                <i class="fas fa-home"></i>
                <span>হোম</span>
            </a>
            <a href="my-team.php" class="nav-item">
                <i class="fas fa-users"></i>
                <span>মাই টিম</span>
            </a>
            <a href="deposit.php" class="nav-item">
                <i class="fas fa-plus-circle"></i>
                <span>ডিপোজিট</span>
            </a>
            <a href="free-earning.php" class="nav-item active">
                <i class="fas fa-gift"></i>
                <span>ফ্রি আর্নিং</span>
            </a>
            <a href="settings.php" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>সেটিংস</span>
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Configuration
        let currentAdId = null;
        let timerInterval = null;
        let adModal = null;
        
        // Get today's date string
        function getTodayKey(adId) {
            const today = new Date().toISOString().split('T')[0];
            return `watched_ad_${adId}_${today}`;
        }
        
        // Get remaining ads from localStorage
        function getWatchedCount() {
            let count = 0;
            for (let i = 1; i <= 30; i++) {
                const key = getTodayKey(i);
                if (localStorage.getItem(key) === 'watched') {
                    count++;
                }
            }
            return count;
        }
        
        // Update UI based on watched ads
        function updateWatchedAds() {
            const remainingAdsSpan = document.getElementById('remainingAds');
            const todayEarningsSpan = document.getElementById('todayEarnings');
            
            let watchedCount = 0;
            let todayEarnings = 0;
            
            for (let i = 1; i <= 30; i++) {
                const key = getTodayKey(i);
                const isWatched = localStorage.getItem(key) === 'watched';
                const btn = document.getElementById(`ad-${i}`);
                
                if (isWatched) {
                    watchedCount++;
                    todayEarnings++;
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                        btn.disabled = true;
                        btn.style.background = 'rgba(255, 255, 255, 0.1)';
                        btn.style.color = 'rgba(255, 255, 255, 0.3)';
                    }
                } else {
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-play"></i> দেখুন';
                        btn.disabled = false;
                        btn.style.background = 'linear-gradient(135deg, #FFD700, #FFA500)';
                        btn.style.color = '#0a0a1a';
                    }
                }
            }
            
            const remaining = 30 - watchedCount;
            if (remainingAdsSpan) {
                remainingAdsSpan.innerHTML = `${remaining} / 30`;
            }
            if (todayEarningsSpan) {
                todayEarningsSpan.innerHTML = `${todayEarnings} কয়েন`;
            }
            
            // Update total coins display
            fetchTotalCoins();
        }
        
        // Fetch total coins from server
        function fetchTotalCoins() {
            fetch('get_user_coins.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('totalCoins').innerHTML = parseFloat(data.coins).toFixed(2);
                    }
                })
                .catch(error => console.log('Error fetching coins:', error));
        }
        
        // Watch ad function
        function watchAd(adId) {
            const key = getTodayKey(adId);
            
            // Check if already watched today
            if (localStorage.getItem(key) === 'watched') {
                showToast('আপনি আজ এই বিজ্ঞাপনটি ইতিমধ্যে দেখেছেন!', 'error');
                return;
            }
            
            // Check daily limit
            const watchedCount = getWatchedCount();
            if (watchedCount >= 30) {
                showToast('আপনি আজকের সর্বোচ্চ ৩০টি বিজ্ঞাপন দেখে ফেলেছেন! আগামীকাল আবার চেষ্টা করুন।', 'error');
                return;
            }
            
            currentAdId = adId;
            let seconds = 5;
            const timerElement = document.getElementById('timer');
            const okBtn = document.getElementById('okBtn');
            
            timerElement.innerText = seconds;
            okBtn.disabled = true;
            
            // Show modal
            if (!adModal) {
                adModal = new bootstrap.Modal(document.getElementById('adModal'));
            }
            adModal.show();
            
            // Start timer
            if (timerInterval) clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                seconds--;
                timerElement.innerText = seconds;
                if (seconds <= 0) {
                    clearInterval(timerInterval);
                    okBtn.disabled = false;
                }
            }, 1000);
        }
        
        // Ad completed function
        function adCompleted() {
            if (currentAdId) {
                const key = getTodayKey(currentAdId);
                localStorage.setItem(key, 'watched');
                
                // Update button
                const btn = document.getElementById(`ad-${currentAdId}`);
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                    btn.disabled = true;
                    btn.style.background = 'rgba(255, 255, 255, 0.1)';
                    btn.style.color = 'rgba(255, 255, 255, 0.3)';
                }
                
                // Update earnings to server
                updateEarnings(currentAdId);
                
                // Update UI
                updateWatchedAds();
                
                // Show success message
                showToast('আপনি ১ কয়েন পেয়েছেন!', 'success');
                
                // Close modal
                if (adModal) {
                    adModal.hide();
                }
            }
            
            currentAdId = null;
            if (timerInterval) {
                clearInterval(timerInterval);
            }
        }
        
        // Update earnings to server
        function updateEarnings(adId) {
            fetch('process_ad_earning.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `ad_id=${adId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Earning recorded:', data);
                    fetchTotalCoins();
                } else {
                    console.log('Error:', data.message);
                }
            })
            .catch(error => console.log('Error:', error));
        }
        
        // Show toast message
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = 'toast-message';
            toast.style.background = type === 'error' ? '#dc3545' : '#28a745';
            toast.innerHTML = `<i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i> ${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateWatchedAds();
            
            // Reset modal if closed manually
            document.getElementById('adModal').addEventListener('hidden.bs.modal', function() {
                if (timerInterval) {
                    clearInterval(timerInterval);
                }
                currentAdId = null;
            });
        });
    </script>
</body>
</html>