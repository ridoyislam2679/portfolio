<?php 
	include_once('header.php');

    if ($_SERVER['REQUEST_URI'] === '/index' || $_SERVER['REQUEST_URI'] === '/index.php') {
        header("Location: /");
        exit;
    }

	
	$sql = "SELECT brand_name FROM brands";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
?>
    <!-- Hero Section -->
    <header class="hero-section bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Quality Pre-Owned Mobiles</h1>
            <p class="lead mb-4">Find the perfect used smartphone at unbeatable prices</p>
            <a href="pre-owned-phone/" class="btn btn-primary btn-lg px-4">Browse Phones</a>
        </div>
    </header>

    <!-- Search Filters -->
	<section class="search-filters py-4 bg-white">
		<div class="container">
			<form method="POST" action="" class="search-form">
				<div class="row g-3 align-items-end">
					<!-- Price Range -->
					<div class="col-md-3">
						<label for="price-range" class="form-label">Price Range</label>
						<select class="form-select" id="price-range" name="price_range">
							<option value="0-10000">Under ৳10,000</option>
							<option value="10000-15000">৳10,000 - ৳15,000</option>
							<option value="15000-20000">৳15,000 - ৳20,000</option>
							<option value="20000-25000">৳20,000 - ৳25,000</option>
							<option value="25000-30000">৳25,000 - ৳30,000</option>
							<option value="30000-999999">Over ৳30,000</option>
						</select>
					</div>
					
					<!-- Brand -->
					<div class="col-md-3">
						<label for="brand" class="form-label">Brand</label>
						<select class="form-select" id="brand" name="brand">
							<?php 
								while($row = $stmt->fetch()){
									echo "<option value='{$row['brand_name']}' selected>{$row['brand_name']}</option>";
								}
							?>
						</select>
					</div>
					
					<!-- Condition -->
					<div class="col-md-3">
						<label for="condition" class="form-label">Condition</label>
						<select class="form-select" id="condition" name="condition">
							<option value="New" selected>New Phones</option>
							<option value="Pre-Owned">Pre-Owned Phones</option>
						</select>
					</div>
					
					<!-- Submit Button -->
					<div class="col-md-3">
						<button type="submit" class="btn btn-primary w-100 py-2" name="searchBtn">
							<i class="fas fa-search me-2"></i> Search Phones
						</button>
					</div>
				</div>
			</form>
		</div>
	</section>
	
	<?php 
		if (isset($_POST['searchBtn'])) {
    $price_range = $_POST['price_range'];
    $brand = $_POST['brand'];
    $condition = $_POST['condition'];

    list($min_price, $max_price) = explode('-', $price_range);

    $sql = "SELECT model_name, main_image, price, status, brand_name 
            FROM mobiles
            INNER JOIN brands ON mobiles.brand_id = brands.brand_id
            WHERE price BETWEEN ? AND ? 
            AND brand_name = ? 
            AND status = ?
            GROUP BY model_name, brand_name"; // duplicate বাদ দিতে GROUP BY

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$min_price, $max_price, $brand, $condition]);
    $phones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($phones) {
		?>
		<div class="container">
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h2 class="section-title mb-0">Search Results:</h2>
				<a href="pre-owned-phone/" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
			</div>
			<div class="row g-4">
		<?php 
        foreach ($phones as $phone) {
			?>
				<div class="col-6 col-md-4 col-lg-3">
					<div class="card phone-card h-100">
						<div class="badge bg-success position-absolute m-2"><?php echo $phone['status']; ?></div>
						<?php if($phone['status'] == 'New'):?>
						<img src="images/new/<?php echo $phone['main_image']; ?>" class="card-img-top p-3" alt="<?php echo $phone['model_name']; ?>">
						<?php else: ?>
						<img src="images/used/<?php echo $phone['main_image']; ?>" class="card-img-top p-3" alt="<?php echo $phone['model_name']; ?>">
						<?php endif; ?>
						<div class="card-body text-center">
							<h5 class="card-title"><?php echo $phone['model_name']; ?></h5>
							<p class="card-text text-primary fw-bold">৳<?php echo $phone['price']; ?></p>
							<div class="d-grid">
								<a href="phone-details/<?php echo str_replace(" ", "-", $phone['model_name']); ?>" class="btn btn-primary">View Details</a>
							</div>
						</div>
					</div>
				</div>
			<?php
        }
        ?>
			</div>
		</div>
		<?php 
    } else {
        echo "<div class='container py-4'>
                <h5 class='text-danger'>❌ No phones found.</h5>
              </div>";
    }
}
	?>
	
    <!-- Popular Price Ranges -->
    <section class="price-ranges py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-4">Popular Price Ranges</h2>
            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 5000 to 10000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">৳5k - ৳10k</h5>
                        </div>
                    </a>
                </div>
                <!-- Repeat for other price ranges -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 10000 to 15000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">৳10k - ৳15k</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 15000 to 20000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">৳15k - ৳20k</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 20000 to 25000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">৳20k - ৳25k</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 25000 to 30000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">৳25k - ৳30k</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="top-phones/<?php echo str_replace(" ", "-", "top 10 phone between 30000 to 1000000"); ?>" class="price-card card text-center text-decoration-none h-100">
                        <div class="card-body">
                            <i class="fas fa-money-bill-wave text-success mb-2 fs-3"></i>
                            <h5 class="mb-0">Over ৳30k</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest New Phones -->
    <section id="featured" class="featured-phones py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Latest New Phones</h2>
                <a href="new-phones/" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-4">
                <!-- Phone Card 1 -->
				
				<?php 
					$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY release_date DESC LIMIT 10";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['New']);
					
					while($row = $stmt->fetch()){
						?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="card phone-card h-100">
									<div class="badge bg-success position-absolute m-2"><?php echo $row['status']; ?></div>
									<img src="images/new/<?php echo $row['main_image']; ?>" class="card-img-top p-3" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body text-center">
										<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
										<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
										<div class="d-grid">
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary">View Details</a>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
					
				?>
            </div>
        </div>
    </section>
	
	<!-- Latest Upcoming Phones -->
    <section id="featured" class="featured-phones py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Latest Upcoming Phones</h2>
                <a href="upcoming-phones/" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-4">
                <!-- Phone Card 1 -->
				
				<?php 
					$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY created_at DESC LIMIT 10";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['Upcoming']);
					
					while($row = $stmt->fetch()){
						?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="card phone-card h-100">
									<div class="badge bg-success position-absolute m-2"><?php echo $row['status']; ?></div>
									<img src="images/new/<?php echo $row['main_image']; ?>" class="card-img-top p-3" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body text-center">
										<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
										<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
										<div class="d-grid">
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary">View Details</a>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
					
				?>
            </div>
        </div>
    </section>
	
	<!-- Pre-Owned Phones -->
    <section id="featured" class="featured-phones py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Pre-Owned Phones</h2>
                <a href="pre-owned-phone/" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-4">
                <!-- Phone Card 1 -->
				
				<?php 
					$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY release_date DESC LIMIT 10";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['pre-owned']);
					
					while($row = $stmt->fetch()){
						?>
							<div class="col-6 col-md-4 col-lg-3">
								<div class="card phone-card h-100">
									<div class="badge bg-success position-absolute m-2"><?php echo $row['status']; ?></div>
									<img src="images/used/<?php echo $row['main_image']; ?>" class="card-img-top p-3" alt="<?php echo $row['model_name']; ?>">
									<div class="card-body text-center">
										<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
										<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
										<div class="d-grid">
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary">View Details</a>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
					
				?>
            </div>
        </div>
    </section>

    <!-- Popular Brands -->
    <section class="popular-brands py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Popular Brands</h2>
                <a href="brands/" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
				<?php 
					$sql = "SELECT * FROM brands ORDER BY brand_name ASC LIMIT 10;";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					
					while($brand = $stmt->fetch()){
						?>
							<div class="col-4 col-md-3 col-lg-2">
								<a href="brands/<?php echo $brand['brand_name']; ?>" class="brand-card card text-center text-decoration-none h-100">
									<div class="card-body py-4">
										<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?> | mobilereviewbd" class="img-fluid mb-2" style="height: 30px;">
										<h5 class="mb-0"><?php echo $brand['brand_name']; ?></h5>
									</div>
								</a>
							</div>
						<?php
					}
				?>
            </div>
        </div>
    </section>

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

    <!-- About Section -->
    <section class="about-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="images/mobilereviewbd-about-poster.jpg" alt="About Mobile Bazaar" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2 class="section-title mb-3">About Mobilereviewbd.com</h2>
                    <p class="lead">
                         MobileReviewBD is one of the trusted mobile information sites in Bangladesh. We collect the latest news, reviews, prices, and details of new and used phones pre owned phones from reliable sources and share them with readers in a clear and simple way.
                    </p>
                    <p>We started our journey on October 6, 2025, for the mobile and tech lovers of Bangladesh. We regularly post reviews on our website, YouTube, and Facebook to help people choose the right phone based on real experience.
                    </p>
                    <p>Our team consists of below team members with 5 years of experience.</p>
                    <a href="about-us" class="btn btn-primary mt-3">Learn More</a>
                </div>
            </div>
        </div>
    </section>
<?php
	include_once("footer.php");
?>