<?php
	session_start();
	if (!isset($_SESSION['admin_id'])) {
		header('Location: login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard-Micro Earning</title>
    <!-- Bootstrap 5 CSS -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Top Header -->
    <header class="top-header">
        <div class="logo-container">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="logo">
                <a href="dashboard.php"> <img src="../assets/PNG-File-7.png" alt="Logo"> </a>
            </div>
        </div>
        <div class="admin-name">
            <span>Admin Dashboard</span>
        </div>
		<form method="POST">
			<button class="logout-btn" name="logout">
				<i class="fas fa-sign-out-alt"></i> Logout
			</button>
		</form>
		<?php 
			if(isset($_POST['logout'])){
				session_start();
				session_destroy();
				header("location:../admin/login.php");
			}
		?>
    </header>
    
   