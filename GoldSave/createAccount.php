<?php
	session_start();
	require 'db/index.php';
	
	$number = $_SESSION['number'];
		
	if(!$number){
		header("Location: register.php");
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$username 		  = trim($_POST['fullname'] ?? '');
		$email    		  = trim($_POST['email'] ?? '');
		$password 		  = trim($_POST['password'] ?? '');
		$confirm_password = trim($_POST['confirm_password'] ?? '');
		$gender  		  = trim($_POST['gender'] ?? '');
		$referred_by_code = trim($_POST['code'] ?? '');
		
		
		//$destination = "assets/".$image;
		
		$image = null;

		if (!empty($_FILES['image']['name'])) {
			$orginalImage = $_FILES['image']['name'];
			$imageName = time() . '_' . $orginalImage;
			$destination = "assets/" . $imageName;
			move_uploaded_file($_FILES['image']['tmp_name'], $destination);
			$image = $imageName;
		}
		
		$referral_code = generateReferralCode();
		
		$referred_by = null; // আগে default দাও

		if (!empty($referred_by_code)) {
			$stmt = $pdo->prepare("SELECT user_id FROM user WHERE userId = ?");
			$stmt->execute([$referred_by_code]);
			$referrer = $stmt->fetch();

			if ($referrer) {
				$referred_by = $referrer['user_id'];
			}
		}		

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
				
				if($password !== $confirm_password){
					$error = "Unmatch password";	
				}else{
					// 🔐 Password Hash
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					$pdo->beginTransaction();

					try {

						$stmt = $pdo->prepare("INSERT INTO user (user_name, number, email, gender, userId, referred_id, pass, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->execute([$username, $number, $email, $gender, $referral_code, $referred_by, $hashedPassword, $image]);

						$user_id = $pdo->lastInsertId();

						$stmt = $pdo->prepare("INSERT INTO balance (user_id, total_balance, gold_balance, coin_balance) VALUES (?, ?, ?, ?)");
						$stmt->execute([$user_id, 0,0,0]);

						if(!empty($referred_by)){
							$stmt = $pdo->prepare("INSERT INTO reffer (refer_id, referred_id) VALUES (?, ?)");
							$stmt->execute([$user_id, $referred_by]);
						}

						$pdo->commit();

						$_SESSION['userId'] = $referral_code;
						$_SESSION['last_activity'] = time();
						header('location:home.php');
						exit();

					} catch(Exception $e){
						$pdo->rollBack();
						$error = "Something went wrong";
					}
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
    <title>Login - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS (optional, for some components) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Common CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/register.css">
    
</head>
<body>
    <div class="main-content">
        <div class="top-actions">
            <div class="logo-area">
                <a href="index.php" style="text-decoration: none;">
                    <span class="logo">
                        <i class="fas fa-coins"></i> Gold Save World
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
        
        <div class="form-container">
            <div class="form-image">
                <div class="form-image-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            
            <h2 class="form-title">Create Account</h2>
            <div id="errorMessage" class="error-message">
				<?php if (isset($error)) echo $error; ?>
			</div>
            <div id="successMessage" class="success-message"></div>
            
            <form id="registerForm" method="POST" action="" enctype='multipart/form-data' autocomplete="off">
                <div class="form-group">
                    <label for="fullname"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your full name" autocomplete="off" required>
                </div>
				
				 <!-- Gender Selection with Radio Buttons -->
                <div class="gender-group">
                    <div class="gender-label">
                        <i class="fas fa-venus-mars"></i> Gender
                    </div>
                    <div class="gender-options">
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderMale" value="male" required>
                            <label for="genderMale">
                                <i class="fas fa-mars"></i> Male
                            </label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderFemale" value="female">
                            <label for="genderFemale">
                                <i class="fas fa-venus"></i> Female
                            </label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" name="gender" id="genderOther" value="other">
                            <label for="genderOther">
                                <i class="fas fa-genderless"></i> Other
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="regMobile"><i class="fas fa-phone-alt"></i> Mobile Number</label>
                    <div class="phone-input">
                        <input type="tel" name="mobile" id="regMobile" class="form-control phone-number" value="<?php echo $number; ?>" disabled >
                    </div>
                </div>
				
				<div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email..." autocomplete="off" required>
                </div>
				
				<div class="form-group">
                    <label for="image"><i class="fas fa-envelope"></i> Your Image</label>
                    <input type="file" name="image" id="image" class="form-control" autocomplete="off" required>
                </div>
				
				<div class="form-group">
                    <label for="code"><i class="fas fa-envelope"></i> Reffer Code(optional)</label>
                    <input type="number" name="code" id="code" class="form-control" placeholder="Enter your reffer code..." autocomplete="off">
                </div>
				
                <div class="form-group">
                    <label for="regPassword"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" id="regPassword" class="form-control" placeholder="Create a password" autocomplete="off" required>
                    <div id="passwordStrength" class="password-strength"></div>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword"><i class="fas fa-check-circle"></i> Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm your password" autocomplete="off" required>
                </div>
                <!--
                <div class="terms">
                    <input type="checkbox" id="termsCheckbox" required>
                    <label for="termsCheckbox">I agree to the <a href="terms.html">Terms & Conditions</a> and <a href="privacy.html">Privacy Policy</a></label>
                </div>
                !-->
                <button type="submit" class="btn-submit" id="registerBtn">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
            
            <div class="register-link">
                <p>Already have an account? <a href="login.html">Login Here</a></p>
            </div>
        </div>
        
        <input type="hidden" id="csrf_token" value="">
    </div>
</body>
</html>