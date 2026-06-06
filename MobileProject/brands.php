<?php 
	include_once('header.php');
?>

    <!-- Main Brands Content Section -->
    <main class="brands-content">
		<?php 
		if(isset($_GET['brand'])):
		$brand = $_GET['brand'];
		?>
		<!-- Latest New Phones -->
        <section class="brand-phones-section py-5 bg-light">
            <div class="container">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">Showing New phones of <?php echo $brand; ?></h2>
                    <a href="new-phones/" class="btn btn-outline-primary">View All</a>
                </div>

                <div class="row g-4">
                    <!-- Phone 1 -->
					<?php
						$sql = "SELECT model_name, main_image, price, status, brand_name FROM mobiles INNER JOIN brands ON mobiles.brand_id = brands.brand_id WHERE brand_name = ? AND status = ? ORDER BY price ASC LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute([$brand, 'New']);
						
						while($row = $stmt->fetch()){
							?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="brand-phone-card card h-100">
									<span class="badge bg-success"><?php echo $row['status']; ?></span>
									<img src="images/new/<?php echo $row['main_image']; ?>" class="card-img-top" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body">
										<h5 class="phone-model"><?php echo $row['model_name']; ?></h5>
										<p class="phone-price text-primary">৳<?php echo $row['price']; ?></p>
										<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-sm btn-primary w-100">Details</a>
									</div>
								</div>
							</div>
							<?php 
						}
					?>
                </div>
            </div>
        </section>
		
		<section class="brand-phones-section py-5 bg-light">
            <div class="container">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">Showing Pre-Owned phones of <?php echo $brand; ?></h2>
                    <a href="pre-owned-phone/" class="btn btn-outline-primary">View All</a>
                </div>

                <div class="row g-4">
                    <!-- Phone 1 -->
					<?php
						$sql = "SELECT model_name, main_image, price, status, brand_name FROM mobiles INNER JOIN brands ON mobiles.brand_id = brands.brand_id WHERE brand_name = ? AND status = ? ORDER BY price ASC LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute([$brand, 'Pre-Owned']);
						
						while($row = $stmt->fetch()){
							?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="brand-phone-card card h-100">
									<span class="badge bg-success"><?php echo $row['status']; ?></span>
									<img src="images/used/<?php echo $row['main_image']; ?>" class="card-img-top" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body">
										<h5 class="phone-model"><?php echo $row['model_name']; ?></h5>
										<p class="phone-price text-primary">৳<?php echo $row['price']; ?></p>
										<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-sm btn-primary w-100">Details</a>
									</div>
								</div>
							</div>
							<?php 
						}
					?>
                </div>
            </div>
        </section>
        
		<?php else:?>
		<!-- Brands Section -->
        <section class="brands-section py-5">
            <div class="container">
                <div class="brands-header text-center mb-5">
                    <h1 class="brands-main-title">Explore Mobile Brands</h1>
                    <p class="brands-subtitle text-muted">Find phones from your favorite manufacturers</p>
                </div>

                <div class="brands-grid row g-4">
                    <!-- Brand 1 -->
					<?php 
						$sql = "SELECT * FROM brands";
						$stmt = $pdo->prepare($sql);
						$stmt->execute();
						
						while($row = $stmt->fetch()){
							?>
								<div class="col-6 col-md-4 col-lg-3">
									<div class="brand-item card h-100 border-0 shadow-sm">
										<div class="brand-img-container p-4">
											<img src="images/brands/<?php echo $row['brand_logo']; ?>" alt="<?php echo $row['brand_name']; ?>" class="brand-logo img-fluid">
										</div>
										<div class="card-body text-center">
											<h3 class="brand-name"><?php echo $row['brand_name']; ?></h3>
											<a href="brands/<?php echo $row['brand_name']; ?>" class="btn btn-sm btn-primary mt-2 brand-btn">View Phones</a>
										</div>
									</div>
								</div>
							<?php 
						}
					?>                    
                </div>				
            </div>
        </section>	
		
		<!-- Latest New Phones -->
        <section class="brand-phones-section py-5 bg-light">
            <div class="container">
                <div class="section-header d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">Top 10 New Phones</h2>
                    <a href="new-phones/" class="btn btn-outline-primary">View All</a>
                </div>

                <div class="row g-4">
                    <!-- Phone 1 -->
					<?php 
						$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY created_at LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['new']);
						
						while($row = $stmt->fetch()){
							?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="brand-phone-card card h-100">
									<span class="badge bg-success"><?php echo $row['status']; ?></span>
									<img src="images/new/<?php echo $row['main_image']; ?>" class="card-img-top" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body">
										<h5 class="phone-model"><?php echo $row['model_name']; ?></h5>
										<p class="phone-price text-primary">৳<?php echo $row['price']; ?></p>
										<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-sm btn-primary w-100">Details</a>
									</div>
								</div>
							</div>
							<?php 
						}
					?>
                </div>
            </div>
        </section>
		
		<?php endif; ?>
		
        <!-- Guides Section -->
		<section class="guides-section py-5">
			<div class="container">
				<h2 class="section-title text-center mb-5">Buying Guides</h2>
				<div class="row g-4">
					<?php 
						$sql = "SELECT * FROM articles ORDER BY created_at LIMIT 3;";
						$stmt = $pdo->prepare($sql);
						$stmt->execute();
						
						while($article = $stmt->fetch()){
							$content = $article['content'];
							$length = strlen($content);
							
							if(strlen($length > 150 )){
								$dsc = substr($content, 0, 140);
								$content = $dsc.'...';						
							}
							
							
							?>
								<div class="col-md-4">
									<div class="card guide-card h-100">
										<img src="images/article/<?php echo $article['image']; ?>" class="card-img-top" alt="Guide 1">
										<div class="card-body">
											<h5 class="card-title"><?php echo $article['title']; ?></h5>
											<p class="card-text"><?php echo $content; ?></p>
											<a href="user-gied-details/<?php echo str_replace(" ", "-", $article['title']); ?>" class="btn btn-outline-primary">Read Guide</a>
										</div>
									</div>
								</div>
							<?php
						}
						
					?>
				</div>
				<a href="user-gied" class="btn btn-primary w-100 mt-2">View All Guides</a>
			</div>
		</section>
    </main>

<?php 
	include_once('footer.php');
?>