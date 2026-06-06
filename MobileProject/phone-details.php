<?php 
    error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include_once("header.php");
	if(!isset($_GET['name']) || empty($_GET['name'])) {
		header("location:$base/index");
		exit;
	}
	$model = trim($_GET['name']); 
	$model = str_replace('-', ' ', $model); // slug থেকে space এ
	
	$sql = "SELECT mobile_id, status FROM mobiles WHERE LOWER(model_name) = LOWER(?)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$model]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ($row) {
		$id = $row['mobile_id'];

		$mobile = "SELECT mobile_specification.*, brands.brand_name, mobiles.model_name, mobiles.battery_helth, mobiles.phone_condition, mobiles.price, mobiles.release_date, mobiles.main_image FROM mobile_specification INNER JOIN brands ON mobile_specification.brand_id = brands.brand_id INNER JOIN mobiles ON mobile_specification.mobile_id = mobiles.mobile_id WHERE mobile_specification.mobile_id = ?";
	
		//$mobile = "SELECT *, brand_name FROM mobile_specification INNER JOIN brands ON mobile_specification.brand_id = brands.brand_id WHERE mobile_id = ?";
		$stmt = $pdo->prepare($mobile);
		$stmt->execute([$id]);
		$specification = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$mobileImage = "SELECT * FROM mobile_images WHERE mobile_id = ?";
		$stmt = $pdo->prepare($mobileImage);
		$stmt->execute([$id]);
		$phone = $stmt->fetch();
		$images = [];

		if ($phone && !empty($phone['image_url'])) {
			$decoded = json_decode($phone['image_url'], true);
			if (is_array($decoded)) {
				$images = $decoded;
			}
		}

		$videoQuery = "SELECT video_link FROM youtube_video WHERE mobile_id = ?";
		$stmt = $pdo->prepare($videoQuery);
		$stmt->execute([$id]);
		$videoLinkRow = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$iframeLink = $videoLinkRow ? $videoLinkRow['video_link'] : null;
        // iframe link থেকে VIDEO_ID আলাদা করা
        $videoId = null;
        if ($iframeLink) {
            // উদাহরণ: https://www.youtube.com/embed/abcd1234
            $parts = explode('/embed/', $iframeLink);
            $videoId = end($parts);
            $thumbnail = "https://img.youtube.com/vi/" . $videoId . "/maxresdefault.jpg";
        }
		
		$priceReview = "SELECT review, overview FROM price_review WHERE mobile_id = ?";
		$stmt = $pdo->prepare($priceReview);
		$stmt->execute([$id]);
		$review = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$mobileFaq = "SELECT FAQ_id, FAQ_Question, FAQ_Answer FROM mobile_faq WHERE mobile_id = ?";
		$stmt = $pdo->prepare($mobileFaq);
		$stmt->execute([$id]);
		$faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$mobileHighlight = "SELECT highlight_text FROM mobile_highlights WHERE mobile_id = ?";
		$stmt = $pdo->prepare($mobileHighlight);
		$stmt->execute([$id]);
		$highlights = $stmt->fetch(PDO::FETCH_ASSOC);		
		$features = json_decode($highlights['highlight_text'], true); // JSON → Array
		//$features = array_map('trim', explode(',', $highlights['highlight_text']));
		
		
		$ratingQuery = "SELECT * FROM mobile_ratings WHERE mobile_id = ?";
		$stmt = $pdo->prepare($ratingQuery);
		$stmt->execute([$id]);
		$rating = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$Average = round(($rating['display_rating'] + $rating['design_rating'] + $rating['performance_rating'] + $rating['camera_rating'] + $rating['connectivity_rating'] + $rating['battery_rating'] + $rating['price_rating'])/7);


	} else {
		
		die("
			<h5 class='no-found'>❌ No record found for: " . htmlspecialchars($model) . " <br>
			Redirecting to home page in <span id='countdown'>5</span> seconds... </h5>
			<script>
				let seconds = 5;
				let countdownEl = document.getElementById('countdown');

				let interval = setInterval(function(){
					seconds--;
					countdownEl.textContent = seconds;
					if(seconds <= 0){
						clearInterval(interval);
						window.location.href = '$base/index';
					}
				}, 1000);
			</script>
		");

	}
?>

    <div class="container py-2">
        <div class="row">
            <!-- Main Content (Left Side) -->
            <div class="col-lg-8">
                <div class="row product-container p-4">
					<?php
					$basePath = $row['status'] === 'New' ? 'images/new/' : 'images/used/';
					$mainImage = $basePath . $specification['main_image'];
					?>
					<div class="col-sm-6 image-slider">
						<div id="mainImage" class="mb-1 main-slider img-zoom-container">
							<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $row['mobile_id']; ?>">
								<img src="<?php echo $mainImage; ?>" class="img-fluid rounded" alt="<?php echo $specification['model_name']; ?>">
							</a>
						</div>
						<div class="thumbnail-container">
							<img src="<?php echo $mainImage; ?>" class="thumbnail" onclick="changeImage(this)" alt="<?php echo $specification['model_name']; ?>">

							<?php if (!empty($images) && is_array($images)): ?>
								<?php foreach ($images as $img): ?>
									<img src="<?php echo $basePath . htmlspecialchars($img); ?>" 
										 class="thumbnail" 
										 onclick="changeImage(this)" 
										 alt="<?php echo htmlspecialchars($specification['model_name']); ?>">
								<?php endforeach; ?>
							<?php else: ?>
								<!-- <p style="color:red;">No extra images found-->.</p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="imageModal<?php echo $row['mobile_id']; ?>" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content modalContent">
								<div class="modal-body p-0">
									<img id="modalImage" src="<?php echo $mainImage; ?>" 
										 class="img-fluid w-100" alt="<?php echo $specification['model_name']; ?>">
								</div>
							</div>
						</div>
					</div>


                    <!-- Product Info -->
                    <div class="col-sm-6">
                        <h2> <?php echo $specification['model_name']; ?></h2>
                        <span class="badge bg-success condition-badge"><?php echo $row['status']; ?></span>
						<?php if($row['status'] == 'Pre-Owned'):?>
                        <div class="price mt-2">
							৳<?php echo $specification['price']; ?>(Condition: <?php echo $specification['phone_condition']; ?>)
						</div>
						<?php else:?>
						<div class="price mt-2">৳<?php echo $specification['price']; ?></div>
						<?php endif;?>
                        
                        <div class="mt-2">
                            <h4>Key Specifications</h4>
                            <ul class="specs-list">
                                <li><strong>Chipset:</strong> <?php echo $specification['chipset']; ?></li>
                                <li><strong>OS:</strong> <?php echo $specification['os_version']; ?></li>
                                <li><strong>RAM:</strong> <?php echo $specification['ram']; ?> </li>
                                <li><strong>Storage:</strong> <?php echo $specification['internal_storage']; ?> </li>
                                <li><strong>Battery:</strong> <?php echo $specification['capacity']; ?></li>
                                <li><strong>Battery Helth:</strong> <?php echo $specification['battery_helth']; ?></li>
                                <li><a href="pre-owned-phone.php" class="PreLink">Pre-Owned Mobile price</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
				<!-- Rating Section (Moved down) -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-4">Ratings</h4>
                        <div class="mb-2">
                            <span>Display: <?php echo $rating['display_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['display_rating']*10; ?>%"></div>
                            </div>
                        </div>
						<div class="mb-2">
                            <span>Design: <?php echo $rating['design_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['design_rating']*10; ?>%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span>Performance: <?php echo $rating['performance_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['performance_rating']*10; ?>%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span>Camera: <?php echo $rating['camera_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['camera_rating']*10; ?>%"></div>
                            </div>
                        </div>
						<div class="mb-2">
                            <span>Conectivity: <?php echo $rating['connectivity_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['connectivity_rating']*10; ?>%"></div>
                            </div>
                        </div>
						<div class="mb-2">
                            <span>Battery: <?php echo $rating['battery_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['battery_rating']*10; ?>%"></div>
                            </div>
                        </div>
						<div class="mb-2">
                            <span>Price: <?php echo $rating['price_rating']; ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $rating['price_rating']*10; ?>%"></div>
                            </div>
                        </div>
						<div class="mb-2">
                            <span>Average: <?php echo $Average ?>/10</span>
                            <div class="rating-bar">
                                <div class="rating-fill" data-width="<?php echo $Average*10; ?>%"></div>
                            </div>
                        </div>
						<a href="new-phones.php" class="PreLink">Visit More Mobile price</a>
                    </div>
                </div>
				
				<!-- Specifications Table -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-2 full-specifications">Full Specifications</h4>
                        <table class="table table-bordered details-table">
							<h4 class="mb-1">General</h4>
                            <tbody>
                                <tr>
                                    <th>Brand</th>
                                    <td><?php echo $specification['brand_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td><?php echo $specification['model_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Relese Date</th>
                                    <td><?php echo $specification['release_date']; ?></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><?php echo $specification['price']; ?></td>
                                </tr>
								<tr>
                                    <th>Made By</th>
                                    <td><?php echo $specification['made_by']; ?></td>
                                </tr>
								<tr>
                                    <th>More Mobile</th>
                                    <td><a href="pre-owned-phone.php" class="PreLink">Pre-Owned Mobile price</a></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Design</h4>
                            <tbody>
                                <tr>
                                    <th>Height</th>
                                    <td><?php echo $specification['height']; ?></td>
                                </tr>
								<tr>
                                    <th>Width</th>
                                    <td><?php echo $specification['width']; ?></td>
                                </tr>
                                <tr>
                                    <th>Thickness</th>
                                    <td><?php echo $specification['thickness']; ?></td>
                                </tr>
								<tr>
                                    <th>Build</th>
                                    <td><?php echo $specification['build']; ?></td>
                                </tr>
								<tr>
                                    <th>Weight</th>
                                    <td><?php echo $specification['weight']; ?></td>
                                </tr>
								<tr>
                                    <th>Colors</th>
                                    <td><?php echo $specification['colors']; ?></td>
                                </tr>
                                <tr>
                                    <th>SIM</th>
                                    <td><?php echo $specification['sim_slot']; ?></td>
                                </tr>
                                <tr>
                                    <th>Water Resistant</th>
                                    <td><?php echo $specification['water_resistant']; ?></td>
                                </tr>
                            </tbody>
                        </table>

						<table class="table table-bordered details-table">
							<h4 class="mb-1">Display</h4>
                            <tbody>
                                <tr>
                                    <th>Display Type</th>
                                    <td><?php echo $specification['display_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Screen Size</th>
                                    <td><?php echo $specification['screen_size']; ?></td>
                                </tr>
                                <tr>
                                    <th>Resolution</th>
                                    <td><?php echo $specification['resolution']; ?></td>
                                </tr>
                                <tr>
                                    <th>Aspect Ratio</th>
                                    <td><?php echo $specification['aspect_ratio']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pixel Density</th>
                                    <td><?php echo $specification['pixel_density']; ?></td>
                                </tr>
                                <tr>
                                    <th>Screen to Body Ratio</th>
                                    <td><?php echo $specification['screen_to_body_ratio']; ?></td>
                                </tr>
                                <tr>
                                    <th>Brightness</th>
                                    <td><?php echo $specification['brightness']; ?></td>
                                </tr>
								<tr>
                                    <th>HDR 10 / HDR + support</th>
                                    <td><?php echo $specification['hdr_support']; ?></td>
                                </tr>
								<tr>
                                    <th>Refresh Rate</th>
                                    <td><?php echo $specification['refresh_rate']; ?></td>
                                </tr>
								<tr>
                                    <th>Notch</th>
                                    <td><?php echo $specification['notch']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Main Camera</h4>
                            <tbody>
                                <tr>
                                    <th>Camera Setup</th>
                                    <td><?php echo $specification['main_camera_setup']; ?></td>
                                </tr>
                                <tr>
                                    <th>Resolution</th>
                                    <td><?php echo $specification['main_camera_resolution']; ?></td>
                                </tr>
                                <tr>
                                    <th>Image Resolution</th>
                                    <td><?php echo $specification['main_camera_image_resolution']; ?></td>
                                </tr>
                                <tr>
                                    <th>Flash</th>
                                    <td><?php echo $specification['main_camera_flash']; ?></td>
                                </tr>
                                <tr>
                                    <th>Zoom</th>
                                    <td><?php echo $specification['main_camera_zoom']; ?></td>
                                </tr>
                                <tr>
                                    <th>Video Recording</th>
                                    <td><?php echo $specification['main_camera_video']; ?></td>
                                </tr>
                                <tr>
                                    <th>Camera Features</th>
                                    <td><?php echo $specification['main_camera_features']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Selfie camera</h4>
                            <tbody>
                                <tr>
                                    <th>Camera Setup</th>
                                    <td><?php echo $specification['selfie_camera_setup']; ?></td>
                                </tr>
								<tr>
                                    <th>Resolution</th>
                                    <td><?php echo $specification['selfie_camera_resolution']; ?></td>
                                </tr>
                                <tr>
                                    <th>Video Recording</th>
                                    <td><?php echo $specification['selfie_camera_video']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Hardware & Software</h4>
                            <tbody>
                                <tr>
                                    <th>Operating System</th>
                                    <td><?php echo $specification['operating_system']; ?></td>
                                </tr>
                                <tr>
                                    <th>OS Version</th>
                                    <td><?php echo $specification['os_version']; ?></td>
                                </tr>
                                <tr>
                                    <th>User Interface</th>
                                    <td><?php echo $specification['user_interface']; ?></td>
                                </tr>
                                <tr>
                                    <th>Chipset</th>
                                    <td><?php echo $specification['chipset']; ?></td>
                                </tr>
                                <tr>
                                    <th>GPU</th>
                                    <td><?php echo $specification['gpu']; ?></td>
                                </tr>
                                <tr>
                                    <th>CPU</th>
                                    <td>
										<?php echo $specification['cpu']; ?>
									</td>
                                </tr>
                                <tr>
                                    <th>CPU Cores</th>
                                    <td><?php echo $specification['cpu_cores']; ?></td>
                                </tr>
                                <tr>	
                                    <th>Architecture</th>
                                    <td><?php echo $specification['architecture']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Memory</h4>
                            <tbody>
                                <tr>
                                    <th>Card slot</th>
                                    <td><?php echo $specification['card_slot']; ?></td>
                                </tr>
                                <tr>
                                    <th>Internal Storage</th>
                                    <td><?php echo $specification['internal_storage']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Storage Type</th>
                                    <td><?php echo $specification['storage_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>RAM</th>
                                    <td><?php echo $specification['ram']; ?></td>
                                </tr>
                                <tr>
                                    <th>RAM Type</th>
                                    <td><?php echo $specification['ram_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Variant</th>
                                    <td><?php echo $specification['variant']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Network & Connectivity</h4>
                            <tbody>
                                <tr>
                                    <th>Network</th>
                                    <td><?php echo $specification['network']; ?></td>
                                </tr>
                                <tr>
                                    <th>SIM Slot</th>
                                    <td><?php echo $specification['sim_slot']; ?></td>
                                </tr>
                                <tr>
                                    <th>SIM Size</th>
                                    <td><?php echo $specification['sim_size']; ?></td>
                                </tr>
                                <tr>
                                    <th>Speed</th>
                                    <td><?php echo $specification['speed']; ?></td>
                                </tr>
                                <tr>
                                    <th>VoLTE</th>
                                    <td><?php echo $specification['volte']; ?></td>
                                </tr>
                                <tr>
                                    <th>WLAN</th>
                                    <td><?php echo $specification['wlan']; ?></td>
                                </tr>
                                <tr>
                                    <th>Bluetooth</th>
                                    <td><?php echo $specification['bluetooth']; ?></td>
                                </tr>
                                <tr>
                                    <th>GPS</th>
                                    <td><?php echo $specification['gps']; ?></td>
                                </tr>
                                <tr>
                                    <th>NFC</th>
                                    <td><?php echo $specification['nfc']; ?></td>
                                </tr>
                                <tr>
                                    <th>USB</th>
                                    <td><?php echo $specification['usb']; ?></td>
                                </tr>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Sensors & security</h4>
                            <tbody>
                                <tr>
                                    <th>Fingerprint Sensor</th>
                                    <td><?php echo $specification['fingerprint_sensor']; ?></td>
                                </tr>
                                <tr>
                                    <th>Finger Sensor Position</th>
                                    <td><?php echo $specification['finger_sensor_position']; ?></td>
                                </tr>
                                <tr>
                                    <th>Finger Sensor Type</th>
                                    <td><?php echo $specification['finger_sensor_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Face Unlock</th>
                                    <td><?php echo $specification['face_unlock']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Battery</h4>
                            <tbody>
                                <tr>
                                    <th>Battery type</th>
                                    <td><?php echo $specification['battery_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Capacity</th>
                                    <td><?php echo $specification['capacity']; ?></td>
                                </tr>
                                <tr>
                                    <th>Charging</th>
                                    <td><?php echo $specification['charging']; ?></td>
                                </tr>
                                <tr>
                                    <th>USB</th>
                                    <td><?php echo $specification['usb']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						
						<table class="table table-bordered details-table">
							<h4 class="mb-1">Multimedia</h4>
                            <tbody>
                                <tr>
                                    <th>Loudspeaker</th>
                                    <td><?php echo $specification['loudspeaker']; ?></td>
                                </tr>
                                <tr>
                                    <th>Audio Jack</th>
                                    <td><?php echo $specification['audio_jack']; ?></td>
                                </tr>
                                <tr>
                                    <th>Video</th>
                                    <td><?php echo $specification['video']; ?></td>
                                </tr>
                            </tbody>
                        </table>
						<a href="pre-owned-phone.php" class="PreLink">Pre-Owned Mobile price in 2025</a> &nbsp;&nbsp; 
						<a href="top-phones.php" class="PreLink">Top 10 Mobile Price 2025 in Bangladesh</a>
                    </div>
                </div>
				
				<!-- Video Section -->	
				
				<script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "VideoObject",
                    "name": "<?= htmlspecialchars($specification['model_name']) ?> Review",
                    "description": "<?= htmlspecialchars($meta_description) ?>",
                    "thumbnailUrl": "<?= $thumbnail ?>",
                    "uploadDate": "<?= date('c') ?>",
                    "contentUrl": "https://www.youtube.com/watch?v=<?= $videoId ?>",
                    "embedUrl": "<?= $iframeLink ?>",
                    "publisher": {
                        "@type": "Organization",
                        "name": "Mobile Review BD",
                        "logo": {
                          "@type": "ImageObject",
                          "url": "https://yourwebsite.com/logo.png"
                        }
                    }
                }
                </script>
				
                <div class="row video-container mb-3">
                    <div class="video-wrapper">
                        <?php 
							if ($videoLinkRow && isset($videoLinkRow['video_link'])) {
								echo $videoLinkRow['video_link'];
							}
						?>
                    </div>
					<h4 class="about-text mb-3">
                        Youtube Chanel👉 
                        <a href="https://www.youtube.com/@studycareinfo"> Chanel </a>
                    </h4>
					<h4 class="about-text mb-4">
                        Facebook Page👉 
                        <a href="https://www.facebook.com/mobilereviewbd.comahm"> facebook </a>
                    </h4>
                </div>

                <!-- Highlights moved up -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-4">Key Highlights</h4>
                        <div class="highlight-box">
                            <ul>
								<?php 
									if($features){
										foreach($features as $highlight){
											echo "<li>$highlight</li>";
										}
									}
								?>
                            </ul>
                        </div>
						<a href="new-phones.php" class="PreLink">New Mobile price 2025 in Bangladesh</a>
                    </div>
                </div>

				<!-- Value for Money Article -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-4"> <?php echo $specification['model_name']; ?> Overview</h4>
                        <?php echo '<p style="white-space: pre-wrap;">' . $review['overview'] . '</p>'; ?>
                    </div>
					<a href="camera-phones.php" class="PreLink">Top Camera Phones</a>
                </div>
				
                <!-- Value for Money Article -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-4">Is It Worth The Price?</h4>
                        <?php echo '<p style="white-space: pre-wrap;">' . $review['review'] . '</p>'; ?>
                    </div>
					<a href="pre-owned-phone.php" class="PreLink">Pre-Owned Mobile price in 2025</a>
                </div>

                <!-- FAQ Section -->
                <div class="row product-container p-4">
                    <div class="col-12">
                        <h4 class="mb-4">Frequently Asked Questions</h4>
                        <div class="accordion" id="faqAccordion">
							<?php 
							if ($faqs) {
								foreach ($faqs as $index => $faq) {
									$collapseId = "faq".$index;
									$isFirst = $index === 0; // শুধু প্রথম আইটেম খোলা থাকবে

									?>
									<div class="accordion-item">
										<h2 class="accordion-header" id="heading<?php echo $index; ?>">
											<button class="accordion-button <?php echo $isFirst ? '' : 'collapsed'; ?>" 
													type="button" 
													data-bs-toggle="collapse" 
													data-bs-target="#<?php echo $collapseId; ?>" 
													aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>" 
													aria-controls="<?php echo $collapseId; ?>">
												<?php echo $faq['FAQ_Question']; ?>
											</button>
										</h2>
										<div id="<?php echo $collapseId; ?>" 
											 class="accordion-collapse collapse <?php echo $isFirst ? 'show' : ''; ?>" 
											 data-bs-parent="#faqAccordion">
											<div class="accordion-body">
												<?php echo $faq['FAQ_Answer']; ?>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
                    </div>
					<a href="gaming-phones.php" class="PreLink">Top Gaming Phones</a>
                </div>
				
				<!-- Comment Section -->
				<?php 
					$sql = "select user_name, comment_text FROM comments WHERE mobile_id = ? ORDER BY created_at DESC";
					$stmt= $pdo->prepare($sql);
					$stmt->execute([$id]);
				?>				
				<div class="row product-container p-4">
                    <div class="col-12">
						<?php while($row = $stmt->fetch()): ?>
						<div class="d-flex mb-3 mt-4">
							<img src="images/user.png" class="rounded-circle me-3 user" alt="User">
							<div>
								<h6><?php echo $row['user_name']; ?></h6>
								<p><?php echo $row['comment_text']; ?></p>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
                <div class="row product-container p-4 comment-section">
                    <div class="col-12">
                        <h4 class="mb-4">Customer Reviews</h4>
                        
						<form method="POST">
							<div class="row mb-4">
								<div class="col-md-6">
									<div class="form-group">
										<label for="taskTitle" class="form-label">Your Name *</label>
										<input type="text" name="userName" class="form-control" id="taskTitle" placeholder="Enter your name..." required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="taskCredit" class="form-label">Your Email *</label>
										<input type="email" name="email" class="form-control" id="taskCredit" placeholder="Enter your email..." required>
									</div>
								</div>
							</div>
							
							<div class="form-group mb-4">
								<label for="taskDescription" class="form-label">Comment *</label>
								<textarea class="form-control" name="cmnt" id="taskDescription" rows="4" placeholder="Enter detailed Comment..." required></textarea>
							</div>
							
							<div class="d-flex justify-content-start">
								<button type="submit" class="btn btn-primary mt-2" name="CommnetSubmit">Submit Review</button>
							</div>
						</form>
						
						<?php 
							if(isset($_POST['CommnetSubmit'])){
								$userName = $_POST['userName'];
								$email    = $_POST['email'];
								$comment  = $_POST['cmnt'];
								if($userName && $email && $comment){
									$sql = "INSERT INTO comments(mobile_id, user_name, user_email, comment_text) VALUE(?, ?, ?, ?)";
									$stmt = $pdo->prepare($sql);
									$stmt->execute([$id, $userName, $email, $comment]);
								}else{
									echo "Please Insert Proper";
								}
							}
						?>
                    </div>
                </div>

                <!-- Related Phones -->
                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-4">Related Phones</h4>
                    </div>
					<?php 
						$targetPrice = $specification['price'];
						$currentId = (int)$id;

						$sql = "SELECT model_name, price, main_image, status, ABS(price - ?) AS distance FROM mobiles WHERE mobile_id != ? ORDER BY distance ASC LIMIT 4;";

						$stmt = $pdo->prepare($sql);
						$stmt->execute([$targetPrice, $currentId]);
						$relateds = $stmt->fetchAll(PDO::FETCH_ASSOC);
						
						if ($relateds) {
							foreach ($relateds as $related) {
							?>
								<div class="col-6 col-md-4 col-lg-3">
									<div class="card phone-card h-100">
										<div class="badge bg-success position-absolute m-2"><?php echo $related['status'] ?></div>
										<?php if($related['status'] == 'New'): ?>
										<img src="images/new/<?php echo $related['main_image']; ?>" class="card-img-top p-3" alt="Samsung Galaxy S22">
										<?php else: ?>
										<img src="images/used/<?php echo $related['main_image']; ?>" class="card-img-top p-3" alt="Samsung Galaxy S22">
										<?php endif; ?>
										<div class="card-body text-center">
											<h5 class="card-title"><?php echo $related['model_name'] ?></h5>
											<p class="card-text text-primary fw-bold">৳<?php echo $related['price'] ?></p>
											<div class="d-grid">
												<a href="phone-details/<?php echo str_replace(" ", "-", $related['model_name']); ?>" class="btn btn-primary">View Details</a>
											</div>
										</div>
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
												<img src="images/brands/<?php echo $brand['brand_logo']; ?>" alt="<?php echo $brand['brand_name']; ?> | mobilereviewbd">
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

<?php 
	include_once("footer.php");
?>