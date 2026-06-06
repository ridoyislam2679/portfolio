<?php 
	require_once('../db/index.php');
	session_start();

	if (isset($_POST['forget_btn'])) {
		$email = $_POST['email'];
		$admin = $_POST['admin'];
		$new_pass = $_POST['pass'];

		$stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_name = ? AND admin_email = ?");
		$stmt->execute([$admin, $email]);
		$admin = $stmt->fetch();
		
		if ($admin) {
			$admin_id = $admin['admin_id'];
			
			$stmt = $pdo->prepare("UPDATE admin SET admin_pass = ? WHERE admin_id = ? AND admin_email = ?");
			$stmt->execute([$new_pass, $admin_id, $email]);
			$msg = "Password has been reset successfully.";
		} else {
			$error = "No user found with given Email and User ID.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Micro Earning</title>
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
            background-color: #37456d;
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
                            <input type="user" name="admin" class="form-control" placeholder="admin name..." required>
                        </div>
						<div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address..." required>
                        </div>
						<div class="input-group mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="New password..." required>
                        </div>
						<div class="forgot-password">
                            <a href="login.php"><i class="fas fa-question-circle"></i> Loging Account</a>
                        </div>
                        <button type="submit" name="forget_btn" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt"></i> Update
                        </button>
                    </form>
					<?php
						if (!empty($msg)) {
							echo "<p style='color:red;text-align:center;'>$msg</p>";
						}
						if (!empty($error)) {
							echo "<p style='color:red;text-align:center;'>$error</p>";
						}
					?>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; 2025 Micro Earning. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>