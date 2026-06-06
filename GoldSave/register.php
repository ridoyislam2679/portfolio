<?php
	session_start();
	if(isset($_POST['registerBtn'])){
		$_SESSION['number'] = $_POST['mobile'];
		
		 if (empty($_POST['mobile'])) {
			$error = "Number field required";
		} else {
			header('location:createAccount.php');
		}
	}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
	<link rel="manifest" href="manifest.json">
	<meta name="theme-color" content="#FFD700">
	
    <title>Login - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS (optional, for some components) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Common CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/login.css">
    
</head>
<body>
    <div class="main-content">
        <!-- Header - Same as home page -->
        <div class="top-actions">
            <div class="logo-area">
                <a href="index.php" style="text-decoration: none;">
                    <span class="logo">
                        <img src="logo/3532A.png" alt="Logo">
                    </span>
                </a>
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
		
		<!-- 👇 এখানে বসাও -->
		<div id="installPopup">
			<p>📲 ভালো experience এর জন্য App install করুন </p>
			<button type="button" onclick="installApp()"  class="btn btn-primary" >Install Now</button>
		</div>
        
        <!-- Login Form -->
        <div class="form-container">
            <!-- Image above form -->
            <div class="form-image">
                <div class="form-image-icon">
                    <image src="Image/user.png" class="login-image">
                </div>
            </div>
            
            <h2 class="form-title">Register Your Account</h2>
            
            <!-- Error message container (for PHP integration) -->
            <div id="errorMessage" class="error-message"></div>
				<?php if (isset($error)) echo $error; ?>
            <!-- Success message container -->
            <div id="successMessage" class="success-message"></div>
            
            <!-- Login Form - PHP Ready -->
            <form id="loginForm" method="POST" action="" autocomplete="off">
                <div class="form-group">
                    <label for="mobile">
                        <i class="fas fa-phone-alt"></i> Mobile Number
                    </label>
                    <div class="phone-input">
                        <input type="tel" 
                               name="mobile" 
                               id="mobile" 
                               class="form-control phone-number" 
                               placeholder="1234567890"
                               title="Please enter 10 digit mobile number"
                               autocomplete="off"
                               required>
                    </div>
                </div>
                
                <!-- Login Link -->
                <div class="forgot-link">
                    <a href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Login Account
                    </a>
                </div>
                
                <button type="submit" name="registerBtn" class="btn-submit" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Register
                </button>
            </form>
			
			<?php 
			/*
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$number = $_POST['mobile'];
					
					if(empty($number)){
						echo "Invalid Number!";
						exit();
					}
					
					 // convert to 880 format
					if (substr($number, 0, 1) == "0") {
						$number = "88" . $number;
					}
					
					$stmt = $pdo->prepare("SELECT user_id FROM user WHERE number = ?");
					$stmt->execute([$number]);

					if ($stmt->fetch()) {
						echo "User already exists";
					} 
					else {
						function sms_send() {
							$url = "http://bulksmsbd.net/api/smsapi";
							$api_key = "r5QVyJ4lLsabS9stA9fw";
							$senderid = "8809617611008";
							$number = "8801656289641,8801956843515";
							$message = "test sms check";
						 
							$data = [
								"api_key" => $api_key,
								"senderid" => $senderid,
								"number" => $number,
								"message" => $message
							];
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							$response = curl_exec($ch);
							curl_close($ch);
							return $response;
						}
					}
					
				}
			*/
				
			?>
			
        </div>
        
        <!-- Hidden input for CSRF token (for PHP security) -->
        <input type="hidden" id="csrf_token" value="">		
    </div>
    
    <!-- Bootstrap JS (minimal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		let deferredPrompt;

		window.addEventListener('beforeinstallprompt', (e) => {
			e.preventDefault();
			deferredPrompt = e;

			document.getElementById('installPopup').style.display = 'block';
		});

		function installApp() {
			if (!deferredPrompt) return;

			deferredPrompt.prompt();

			deferredPrompt.userChoice.then((choiceResult) => {
				deferredPrompt = null;
				document.getElementById('installPopup').style.display = 'none';
			});
		}
		
	</script>
    
</body>
</html>