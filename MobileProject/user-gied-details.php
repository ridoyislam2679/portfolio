<?php 
	include_once("header.php");
	
	if(!isset($_GET['name']) || empty($_GET['name'])) {
		header("location:$base/index");
		exit;
	}
	$article = trim($_GET['name']); 
	$article = str_replace('-', ' ', $article); // slug থেকে space এ
	
	$sql = "SELECT title, content, image, status, created_at FROM articles WHERE LOWER(title) = LOWER(?)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$article]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
?>
    <!-- Guide Details Content -->
    <section class="guide-details-section">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8">
                    <img src="images/article/<?php echo $row['image'] ?>" alt="<?php $row['image'] ?>" class="guide-main-img">
                    
                    <div class="guide-meta">
                        <span><i class="far fa-calendar-alt me-1"></i> Published: <?php echo $row['created_at'] ?></span>
                        <span class="ms-3"><i class="far fa-eye me-1"></i> 1,245 Views</span>
                        <span class="ms-3"><i class="fas fa-user me-1"></i> By Asmaul Khan</span>
                    </div>
                    
                    <h1><?php echo $row['title'] ?></h1>
                    
                    <div class="guide-content mt-4">
                        <p>Buying a used phone can save you money, but it's important to thoroughly check the device before making a purchase. This guide will walk you through the essential checks to perform when buying a pre-owned mobile phone to ensure you get a quality device without any hidden issues.</p>
                        
                        <h3>Physical Inspection</h3>
                        <p>Start by carefully examining the phone's physical condition:</p>
                        <ul>
                            <li><strong>Body:</strong> Check for dents, scratches, or cracks on the body and frame</li>
                            <li><strong>Screen:</strong> Look for dead pixels, discoloration, or touch responsiveness issues</li>
                            <li><strong>Buttons:</strong> Test all physical buttons (power, volume, home button if applicable)</li>
                            <li><strong>Ports:</strong> Inspect charging port, headphone jack, and SIM tray for damage or debris</li>
                            <li><strong>Water damage indicators:</strong> Many phones have small indicators (usually white) that turn red if exposed to water</li>
                        </ul>
                        
                        <h3>Functionality Tests</h3>
                        <p>Perform these essential functionality tests:</p>
                        <ol>
                            <li><strong>Display test:</strong> Display a pure white image to check for dead pixels and color uniformity</li>
                            <li><strong>Touch test:</strong> Use a touch test app or move an icon around the screen to test all areas</li>
                            <li><strong>Camera test:</strong> Take photos with all cameras, check autofocus and flash</li>
                            <li><strong>Speaker test:</strong> Play audio to check both earpiece and loudspeaker</li>
                            <li><strong>Microphone test:</strong> Record voice memos and make a test call</li>
                            <li><strong>Sensor test:</strong> Verify proximity sensor (screen turns off during calls), accelerometer, and gyroscope</li>
                        </ol>
                        
                        <h3>Software Checks</h3>
                        <p>Important software verifications:</p>
                        <ul>
                            <li><strong>Factory reset:</strong> Ensure the phone has been properly reset and isn't linked to previous owner's accounts</li>
                            <li><strong>IMEI check:</strong> Dial *#06# to get IMEI number and verify it matches the one on the box/device</li>
                            <li><strong>Battery health:</strong> Check battery condition in settings (for iPhones) or use apps like AccuBattery for Android</li>
                            <li><strong>Performance:</strong> Open multiple apps to check for lag or overheating issues</li>
                            <li><strong>Network test:</strong> Insert SIM card to verify cellular connectivity and data speeds</li>
                        </ul>
                        
                        <div class="alert alert-primary mt-4">
                            <i class="fas fa-lightbulb me-2"></i> <strong>Pro Tip:</strong> Always meet in a well-lit public place when buying used phones, and consider getting a written receipt with the seller's contact information.
                        </div>
                    </div>
                    
                    <!-- Related Guides -->
                    <div class="related-guides">
                        <h3>Related Guides</h3>
                        
						<?php
							$offset = $row['title'];
							$articleQuery = "SELECT title, content, image, status, created_at FROM articles WHERE title != '".$offset."'
							ORDER BY created_at DESC LIMIT 3";
							$stmt = $pdo->prepare($articleQuery);
							$stmt->execute();
							$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
							
							if($articles){
								foreach($articles as $artC){
									$content = $artC['content'];
									$length = strlen($content);
									if($length > 120){
										$dsc = substr($content, 0, 110);
										$content = $dsc.'...';					
									}
									?>.
										<div class="related-guide-card">
											<img src="images/article/<?php echo $artC['image'] ?>" alt="<?php echo $artC['title'] ?>" class="related-guide-img">
											<div>
												<h5><a href="user-gied-details/<?php echo str_replace(" ", "-", $artC['title']); ?>"><?php echo $artC['title'] ?></a></h5>
												<p class="text-muted"><?php echo $content; ?></p>
											</div>
										</div>
									<?php
								}	
							}							
						?>
						
                    </div>
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
								$sql = "SELECT model_name, main_image, price, status FROM mobiles WHERE status = ? ORDER BY created_at LIMIT 10";
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
                    
                    <div class="sidebar-section mt-5">
                        <h4 class="mb-4">Top Brands</h4>
						
						<?php 
							$sql = "SELECT * FROM brands ORDER BY brand_name ASC LIMIT 10;";
							$stmt = $pdo->prepare($sql);
							$stmt->execute();
							
							while($brand = $stmt->fetch()){
								?>
									<a href="brands/<?php echo $brand['brand_name']; ?>/" class="brand-card text-decoration-none">
										<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?>" class="brand-img">
										<span><?php echo $brand['brand_name']; ?></span>
									</a>
								<?php 
							}
						?>
                        <div class="text-center mt-3">
                            <a href="brands/" class="btn btn-outline-primary">View All Brands</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
	include_once("footer.php");
?>