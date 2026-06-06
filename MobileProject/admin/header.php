<?php
	ob_start();
	include "../db/index.php";
	//$base = "http://localhost/MobileProject";
	
	function active_class($page_name) {
		$current_page = $_SERVER['REQUEST_URI']; // full path with folder
		if (strpos($current_page, $page_name) !== false) {
			echo 'active';
		}
		return '';
	}
	
	session_start();
	if (!isset($_SESSION['admin_id'])) {
		header('Location: login.php');
		exit();
	}
	
	echo $_SESSION['admin_id'];
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobileStore Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php active_class('dashboard.php'); ?>" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php active_class('add_brands.php'); ?>" href="add_brands.php">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Brands</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_mobile.php'); ?>" href="add_mobile.php">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Add Mobile</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_ratings.php'); ?>" href="add_ratings.php">
                        <i class="fas fa-star"></i>
                        <span>Add Rating</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_mobile_specification.php'); ?>" href="add_mobile_specification.php">
                        <i class="fas fa-cogs"></i>
                        <span>Add Mobile Specification</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_images.php'); ?>" href="add_images.php">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Add Mobile Images</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_highlights.php'); ?>" href="add_highlights.php">
                        <i class="fas fa-highlighter"></i>
                        <span>Add Highlights</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_overview.php'); ?>" href="add_overview.php">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Mobile Overview</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_faq.php'); ?>" href="add_faq.php">
                        <i class="fas fa-question-circle"></i>
                        <span>Add FAQs</span>
                    </a>
                </li>				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('add_articles.php'); ?>" href="add_articles.php">
                        <i class="fas fa-file-alt"></i>
                        <span>Add Article</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php active_class('add_video.php'); ?>" href="add_video.php">
                        <i class="fas fa-file-alt"></i>
                        <span>Add Video</span>
                    </a>
                </li>
                
				
				<!--
				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('brand_list.php'); ?>" href="brand_list.php">
                        <i class="fas fa-list"></i>
                        <span>List Brands</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php active_class('mobile_list.php'); ?>" href="mobile_list.php">
                        <i class="fas fa-list-alt"></i>
                        <span>List Mobile</span>
                    </a>
                </li>
				
				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('index/'); ?>" href="rating_list.php">
                        <i class="fas fa-th-list"></i>
                        <span>Rating List</span>
                    </a>
                </li>
                
				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('highlight_list.php'); ?>" href="highlight_list.php">
                        <i class="fas fa-highlighter"></i>
                        <span>Highlights List</span>
                    </a>
                </li>
				
				<li class="nav-item">
                    <a class="nav-link <?php active_class('index/'); ?>" href="rating_list.php">
                        <i class="fas fa-th-list"></i>
                        <span>Overview List</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php active_class('article_list.php'); ?>" href="article_list.php">
                        <i class="fas fa-th-list"></i>
                        <span>Article List</span>
                    </a>
                </li>
                
				<li class="nav-item">
                    <a class="nav-link <?php active_class('faq_list.php'); ?>" href="faq_list.php">
                        <i class="fas fa-th-list"></i>
                        <span>FAQs List</span>
                    </a>
                </li>
				
				-->
				
            </ul>
        </div>
    </div>
	
	<div class="main-content" id="mainContent">
        <!-- Header -->
        <div class="header d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="logo d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/906/906361.png" alt="Logo">
                    <h1 class="ms-2 mb-0 fs-4">MobileStore Admin</h1>
                </div>
            </div>
            <div class="user-info d-flex align-items-center w-100 justify-content-md-end justify-content-between">
                <span class="me-3 d-none d-sm-block">Welcome, Admin User</span>
				<form method="POST">
					<button class="logout-btn" name="logoutBtn">
						<i class="fas fa-sign-out-alt me-2"></i> Logout
					</button>
				</form>
            </div>
			<?php 
				if(isset($_POST['logoutBtn'])){
					session_start();
					session_destroy();
					header("location:login.php");
				}
			?>
        </div>