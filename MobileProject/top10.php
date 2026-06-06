<?php 
	include_once("header.php");
	
	if(!isset($_GET['slug']) || empty($_GET['slug'])) {
		header("location:$base/index");
		exit;
	}
	
	if (isset($_GET['slug'])) {
		$slug = $_GET['slug']; 
		
		// Regex দিয়ে সংখ্যা বের করি
		$slug = str_replace("-", " ", $_GET['slug']); 
		// "Top 10 Mobile Phone Under 13000 in BD"

		if (preg_match_all('/\d+/', $slug, $matches)) {
			$numbers = $matches[0];  
			$price = (int) end($numbers); // শেষ সংখ্যা = 13000
			//echo $price;
		} else {
			$price = 20000; // fallback
		}
	}
?>
    <!-- Main Content -->
    <section class="top-phones-section">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <!-- New Phones Section -->
					<?php 
						$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE CAST(REPLACE(REPLACE(REPLACE(price, ',', ''), '৳', ''), '$', '') AS UNSIGNED) <= ? ORDER BY release_date DESC LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute([$price]);
						$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if($rows && count($rows) > 0): 					
					?>
                    <div class="phone-section">
                        <div class="section-title-bar">
                            <h2 class="section-title"><?php echo $slug; ?></h2>
                        </div>
                        
                        <div class="row">
                            <!-- Phone 1 -->
							<?php 
								foreach($rows as $row){
									?>
										<div class="col-6 col-md-4 col-lg-4 mb-4">
											<div class="card phone-card">
												<div class="badge bg-success position-absolute m-2"><?php echo $row['status']; ?></div>
												<div class="phone-img-container">
													<?php if($row['status'] == "New"): ?>
													<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
													<?php else: ?>
													<img src="images/used/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
													<?php endif; ?>
												</div>
												<div class="card-body text-center">
													<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
													<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
													<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">Details</a>
												</div>
											</div>
										</div>
									<?php
								}								
							?>
                        </div>
                    </div>
                    <?php else: ?>
					<h5 class="no-found"> Not Founded Top <?php echo $price; ?> Price Phone Right Now.</h5>
					
					<!-- Pre-Owned Phones Section -->
                    <div class="phone-section">
                        <div class="section-title-bar">
                            <h2 class="section-title">Availbe Phones</h2>
                            <a href="pre-owned-phone/" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        
                        <div class="row">
                            <!-- Phone 1 -->
							<?php 
								$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY release_date DESC LIMIT 10";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['new']);
								
								while($row = $stmt->fetch()){
									?>
										<div class="col-6 col-md-4 col-lg-4">
											<div class="card phone-card mt-4">
												<span class="badge bg-success position-absolute top-0 start-0 m-2"><?php echo $row['status']; ?></span>
												<div class="phone-img-container">
													<?php if($row['status'] == "New"): ?>
													<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
													<?php else: ?>
													<img src="images/used/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
													<?php endif; ?>
												</div>
												<div class="card-body text-center">
													<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
													<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
													<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">Details</a>
												</div>
											</div>
										</div>
									<?php
								}
							?>
                        </div>
                    </div>
					
                    <?php endif; ?>
					
                </div>
                
                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <!-- Top Brands Section -->
                    <div class="card sidebar-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Top Brands</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
								<?php 
									$sql = "SELECT * FROM brands ORDER BY brand_name ASC LIMIT 10;";
									$stmt = $pdo->prepare($sql);
									$stmt->execute();
									
									while($brand = $stmt->fetch()){
										?>
											<a href="brands/<?php echo $brand['brand_name']; ?>/" class="brand_link">
												<li class="brand-item">
													<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?>">
													<span><?php echo $brand['brand_name']; ?></span>
												</li>
											</a>
										<?php 
									}
								?>
                            </ul>
                            <a href="brands/" class="btn btn-outline-primary w-100 mt-2">View All Brands</a>
                        </div>
                    </div>
                    
                    <!-- User Guides Section -->
                    <div class="card sidebar-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">User Guides</h5>
                        </div>
                        <div class="card-body">
							<?php 
								$sql = "SELECT * FROM articles ORDER BY created_at LIMIT 7;";
								$stmt = $pdo->prepare($sql);
								$stmt->execute();
								
								while($article = $stmt->fetch()){
									$content = $article['content'];
									$length = strlen($content);
									
									if(strlen($length > 100 )){
										$dsc = substr($content, 0, 90);
										$content = $dsc.'...';						
									}
									?>
										<div class="guide-item">
											<a href="user-gied-details/<?php echo str_replace(" ", "-", $article['title']); ?>/" class="guide_link"> <h6 class="guide-title"><?php echo $article['title']; ?></h6> </a>
											<div class="guide-meta"><?php echo $content; ?></div>
										</div>
									<?php
								}
							?>
                            <a href="user-gied/" class="btn btn-outline-primary w-100 mt-2">View All Guides</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
	include_once("footer.php");
?>