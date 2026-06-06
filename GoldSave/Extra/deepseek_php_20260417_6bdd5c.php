<?php
session_start();
$number = $_SESSION['number'];

require 'db/index.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $gender   = trim($_POST['gender'] ?? '');

    // 🔴 Validation
    if (empty($username) || empty($email) || empty($password) || empty($gender)) {
        $error = "All fields are required";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } 
    elseif (!in_array($gender, ['male', 'female', 'other'])) {
        $error = "Invalid gender selection";
    }
    else {

        // 🔍 Check if user already exists
        $stmt = $pdo->prepare("SELECT user_id FROM user WHERE number = ? OR email = ?");
        $stmt->execute([$number, $email]);

        if ($stmt->fetch()) {
            $error = "User already exists";
        } 
        else {

            // 🔐 Password Hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 💾 Insert User with gender
            $stmt = $pdo->prepare("INSERT INTO user (user_name, email, number, pass, gender) VALUES (?, ?, ?, ?, ?)");
            $successInsert = $stmt->execute([$username, $email, $number, $hashedPassword, $gender]);

            if ($successInsert) {
                $success = "Registration successful! Please login.";
                // Clear form data after success (optional)
                // header("refresh:2; url=login.html");
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Register - Gold Kinen</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #0a0a1a 0%, #0f0f2a 50%, #1a1a3e 100%);
            min-height: 100vh;
            color: #fff;
        }
        
        .main-content {
            max-width: 500px;
            margin: 0 auto;
        }
        
        /* Top Actions */
        .top-actions {
            padding: 16px 16px 8px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }
        
        .logo-area {
            flex-shrink: 0;
        }
        
        .logo {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }
        
        .logo i {
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
            color: #FFD700;
            font-size: 1.2rem;
        }
        
        .btn-group-top {
            display: flex;
            gap: 8px;
        }
        
        .btn-top {
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            border: none;
            cursor: pointer;
        }
        
        .btn-login-top {
            background: transparent;
            border: 1.5px solid #FFD700;
            color: #FFD700;
        }
        
        .btn-register-top {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            color: #0a0a1a;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }
        
        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 30px;
            padding: 30px 24px;
            margin: 20px 16px;
            border: 1px solid rgba(255, 215, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .form-image-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.15), rgba(255, 165, 0, 0.08));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 2px solid rgba(255, 215, 0, 0.3);
        }
        
        .form-image-icon i {
            font-size: 50px;
            color: #FFD700;
        }
        
        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .form-group label i {
            margin-right: 8px;
            color: #FFD700;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 12px;
            font-size: 15px;
            color: #fff;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #FFD700;
            background: rgba(255, 215, 0, 0.05);
        }
        
        .form-control:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* Gender Radio Styles */
        .gender-group {
            margin-bottom: 20px;
        }
        
        .gender-label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .gender-label i {
            color: #FFD700;
            margin-right: 8px;
        }
        
        .gender-options {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .gender-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .gender-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #FFD700;
        }
        
        .gender-option label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            margin: 0;
        }
        
        /* Message Styles */
        .error-message {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            color: #ff6b6b;
            font-size: 13px;
            display: none;
        }
        
        .error-message.show {
            display: block;
        }
        
        .success-message {
            background: rgba(40, 167, 69, 0.15);
            border: 1px solid rgba(40, 167, 69, 0.3);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
            color: #6bff8b;
            font-size: 13px;
            display: none;
        }
        
        .success-message.show {
            display: block;
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #0a0a1a;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }
        
        .btn-submit:active {
            transform: scale(0.98);
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.1);
        }
        
        .register-link p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .register-link a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 600;
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 25px 20px;
            }
            
            .gender-options {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="top-actions">
            <div class="logo-area">
                <a href="home.html" style="text-decoration: none;">
                    <span class="logo">
                        <i class="fas fa-coins"></i> Gold Kinen
                    </span>
                </a>
            </div>
            <div class="btn-group-top">
                <a href="login.html" class="btn-top btn-login-top">
                    <i class="fas fa-sign-in-alt"></i> LOGIN
                </a>
                <a href="register.html" class="btn-top btn-register-top">
                    <i class="fas fa-user-plus"></i> REGISTER
                </a>
            </div>
        </div>
        
        <div class="form-container">
            <div class="form-image">
                <div class="form-image-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            
            <h2 class="form-title">Create Account</h2>
            
            <!-- Error Message Display -->
            <div id="errorMessage" class="error-message <?php echo !empty($error) ? 'show' : ''; ?>">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
            
            <!-- Success Message Display -->
            <div id="successMessage" class="success-message <?php echo !empty($success) ? 'show' : ''; ?>">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
            </div>
            
            <form id="registerForm" method="POST" action="" autocomplete="off">
                <div class="form-group">
                    <label for="fullname"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="username" id="fullname" class="form-control" placeholder="Enter your full name" autocomplete="off" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                </div>
                
                <!-- Gender Selection -->
                <div class="gender-group">
                    <div class="gender-label">
                        <i class="fas fa-venus-mars"></i> Gender
                    </div>
                    <div class="gender-options">
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderMale" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?> required>
                            <label for="genderMale">
                                <i class="fas fa-mars"></i> Male
                            </label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderFemale" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?>>
                            <label for="genderFemale">
                                <i class="fas fa-venus"></i> Female
                            </label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderOther" value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'other') ? 'checked' : ''; ?>>
                            <label for="genderOther">
                                <i class="fas fa-genderless"></i> Other
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="regMobile"><i class="fas fa-phone-alt"></i> Mobile Number</label>
                    <input type="tel" name="mobile" id="regMobile" class="form-control" placeholder="1234567890" maxlength="10" autocomplete="off" disabled value="<?php echo isset($number) ? htmlspecialchars($number) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email..." autocomplete="off" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="regPassword"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" id="regPassword" class="form-control" placeholder="Create a password" autocomplete="off" required>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword"><i class="fas fa-check-circle"></i> Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm your password" autocomplete="off" required>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
            
            <div class="register-link">
                <p>Already have an account? <a href="login.html">Login Here</a></p>
            </div>
        </div>
    </div>
</body>
</html>