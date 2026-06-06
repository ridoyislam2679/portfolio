<?php
include "../db/index.php";

$model_name = $_GET['model_name'] ?? '';

if ($model_name) {
    //$sql = "SELECT * FROM mobile_specification WHERE model_name = ?";
	$sql = "SELECT *, brand_name FROM mobile_specification INNER JOIN brands ON mobile_specification.brand_id = brands.brand_id WHERE model_name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$model_name]);
    $phone = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($phone) {
		/*
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4>".$phone['brand']." ".$phone['model_name']."</h4>";
        echo "<img src='images/new/".$phone['main_image']."' class='img-fluid mb-2'>";
        echo "<ul class='list-group'>";
        echo "<li class='list-group-item'><b>Price:</b> ".$phone['price']." TK</li>";
        echo "<li class='list-group-item'><b>Display:</b> ".$phone['display']."</li>";
        echo "<li class='list-group-item'><b>Processor:</b> ".$phone['processor']."</li>";
        echo "<li class='list-group-item'><b>RAM:</b> ".$phone['ram']."</li>";
        echo "<li class='list-group-item'><b>Storage:</b> ".$phone['storage']."</li>";
        echo "<li class='list-group-item'><b>Camera:</b> ".$phone['camera']."</li>";
        echo "<li class='list-group-item'><b>Battery:</b> ".$phone['battery']."</li>";
        echo "</ul>";
        echo "</div></div>";
		*/
		?>
			<!-- phones Table -->
			<div class="row product-container p-4">
				<div class="col-sm-6">
					<h4 class="mb-2 full-phones"><?php echo $phone['model_name']; ?> specification </h4>
					<table class="table table-bordered details-table">
						<h4 class="mb-1">General</h4>
						<tbody>
							<tr>
								<th>Brand</th>
								<td><?php echo $phone['brand_name']; ?></td>
							</tr>
							<tr>
								<th>Model</th>
								<td><?php echo $phone['model_name']; ?></td>
							</tr>
							<tr>
								<th>Relese Date</th>
								<td><?php echo $phone['release_date']; ?></td>
							</tr>
							<tr>
								<th>Price</th>
								<td><?php echo $phone['price']; ?></td>
							</tr>
							<tr>
								<th>Made By</th>
								<td><?php echo $phone['made_by']; ?></td>
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
								<td><?php echo $phone['height']; ?></td>
							</tr>
							<tr>
								<th>Width</th>
								<td><?php echo $phone['width']; ?></td>
							</tr>
							<tr>
								<th>Thickness</th>
								<td><?php echo $phone['thickness']; ?></td>
							</tr>
							<tr>
								<th>Build</th>
								<td><?php echo $phone['build']; ?></td>
							</tr>
							<tr>
								<th>Weight</th>
								<td><?php echo $phone['weight']; ?></td>
							</tr>
							<tr>
								<th>Colors</th>
								<td><?php echo $phone['colors']; ?></td>
							</tr>
							<tr>
								<th>SIM</th>
								<td><?php echo $phone['sim_slot']; ?></td>
							</tr>
							<tr>
								<th>Water Resistant</th>
								<td><?php echo $phone['water_resistant']; ?></td>
							</tr>
						</tbody>
					</table>

					<table class="table table-bordered details-table">
						<h4 class="mb-1">Display</h4>
						<tbody>
							<tr>
								<th>Display Type</th>
								<td><?php echo $phone['display_type']; ?></td>
							</tr>
							<tr>
								<th>Screen Size</th>
								<td><?php echo $phone['screen_size']; ?></td>
							</tr>
							<tr>
								<th>Resolution</th>
								<td><?php echo $phone['resolution']; ?></td>
							</tr>
							<tr>
								<th>Aspect Ratio</th>
								<td><?php echo $phone['aspect_ratio']; ?></td>
							</tr>
							<tr>
								<th>Pixel Density</th>
								<td><?php echo $phone['pixel_density']; ?></td>
							</tr>
							<tr>
								<th>Screen to Body Ratio</th>
								<td><?php echo $phone['screen_to_body_ratio']; ?></td>
							</tr>
							<tr>
								<th>Brightness</th>
								<td><?php echo $phone['brightness']; ?></td>
							</tr>
							<tr>
								<th>HDR 10 / HDR + support</th>
								<td><?php echo $phone['hdr_support']; ?></td>
							</tr>
							<tr>
								<th>Refresh Rate</th>
								<td><?php echo $phone['refresh_rate']; ?></td>
							</tr>
							<tr>
								<th>Notch</th>
								<td><?php echo $phone['notch']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Main Camera</h4>
						<tbody>
							<tr>
								<th>Camera Setup</th>
								<td><?php echo $phone['main_camera_setup']; ?></td>
							</tr>
							<tr>
								<th>Resolution</th>
								<td><?php echo $phone['main_camera_resolution']; ?></td>
							</tr>
							<tr>
								<th>Image Resolution</th>
								<td><?php echo $phone['main_camera_image_resolution']; ?></td>
							</tr>
							<tr>
								<th>Flash</th>
								<td><?php echo $phone['main_camera_flash']; ?></td>
							</tr>
							<tr>
								<th>Zoom</th>
								<td><?php echo $phone['main_camera_zoom']; ?></td>
							</tr>
							<tr>
								<th>Video Recording</th>
								<td><?php echo $phone['main_camera_video']; ?></td>
							</tr>
							<tr>
								<th>Camera Features</th>
								<td><?php echo $phone['main_camera_features']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Selfie camera</h4>
						<tbody>
							<tr>
								<th>Camera Setup</th>
								<td><?php echo $phone['selfie_camera_setup']; ?></td>
							</tr>
							<tr>
								<th>Resolution</th>
								<td><?php echo $phone['selfie_camera_resolution']; ?></td>
							</tr>
							<tr>
								<th>Video Recording</th>
								<td><?php echo $phone['selfie_camera_video']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Hardware & Software</h4>
						<tbody>
							<tr>
								<th>Operating System</th>
								<td><?php echo $phone['operating_system']; ?></td>
							</tr>
							<tr>
								<th>OS Version</th>
								<td><?php echo $phone['os_version']; ?></td>
							</tr>
							<tr>
								<th>User Interface</th>
								<td><?php echo $phone['user_interface']; ?></td>
							</tr>
							<tr>
								<th>Chipset</th>
								<td><?php echo $phone['chipset']; ?></td>
							</tr>
							<tr>
								<th>GPU</th>
								<td><?php echo $phone['gpu']; ?></td>
							</tr>
							<tr>
								<th>CPU</th>
								<td>
									<?php echo $phone['cpu']; ?>
								</td>
							</tr>
							<tr>
								<th>CPU Cores</th>
								<td><?php echo $phone['cpu_cores']; ?></td>
							</tr>
							<tr>	
								<th>Architecture</th>
								<td><?php echo $phone['architecture']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Memory</h4>
						<tbody>
							<tr>
								<th>Card slot</th>
								<td><?php echo $phone['card_slot']; ?></td>
							</tr>
							<tr>
								<th>Internal Storage</th>
								<td><?php echo $phone['internal_storage']; ?> </td>
							</tr>
							<tr>
								<th>Storage Type</th>
								<td><?php echo $phone['storage_type']; ?></td>
							</tr>
							<tr>
								<th>RAM</th>
								<td><?php echo $phone['ram']; ?></td>
							</tr>
							<tr>
								<th>RAM Type</th>
								<td><?php echo $phone['ram_type']; ?></td>
							</tr>
							<tr>
								<th>Variant</th>
								<td><?php echo $phone['variant']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Network & Connectivity</h4>
						<tbody>
							<tr>
								<th>Network</th>
								<td><?php echo $phone['network']; ?></td>
							</tr>
							<tr>
								<th>SIM Slot</th>
								<td><?php echo $phone['sim_slot']; ?></td>
							</tr>
							<tr>
								<th>SIM Size</th>
								<td><?php echo $phone['sim_size']; ?></td>
							</tr>
							<tr>
								<th>Speed</th>
								<td><?php echo $phone['speed']; ?></td>
							</tr>
							<tr>
								<th>VoLTE</th>
								<td><?php echo $phone['volte']; ?></td>
							</tr>
							<tr>
								<th>WLAN</th>
								<td><?php echo $phone['wlan']; ?></td>
							</tr>
							<tr>
								<th>Bluetooth</th>
								<td><?php echo $phone['bluetooth']; ?></td>
							</tr>
							<tr>
								<th>GPS</th>
								<td><?php echo $phone['gps']; ?></td>
							</tr>
							<tr>
								<th>NFC</th>
								<td><?php echo $phone['nfc']; ?></td>
							</tr>
							<tr>
								<th>USB</th>
								<td><?php echo $phone['usb']; ?></td>
							</tr>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Sensors & security</h4>
						<tbody>
							<tr>
								<th>Fingerprint Sensor</th>
								<td><?php echo $phone['fingerprint_sensor']; ?></td>
							</tr>
							<tr>
								<th>Finger Sensor Position</th>
								<td><?php echo $phone['finger_sensor_position']; ?></td>
							</tr>
							<tr>
								<th>Finger Sensor Type</th>
								<td><?php echo $phone['finger_sensor_type']; ?></td>
							</tr>
							<tr>
								<th>Face Unlock</th>
								<td><?php echo $phone['face_unlock']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Battery</h4>
						<tbody>
							<tr>
								<th>Battery type</th>
								<td><?php echo $phone['battery_type']; ?></td>
							</tr>
							<tr>
								<th>Capacity</th>
								<td><?php echo $phone['capacity']; ?></td>
							</tr>
							<tr>
								<th>Charging</th>
								<td><?php echo $phone['charging']; ?></td>
							</tr>
							<tr>
								<th>USB</th>
								<td><?php echo $phone['usb']; ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-bordered details-table">
						<h4 class="mb-1">Multimedia</h4>
						<tbody>
							<tr>
								<th>Loudspeaker</th>
								<td><?php echo $phone['loudspeaker']; ?></td>
							</tr>
							<tr>
								<th>Audio Jack</th>
								<td><?php echo $phone['audio_jack']; ?></td>
							</tr>
							<tr>
								<th>Video</th>
								<td><?php echo $phone['video']; ?></td>
							</tr>
						</tbody>
					</table>
					<a href="pre-owned-phone.php" class="PreLink">Pre-Owned Mobile price in 2025</a> &nbsp;&nbsp; 
					<a href="top-phones.php" class="PreLink">Top 10 Mobile Price 2025 in Bangladesh</a>
				</div>
			</div>		
		<?php 
		
    } else {
        echo "<p class='text-danger'>❌ Phone not found.</p>";
    }
}
?>
