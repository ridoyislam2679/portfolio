<?php 
	ob_start();
	include_once('security.php');
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Status Change- Gold Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/markettingPost.css">
	<link rel="stylesheet" href="CSS/header.css">
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <?php include_once('header.php'); ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Fixed Top Header with Logout Form -->
        <div class="top-header">
            <div class="page-title">
                <h1>Status</h1>
                <p>Change User Status</p>
            </div>
            <div class="admin-info">
                <div class="admin-name">
                    <div class="name"><?php echo $admin_name; ?></div>
                    <div class="role">সুপার অ্যাডমিন</div>
                </div>
                <form class="logout-form" method="POST" action="logout.php">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        লগআউট
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Marketing Post Form -->
        <div class="settings-card">
            <div class="settings-header">
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h2>Status</h2>
                <p>Change User Status</p>
            </div>
            
            <!-- Post Form -->
            <form id="postForm" method="POST" action="" enctype='multipart/form-data' autocomplete="off">
				<div class="form-group">
                    <label><i class="fas fa-user"></i> User Id</label>
                    <input type="text" 
                           id="postTitle" 
                           name="UserId" 
                           class="form-control" 
                           placeholder="User Id.."
                           required>
                </div>
                <div class="gender-group">
                    <div class="gender-label">
                        <i class="fas fa-venus-mars"></i> Status
                    </div>
                    <div class="gender-options form-control mt-2 mb-2">
						<select class="form-control" name="userStatus">
							<option value=""> select </option>
							<option value="active"> Active </option>
							<option value="deactivate"> Deactive </option>
						</select>
                    </div>
                </div>
                
                <button type="submit" name="userUpdate" class="submit-btn">
                    Update
                </button>
            </form>
			<?php 
				if(isset($_POST['userUpdate'])){

					$user_id = $_POST['UserId'];
					$status  = trim($_POST['userStatus']);

					// 🔒 validation
					if(empty($user_id) || empty($status)){
						echo '<span style="color:red;">Invalid Input!</span>';
						exit();
					}

					// only allow valid status
					if(!in_array($status, ['active', 'deactivate'])){
						echo '<span style="color:red;">Invalid Status!</span>';
						exit();
					}

					// 🔍 check user exists
					$stmt = $pdo->prepare("SELECT user_id FROM user WHERE userId = ?");
					$stmt->execute([$user_id]);
					$user = $stmt->fetch();

					if(!$user){
						echo '<span style="color:red;">User Not Found!</span>';
						exit();
					}

					$real_id = $user['user_id'];

					// ✅ update status using real id
					$stmt = $pdo->prepare("UPDATE user SET status = ? WHERE user_id = ?");
					$stmt->execute([$status, $real_id]);
					
					// check updated or not
					if($stmt->rowCount() > 0){
						echo '<span style="color:green;">Status Updated Successfully!</span>';
					} else {
						echo '<span style="color:orange;">No Changes (Same Status)</span>';
					}
				}
			?>
        </div>
    </div>
    <script src="JS/menu.js"> </script>
</body>
</html>