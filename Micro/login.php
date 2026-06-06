<?php
require 'db/index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
	
    if ($user && $password === $user['password']) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: user/dashboard.php');
        exit();
    } else {
        $error = "<h2 style='color: red; text-align:center;'>Invalid username or password</h2>";
    }	
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Please Loging Your Account</title>
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
					<?php if (isset($error)) echo $error; ?>
					<div class="right-section">
					<div class="d-flex justify-content-between mb-3">
						<a href="register.php" class="btn btn-outline-primary btn-sm">Sign Up</a>
						<a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
					</div>
					<h5 class="mb-3">Login Form</h5>
					<form method="POST">
						<div class="mb-3">
						<label>Email</label>
						<input type="email" class="form-control" name="email" autocomplete="off" autofocus="on" required>
						</div>
						<div class="mb-3">
						<label>Password</label>
						<input type="password" class="form-control" name="password" autocomplete="off" required>
						</div>
						<button class="btn btn-primary w-100 coustom-login-btn">Login</button>
					</form>
					<div class="mt-3 text-center">
						<a href="register.php">Create a new account</a> | 
						<a href="forget.php">Forgot Password?</a>
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
				<div class="col-md-4">
					<div class="info-box">
						<img src="assets/rit-coin-chart.png" alt="referral">
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
			Contuct us Refonexxcore@gmail.com
		</div>
	</body>
</html>
