<?php 
	ob_start();
	session_start();
	include "db/index.php";
	
	function active_class($page_name){
		$current_page = basename($_SERVER['PHP_SELF']); 
		if($page_name == $current_page){
			echo 'active-link';
		}
		return '';
	}

	if (isset($_SESSION['user_id'])) {
		$field = "user_id";
		$value = $_SESSION['user_id'];
	} else {
		$field = "session_id";
		$value = session_id();
	}

	$query = $pdo->prepare("SELECT COUNT(cart_id) AS cart_count FROM cart WHERE $field=?");
	$query->execute([$value]);
	$cart = $query->fetch(PDO::FETCH_ASSOC);
	
	$select = "SELECT * FROM products"; 
	$stmt = $pdo->prepare($select);
	$stmt->execute();
	$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>গুরবাজার - প্রাকৃতিক পণ্যের এক-stop দোকান</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product-details.css">
    <link rel="stylesheet" href="css/combo-offer.css">
    <link rel="stylesheet" href="css/categories.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/delivery-policy.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/article-details.css">	
    <link rel="stylesheet" href="css/cart.css">	
</head>
<body>
    <!-- WhatsApp Float Icon -->
    <a href="https://wa.me/8801893331426" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
	
	<!-- Facebook Float Icon -->
    <a href="https://www.facebook.com/PrakitikShad" class="facebook-float" target="_blank">
        <i class="fab fa-facebook"></i>
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">গুরবাজার</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active <?php active_class('index.php'); ?>" href="index.php">হোম</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php active_class('best-sell.php'); ?>" href="best-sell.php">বেস্ট সেল</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php active_class('offer-product.php'); ?>" href="offer-product.php">অফার প্রোডাক্ট</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php active_class('combo-offer.php'); ?>" href="combo-offer.php">কম্বো প্রোডাক্ট</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php active_class('categories.php'); ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            ক্যাটেগরিস
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="categories.php">সকল পণ্য</a></li>
                            <?php							
								$select = "SELECT * FROM categories ORDER BY categories_id"; 
								$stmt = $pdo->prepare($select);
								$stmt->execute();
								
								while($categorie = $stmt->fetch()){
								?>
									 <li>
										<a class="dropdown-item" href="categories.php?category=<?php echo $categorie['categories_name']?>"><?php echo $categorie['categories_name']?></a>
									 </li>
								<?php
								}								
							?>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="search-box me-3">
                        <div class="input-group">
							<form method="get" action="phone-details/" class="d-flex">
								<input class="form-control" list="phones" name="name" type="search" placeholder="পণ্য খুঁজুন......">
								<datalist id="phones">
									<?php 
									foreach ($items as $p) {
										echo '<option value="' . htmlspecialchars($p['model_name']) . '">';
									}
									?>
								</datalist>
								<button class="btn btn-outline-success" type="button">
									<i class="fas fa-search"></i>
								</button>
							</form>
                        </div>
                    </div>
                    <div class="cart-icon">
                        <a href="cart.php" class="text-dark"><i class="fas fa-shopping-cart fa-lg"></i>
							<span class="cart-count"><?php echo $cart['cart_count']; ?></span>
						</a>
                    </div>
                    <div class="user-icon">
                        <a href="#" class="text-dark"><i class="fas fa-user-circle fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>