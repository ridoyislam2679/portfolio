<?php 
	include_once('db/index.php');
	include_once('header.php');
?>
    <!-- Combo Offers Section -->
    <section class="cmb-section">
        <div class="container">
            <h2 class="combo-section-title">কম্বো প্রোডাক্ট</h2>
            <div class="row">
				<?php 
					$select = "SELECT * FROM products WHERE categories_id = 11"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($combo = $stmt->fetch()){
						$oldPrice = $combo['old_price'];
						$newPrice = $combo['product_price'];
						$percentLess = abs((($oldPrice - $newPrice) / $oldPrice) * 100);
						
						?>
							<div class="col-lg-4 col-md-6 mb-4">
								<div class="combo-card card h-100" onclick="window.location.href='product-details.php?productName=<?php echo $combo['product_name']; ?>'">
									<div class="position-relative">
										<img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="combo-img card-img-top" alt="স্পেশাল কম্বো অফার ১">
										<div class="combo-badge"><?php echo $percentLess ?>% ছাড়</div>
									</div>
									<div class="card-body">
										<h5 class="combo-title"><?php echo $combo['product_name']; ?></h5>
										<p class="combo-products"><?php echo $combo['product_dsc']; ?></p>
										<div class="d-flex align-items-center">
											<span class="combo-price"><?php echo $newPrice; ?> টাকা</span>
											<span class="combo-old-price"><?php echo $oldPrice; ?> টাকা</span>
											<span class="combo-save"><?php echo ($oldPrice-$newPrice); ?> টাকা সাশ্রয়</span>
										</div>
										<a href="add_to_cart.php?id=<?= $combo['product_id'] ?>" class="cart-product-link">
											<button class="add-to-cart btn"> 
											কার্টে যোগ করুন
											</button>
										</a>
										<a href="add_to_cart.php?id=<?= $combo['product_id'] ?>" class="cart-product-link">
											<button class="order-now btn"> 
											অর্ডার করুন
											</button>
										</a>
									</div>
								</div>
							</div>
						<?php
					}
				?>
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
												<button class="add-to-cart btn"> 
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

<?php 
	include_once('footer.php');
?>