<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

	function active_class($page_name){
		$current_page = basename($_SERVER['PHP_SELF']); 
		if($page_name == $current_page){
			echo 'nav-link active';
		}else{
			echo 'nav-link';
		}
		return '';;
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>user dashboard-refonex micro earning</title>
	<link href="css/dashboard.css" rel="stylesheet">
	<link href="css/deposite.css" rel="stylesheet">
	<link href="css/spain.css" rel="stylesheet">
	<link href="css/shop.css" rel="stylesheet">
	<link href="css/profile-edit.css" rel="stylesheet">
	<link href="css/ads-earning.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="main-body">
	
		<!-- Header -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container">
				<a class="navbar-brand" href="dashboard.php">
					<img src="assets/PNG-File-7.png" class="main-logo" alt="logo">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="<?php active_class('dashboard.php'); ?>" href="dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="<?php active_class('task.php'); ?>" href="task.php">Tasks</a>
						</li>
						<li class="nav-item">
							<a class="<?php active_class('ads-earning.php'); ?>" href="ads-earning.php">Ads earning</a>
						</li>
						<li class="nav-item">
							<a class="<?php active_class('deposite.php'); ?>" href="deposite.php">Deposit</a>
						</li>
						<li class="nav-item">
							<a class="<?php active_class('withdraw.php'); ?>" href="withdraw.php">withdraw</a>
						</li>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	
		