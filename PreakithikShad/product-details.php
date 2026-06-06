<?php 
	ob_start();
	include_once('db/index.php');
	
	if(!isset($_GET['productName'])){
		header('location: index.php');
		exit;
	}
	
	$productName = $_GET['productName'];
	include_once('header.php');
	
	$select = "SELECT * FROM products WHERE product_name = ?"; 
	$stmt = $pdo->prepare($select);
	$stmt->execute([$productName]);
	$product = $stmt->fetch();
	
	$oldPrice = $product['old_price'];
	$newPrice = $product['product_price'];
	$percentLess = abs((($oldPrice - $newPrice) / $oldPrice) * 100);
	
	$catId = $product['categories_id'];
	$id = $product['product_id'];
	
	$select = "SELECT * FROM image WHERE product_id = ?"; 
	$stmt = $pdo->prepare($select);
	$stmt->execute([$id]);
	
?>
    <!-- Product Details Section -->
    <section class="product-details-container">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6">
                    <div class="product-image-slider">
                        <img id="main-image" src="assets/<?php echo $product['image']; ?>" class="product-image w-100" alt="খেজুর গুড়">
                    </div>
                    <div class="thumbnail-container d-flex">
						<?php
							while($pImage = $stmt->fetch()){
								?>
								<img src="assets/<?php echo $pImage['image']; ?>" class="thumbnail active" onclick="changeImage(this)" alt="খেজুর গুড় ১">
								<?php
							}
						?>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h1 class="product-title"><?php echo $product['product_name']; ?> </h1>
                        <p class="product-description"> <?php echo $product['product_dsc']; ?> </p>
                        <div class="price-container">
                            <span class="current-price"><?php echo $newPrice; ?> টাকা</span>
                            <span class="regular-price"><?php echo $oldPrice; ?>  টাকা</span>
                            <span class="discount-badge"><?php echo $percentLess; ?> % ছাড়</span>
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn btn-cart"><i class="fas fa-shopping-cart me-2"></i>কার্টে যোগ করুন</button>
                            <button class="btn btn-order" data-bs-toggle="modal" data-bs-target="#orderModal"><i class="fas fa-bolt me-2"></i>অর্ডার করুন</button>
                        </div>
                        
                        <div class="product-features">
                            <h4 class="mb-4">পণ্যের বিশেষত্ব</h4>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div>
                                    <h5>দ্রুত ডেলিভারি</h5>
                                    <p class="mb-0">অর্ডার করলে ২৪ ঘন্টার মধ্যে ডেলিভারি</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h5>নিরাপদ পেমেন্ট</h5>
                                    <p class="mb-0">সুরক্ষিত পেমেন্ট গেটওয়ে</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div>
                                    <h5>১০০% প্রাকৃতিক</h5>
                                    <p class="mb-0">কোন রাসায়নিক বা প্রিজারভেটিভ নেই</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <h5>২৪/৭ সাপোর্ট</h5>
                                    <p class="mb-0">যোগাযোগ: +৮৮০ ১৭১২ ৩৪৫৬৭৮</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<!-- Order Modal -->
    <div class="modal fade order-modal" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel"><i class="fas fa-shopping-cart me-2"></i>পণ্য অর্ডার করুন</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product Information -->
                    <div class="order-product-info">
                        <img src="assets/anaros.avif" class="order-product-image" alt="খেজুর গুড়">
                        <div class="order-product-details">
                            <h5 class="order-product-title">খেজুর গুড় (প্রিমিয়াম কোয়ালিটি)</h5>
                            <div class="order-product-price">৩৫০ টাকা</div>
                        </div>
                    </div>
                    
                    <!-- Quantity Selection -->
                    <div class="mb-4">
                        <label class="form-label">পরিমাণ নির্বাচন করুন</label>
                        <div class="quantity-control">
                            <button class="quantity-btn" id="decrease-qty"><i class="fas fa-minus"></i></button>
                            <input type="number" class="quantity-input" id="quantity" value="1" min="1">
                            <button class="quantity-btn" id="increase-qty"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="payment-options">
                        <label class="form-label">পেমেন্ট পদ্ধতি নির্বাচন করুন</label>
                        
                        <div class="payment-card selected" id="cash-on-delivery">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paymentCOD" value="cash_on_delivery" checked>
                                <label class="form-check-label d-flex align-items-center" for="paymentCOD">
                                    <i class="fas fa-money-bill-wave payment-icon"></i>
                                    <div>
                                        <h6 class="mb-0">ক্যাশ অন ডেলিভারি</h6>
                                        <small>পণ্য হাতে পেয়ে তারপর পেমেন্ট করুন</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="payment-card" id="online-payment">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paymentOnline" value="online_payment">
                                <label class="form-check-label d-flex align-items-center" for="paymentOnline">
                                    <i class="fas fa-credit-card payment-icon"></i>
                                    <div>
                                        <h6 class="mb-0">অনলাইন পেমেন্ট</h6>
                                        <small>কার্ড/মোবাইল ব্যাংকিং/বিকাশ</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Details Form -->
                    <div class="user-details-form">
                        <h5 class="mb-3">আপনার তথ্য দিন</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customerName" class="form-label">নাম *</label>
                                <input type="text" class="form-control" id="customerName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customerPhone" class="form-label">ফোন নম্বর *</label>
                                <input type="tel" class="form-control" id="customerPhone" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="customerAddress" class="form-label">ঠিকানা *</label>
                                <textarea class="form-control" id="customerAddress" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customerEmail" class="form-label">ইমেইল</label>
                                <input type="email" class="form-control" id="customerEmail">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customerCity" class="form-label">শহর *</label>
                                <input type="text" class="form-control" id="customerCity" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h5 class="mb-3">অর্ডার সারাংশ</h5>
                        
                        <div class="summary-item">
                            <span>পণ্যের মূল্য</span>
                            <span id="product-amount">৩৫০ টাকা</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>ডেলিভারি চার্জ</span>
                            <span id="delivery-charge">৫০ টাকা</span>
                        </div>
                        
                        <div class="total-price">
                            <span>মোট অর্থপ্রদান</span>
                            <span id="total-amount">৪০০ টাকা</span>
                        </div>
                    </div>
                    
                    <!-- Confirm Order Button -->
                    <button class="btn btn-confirm" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                        <i class="fas fa-check-circle me-2"></i>অর্ডার নিশ্চিত করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="confirmationModalLabel"><i class="fas fa-check-circle me-2"></i>অর্ডার সফল</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="success-animation">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="text-success">আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে!</h4>
                    <p class="mb-0">আমাদের representative শীঘ্রই আপনার সাথে যোগাযোগ করবে।</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                    <button type="button" class="btn btn-success">অর্ডার ট্র্যাক করুন</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="related-products bg-light">
        <div class="container">
            <h2 class="section-title">সম্পর্কিত পণ্য</h2>
            <div class="row">
				<?php
					$select = "SELECT * FROM products WHERE categories_id = ? AND product_id != ? ORDER BY product_price DESC LIMIT 8"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute([$catId, $id]);
					$relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if(empty($relatedProducts)){
						$select = "SELECT * FROM products ORDER BY product_price DESC LIMIT 8"; 
						$stmt = $pdo->prepare($select);
						$stmt->execute();
						$relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
					}
					
					foreach($relatedProducts as $relatedProduct){
						?>
							<div class="col-lg-3 col-md-4 col-6 mb-4">
								<a href="product-details.php?productName=<?php echo $relatedProduct['product_name']; ?>"  class="product-card-link">
									<div class="product-card card h-100">
										<img src="assets/<?php echo htmlspecialchars($relatedProduct['image']); ?>" class="product-img card-img-top" alt="<?php echo htmlspecialchars($relatedProduct['image']); ?>">
										<div class="card-body">
											<h5 class="product-title card-title"><?= htmlspecialchars($relatedProduct['product_name']); ?></h5>
											<div class="mb-2">
												<span class="product-price"><?= $relatedProduct['product_price']; ?> টাকা</span>
											</div>
											<button class="add-to-cart btn">কার্টে যোগ করুন</button>
										</div>
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
	
<?php
	include_once('footer.php');
?>