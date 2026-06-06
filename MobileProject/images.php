<?php 
	include_once('header.php');
?>

    <!-- Main Gallery Section -->
    <div class="gallery-section">
        <div class="container">
			<div class="custom-card">
				<!-- Featured Images Section -->
				<div class="gallery-section-title">
					<h2>New Mobile Phone Images</h2>
				</div>
				<div class="row p-4">
					<?php 
						$sql = "SELECT mobile_id, model_name, main_image FROM mobiles WHERE status = ? ORDER BY release_date";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['new']);
						
						while($row = $stmt->fetch()){
							?>
								<div class="col-6 col-md-4 col-lg-3">
									<div class="img-zoom-container">
										<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['mobile_id']; ?>">
											<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
										</a>
										<div class="img-caption">
											<h5> <?php echo $row['model_name']; ?> </h5>
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">View Details</a>
										</div>
									</div>
								</div>
								
								<!-- Modal -->
								<div class="modal fade" id="imageModal<?php echo $row['mobile_id']; ?>" tabindex="-1" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg">
										<div class="modal-content">
											<div class="modal-body p-0">
												<img src="images/new/<?php echo $row['main_image']; ?>" class="img-fluid w-100" alt="<?php echo $row['model_name']; ?>">
											</div>
										</div>
									</div>
								</div>
								
							<?php
						}
					?>
				</div>
			</div>
			
			<div class="custom-card">
				<!-- Featured Images Section -->
				<div class="gallery-section-title">
					<h2>Pre-Owned Mobile Phone Images</h2>
				</div>
				<div class="row p-4">
					<?php 
						$sql = "SELECT mobile_id, model_name, main_image FROM mobiles WHERE status = ? ORDER BY created_at";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['pre-owned']);
						
						while($row = $stmt->fetch()){
							?>
								<div class="col-6 col-md-4 col-lg-3">
									<div class="img-zoom-container">
										<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['mobile_id']; ?>">
											<img src="images/used/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
										</a>
										<div class="img-caption">
											<h5> <?php echo $row['model_name']; ?> </h5>
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">View Details</a>
										</div>
									</div>
								</div>
								
								<!-- Modal -->
								<div class="modal fade" id="imageModal<?php echo $row['mobile_id']; ?>" tabindex="-1" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg">
										<div class="modal-content">
											<div class="modal-body p-0">
												<img src="images/used/<?php echo $row['main_image']; ?>" class="img-fluid w-100" alt="<?php echo $row['model_name']; ?>">
											</div>
										</div>
									</div>
								</div>
								
							<?php
						}
					?>
				</div>
			</div>
            
            <!-- New Phones Section -->
            <div class="phone-list-section">
                <div class="gallery-section-title">
                    <h2>Top New Phones</h2>
                </div>
                <div class="row p-4">
                    <!-- Phone 1 -->
					<?php 
						$sql = "SELECT model_name, main_image, price FROM mobiles WHERE status = ? ORDER BY created_at LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['New']);
						
						while($row = $stmt->fetch()){
							?>
								<div class="col-6 col-md-3 mb-4">
									<div class="phone-card">
										<div class="phone-img">
											<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
										</div>
										<div class="phone-body">
											<h5><?php echo $row['model_name']; ?></h5>
											<div class="phone-price">৳<?php echo $row['price']; ?></div>
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">View Details</a>
										</div>
									</div>
								</div>
							<?php
						}
					?>
                </div>
				<!-- View All Button -->
				<div class="text-center mt-5">
					<a href="new-phones/" class="btn btn-outline-primary btn-lg brands-view-all">
						<i class="fas fa-list me-2"></i> View All New Phones
					</a>
				</div>
            </div>
            
            <!-- Pre-Owned Phones Section -->
            <div class="phone-list-section">
                <div class="gallery-section-title">
                    <h2>Top Pre-Owned Phones</h2>
                </div>
                <div class="row p-4">
                    <!-- Phone 1 -->
					<?php 
						$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY created_at LIMIT 10";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['pre-owned']);
						
						while($row = $stmt->fetch()){
							?>
								<div class="col-6 col-md-3">
									<div class="phone-card">
										<span class="badge bg-success position-absolute m-2"><?php echo $row['status']; ?></span>
										<div class="phone-img">
											<img src="images/used/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
										</div>
										<div class="phone-body">
											<h5><?php echo $row['main_image']; ?></h5>
											<div class="phone-price">৳<?php echo $row['price']; ?></div>
											<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary btn-sm">View Details</a>
										</div>
									</div>
								</div>
							<?php 
						}
					?>
				<!-- View All Button -->
				<div class="text-center mt-5">
					<a href="pre-owned-phone" class="btn btn-outline-primary btn-lg brands-view-all">
						<i class="fas fa-list me-2"></i> View All Pre-Owned Phones
					</a>
				</div>
            </div>
            
            <!-- Brands Section -->
            <div class="gallery-section-title">
                <h2>Top Popular Brands</h2>
            </div>
            <div class="row p-4">
				<?php 
					$sql = "SELECT * FROM brands ORDER BY brand_name ASC LIMIT 10;";
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					
					while($brand = $stmt->fetch()){
						?>
							<div class="col-6 col-md-3 col-lg-2">
								<a href="brands/<?php echo $brand['brand_name']; ?>" class="brand_link">
									<div class="brand-card">
										<div class="brand-img">
											<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="Samsung">
										</div>
										<h5><?php echo $brand['brand_name']; ?></h5>
									</div>
								</a>
							</div>
						<?php
					}
				?>
            </div>
			<!-- View All Button -->
			<div class="text-center mt-5">
				<a href="brands/" class="btn btn-outline-primary btn-lg brands-view-all">
					<i class="fas fa-list me-2"></i> View All Brands
				</a>
			</div>
        </div>
    </div>
<?php 
	include_once('footer.php');
?>