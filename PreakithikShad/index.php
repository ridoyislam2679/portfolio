<?php 
	include_once('db/index.php');
	include_once('header.php');
	
	// Debugging on
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	if(isset($_POST['add_cart_btn'])){
		//echo $_POST['hiddenProductId'];
		
		//$user_id = 1; // Demo user (later আপনি $_SESSION['user_id'] ব্যবহার করবেন)
		//$_SESSION['user_id'] = 10;

		// login check
		if (isset($_SESSION['user_id'])) {
			$field = "user_id";
			$value = $_SESSION['user_id'];
		} else {
			$field = "session_id";
			$value = session_id();
		}
		
		$product_id = $_POST['hiddenProductId'];

		// Check if already in cart

		$check = $pdo->prepare("SELECT cart_id, quantity FROM cart WHERE $field=? AND product_id=?");
		$check->execute([$value, $product_id]);

		if ($check->rowCount() > 0) {
			$row = $check->fetch();
			$new_qty = $row['quantity'] + 1;
			$update = $pdo->prepare("UPDATE cart SET quantity=? WHERE cart_id=?");
			$update->execute([$new_qty, $row['cart_id']]);
		} else {
			$insert = $pdo->prepare("INSERT INTO cart ($field, product_id, quantity) VALUES (?, ?, 1)");
			$insert->execute([$value, $product_id]);
		}
		
		//echo "<h2 style='color: #a38019; font-size: 1.5rem; text-align: center; display: block; background: antiquewhite; padding: 20px; margin-top: 20px; margin-bottom: 20px;'> Your Product Inserted Cart page <a href='cart.php' style='font-size: 20px; color: green; text-decoration: none;'> View Cart </a> </h2>";
		
		 // ✅ Toast দেখানোর জন্য session এ flag রাখি
		$_SESSION['toast_message'] = "পণ্যটি সফলভাবে কার্টে যোগ হয়েছে!";
		$_SESSION['toast_product'] = $product_id;

		// Page reload prevent করার জন্য redirect
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
	}
	
