<?php 
	ob_start();
	session_start();
	include "db/index.php";
	//$base = "http://localhost/MobileProject";
	
	function active_class($page_name) {
		$current_page = $_SERVER['REQUEST_URI']; // full path with folder
		if (strpos($current_page, $page_name) !== false) {
			echo 'active';
		}
		return '';
	}
	
	$sql = "SELECT mobile_id, model_name FROM mobiles ORDER BY release_date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);
    $phones = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
?>	
<?php
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

    // Detect host
    if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST']; // Proxy/CDN case
    } else {
        $host = $_SERVER['HTTP_HOST'];
    }
    
    // Detect environment
    if (in_array($host, ['localhost', '127.0.0.1'])) {
        // Development
        $base = $protocol . "://" . $host; // localhost base
    } else {
        // Production
        $base = $protocol . "://" . $host; // live domain
    }
    
    // Always remove trailing slash
    $base = rtrim($base, '/');
    include "meta.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords); ?>">
	<link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Mobilereview_favicon.png" type="image/png">
	
	<!-- 🔸 Open Graph Basic -->
	<meta property="og:site_name" content="Mobile Review BD">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="en_US">
	<meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
	<meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
	<meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
	<meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
	<meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
	<meta property="og:image:alt" content="<?php echo htmlspecialchars($title); ?>">

	<!-- 🔸 Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
	<meta name="twitter:description" content="<?php echo htmlspecialchars($meta_description); ?>">
	<meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
	<meta name="twitter:site" content="@your_twitter_username">
	<meta property="article:publisher" content="https://www.facebook.com/mobilereviewbd.comahm">
	
    
    <!-- Bootstrap 5 CSS -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></noscript>
    
    <!-- Font Awesome -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    
    <!-- Custom CSS -->
    <link rel="preload" href="<?php echo $base; ?>/css/about-us.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/brands.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/compare.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/contact.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/disclaimer.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/faq.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/images.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/phone-details.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/privacy-policy.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/top-phones.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/user-gied.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo $base; ?>/css/user-gied-details.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?php echo $base; ?>/css/about-us.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/brands.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/compare.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/contact.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/disclaimer.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/faq.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/images.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/phone-details.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/privacy-policy.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/top-phones.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/user-gied.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/user-gied-details.css">
    </noscript>

	
	<base href="https://mobilereviewbd.com/">
	
	
    <!-- Organization structured data: Google site logo -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "mobile review bd",
      "url": "https://www.mobilereviewbd.com/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://wwwmobilereviewbd.com/images/Mobilereview_favicon.png",
        "width": 60,
        "height": 60
      },
      "sameAs": [
        "https://www.facebook.com/mobilereviewbd.comahm",
        "https://www.youtube.com/@mobilereviewbd-j6y"
      ]
    }
    </script>
	
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= $base; ?>">
               <img src="images/logo2.png" alt="Mobile Bazaar" height="40" width="100%" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" id="tooglebtn" aria-label="Name">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
						<a class="nav-link <?php active_class('index.php'); ?>" href="<?= $base; ?>">Home</a>
					</li>
					<!-- Mobile Phones Dropdown -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="mobilesDropdown" role="button" data-bs-toggle="dropdown">
							Top 10
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item <?php active_class('gaming-phones/'); ?>" href="gaming-phones/<?php echo str_replace(" ", "-", "Top 10 Best Gaming Phones"); ?>">
									Top 10 Gaming Phone
								</a>
							</li>
							<li>
								<a class="dropdown-item <?php active_class('camera-phones/'); ?>" href="camera-phones/<?php echo str_replace(" ", "-", "Top 10 Best Camera Phones"); ?>">
									Top 10 Camera Phone
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 13000 in BD"); ?>">
									Top 10 Mobile Phone Under 13000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 15000 in BD"); ?>">
									Top 10 Mobile Phone Under 15000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 20000 in BD"); ?>">
									Top 10 Mobile Phone Under 20000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 25000 in BD"); ?>">
									Top 10 Mobile Phone Under 25000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 30000 in BD"); ?>">
									Top 10 Mobile Phone Under 30000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top10/<?php echo str_replace(" ", "-", "Top 10 Mobile Phone Under 35000 in BD"); ?>">
									Top 10 Mobile Phone Under 35000 in BD
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item">
						<a class="nav-link <?php active_class('brands/'); ?>" href="brands/">Brands</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link <?php active_class('compare/'); ?>" href="compare/">Compare</a>
					</li>					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="mobilesDropdown" role="button" data-bs-toggle="dropdown">
							Top Phones
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 5000 to 10000"); ?>">
									Top 10 Best Mobile Phone Under 10000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 10000 to 15000"); ?>">
									Top 10 Mobile Phone Between 10000 to 15000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 15000 to 20000"); ?>">
									Top 10 Mobile Phone Between 15000 to 20000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 20000 to 25000"); ?>">
									Top 10 Mobile Phone Between 20000 to 25000 in BD
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="top-phones/<?php echo str_replace(" ", "-", "top 10 best phone between 25000 to 30000"); ?>">
									Top 10 Mobile Phone Between 25000 to 30000 in BD
								</a>
							</li>
						</ul>
					</li>					
					<!-- Mobile Phones Dropdown -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="mobilesDropdown" role="button" data-bs-toggle="dropdown">
							Catagory
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item <?php active_class('new-phones/'); ?>" href="new-phones/">New Mobiles</a>
							</li>
							<li>
								<a class="dropdown-item <?php active_class('upcoming-phones/'); ?>" href="upcoming-phones/">upcoming Mobiles</a>
							</li>
							<li>
								<a class="dropdown-item <?php active_class('pre-owned-phone/'); ?>" href="pre-owned-phone/">Pre-Owned Mobiles</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php active_class('user-gied/'); ?>" href="user-gied/"> User Gied </a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php active_class('images/'); ?>" href="images/"> Images </a>
					</li>	
                </ul>
                <form method="get" action="phone-details/" class="d-flex">
                    <input class="form-control me-2" list="phones" name="name" type="search" placeholder="Search mobiles...">
					<datalist id="phones">
						<?php 
						foreach ($phones as $p) {
							echo '<option value="' . htmlspecialchars($p['model_name']) . '">';
						}
						?>
					</datalist>
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
