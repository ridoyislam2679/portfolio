<?php 
	require 'db/index.php';
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
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
		
		<div class="image-container">
			<image src="Image/login-Image.png" align="center">
		</div>
        
        <!-- Login Form -->
        <div class="form-container">
            <!-- Image above form -->
            <div class="form-image">
                <div class="form-image-icon">
                    <image src="Image/user.png" class="login-image">
                </div>
            </div>
            
            <h2 class="form-title">Find Your Account</h2>
            
            <!-- Error message container (for PHP integration) -->
            <div id="errorMessage" class="error-message"></div>
            
            <!-- Success message container -->
            <div id="successMessage" class="success-message"></div>
            
            <!-- Login Form - PHP Ready -->
            <form id="loginForm" method="POST"  autocomplete="off">
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
                               maxlength="11"
                               title="Please enter 11 digit mobile number"
                               autocomplete="off"
                               required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="userId">
                        <i class="fas fa-lock"></i> User Id
                    </label>
                    <input type="text" 
                           name="userId" 
                           id="userId" 
                           class="form-control" 
                           placeholder="Enter your user Id"
                           autocomplete="off"
                           required>
                </div>
				
				<div class="form-group">
                    <label for="newPass">
                        <i class="fas fa-lock"></i> New Password
                    </label>
                    <input type="text" 
                           name="new_pass" 
                           id="newPass" 
                           class="form-control" 
                           placeholder="Enter your new password"
                           autocomplete="off"
                           required>
                </div>
				
				<div class="form-group">
                    <label for="cnf_pass">
                        <i class="fas fa-lock"></i> New Password
                    </label>
                    <input type="text" 
                           name="cnf_pass" 
                           id="cnf_pass" 
                           class="form-control" 
                           placeholder="Enter your new confirm password"
                           autocomplete="off"
                           required>
                </div>
                
                <!-- Login Link -->
                <div class="forgot-link">
                    <a href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Login Account
                    </a>
                </div>
                
                <button type="submit" class="btn-submit" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Submit
                </button>
            </form>
			
			<?php 
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$userId   = $_POST['userId'] ?? '';
					$mobile   = $_POST['mobile'] ?? '';
					$new_pass = $_POST['new_pass'] ?? '';
					$cnf_pass = $_POST['cnf_pass'] ?? '';

					if (empty($mobile) || empty($userId) || empty($new_pass) || empty($cnf_pass)) {
						die("All fields are required");
					}

					$stmt = $pdo->prepare("SELECT user_id FROM user WHERE number = ? AND userId = ?");
					$stmt->execute([$mobile, $userId]);
					$user = $stmt->fetch();

					if (!$user) {
						die("Invalid user");
					}

					if ($new_pass !== $cnf_pass) {
						die("Password not match");
					}

					$hashed = password_hash($new_pass, PASSWORD_DEFAULT);

					$stmt = $pdo->prepare("UPDATE user SET pass = ? WHERE user_id = ?");
					$stmt->execute([$hashed, $user['user_id']]);

					if ($stmt->rowCount() > 0) {
						echo '<span id="copyMsg" style="color: red;">Password updated successfully</span>';
					} else {
						echo '<span id="copyMsg" style="color: red;">No change made</span>';
					}
				}

			?>
            
            <!-- Register Link -->
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Create Account</a></p>
            </div>
        </div>
        
        <!-- Hidden input for CSRF token (for PHP security) -->
        <input type="hidden" id="csrf_token" value="">
    </div>
    
    <!-- Bootstrap JS (minimal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>