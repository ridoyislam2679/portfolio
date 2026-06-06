<?php
	include_once('header.php');
	
	// যদি category না থাকে তাহলে home এ পাঠাবে
	if(isset($_GET['category'])){
		$category = $_GET['category'];
		
		// SQL দিয়ে ওই category এর products বের করা
		//$select = "SELECT * FROM products WHERE category_name = ?";
		$select = "SELECT 
					p.* FROM products p JOIN categories c 
					ON p.categories_id = c.categories_id
					WHERE c.categories_name = ?";
		$stmt = $pdo->prepare($select);
		$stmt->execute([$category]);
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$category = "সকল";
		
		$select = "SELECT * FROM products";
		$stmt = $pdo->prepare($select);
		$stmt->execute();
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
?>
    <!-- Categories Hero Section -->
    <section class="categories-hero">
        <div class="container">
            <h1 class="categories-title" id="category-title"><?php echo $category; ?> ক্যাটেগরিস</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb categories-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white">হোম</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page" id="breadcrumb-category">ক্যাটেগরিস</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Categories Content -->
    <section class="categories-container">
        <div class="container">
            <!-- Category Filter Buttons -->
            <div class="category-filter">
                <div class="category-buttons">
					<?php 
						if(!isset($_GET['category'])){
							$all_categories = 'all-category';
						}else{
							$all_categories = '';
						}
					?>
					<a href="categories.php" class="btn category-btn <?php echo $all_categories; ?>" data-category="সকল ক্যাটেগরিস">সকল ক্যাটেগরিস</a>
					<?php
						$select = "SELECT * FROM categories ORDER BY categories_id"; 
						$stmt = $pdo->prepare($select);
						$stmt->execute();
						
						$currentCategory = isset($_GET['category']) ? $_GET['category'] : '';
						
						while($categorie = $stmt->fetch()){
							$activeClass = ($categorie['categories_name'] == $currentCategory) ? 'active-category' : '';
							?>
								<a href="categories.php?category=<?php echo $categorie['categories_name']?>" class="btn category-btn <?php echo $activeClass; ?>" data-category="খেজুর-গুড়"><?php echo $categorie['categories_name']?></a>
							<?php
						}						
					?>
                    
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="product-grid">
                <h2 class="section-title" id="products-title">সকল পণ্য</h2>
                <div class="row" id="products-container">
					<?php 
						if(count($products) > 0){
							foreach($products as $product){
								$description = $product['product_dsc'];
								$length = strlen($description);
								
								if(strlen($length > 100 )){
									$dsc = substr($description, 0, 90);
									$description = $dsc.'...';						
								}
							?>
								<div class="col-lg-3 col-md-4 col-6 mb-4">
									<div class="product-card card h-100">
										<a href="product-details.php?productName=<?php echo $product['product_name']; ?>" class="product-card-link">
											<img src="assets/<?php echo $product['image']; ?>" class="product-img card-img-top" alt="<?php echo $product['product_name']; ?>">
											<div class="card-body">
												<h5 class="product-title card-title"><?php echo $product['product_name']; ?></h5>
												<div class="mb-2">
													<span class="product-price"><?php echo $product['product_price']; ?> টাকা</span>
													<span class="product-old-price ms-2"><?php echo $product['old_price']; ?> টাকা</span>
												</div>
												<p class="product-description">
													<?php echo $description; ?>
												</p>
												
												<form action="" method="POST">
													<button class="add-to-cart btn" name="add_cart_btn" type="submit" data-product=<?php echo $product['product_name']; ?>"> 
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
								</div>
							<?php
							}
						}
						else{
							echo "<h2 class='no-found'> এই ক্যাটাগরিতে কোনো প্রোডাক্ট পাওয়া যায়নি। </h2>";
						}
					?>
                </div>
            </div>
        </div>
    </section>
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
											<a href="add_to_cart.php?id=<?= $row['product_id'] ?>" class="cart-product-link">
												<button class="add-to-cart btn"> 
												কার্টে যোগ করুন
												</button>
											</a>
											<a href="add_to_cart.php?id=<?= $row['product_id'] ?>" class="cart-product-link">
												<button class="order-now btn"> 
												অর্ডার করুন
												</button>
											</a>
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
<?php
	include_once('footer.php');
?>