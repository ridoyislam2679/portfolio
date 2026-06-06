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
	
	$stmt = $pdo->prepare("SELECT bonus_coin FROM bonus_coin WHERE date = CURDATE() LIMIT 1");
	$stmt->execute();
	$bonus_coin = $stmt->fetch();
	
	$bonusStatus = "";
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$stmt = $pdo->prepare("SELECT bonus_id FROM bonus WHERE user_id = ? AND DATE(bonus_date) = CURDATE()");
		$stmt->execute([$id]);
		$collect_coin = $stmt->fetch();
		
		if ($collect_coin){
			$bonusStatus = "already";
		} else {

			$bonus_amount = $bonus_coin['bonus_coin'] ?? 0;

			$pdo->beginTransaction();

			try {
				// balance update
				$stmt = $pdo->prepare("UPDATE balance SET coin_balance = coin_balance + ? WHERE user_id = ?");
				$stmt->execute([$bonus_amount, $id]);

				// claim insert
				$stmt = $pdo->prepare("INSERT INTO bonus (user_id, bonus_amount, bonus_date) VALUES (?, ?, NOW())");
				$stmt->execute([$id, $bonus_amount]);

				$pdo->commit();
				
				$bonusStatus = "success";

				header("Location: ".$_SERVER['PHP_SELF']);
				exit();

			} catch (Exception $e) {
				$pdo->rollBack();
				echo "Error!";
			}
		}
	}
	
	/*
	if(isset($_POST['boxBtn'])){
		
		$stmt = $pdo->prepare("SELECT bonus_id FROM bonus WHERE user_id = ? AND DATE(bonus_date) = CURDATE()");
		$stmt->execute([$id]);
		$collect_coin = $stmt->fetch();
		
		if ($collect_coin){
			echo "<h2 style='color:red;'> আপনি ইতিমধ্যে আজকের বোনাস নিয়ে নিয়েছেন! আগামীকাল আবার আসুন। </h2>";
		}else{
			$sql ="UPDATE balance SET coin_balance = coin_balance + ? WHERE user_id = ?";
			$update_blance = $pdo->prepare($sql);
			$update_blance->execute([$bonus_coin, $id]);
			header("Location: ".$_SERVER['PHP_SELF']);
		}
	}
	*/
	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Daily Bonus - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="CSS/bonus.css">
	<link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                <i class="fas fa-gift"></i> Daily Bonus
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Header Section -->
        <div class="bonus-header">
            <p>প্রতিদিন বক্স খুলে বোনাস নিন</p>
        </div>
		
		<!-- Coin Balance Card -->
        <div class="coin-balance-card">
            <div class="coin-icon">
                <i class="fas fa-coins"></i>
            </div>
            <div class="coin-balance-label">আপনার মোট ডায়মন্ড</div>
            <div class="coin-balance-amount" id="userCoins"><?php echo $balance['coin_balance']?? 0; ?></div>
            <div class="coin-rate">
                <i class="fas fa-exchange-alt"></i> 1 Diamond = ৳ 1
            </div>
        </div>
		
		
        <!-- Message Card -->
        <div id="messageCard" class="message-card"></div>
        
        <!-- Bonus Box Card -->
        <div class="bonus-box-card">
            <div class="gift-box" id="giftBox">
                <div class="box-lid"></div>
                <div class="box-body">
                    <div class="box-ribbon-horizontal"></div>
                    <div class="box-ribbon-vertical"></div>
                    <i class="fas fa-gift box-icon"></i>
                </div>
            </div>
			<div class="gift-box <?php if($opened) echo 'open'; ?>">
            
            <div class="bonus-info">
                <div class="bonus-amount" id="bonusAmount"><?php //echo $bonus_coin['bonus_coin'] ?? 0; ?> ? ডায়মন্ড</div>
                <div class="bonus-label">আজকের বোনাস</div>
            </div>
			
			<form method="POST" onsubmit="return handleBonus(event)">
				<button class="collect-btn" id="collectBtn" name="boxBtn">
					<i class="fas fa-hand-holding-heart"></i> বক্স খুলুন
				</button>
			</form>
        </div>
        
    </div>
	
    <?php include_once('bottom.php'); ?>
	
	<script>
	const giftBox = document.getElementById('giftBox');
	const collectBtn = document.getElementById('collectBtn');

	// Form submit handle
	function handleBonus(e) {
		e.preventDefault(); // form stop

		// animation start
		giftBox.classList.add('open');
		collectBtn.disabled = true;

		// 500ms পরে form submit (PHP run হবে)
		setTimeout(() => {
			e.target.submit();
		}, 500);

		return false;
	}
	
	let bonusStatus = "<?php echo $bonusStatus; ?>";
	let bonusAmount = "<?php echo $bonus_coin['bonus_coin'] ?? 0; ?>";
	
	const messageCard = document.getElementById('messageCard');

	function showMessage(text, isError = false) {
		messageCard.className = 'message-card show';
		messageCard.innerHTML = text;

		setTimeout(() => {
			messageCard.classList.remove('show');
		}, 3000);
	}

	// page load হলে check করো
	if (bonusStatus === "success") {
		showMessage("অভিনন্দন! আপনি " + bonusAmount + " ডায়মন্ড পেয়েছেন 🎉");
		collectBtn.disabled = true;
		collectBtn.innerHTML = "✔ নেওয়া হয়েছে";
	}

	if (bonusStatus === "already") {
		showMessage("আপনি আজকের বোনাস ইতিমধ্যে নিয়েছেন", true);
		collectBtn.disabled = true;
	}

	if (bonusStatus === "error") {
		showMessage("কিছু ভুল হয়েছে!", true);
	}
	
	</script>
 
</body>
</html>