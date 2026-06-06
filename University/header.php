<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Name - Home</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/administration.css">
    <link rel="stylesheet" href="css/admission.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/events.css">
    <link rel="stylesheet" href="css/library.css">
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/online.css">
    <link rel="stylesheet" href="css/scholarship.css">
    <link rel="stylesheet" href="css/news-details.css">
    <link rel="stylesheet" href="css/ict-center.css">
    <link rel="stylesheet" href="css/administration-details.css">
    <link rel="stylesheet" href="css/administration-profile.css">
    <link rel="stylesheet" href="css/campus.css">
    <link rel="stylesheet" href="css/dean-profile.css">
    <link rel="stylesheet" href="css/faculty.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="main-nav">
        <div class="container">
            <div class="nav-logo">
               <a href='index.php'> <h1>University Name</h1> </a>
            </div>
			<?php 
				function active_class($page_name){
					$current_page = basename($_SERVER['PHP_SELF']); 
					if($page_name == $current_page){
						echo 'active';
					}
					return '';;
				}
			?>
            <ul class="nav-links">
                <li><a href="index.php" class="<?php active_class('index.php'); ?>">Home</a></li>
                <li>
					<a href="administration.php" class="<?php active_class('administration.php'); ?>">Administration</a>
				</li>
                <li>
					<a href="academic.php" class="<?php active_class('academic.php'); ?>">Academic</a>
				</li>
				<li>
					<a href="admission.php" class="<?php active_class('admission.php'); ?>">Admission</a>
				</li>
                <li>
					<a href="facilities.php" class="<?php active_class('facilities.php'); ?>">Facilities</a>
				</li>               
                <li>
					<a href="online-service.php" class="<?php active_class('online-service.php'); ?>">Online Service</a>
				</li>
                <li>
					<a href="library.php" class="<?php active_class('library.php'); ?>">Library</a>
				</li>
                <li>
					<a href="ict-center.php" class="<?php active_class('ict-center.php'); ?>">ICT Center</a>
				</li>
                <li>
					<a href="campus.php" class="<?php active_class('campus.php'); ?>">Campus</a>
				</li>
            </ul>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
