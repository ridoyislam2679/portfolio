<?php 
	include_once("header.php");
	
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	if($page < 1) $page = 10;
	
	$itemperpage = 1;
	$offset = ($page-1)*$itemperpage;
	
	if(isset($_GET['name'])){
		$status = $_GET['name'];
		$sql = "SELECT * FROM articles WHERE status = ? ORDER BY created_at";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$status]);
	}else{
		$sql = "SELECT * FROM articles ORDER BY created_at DESC LIMIT $itemperpage OFFSET $offset";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}
	
	
?>
    <!-- Main Content -->
    <div class="ug-main-container">
        <div class="container">
            <div class="row">
                <!-- Left Content - User Guide Posts -->
                <div class="col-lg-8">
                    <div class="ug-posts-container">
						<?php 
							
							while($row = $stmt->fetch()){
								?>
									<div class="ug-post-card">
										<div class="ug-post-img">
											<img src="images/article/<?php echo $row['image']; ?>" alt="How to Check a Used Phone">
										</div>
										<div class="ug-post-body">
											<h3 class="ug-post-title"><?php echo $row['title']; ?></h3>
											<p class="ug-post-desc"><?php echo $row['content']; ?></p>
											<div class="ug-post-meta">
												<span><i class="far fa-calendar-alt me-1"></i> <?php echo $row['created_at']; ?></span>
												<a href="user-gied-details/<?php echo str_replace(" ", "-", $row['title']); ?>" class="btn btn-primary btn-sm">View Details</a>
											</div>
										</div>
									</div>
								<?php
							}
						?>
						
                        <!-- Pagination -->
						<?php 
							$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
							if($page < 1) $page = 1;
							
							//$page_number = $_GET['page']; 
							//$current_url = $_SERVER['REQUEST_URI'];
							
							$countSql = "SELECT COUNT(*) FROM articles";
							$stmt = $pdo->prepare($countSql);
							$stmt->execute();
							$totalevents = $stmt->fetchColumn();

							$totalPages = ceil($totalevents / $itemperpage);
						
							$baseUrl = "user-gied";
						?>
						<?php if($totalPages > 1): ?>
						
						<nav aria-label="Mobile pagination" class="mt-4">
							<ul class="pagination justify-content-center">

								<!-- Previous Button -->
								<li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
									<a class="page-link" href="<?= $baseUrl ?>?page=<?= $page - 1 ?>">Previous</a>
								</li>

								<!-- Page Numbers -->
								<?php for ($i = 1; $i <= $totalPages; $i++): ?>
									<li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
										<a class="page-link" href="<?= $baseUrl ?>?page=<?= $i ?>"><?= $i ?></a>
									</li>
								<?php endfor; ?>

								<!-- Next Button -->
								<li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
									<a class="page-link" href="<?= $baseUrl ?>?page=<?= $page + 1 ?>">Next</a>
								</li>
							</ul>
						</nav>
						<?php endif; ?>
						
                    </div>
                    
                    <!-- New Phones List -->
                    <div class="ug-phone-list">
                        <h3 class="mb-4">Latest New Phones</h3>
                        <?php 
							$sql = "SELECT model_name, main_image, price FROM mobiles WHERE status = ? ORDER BY release_date DESC LIMIT 10";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['New']);
							
							while($row = $stmt->fetch()){
								?>
									<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="ug-phone-card text-decoration-none">
										<div class="ug-phone-img">
											<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>" width="40">
										</div>
										<div class="ug-phone-info">
											<h5 class="ug-phone-name"><?php echo $row['model_name']; ?></h5>
											<div class="ug-phone-price">৳<?php echo $row['price']; ?></div>
										</div>
										<i class="fas fa-chevron-right text-muted"></i>
									</a>
								<?php
							}
						?>
                        
                        <div class="text-center mt-4">
                            <a href="new-phones/" class="btn btn-outline-primary">View All New Phones</a>
                        </div>
                    </div>
                </div>
                
                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <!-- Used Phones List -->
                    <div class="ug-sidebar-section">
                        <div class="ug-sidebar-header">
                            <h4 class="mb-0">Best Used Phones</h4>
                        </div>
                        <div class="ug-sidebar-body">
							<?php 
								$sql = "SELECT model_name, main_image, price FROM mobiles WHERE status = ? ORDER BY release_date DESC LIMIT 10";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['pre-owned']);
								
								while($row = $stmt->fetch()){
									?>
										<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="ug-phone-card text-decoration-none">
											<div class="ug-phone-img">
												<img src="images/used/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>" width="40">
											</div>
											<div class="ug-phone-info">
												<h5 class="ug-phone-name"><?php echo $row['model_name']; ?></h5>
												<div class="ug-phone-price">৳<?php echo $row['price']; ?></div>
											</div>
											<i class="fas fa-chevron-right text-muted"></i>
										</a>										
									<?php
								}
							?>
                            <div class="text-center mt-3">
                                <a href="pre-owned-phone/" class="btn btn-outline-primary btn-sm">View All Used Phones</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Brands List -->
                    <div class="ug-sidebar-section">
                        <div class="ug-sidebar-header">
                            <h4 class="mb-0">Popular Brands</h4>
                        </div>
                        <div class="ug-sidebar-body">
                            <!-- Brand 1 -->
							<?php 
								$sql = "SELECT * FROM brands ORDER BY brand_name ASC LIMIT 10;";
								$stmt = $pdo->prepare($sql);
								$stmt->execute();
								
								while($brand = $stmt->fetch()){
									?>
										<a href="brands/<?php echo $brand['brand_name']; ?>" class="ug-brand-item text-decoration-none">
											<div class="ug-brand-img">
												<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?>" width="20">
											</div>
											<span><?php echo $brand['brand_name']; ?></span>
										</a>
									<?php 
								}
							?>
                            
                            <div class="text-center mt-3">
                                <a href="brands/" class="btn btn-outline-primary btn-sm">View All Brands</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
	include_once("footer.php");
?>