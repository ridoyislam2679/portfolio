<?php 
	require_once('../db/index.php');
	session_start();

	if (isset($_POST['admin_logIn'])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$stmt = $pdo->prepare("SELECT admin_id, admin_pass FROM admin_login WHERE admin_email = ?");
		$stmt->execute([$email]);
		$admin = $stmt->fetch();

		if ($admin && $pass == $admin['admin_pass']) {
			$_SESSION['admin_id'] = $admin['admin_id'];
			header('Location: dashboard.php');
			exit();
		} else {
			$error = "<h3 style='color: red; text-align:center;'>Invalid username or password</h3>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Gold Save World</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #224abe;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #000;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        
        .login-card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
        
        .card-header h4 {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .card-body {
            padding: 2rem;
            background-color: white;
            border-radius: 0 0 0.5rem 0.5rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.35rem;
            margin-bottom: 1.25rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            width: 100%;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--secondary-color);
        }
        
        .input-group-text {
            background-color: #f8f9fc;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group .form-control:focus {
            box-shadow: none;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 1.5rem;
        }
        
        .forgot-password a {
            color: #6e707e;
            font-size: 0.875rem;
        }
        
        .footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6e707e;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">            
            <div class="login-card">
                <div class="card-header">
                    <h4><i class="fas fa-lock"></i> Admin Login</h4>
                </div>
                <div class="card-body">
                    <form id="loginForm" method="POST">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <!--
                        <div class="forgot-password">
                            <a href="forget.php"><i class="fas fa-question-circle"></i> Forgot Password?</a>
                        </div>
						-->
                        
                        <button type="submit" name="admin_logIn" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
					<?php
						if (!empty($error)) {
							echo $error;
						}
					?>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; 2025 Gold Save World. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>