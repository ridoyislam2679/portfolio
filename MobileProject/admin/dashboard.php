<?php 
	include_once('header.php');
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	$stmt = $pdo->prepare("SELECT COUNT(*) as mobile_id FROM mobiles");
	$stmt->execute();
	$mobile = $stmt->fetch();

	$stmt = $pdo->prepare("SELECT COUNT(*) as brand_id FROM brands");
	$stmt->execute();
	$brand = $stmt->fetch();
	
	$stmt = $pdo->prepare("SELECT COUNT(*) as article_id FROM articles");
	$stmt->execute();
	$article = $stmt->fetch();
	
	$stmt = $pdo->prepare("SELECT COUNT(*) as FAQ_id FROM mobile_faq");
	$stmt->execute();
	$faq = $stmt->fetch();
	
	$sql = "SELECT model_name, main_image, price, status FROM mobiles ORDER BY created_at DESC LIMIT 10";
	$list = $pdo->prepare($sql);
	$list->execute();
?>
   

        <!-- Dashboard Stats -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card mobile-stat">
                    <div class="stat-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="mb-1"><?php echo $mobile['mobile_id']; ?></h3>
                        <p class="mb-0 text-muted">Total Mobiles</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card brands-stat">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="mb-1"><?php echo $brand['brand_id']; ?></h3>
                        <p class="mb-0 text-muted">Total Brands</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card articles-stat">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="mb-1"><?php echo $article['article_id']; ?></h3>
                        <p class="mb-0 text-muted">Total Articles</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="stat-card faqs-stat">
                    <div class="stat-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="mb-1"><?php echo $faq['FAQ_id']; ?></h3>
                        <p class="mb-0 text-muted">Total FAQs</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Mobiles Table -->
        <div class="recent-mobiles">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <h2 class="mb-3 mb-md-0">Recently Added Mobiles</h2>
                <button class="btn btn-primary">
					<a href="add_mobile.php" class="add_mobile">
						<i class="fas fa-plus me-2"></i> Add New Mobile
					</a>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mobile Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php 
							while($row = $list->fetch()){
								$basePath = $row['status'] === 'New' ? '../images/new/' : 'images/used/';
								$mainImage = $basePath . $row['main_image'];
								?>
								<tr>
									<td><?php echo $row['model_name']; ?></td>
									<td><span class="status active"><?php echo $row['status']; ?></span></td>
									<td><img src="../images/<?php echo $mainImage; ?>" alt="iPhone" class="mobile-img"></td>
									<td><?php echo $row['price']; ?>৳</td>
									<td>
										<div class="d-flex gap-2">
											<button class="action-btn edit-btn">
												<i class="fas fa-edit"></i>
											</button>
											<button class="action-btn delete-btn">
												<i class="fas fa-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<?php
							}
						?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php 
	include_once('footer.php');
?>
   