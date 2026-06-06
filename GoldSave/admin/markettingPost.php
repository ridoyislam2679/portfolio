<?php 
	ob_start();
	include_once('security.php');
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Marketing Posts - Admin Panel</title>
    
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
                <h1>মার্কেটিং পোস্ট</h1>
                <p>নতুন পোস্ট তৈরি করুন</p>
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
                <h2>new post</h2>
                <p>Create a new marketting post</p>
            </div>
            
            <!-- Post Form -->
            <form id="postForm" method="POST" action="" enctype='multipart/form-data' autocomplete="off">
                <div class="form-group">
                    <label><i class="fas fa-heading"></i> Post Title</label>
                    <input type="text" 
                           id="postTitle" 
                           name="title" 
                           class="form-control" 
                           placeholder="post title..."
                           required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-align-left"></i> Post Description </label>
                    <textarea id="postDescription" 
                              name="description" 
                              class="form-control" 
                              placeholder="post description..."
                              required></textarea>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-image"></i> Image </label>
                    <input type="file" id="postImage" name="image_url" class="form-control">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-coins"></i> Reward Coin</label>
                    <input type="number" id="rewardCoins" name="reward_coins" class="form-control" placeholder="20" required>
                </div>
                
                <button type="submit" name="submitPost" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Create a Post
                </button>
            </form>
			<?php 
				if(isset($_POST['submitPost'])){
					$title = $_POST['title'];
					$dsc   = $_POST['description'];
					$coin  = $_POST['reward_coins'];
					
					$image = $_FILES['image_url']['name'];
					$destination = "../assets/".$image;
					
					if(empty($title) || empty($dsc) || empty($coin) || empty($image)){
						echo '<span id="copyMsg" style="color: green;">Invalid!</span>'; 
						exit();
					}
					
					$stmt = $pdo->prepare("INSERT INTO marketing_drop (marketing_title, marketing_dsc, marketing_image, coin, marketing_date) VALUES (?, ?, ?, ?, CURDATE())");
					$success = $stmt->execute([$title, $dsc, $image, $coin]);
					move_uploaded_file($_FILES['image_url']['tmp_name'], $destination);
					
					echo '<span id="copyMsg" style="color: green;">Updated Sucessful!</span>'; 					
				}
			?>			
        </div>
    </div>
    <script src="JS/menu.js"> </script>
</body>
</html>