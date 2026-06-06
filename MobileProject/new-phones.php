<?php 
	include_once("header.php");
?>

    <!-- Main Content -->
    <section class="top-phones-section">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <!-- New Phones Section -->
                    <div class="phone-section">
                        <div class="section-title-bar">
                            <h2 class="section-title">New Phones List</h2>
                        </div>
                        
                        <div class="row">
                            <!-- Phone 1 -->
							<?php 
								$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
								if($page < 1) $page = 1;
								
								$itemperpage = 10;
								$offset = ($page-1)*$itemperpage;
							
								$sql = "SELECT model_name, main_image, price FROM mobiles WHERE status = ? ORDER BY created_at DESC LIMIT $itemperpage OFFSET $offset";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['New']);
								
								while($row = $stmt->fetch()){
									?>
										<div class="col-6 col-md-4 col-lg-4 mb-4">
											<div class="card phone-card">
												<div class="phone-img-container">
													<img src="images/new/<?php echo $row['main_image']; ?>" alt="<?php echo $row['model_name']; ?>">
												</div>
												<div class="card-body text-center">
													<h5 class="card-title"><?php echo $row['model_name']; ?></h5>
													<p class="card-text text-primary fw-bold">৳<?php echo $row['price']; ?></p>
													<a href="phone-details/<?php echo str_replace(" ", "-", $row['model_name']); ?>" class="btn btn-primary" class="btn btn-primary btn-sm">Details</a>
												</div>
											</div>
										</div>
									<?php
								}
							?>
                        </div>
						
						<!-- Pagination -->
						<?php 
							$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
							if($page < 1) $page = 1;
							
							//$page_number = $_GET['page']; 
							//$current_url = $_SERVER['REQUEST_URI'];
							
							$status = 'New';
							$countSql = "SELECT COUNT(*) FROM mobiles WHERE status = :status";
							$stmt = $pdo->prepare($countSql);
							$stmt->execute([':status' => $status]);
							$totalevents = $stmt->fetchColumn();

							$totalPages = ceil($totalevents / $itemperpage);

						
							$baseUrl = "new-phones";
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
														<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?>" class="img-fluid mb-2" style="height: 30px;">
														<h6 class="mb-0"><?php echo $brand['brand_name']; ?></h6>
													</div>
												</a>
											</div>
										<?php
									}
								?>
							</div>
							<a href="brands/" class="btn btn-primary w-100 mt-4">View All Brands</a>
						</div>
					</section>
					
                </div>
                
                <!-- Right Sidebar -->
                <div class="col-lg-4">
                    <!-- Pre-Owned Phones Section -->
                    <div class="phone-section">
                        <div class="section-title-bar">
                            <h2 class="section-title">Top Pre-Owned Phones</h2>
                            <a href="pre-owned-phone/" class="btn btn-primary btn-sm">View All</a>
                        </div>
                        
                        <div class="row">
                            <!-- Phone 1 -->
							<?php 
								$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY created_at DESC LIMIT 10";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['pre-owned']);
								
								while($row = $stmt->fetch()){
									?>
										<div class="col-6 col-md-6 col-lg-6 mb-4">
											<div class="card phone-card">
												<span class="badge bg-success position-absolute top-0 start-0 m-2"><?php echo $row['status']; ?></span>
												<div class="phone-img-container">
													<img src="images/used/<?php echo $row['main_image']; ?>" alt="Samsung Galaxy S21">
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
                    <!-- User Guides Section -->
                    <div class="card sidebar-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">User Guides</h5>
                        </div>
                        <div class="card-body">
                            <?php 
								$sql = "SELECT * FROM articles ORDER BY created_at DESC LIMIT 7;";
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
											<a href="user-gied-details/<?php echo str_replace(" ", "-", $article['title']); ?>" class="guide_link"> <h6 class="guide-title"><?php echo $article['title']; ?></h6> </a>
											<div class="guide-meta"><?php echo $content; ?></div>
										</div>
									<?php
								}
							?>
                            <a href="user-gied/" class="btn btn-outline-primary w-100 mt-4">View All Guides</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
	include_once("footer.php");
?>