?>
    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="খেজুর গুড়">
                <div class="carousel-caption d-none d-md-block">
                    <h5>খেজুর গুড়</h5>
                    <p>প্রাকৃতিক ও বিশুদ্ধ খেজুর গুড় এখন আপনার দোরগোড়ায়</p>
                    <button class="btn btn-hero">কিনুন এখন</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1600271886742-f049cd451bba?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="আকর গুড়">
                <div class="carousel-caption d-none d-md-block">
                    <h5>আকর গুড়</h5>
                    <p>স্বাদের অতুলনীয় আকর গুড়</p>
                    <button class="btn btn-hero">কিনুন এখন</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1598033129183-c4f50c736f10?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="বিভিন্ন ফল">
                <div class="carousel-caption d-none d-md-block">
                    <h5>তাজা ও প্রাকৃতিক ফল</h5>
                    <p>সব ধরনের তাজা ও প্রাকৃতিক ফল পাবেন আমাদের কাছে</p>
                    <button class="btn btn-hero">কিনুন এখন</button>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Best Selling Products -->
    <section class="best-sell-section">
        <div class="container">
            <h2 class="section-title">বেস্ট সেলিং পণ্য</h2>
            <div class="row">
				<?php 
					$select = "SELECT
						p.`product_id`, 
						p.`product_name`,
						p.`product_price`,
						p.`old_price`,
						p.`product_dsc`,
						p.`image`, 
						SUM(order_items.quantity) AS total_quantity 
						FROM order_items JOIN products p ON order_items.product_id = p.`product_id`
						GROUP BY p.`product_id`, p.`product_name`, p.`product_price`, p.`image` 
						ORDER BY total_quantity DESC LIMIT 8"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($row = $stmt->fetch()){
						$description = $row['product_dsc'];
						$length = strlen($description);
						
						if(strlen($length > 100 )){
							$dsc = substr($description, 0, 90);
							$description = $dsc.'...';						
						}
						
						?>
							<div class="col-lg-3 col-md-4 col-6 mb-4">
								<div class="product-card card h-100 best-seling">
									<a href="product-details.php?productName=<?php echo $row['product_name']; ?>" class="product-card-link">
										<div class="badge bg-danger position-absolute" style="top: 10px; right: 10px">সেল</div>
										<img src="assets/<?php echo $row['image']; ?>" class="product-img card-img-top" alt="<?php echo $row['image']; ?>">
										<div class="card-body">
											<h5 class="product-title card-title"><?php echo $row['product_name']; ?></h5>
											<div class="mb-2">
												<span class="product-price"><?php echo $row['product_price']; ?> টাকা</span>
												<span class="product-old-price ms-2"><?php echo $row['old_price']; ?> টাকা</span>
											</div>
											<p class="product-description">
												<?php echo $description; ?>
											</p>
											<!--
											<a href="add_to_cart.php?id=<?= $row['product_id'] ?>" class="cart-product-link"> </a>--!>
												<form action="" method="POST">
													<button class="add-to-cart btn" name="add_cart_btn" type="submit" data-product="<?php echo $row['product_name']; ?>"> 
													কার্টে যোগ করুন
													</button>
													<input type="hidden" name="hiddenProductId" value="<?php echo $row['product_id']; ?>">
												</form>
												
											
											<a href="add_to_cart.php?id=<?= $row['product_id'] ?>" class="cart-product-link">
												<button class="order-now btn"> 
												অর্ডার করুন
												</button>
											</a>
											<!--
												<a href="product-details.php?<?php echo $row['product_name']; ?>" class="add-to-cart btn">কার্টে যোগ করুন</a> 
												<button class="order-now btn"></button>
											--!>
										</div>
									</a>
								</div>
							</div>
						<?php
					}				
				?>
            </div>
        </div>
    </section>

    <!-- All Products -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">সব পণ্য</h2>
            <div class="row">
				<?php 
					$select = "SELECT * FROM products ORDER BY product_id LIMIT 12"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($product = $stmt->fetch()){
						?>
							<div class="col-lg-3 col-md-4 col-6 mb-4">
								<a href="product-details.php?productName=<?php echo $product['product_name']; ?>" class="product-card-link">
									<div class="product-card card h-100 all-product">
										<img src="assets/<?php echo $product['image']; ?>" class="product-img card-img-top" alt="<?php echo $product['image']; ?>">
										<div class="card-body text-center">
											<h5 class="product-title card-title"><?php echo $product['product_name']; ?></h5>
											<span class="product-price"><?php echo $product['product_price']; ?> টাকা</span>
										</div>
										
										<form action="" method="POST">
											<button class="add-to-cart btn" name="add_cart_btn" type="submit" > 
											কার্টে যোগ করুন
											</button>
											<input type="hidden" name="hiddenProductId" value="<?php echo $product['product_id']; ?>">
										</form>
										
										<a href="add_to_cart.php?id=<?= $product['product_id'] ?>" class="cart-product-link">
											<button class="order-now btn"> 
											অর্ডার করুন
											</button>
										</a>
									</div>
								</a>
							</div>
						<?php
					}
					
				?>
            </div>
            <div class="text-center mt-4">
                <a href="categories.php" class="btn btn-success">আরও পণ্য দেখুন</a>
            </div>
        </div>
    </section>

    <!-- Special Offer Section -->
    <section class="offer-section">
		<a href="categories.php?category=গুড়" class="product-card-link">
			<div class="container">
				<h2 class="offer-title">বিশেষ অফার!</h2>
				<p class="offer-text">খেজুর গুড় ও আকর গুড় কিনুন ২০% ছাড়ে। সীমিত সময়ের জন্য</p>
				<button class="btn btn-light btn-lg px-5 bishes_offer">অর্ডার করুন</button>
			</div>
		</a>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">ক্যাটেগরিস</h2>
            <div class="row">
				<?php 
					$select = "SELECT * FROM categories ORDER BY categories_id"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($categorie = $stmt->fetch()){
						?>
							<div class="col-lg-2 col-md-3 col-4 mb-4">
								<a href="categories.php?category=<?php echo $categorie['categories_name']?>" class="product-card-link">
									<div class="category-card">
										<div class="category-icon">
											<image src="assets/<?php echo $categorie['categories_image']?>" class="categorie_image">
										</div>
										<h5 class="categorie_name"><?php echo $categorie['categories_name']?></h5>
									</div>
								</a>
							</div>
						<?php
					}					
				?>
            </div>
        </div>
    </section>
	
	<!-- Articles Section -->
    <section class="articles-section">
        <div class="container">
            <h2 class="relation-section-title">আমাদের সম্পর্কে</h2>
            <div class="row">
				<?php 
					$select = "SELECT * FROM article ORDER BY created_at DESC LIMIT 3"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($blog = $stmt->fetch()){
						$description = $blog['article_dsc'];
						$length = strlen($description);
						if($length > 100){
							$dsc = substr($description, 0, 90);
							$description = $dsc.'...';
						}
						?>
							<div class="col-md-4 mb-4">
								<div class="article-card card" onclick="window.location.href='article-details.php?blog=<?php echo $blog['article_name']; ?>'">
									<img src="assets/<?php echo $blog['article_image']; ?>" class="article-img card-img-top" alt="কম খরচে ভালো পণ্য">
									<div class="article-content">
										<h5 class="article-title"><?php echo $blog['article_name']; ?></h5>
										<p class="article-excerpt"><?php echo $description; ?></p>
										<button class="btn btn-details">আরও পড়ুন</button>
									</div>
								</div>
							</div>
						<?php
					}					
				?>
            </div>
        </div>
    </section>
	
<?php if(isset($_SESSION['toast_message'])): ?>
    <div class="toast-notification active" id="toast">
        <div class="toast-icon"><i>✓</i></div>
        <div class="toast-content">
            <p class="toast-message"><?php echo $_SESSION['toast_message']; ?></p>
            <div class="toast-buttons">
				<button class="toast-btn okay-btn" id="okay-btn">Okay</button>
                <a href="cart.php" class="toast-btn view-cart">View Cart</a>                
            </div>
        </div>
    </div>
    <script>
        const toast = document.getElementById('toast');
        const okayBtn = document.getElementById('okay-btn');

        // Okay button -> reload current page
        okayBtn.addEventListener('click', function(){
            window.location.href = window.location.pathname;
        });

        // ✅ 5s পরে Toast auto hide হবে
        setTimeout(() => {
            if (toast) {
                toast.classList.remove('active');
            }
        }, 5000);
    </script>
<?php 
    unset($_SESSION['toast_message']);
    unset($_SESSION['toast_product']);
endif; 
?>


<?php 
	include_once('footer.php');
?>