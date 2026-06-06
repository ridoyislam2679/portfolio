<?php
session_start();
require 'db/index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mobile = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($mobile) || empty($password)) {
        $error = "All fields are required";
    } else {

        $stmt = $pdo->prepare("
            SELECT user_id, userId, pass, status 
            FROM user 
            WHERE number = ?
        ");
        $stmt->execute([$mobile]);
        $user = $stmt->fetch();

        if ($user) {
            if (!password_verify($password, $user['pass'])) {
                $error = "Invalid username or password";
            }
            elseif ($user['status'] !== 'active') {
                $error = "Your account is deactivated. Please contact support.";
            }
            else {
                $_SESSION['id_number'] = $user['user_id'];
                $_SESSION['userId'] = $user['userId'];
                $_SESSION['last_activity'] = time();

                header('Location: home.php');
                exit();
            }

        } else {
            $error = "Invalid username or password";
        }
    }
}

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
            
            <h2 class="form-title">Welcome Back!</h2>
            
            <!-- Error message container (for PHP integration) -->
            <div id="errorMessage" class="error-message">
				<?php if (isset($error)) echo $error; ?>
			</div>
            
            <!-- Success message container -->
            <div id="successMessage" class="success-message">
				
			</div>
            
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
                               placeholder="01234567890"
                               maxlength="11"
                               title="Please enter 11 digit mobile number"
                               autocomplete="off"
                               required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Enter your password"
                           autocomplete="off"
                           required>
                </div>
                
                <!-- Forgot Password Link -->
                <div class="forgot-link">
                    <a href="forgot_password.php">
                        <i class="fas fa-key"></i> Forgot Password?
                    </a>
                </div>
                
                <button name ="logingBtn" type="submit" class="btn-submit" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
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