<?php 
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
	
	session_start();

	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}
	$user_id = $_SESSION['user_id'];
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT total_earning, total_coin FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();
	
?>
	<div class="container my-4 mb-0 pb-4">
		<!-- Header Section -->
        <div class="ads-header">
            <h1>Earn From Ads</h1>
            <p>Watch ads and earn money</p>
        </div>
        
        <!-- Earnings Stats -->
        <div class="earnings-card">
            <h3>Your Earnings</h3>
            <div class="earnings-stats">
                <div class="stat-item total-earning">
                    <div class="label">Total Earnings</div>
                    <div class="value" id="totalEarnings"><?php echo $blance['total_earning'];?> TK</div>
                </div>
                <div class="stat-item today-earning">
                    <div class="label">Main Blance</div>
                    <div class="value" id="todayEarnings"><?php echo $blance['total_coin'];?> Coin</div>
                </div>
            </div>
        </div>
	
	<!-- ADS START -->
		<div class="row">
		<!-- One Ad Example -->
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script> (function(){     let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK");     eval(code); })(); </script>
					<button class="btn btn-primary watch-btn" id="ad1-btn" onclick="watchAd('ad1')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Banner Ad - Offer</h5>
					<p>Earn 1 Coin</p>
					<script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
					<button class="btn btn-primary watch-btn" id="ad2-btn" onclick="watchAd('ad2')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script>(s=>{s.dataset.zone='9507279',s.src='https://al5sm.com/tag.min.js'})([document.documentElement, document.body].filter(Boolean).pop().appendChild(document.createElement('script')))</script>
					<button class="btn btn-primary watch-btn" id="ad3-btn" onclick="watchAd('ad3')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script> (function(){     let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK");     eval(code); })(); </script>
					<button class="btn btn-primary watch-btn" id="ad4-btn" onclick="watchAd('ad4')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
				<h5>Native Ad - Product Review</h5>
				<p>Earn 1 Coin</p>
				<script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
				<button class="btn btn-primary watch-btn" id="ad5-btn" onclick="watchAd('ad5')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script> (function(){     let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK");     eval(code); })(); </script>
					<button class="btn btn-primary watch-btn" id="ad6-btn" onclick="watchAd('ad6')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script> (function(){     let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK");     eval(code); })(); </script>
					<button class="btn btn-primary watch-btn" id="ad7-btn" onclick="watchAd('ad7')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
				<h5>Native Ad - Product Review</h5>
				<p>Earn 1 Coin</p>
				<script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
				<button class="btn btn-primary watch-btn" id="ad8-btn" onclick="watchAd('ad8')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
					<h5>Native Ad - Product Review</h5>
					<p>Earn 1 Coin</p>
					<script> (function(){     let code = atob("KGZ1bmN0aW9uKGQseixzKXsKICBzLnNyYz0naHR0cHM6Ly8nK2QrJy80MDEvJyt6OwogIHRyeXsoZG9jdW1lbnQuYm9keXx8ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50KS5hcHBlbmRDaGlsZChzKX0KICBjYXRjaChlKXt9Cn0pKCdncm9sZWVnbmkubmV0Jyw5NTA3MjkxLGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpKTsK");     eval(code); })(); </script>
					<button class="btn btn-primary watch-btn" id="ad9-btn" onclick="watchAd('ad9')">Watch Ad</button>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="ads-card text-center">
				<h5>Native Ad - Product Review</h5>
				<p>Earn 1 Coin</p>
				<script src="https://shoukigaigoors.net/act/files/tag.min.js?z=9507284" data-cfasync="false" async></script>
				<form action="https://otieu.com/4/9507294" target="_blank">
					<button class="btn btn-primary watch-btn" id="ad10-btn" onclick="watchAd('ad10')">Watch Ad</button>
				</form>
				</div>
			</div>
		
		<!-- Add more ads like ad2, ad3... with different IDs -->
		</div>
	<!-- ADS END -->
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="adModal" tabindex="-1" aria-labelledby="adModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content text-center">
			<div class="modal-header">
				<h5 class="modal-title">Watching Ad...</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Propeller Ad is showing. Please wait <span id="timer">5</span> seconds...</p>
			</div>
			<div class="modal-footer">
				<form method="POST">
					<button name="earn_add_button" type="submit" id="okBtn" class="btn btn-success" data-bs-dismiss="modal" onclick="adCompleted()" disabled>Okay</button>
				</form>
				<?php
					if(isset($_POST['earn_add_button'])){
						$sql ="UPDATE blance SET total_coin = total_coin+1 WHERE user_id = ?";
						$update_blance = $pdo->prepare($sql);
						$update_blance->execute([$user_id]);
						
						header("Location: ".$_SERVER['PHP_SELF']);							
						exit();							
					}
				?>
			</div>
			</div>
		</div>
	</div>
	<?php 
		ob_end_flush();
		include_once('footer.php'); 
	?>