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
    <link rel="stylesheet" href="CSS/freeEraning.css"> 
	
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="index.html" class="back-btn">
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
                    <div class="label">মোট টাকা</div>
                    <div class="value" id="totalMoney">7,550 TK</div>
                </div>
                <div class="stat-item">
                    <div class="label">মোট কয়েন</div>
                    <div class="value" id="totalCoins">50 Coin</div>
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
        
        <!-- ADS SECTION - Redesigned -->
        <div class="ads-grid" id="adsGrid">
            <!-- Ad 1 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">ভিডিও বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad1-btn" onclick="watchAd('ad1')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <!-- Ad Script -->
                <script> (function(){ let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK"); eval(code); })(); </script>
            </div>
            
            <!-- Ad 2 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-ad"></i>
                </div>
                <div class="ad-title">ব্যানার বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad2-btn" onclick="watchAd('ad2')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
            </div>
            
            <!-- Ad 3 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">নেটিভ বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad3-btn" onclick="watchAd('ad3')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script>(s=>{s.dataset.zone='9507279',s.src='https://al5sm.com/tag.min.js'})([document.documentElement, document.body].filter(Boolean).pop().appendChild(document.createElement('script')))</script>
            </div>
            
            <!-- Ad 4 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">প্রোডাক্ট রিভিউ</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad4-btn" onclick="watchAd('ad4')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script> (function(){ let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdWlbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK"); eval(code); })(); </script>
            </div>
            
            <!-- Ad 5 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-ad"></i>
                </div>
                <div class="ad-title">অফার বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad5-btn" onclick="watchAd('ad5')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
            </div>
            
            <!-- Ad 6 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">ভিডিও বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad6-btn" onclick="watchAd('ad6')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script> (function(){ let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK"); eval(code); })(); </script>
            </div>
            
            <!-- Ad 7 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">নেটিভ বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad7-btn" onclick="watchAd('ad7')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script> (function(){ let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK"); eval(code); })(); </script>
            </div>
            
            <!-- Ad 8 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-ad"></i>
                </div>
                <div class="ad-title">ব্যানার বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad8-btn" onclick="watchAd('ad8')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
            </div>
            
            <!-- Ad 9 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="ad-title">প্রোডাক্ট রিভিউ</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad9-btn" onclick="watchAd('ad9')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <script> (function(){ let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK"); eval(code); })(); </script>
            </div>
            
            <!-- Ad 10 -->
            <div class="ad-card">
                <div class="ad-icon">
                    <i class="fas fa-ad"></i>
                </div>
                <div class="ad-title">অফার বিজ্ঞাপন</div>
                <div class="ad-reward"><i class="fas fa-coins"></i> ১ কয়েন</div>
                <button class="watch-ad-btn" id="ad10-btn" onclick="watchAd('ad10')">
                    <i class="fas fa-eye"></i> দেখুন
                </button>
                <form action="https://otieu.com/4/9507294" target="_blank" style="display:none;"></form>
            </div>
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
                <div class="modal-footer">
                    <button id="okBtn" class="btn btn-success" disabled onclick="adCompleted()">
                        <i class="fas fa-check"></i> সম্পন্ন হয়েছে
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <?php include_once("bottom.php"); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let currentAdId = null;
        let timerInterval;
        
        // Get today's date string
        function getTodayKey(adId) {
            const today = new Date().toISOString().split('T')[0];
            return `watched_${adId}_${today}`;
        }
        
        // Disable already watched ads
        function disableWatchedAds() {
            const ads = document.querySelectorAll('.watch-ad-btn');
            ads.forEach(ad => {
                const adId = ad.id.replace('-btn', '');
                const key = getTodayKey(adId);
                if (localStorage.getItem(key)) {
                    ad.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                    ad.disabled = true;
                    ad.style.background = 'rgba(255, 255, 255, 0.1)';
                    ad.style.color = 'rgba(255, 255, 255, 0.3)';
                }
            });
            
            // Update remaining ads count
            updateRemainingAds();
        }
        
        // Update remaining ads count
        function updateRemainingAds() {
            let watchedCount = 0;
            for (let i = 1; i <= 10; i++) {
                const key = getTodayKey(`ad${i}`);
                if (localStorage.getItem(key)) {
                    watchedCount++;
                }
            }
            const remaining = 30 - watchedCount;
            document.getElementById('remainingAds').innerHTML = `${remaining} / 30`;
        }
        
        // Watch ad function
        function watchAd(adId) {
            const key = getTodayKey(adId);
            
            if (localStorage.getItem(key)) {
                alert('আপনি আজ এই বিজ্ঞাপনটি ইতিমধ্যে দেখেছেন!');
                return;
            }
            
            currentAdId = adId;
            let seconds = 5;
            document.getElementById('timer').innerText = seconds;
            document.getElementById('okBtn').disabled = true;
            
            const adModal = new bootstrap.Modal(document.getElementById('adModal'));
            adModal.show();
            
            timerInterval = setInterval(() => {
                seconds--;
                document.getElementById('timer').innerText = seconds;
                if (seconds === 0) {
                    clearInterval(timerInterval);
                    document.getElementById('okBtn').disabled = false;
                }
            }, 1000);
        }
        
        // Ad completed function
        function adCompleted() {
            if (currentAdId) {
                const key = getTodayKey(currentAdId);
                localStorage.setItem(key, "watched");
                
                const btn = document.getElementById(currentAdId + '-btn');
                btn.innerHTML = '<i class="fas fa-check-circle"></i> দেখা হয়েছে';
                btn.disabled = true;
                btn.style.background = 'rgba(255, 255, 255, 0.1)';
                btn.style.color = 'rgba(255, 255, 255, 0.3)';
                
                // Update remaining ads
                updateRemainingAds();
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('adModal'));
                modal.hide();
                
                // Show success message
                alert('অভিনন্দন! আপনি ১ কয়েন পেয়েছেন!');
            }
        }
        
        // Initialize on page load
        document.addEventListener("DOMContentLoaded", function() {
            disableWatchedAds();
        });
    </script>
</body>
</html>