<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Gold Save World - Bangladesh's First Gold App</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>
    <div class="main-content">
        <!-- TOP: Login/Register Buttons - Phone e first e dekhabe -->
        <div class="top-actions">
            <div class="logo-area">
                <span class="logo"> 
                    <img src="logo/3532A.png" alt="Logo">
                </span>
            </div>
            <div class="btn-group-top">
                <a href="login.php" class="btn-top btn-login-top">
                    <i class="fas fa-sign-in-alt"></i> LOGIN
                </a>
                <a href="register.php" class="btn-top btn-register-top">
                    <i class="fas fa-user-plus"></i> REGISTER
                </a>
            </div>
        </div>
        
        <!-- Hero Number 96 
        <div class="hero-number">
            <div class="big-96">96</div>
        </div>
		-->
        
        <!-- SLIDER - Top e -->
        <div class="slider-wrapper">
            <div class="shape-card">
                <div class="slider-container">
                    <div class="slide active" data-index="0">
                        <div class="slide-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="slide-title">Real-time Gold Price</h3>
                        <p class="slide-desc">Track live gold prices and sell instantly at the best market rates</p>
                        <div class="slide-badge">
                            <span>₦ 7,850 /Gram</span>
                        </div>
                    </div>
                    
                    <div class="slide" data-index="1">
                        <div class="slide-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="slide-title">100% Secure</h3>
                        <p class="slide-desc">Your investments are safe with blockchain-secured platform</p>
                        <div class="slide-badge">
                            <span>Verified ✅</span>
                        </div>
                    </div>
                    
                    <div class="slide" data-index="2">
                        <div class="slide-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h3 class="slide-title">1 Gram = 1 Coin</h3>
                        <p class="slide-desc">Instant gold conversion. Sell anytime with zero hidden fees</p>
                        <div class="slide-badge">
                            <span>Instant Transfer</span>
                        </div>
                    </div>
                    
                    <div class="slide" data-index="3">
                        <div class="slide-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="slide-title">P2P Investment</h3>
                        <p class="slide-desc">Get daily returns with bonus coins up to 15 days</p>
                        <div class="slide-badge">
                            <span>Up to 10% Return</span>
                        </div>
                    </div>
                </div>
                
                <div class="slider-controls">
                    <button class="slider-nav-btn" id="prevSlide">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="slider-dots" id="sliderDots">
                        <span class="dot active" data-dot="0"></span>
                        <span class="dot" data-dot="1"></span>
                        <span class="dot" data-dot="2"></span>
                        <span class="dot" data-dot="3"></span>
                    </div>
                    <button class="slider-nav-btn" id="nextSlide">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Sell Gold Section -->
        <div class="sell-gold-section">
            <h2 class="sell-title">
                <span class="gold">SELL GOLD</span><br>
                ANYTIME, ANY AMOUNT
            </h2>
            
            <div class="emergency-badge">
                <i class="fas fa-clock"></i> 24 HOUR EMERGENCY
            </div>
            
            <button class="btn-get-started">
                <i class="fas fa-play-circle"></i> Get started with Gold Kinen
            </button>
        </div>
        
		
        <!-- Price Ticker -->
		
		<!-- 
        <div class="price-ticker">
            <div class="price-item">
                <span class="price-label">Gold Price:</span>
                <span class="price-value">₦ 7,850/g</span>
            </div>
            <div class="price-item">
                <span class="price-label">24h Low:</span>
                <span class="price-value">₦ 7,600</span>
            </div>
            <div class="price-item">
                <span class="price-label">24h High:</span>
                <span class="price-value">₦ 7,900</span>
            </div>
        </div>
		
		<!-- 
        
        <!-- Features Grid -->
        <div class="features-section">
            <h3 class="section-title">Why Choose Gold Kinen?</h3>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h4>Instant Sell</h4>
                    <p>Sell gold anytime</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-lock"></i>
                    <h4>Secure Platform</h4>
                    <p>Bank-level security</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-simple"></i>
                    <h4>Live Price</h4>
                    <p>Real-time gold rates</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-headset"></i>
                    <h4>24/7 Support</h4>
                    <p>Always here to help</p>
                </div>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>10K+</h3>
                    <p>Active Users</p>
                </div>
                <div class="stat-item">
                    <h3>₦50M+</h3>
                    <p>Transaction</p>
                </div>
                <div class="stat-item">
                    <h3>99.9%</h3>
                    <p>Satisfaction</p>
                </div>
            </div>
        </div>
        
        <!-- Report Button -->
        <a href="#" class="report-btn">
            <i class="fas fa-exclamation-triangle"></i>
            Report a Problem
        </a>
    </div>
    
    <!-- Bootstrap JS only for potential features -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Minimal JS only for slider -->
    <script src="JS/home.js"> </script>
</body>
</html>