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
	
	$stmt = $pdo->prepare("SELECT total_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Free Earning - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/freeEarning.css">
	
	<script>(function(s){s.dataset.zone='10894311',s.src='https://al5sm.com/tag.min.js'})([document.documentElement, document.body].filter(Boolean).pop().appendChild(document.createElement('script')))</script>
	
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
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
            <p>প্রতিটি বিজ্ঞাপন দেখে ১ ডায়মন্ড আয় করুন</p>
        </div>
        
        <!-- Earnings Stats -->
        <div class="earnings-card">
            <h3><i class="fas fa-chart-line"></i> আপনার আয়</h3>
            <div class="earnings-stats">
                <div class="stat-item">
                    <div class="label">মোট টাকা</div>
                    <div class="value" id="totalMoney"><?php echo $balance['total_balance']?? 0; ?> TK</div>
                </div>
                <div class="stat-item">
                    <div class="label">মোট ডায়মন্ড</div>
                    <div class="value" id="totalCoins"><?php echo $balance['coin_balance']?? 0; ?> Coin</div>
                </div>
            </div>
        </div>
        
        <!-- Daily Limit Card -->
        <div class="daily-limit-card">
            <div class="limit-info">
                <i class="fas fa-calendar-day"></i>
                <div>
                    <div class="limit-text">আজকের বাকি বিজ্ঞাপন</div>
                    <div class="limit-warning">প্রতিদিন সর্বোচ্চ ৩০টি দেখতে পাবেন</div>
                </div>
            </div>
            <div class="limit-count" id="remainingAds">30 / 30</div>
        </div>
        
        <!-- ADS SECTION -->
        <div class="ads-grid" id="adsGrid">
            <?php for($i = 1; $i <= 30; $i++): ?>
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">বিজ্ঞাপন <?php echo $i; ?></div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ ডায়মন্ড</div>
                <button class="watch-ad-btn" data-ad-id="<?php echo $i; ?>">
                    <i class="fas fa-eye"></i> দেখুন
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
                    <div class="timer-display" id="timer">5</div>
                    <p class="mt-2" style="font-size: 12px;">সেকেন্ড বাকি</p>
                </div>
				<form method="POST">
					<div class="modal-footer">
						<button id="okBtn" type="submit" class="btn btn-success" disabled>সম্পন্ন হয়েছে</button>
					</div>
				</form>
				<?php
					if($_SERVER['REQUEST_METHOD'] === 'POST'){
						$sql ="UPDATE balance SET coin_balance = coin_balance+1 WHERE user_id = ?";
						$update_blance = $pdo->prepare($sql);
						$update_blance->execute([$id]);
						
						header("Location: ".$_SERVER['PHP_SELF']);							
						exit();							
					}
				?>
            </div>
        </div>
    </div>
    
    <!-- Bottom Navigation -->
    <?php include_once("bottom.php"); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Get today's date string
        function getTodayKey(adId) {
            const today = new Date().toISOString().split('T')[0];
            return 'watched_ad_' + adId + '_' + today;
        }
        
        // Get watched count
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
        
        // Update remaining ads display
        function updateRemainingAds() {
            const watched = getWatchedCount();
            const remaining = 30 - watched;
            const remainingSpan = document.getElementById('remainingAds');
            if (remainingSpan) {
                remainingSpan.innerHTML = remaining + ' / 30';
            }
        }
        
        // Disable already watched ads
        function disableWatchedAds() {
            for (let i = 1; i <= 30; i++) {
                const key = getTodayKey(i);
                const btn = document.querySelector('.watch-ad-btn[data-ad-id="' + i + '"]');
                if (btn && localStorage.getItem(key) === 'watched') {
                    btn.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                    btn.disabled = true;
                    btn.style.background = 'rgba(255, 255, 255, 0.1)';
                    btn.style.color = 'rgba(255, 255, 255, 0.3)';
                }
            }
            updateRemainingAds();
        }
        
        // Update coins display via AJAX
		/*
        function updateCoinsDisplay() {
            fetch('get_user_coins.php')
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.success) {
                        document.getElementById('totalCoins').innerHTML = parseFloat(data.coins).toFixed(2) + ' Coin';
                        document.getElementById('totalMoney').innerHTML = parseFloat(data.balance).toFixed(2) + ' TK';
                    }
                })
                .catch(function(error) {
                    console.log('Error fetching coins:', error);
                });
        }
        
        // Add coin to user
        function addCoin(adId) {
            fetch('process_ad_earning.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'ad_id=' + adId
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    updateCoinsDisplay();
                }
            })
            .catch(function(error) {
                console.log('Error:', error);
            });
        }
		*/
        
        // Global variables
        let currentAdId = null;
        let timerInterval = null;
        let adModal = null;
        
        // Watch ad function
        function watchAd(adId, btnElement) {
            const key = getTodayKey(adId);
            
            if (localStorage.getItem(key) === 'watched') {
                alert('আপনি আজ এই বিজ্ঞাপনটি ইতিমধ্যে দেখেছেন!');
                return;
            }
            
            const watchedCount = getWatchedCount();
            if (watchedCount >= 30) {
                alert('আপনি আজকের সর্বোচ্চ ৩০টি বিজ্ঞাপন দেখে ফেলেছেন! আগামীকাল আবার চেষ্টা করুন।');
                return;
            }
            
            currentAdId = adId;
            let seconds = 5;
            const timerElement = document.getElementById('timer');
            const okBtn = document.getElementById('okBtn');
            
            timerElement.innerText = seconds;
            okBtn.disabled = true;
            
            if (!adModal) {
                adModal = new bootstrap.Modal(document.getElementById('adModal'));
            }
            adModal.show();
            
            if (timerInterval) clearInterval(timerInterval);
            timerInterval = setInterval(function() {
                seconds--;
                timerElement.innerText = seconds;
                if (seconds <= 0) {
                    clearInterval(timerInterval);
                    okBtn.disabled = false;
                }
            }, 1000);
            
            // Store ok button click handler
            okBtn.onclick = function() {
                if (currentAdId) {
                    const key = getTodayKey(currentAdId);
                    localStorage.setItem(key, 'watched');
                    
                    const btn = document.querySelector('.watch-ad-btn[data-ad-id="' + currentAdId + '"]');
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                        btn.disabled = true;
                        btn.style.background = 'rgba(255, 255, 255, 0.1)';
                        btn.style.color = 'rgba(255, 255, 255, 0.3)';
                    }
                    
                    // Add coin to database
                    addCoin(currentAdId);
                    
                    updateRemainingAds();
                    
                    if (adModal) {
                        adModal.hide();
                    }
                    
                    alert('অভিনন্দন! আপনি ১ ডায়মন্ড পেয়েছেন!');
                }
                
                currentAdId = null;
                if (timerInterval) clearInterval(timerInterval);
            };
        }
        
        // Add event listeners to all watch buttons
        function initButtons() {
            const buttons = document.querySelectorAll('.watch-ad-btn');
            for (let i = 0; i < buttons.length; i++) {
                const btn = buttons[i];
                const adId = btn.getAttribute('data-ad-id');
                btn.onclick = function(e) {
                    e.preventDefault();
                    watchAd(adId, btn);
                };
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initButtons();
            disableWatchedAds();
            
            // Reset modal on close
            const modalElement = document.getElementById('adModal');
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (timerInterval) {
                    clearInterval(timerInterval);
                }
                currentAdId = null;
            });
        });
    </script>
</body>
</html>