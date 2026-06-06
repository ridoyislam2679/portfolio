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
	
	$stmt = $pdo->prepare("SELECT user_id, user_name, profile_picture FROM user WHERE userId = ?");
	$stmt->execute([$userId]);
	$user = $stmt->fetch();
	
	$id = $user['user_id'];
	
	$stmt = $pdo->prepare("SELECT total_balance, gold_balance, coin_balance FROM balance WHERE user_id = ?");
	$stmt->execute([$id]);
	$balance = $stmt->fetch();
	
	$total_balance = $balance['total_balance']?? 0;
	$gold_balance = $balance['gold_balance']?? 0;
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Settings - Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/setting.css">
	
</head>
<body>
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="logo">
                <i class="fas fa-cog"></i> Settings
            </div>
            <div style="width: 40px;"></div>
        </div>
        
        <!-- Profile Image Section -->
        <div class="profile-image-section">
            <div class="profile-image-container">
                <div class="profile-image" id="profileImage">
					<img src="assets/<?php echo $user['profile_picture']; ?>">
                </div>
                <div class="edit-icon" id="editImageBtn">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <p style="font-size: 12px; color: rgba(255,255,255,0.5); margin-top: 10px;">
                <i class="fas fa-info-circle"></i> প্রোফাইল আপডেট করুন
            </p>
            <input type="file" id="profileImageInput" accept="image/jpeg,image/png,image/jpg">
        </div>
		
		<!-- Update Image Card -->
        <div class="settings-card">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="card-title">
					<i class="fas fa-user-edit"></i> ছবি পরিবর্তন করুন
				</div>
				<div class="form-group">
					<label><i class="fas fa-user"></i> আপনার ছবি</label>
					<input type="file" name="image" id="userImage" class="form-control">
				</div>
				<button class="update-btn" name="update_image" id="updateNameBtn">
					<i class="fas fa-save"></i> ছবি আপডেট করুন
				</button>
			</form>
			<?php 
				if(isset($_POST['update_image'])){
					$image = $_FILES['image']['name'];
					$destination = "assets/".$image;
					
					if($image){
						try{
							$update = "UPDATE user set profile_picture = ? WHERE user_id = ?";
							$updateQuery = $pdo->prepare($update);
							$updateQuery ->execute([$image, $id]);
							move_uploaded_file($_FILES['image']['tmp_name'], $destination);
							
							header("Location: ".$_SERVER['PHP_SELF']);
							exit();	
						}catch(PDOException $e){
							echo "<div style='color: red;'>Update failed: " . $e->getMessage() . "</div>";
						}	
					}else{
						echo '<span id="copyMsg" style="color: red;">Update Invalid!</span>';
					}
				}
			?>
        </div>
        
        <!-- Update Name Card -->
        <div class="settings-card">
			<form action="" method="POST" enctype="">
				<div class="card-title">
					<i class="fas fa-user-edit"></i> নাম পরিবর্তন করুন
				</div>
				<div class="form-group">
					<label><i class="fas fa-user"></i> আপনার নাম</label>
					<input type="text" id="fullname" name="fullname" class="form-control" placeholder="আপনার সম্পূর্ণ নাম লিখুন" value="<?php echo $user['user_name']; ?>">
				</div>
				<button class="update-btn" name="update_name" id="updateNameBtn">
					<i class="fas fa-save"></i> নাম আপডেট করুন
				</button>
			</form>
			<?php 
				if(isset($_POST['update_name'])){
					$name = $_POST['fullname'];
					
					if($name){
						try{
							$update = "UPDATE user set user_name = ? WHERE user_id = ?";
							$updateQuery = $pdo->prepare($update);
							$updateQuery ->execute([$name, $id]);
							
							header("Location: ".$_SERVER['PHP_SELF']);
							exit();	
						}catch(PDOException $e){
							echo "<div style='color: red;'>Update failed: " . $e->getMessage() . "</div>";
						}	
					}else{
						echo '<span id="copyMsg" style="color: red;">Update Invalid!</span>';
					}
				}
			?>
        </div>
        
        <!-- Change Password Card -->
        <div class="settings-card">
			<form action="" method="POST" enctype="">
				<div class="card-title">
					<i class="fas fa-lock"></i> পাসওয়ার্ড পরিবর্তন করুন
				</div>
				<div class="form-group">
					<label><i class="fas fa-key"></i> বর্তমান পাসওয়ার্ড</label>
					<input type="password" name="current_pass" id="currentPassword" class="form-control" placeholder="বর্তমান পাসওয়ার্ড দিন">
				</div>
				<div class="form-group">
					<label><i class="fas fa-lock"></i> নতুন পাসওয়ার্ড</label>
					<input type="password" id="newPassword" name="password" class="form-control" placeholder="নতুন পাসওয়ার্ড দিন">
					<div class="password-hint" id="passwordHint"></div>
				</div>
				<div class="form-group">
					<label><i class="fas fa-check-circle"></i> নতুন পাসওয়ার্ড পুনরায় লিখুন</label>
					<input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="নতুন পাসওয়ার্ড আবার লিখুন">
				</div>
				<button type="submit" class="update-btn" name="update_pass" id="updatePasswordBtn">
					<i class="fas fa-key"></i> পাসওয়ার্ড আপডেট করুন
				</button>
			</form>
			<?php 
				if(isset($_POST['update_pass'])){
					$current_pass     = $_POST['current_pass'];
					$pass 		      = $_POST['password'];
					$confirm_password = $_POST['confirm_password'];
					
					if (empty($current_pass) || empty($confirm_password) || empty($pass)) {
						echo '<span id="copyMsg" style="color: red;">All fields are required</span>';
					} else {
						$stmt = $pdo->prepare("SELECT pass FROM user WHERE user_id = ?");
						$stmt->execute([$id]);
						$user = $stmt->fetch();
						
						if ($user && password_verify($current_pass, $user['pass'])) {
							if($pass !== $confirm_password){
								echo '<span id="copyMsg" style="color: red;">Unmatch password!</span>';	
							}else{
								// 🔐 Password Hash
								$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
								$update = "UPDATE user set pass = ? WHERE user_id = ?";
								$updateQuery = $pdo->prepare($update);
								$updateQuery ->execute([$hashedPassword, $id]);
								
								echo '<span id="copyMsg" style="color: green;">Password Change Sucessful</span>';
							}
						} else {
							echo '<span id="copyMsg" style="color: red;">Incorrect Password!</span>';
						}
					}
				}
			?>
        </div>
        
        <!-- App Info Card -->
        <div class="settings-card">
            <div class="card-title">
                <i class="fas fa-info-circle"></i> অ্যাপ তথ্য
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span style="color: rgba(255,255,255,0.6);">অ্যাপ ভার্সন</span>
                <span style="color: #FFD700; font-weight: 600;">v2.0.0</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span style="color: rgba(255,255,255,0.6);">ডেভেলপার</span>
                <span style="color: #FFD700; font-weight: 600;">Gold Save World</span>
            </div>
            <div class="divider"></div>
			<a href="logout.php" style="text-decoration: none; color: white;">
            <button class="update-btn" id="logoutBtn" style="background: rgba(220, 53, 69, 0.8); color: white;">
				<i class="fas fa-sign-out-alt"></i> লগআউট 
            </button>
			</a>
        </div>
    </div>
    
    <?php include_once("bottom.php"); ?>
    
    
</body>
</html>