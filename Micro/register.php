<?php
require 'db/index.php';
session_start();
session_unset();
session_destroy();
session_start();
session_regenerate_id(true);

// Handle referral from URL (only once)
if (isset($_GET['ref'])) {
    $_SESSION['referral_code'] = $_GET['ref'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $referral_code = generateReferralCode();
	
    $referred_by = isset($_GET['ref']) ? $_GET['ref'] : null;
	$referred_by_code = $_GET['ref'] ?? null;
    //$referred_by = null;
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<h1 style='color: red; text-align:center;'>Invalid Email format</h1>");
    }

    $domain = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($domain, "MX")) {
        die("Fake or non-existent email domain.");
    }
	
	if ($referred_by_code) {
		$stmt = $pdo->prepare("SELECT id FROM users WHERE referral_code = ?");
		$stmt->execute([$referred_by_code]);
		$referrer = $stmt->fetch();

		if ($referrer) {
			$referred_by = $referrer['id']; // valid user_id
		}
	}

    try {
        // Start transaction
        $pdo->beginTransaction();

        // Insert new user
		$sql = "INSERT INTO users (username, email, password, referral_code, referred_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password, $referral_code, $referred_by]);
        $user_id = $pdo->lastInsertId();
		
		// Insert new user Blance
		$insertBlance = "INSERT INTO blance (user_id) VALUES (?)";
        $newBlance = $pdo->prepare($insertBlance);
        $newBlance->execute([$user_id]);
		
        // If registered through referral link
        if ($referred_by) {
            // Add referral record
			$referral = "INSERT INTO referrals (referrer_id, referred_id) VALUES (?, ?)";
            $referral_prepare = $pdo->prepare($referral);
            $referral_prepare->execute([$referred_by, $user_id]);

            // reward to referrer user (example: update their balance)
			$reward = "UPDATE blance SET total_coin = total_coin + 0 WHERE user_id = ?";
			$reward_prepare = $pdo->prepare($reward);
            $reward_prepare->execute([$referred_by]);
        }

        $pdo->commit();
        
        // Start session and redirect
        //session_start();
        $_SESSION['user_id'] = $user_id;
        unset($_SESSION['referral_code']);
        header('Location: user/dashboard.php');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>please register your acconut</title>
	  <link rel="stylesheet" href="style.css">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="container py-5">
			<div class="row justify-content-between">
				<div class="col-md-6">
					<img src="assets/action-logo.jpeg" class="action-logo">
					<div class="summary">
					আপনার বিশ্বস্ত মাইক্রো আর্নিং পার্টনার। প্রতিদিন কাজ করুন, ইনকাম করুন এবং টাকা উত্তোলন করুন। সহজ ইন্টারফেস এবং বিশ্বস্ত পেমেন্ট সিস্টেম।
					</div>
					<div class="buttons mt-4">
				    	<a href="https://wa.me/8801975801480" target="_blank">Helpline on WhatsApp. </a>
				    	<a href="https://www.facebook.com/profile.php?id=61577766716838" target="_blank">Facebook Page</a>
					    <a href="https://t.me/Refonexxofficial" target="_blank">official group</a>
					</div> 
				</div>
				<div class="col-md-5">
				<?php if (isset($error)) echo "<p style='color: red; text-align:center; margin-top: 30px;'>$error</p>"; ?>
					<div class="right-section">
					<div class="d-flex justify-content-between mb-3">
						<a href="register.php" class="btn btn-outline-primary btn-sm">Sign Up</a>
						<a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
					</div>
					<h5 class="mb-3">Register Form</h5>
					<form method="POST">
						<div class="mb-3">
							<label>Username</label>
							<input type="text" class="form-control" name="username" autocomplete="off" autofocus="on" required>
						</div>
						<div class="mb-3">
							<label>Email</label>
							<input type="email" class="form-control" name="email" autocomplete="off" required>
						</div>
						<div class="mb-3">
							<label>Password</label>
							<input type="password" class="form-control" name="password" autocomplete="off" required>
						</div>
						<button class="btn btn-primary w-100" name="register_btn">Register</button>
					</form>
					<div class="mt-3 text-center">
						<a href="login.php">Log-In Your account</a>
					</div>
					</div>
				</div>
			</div>
	
			<div class="row text-center mt-5">
				<div class="col-md-4">
					<div class="info-box">
						<img src="assets/daily.jpeg" alt="daily">
					</div>
				</div>
				<div class="col-md-4">
					<div class="info-box">
						<img src="assets/refer.jpeg" alt="referral">
					</div>
				</div>
			</div>
		</div>
	
		<footer class="bg-primary py-4 mt-5">
			<div class="container text-center">
				<div class="footer-links mb-2">
					<a href="login.php">Home</a>
					<a href="privacy_policy.php">Privacy Policy</a>
					<a href="about.php">About Us</a>
				</div>
			</div>
		</footer>
		<div class="footer-copy">
			Contact us Refonexxcore@gmail.com
		</div>
	</body>
</html>
