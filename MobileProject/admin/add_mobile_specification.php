<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql = "SELECT mobile_id, model_name, status FROM mobiles ORDER BY created_at DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if(isset($_POST['specificationSubmit'])){
		$mobile_id 						= $_POST['model_name'];
		$made_by 						= $_POST['made_by'];
		$height			    			= $_POST['height'];
		$width 							= $_POST['width'];
		$thickness 						= $_POST['thickness'];
		$build 							= $_POST['build'];
		$weight 						= $_POST['weight'];
		$colors 						= $_POST['colors'];
		$water_resistant 				= $_POST['water_resistant'];
		$display_type 					= $_POST['display_type'];
		$screen_size 					= $_POST['screen_size'];
		$resolution 					= $_POST['resolution'];
		$aspect_ratio 					= $_POST['aspect_ratio'];
		$pixel_density 					= $_POST['pixel_density'];
		$screen_to_body_ratio 			= $_POST['screen_to_body_ratio'];
		$brightness  		 			= $_POST['brightness'];
		$hdr_support  		 			= $_POST['hdr_support'];
		$refresh_rate 					= $_POST['refresh_rate'];
		$notch		 					= $_POST['notch'];
		$main_camera_setup 				= $_POST['main_camera_setup'];
		$main_camera_resolution 		= $_POST['main_camera_resolution'];
		$main_camera_image_resolution 	= $_POST['main_camera_image_resolution'];
		$main_camera_flash 				= $_POST['main_camera_flash'];
		$main_camera_zoom 				= $_POST['main_camera_zoom'];
		$main_camera_video 				= $_POST['main_camera_video'];
		$main_camera_features 			= $_POST['main_camera_features'];
		$selfie_camera_setup    		= $_POST['selfie_camera_setup'];
		$selfie_camera_resolution   	= $_POST['selfie_camera_resolution'];
		$selfie_camera_video        	= $_POST['selfie_camera_video'];
		$operating_system 				= $_POST['operating_system'];
		$os_version  	 				= $_POST['os_version'];
		$user_interface  	 			= $_POST['user_interface'];
		$chipset 						= $_POST['chipset'];
		$gpu 							= $_POST['gpu'];
		$cpu 							= $_POST['cpu'];		
		$cpu_cores 						= $_POST['cpu_cores'];		
		$architecture 					= $_POST['architecture'];		
		$card_slot  					= $_POST['card_slot'];	
		$internal_storage 				= $_POST['internal_storage'];
		$storage_type 					= $_POST['storage_type'];
		$ram 							= $_POST['ram'];		
		$ram_type 						= $_POST['ram_type'];		
		$variant 						= $_POST['variant'];
		$network 						= $_POST['network'];
		$sim_slot 						= $_POST['sim_slot'];
		$sim_size 						= $_POST['sim_size'];
		$speed  						= $_POST['speed'];
		$volte  						= $_POST['volte'];
		$wlan 							= $_POST['wlan'];
		$bluetooth 						= $_POST['bluetooth'];
		$gps    						= $_POST['gps'];
		$nfc    						= $_POST['nfc'];
		$usb 							= $_POST['usb'];
		$fingerprint_sensor 			= $_POST['fingerprint_sensor'];
		$finger_sensor_position 		= $_POST['finger_sensor_position'];
		$finger_sensor_type     		= $_POST['finger_sensor_type'];
		$face_unlock 					= $_POST['face_unlock'];
		$battery_type 					= $_POST['battery_type'];
		$capacity 						= $_POST['capacity'];
		$charging 						= $_POST['charging'];
		$battery_usb 					= $_POST['battery_usb'];
		$loudspeaker 					= $_POST['loudspeaker'];
		$audio_jack 					= $_POST['audio_jack'];
		$video      					= $_POST['video'];
		
		$select = "SELECT brand_id FROM mobiles WHERE mobile_id = ?";
		$stmt = $pdo->prepare($select);
		$stmt->execute([$mobile_id]);
		$row = $stmt->fetch();
		
		$brand_id = $row['brand_id'];
		
		if($mobile_id && $mobile_id != '#'){
			$sql = "INSERT INTO mobile_specification(mobile_id, brand_id, made_by, height, width, thickness, build, weight, colors, water_resistant,display_type, screen_size, resolution, aspect_ratio, pixel_density, screen_to_body_ratio, brightness, hdr_support, refresh_rate, notch, main_camera_setup, main_camera_resolution, main_camera_image_resolution, main_camera_flash, main_camera_zoom, main_camera_video, main_camera_features, selfie_camera_setup, selfie_camera_resolution, selfie_camera_video, operating_system, os_version, user_interface, chipset, gpu, cpu, cpu_cores, architecture, card_slot, internal_storage, storage_type, ram, ram_type, variant, network, sim_slot, sim_size, speed, volte, wlan, bluetooth, gps, nfc, usb, fingerprint_sensor,  finger_sensor_position, finger_sensor_type, face_unlock, battery_type, capacity, charging, battery_usb, loudspeaker, audio_jack, video) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$mobile_id, $brand_id, $made_by, $height, $width, $thickness, $build, $weight, $colors, $water_resistant, $display_type, $screen_size, $resolution, $aspect_ratio, $pixel_density, $screen_to_body_ratio, $brightness, $hdr_support, $refresh_rate, $notch, $main_camera_setup, $main_camera_resolution, $main_camera_image_resolution, $main_camera_flash, $main_camera_zoom, $main_camera_video, $main_camera_features, $selfie_camera_setup, $selfie_camera_resolution, $selfie_camera_video, $operating_system, $os_version, $user_interface, $chipset, $gpu,$cpu, $cpu_cores, $architecture, $card_slot, $internal_storage, $storage_type, $ram, $ram_type, $variant, $network, $sim_slot, $sim_size, $speed, $volte, $wlan, $bluetooth, $gps, $nfc, $usb, $fingerprint_sensor,  $finger_sensor_position, $finger_sensor_type, $face_unlock, $battery_type, $capacity, $charging, $battery_usb, $loudspeaker, $audio_jack, $video]);
			
			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}
	
?>

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add Mobile Specification</h2>
            
            <form action="" method="POST">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Basic Information</h4>
                    <div class="row">
						<div class="col-md-8 mb-3">
                            <label for="height" class="form-label">Mobile Model Name</label>
							<select class="form-control" id="height" name="model_name" required>
								<option value="#"> --Choice-- </option>
								<?php
									while($row = $stmt->fetch()){
										?>
										<option value="<?= $row['mobile_id']; ?>"> <?= $row['model_name']; ?> </option>
										<?php 
									}
								?>
							</select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="made_by" class="form-label">Made By</label>
                            <input type="text" class="form-control" id="made_by" name="made_by">
                        </div>
                    </div>
                </div>

                <!-- Dimensions & Build -->
                <div class="form-section">
                    <h4>Dimensions & Build</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="width" class="form-label">Width</label>
                            <input type="text" class="form-control" id="width" name="width">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="thickness" class="form-label">Thickness</label>
                            <input type="text" class="form-control" id="thickness" name="thickness">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="build" class="form-label">Build Material</label>
                            <input type="text" class="form-control" id="build" name="build">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="colors" class="form-label">Colors</label>
                            <input type="text" class="form-control" id="colors" name="colors">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="water_resistant" class="form-label">Water Resistant</label>
                            <input type="text" class="form-control" id="water_resistant" name="water_resistant">
                        </div>
                    </div>
                </div>

                <!-- Display -->
                <div class="form-section">
                    <h4>Display</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="display_type" class="form-label">Display Type</label>
                            <input type="text" class="form-control" id="display_type" name="display_type">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="screen_size" class="form-label">Screen Size</label>
                            <input type="text" class="form-control" id="screen_size" name="screen_size">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="resolution" class="form-label">Resolution</label>
                            <input type="text" class="form-control" id="resolution" name="resolution">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="aspect_ratio" class="form-label">Aspect Ratio</label>
                            <input type="text" class="form-control" id="aspect_ratio" name="aspect_ratio">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="pixel_density" class="form-label">Pixel Density</label>
                            <input type="text" class="form-control" id="pixel_density" name="pixel_density">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="screen_ratio" class="form-label">Screen Ratio</label>
                            <input type="text" class="form-control" id="screen_ratio" name="screen_to_body_ratio">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="brightness" class="form-label">Brightness</label>
                            <input type="text" class="form-control" id="brightness" name="brightness">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="hdr_support" class="form-label">HDR Support</label>
                            <input type="text" class="form-control" id="hdr_support" name="hdr_support">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="refresh_rate" class="form-label">Refresh Rate</label>
                            <input type="text" class="form-control" id="refresh_rate" name="refresh_rate">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="notch" class="form-label">Notch</label>
                            <input type="text" class="form-control" id="notch" name="notch">
                        </div>
                    </div>
                </div>

                <!-- Camera -->
                <div class="form-section">
                    <h4>Camera</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="main_camera_setup" class="form-label">Main Camera Setup</label>
                            <input type="text" class="form-control" id="main_camera_setup" name="main_camera_setup">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="main_camera_resolution" class="form-label">Main Camera Resolution</label>
                            <input type="text" class="form-control" id="main_camera_resolution" name="main_camera_resolution">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="main_camera_resolution" class="form-label">Image Resolution</label>
                            <input type="text" class="form-control" id="main_camera_resolution" name="main_camera_image_resolution">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="main_camera_resolution" class="form-label">Flash</label>
                            <input type="text" class="form-control" id="main_camera_resolution" name="main_camera_flash">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="main_camera_resolution" class="form-label">Zoom</label>
                            <input type="text" class="form-control" id="main_camera_resolution" name="main_camera_zoom">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="main_camera_resolution" class="form-label">Main Camera Video</label>
                            <input type="text" class="form-control" id="main_camera_resolution" name="main_camera_video">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="main_camera_features" class="form-label">Main Camera Features</label>
                            <input type="text" class="form-control" id="main_camera_features" name="main_camera_features">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="selfie_camera_setup" class="form-label">Selfie Camera Setup</label>
                            <input type="text" class="form-control" id="selfie_camera_setup" name="selfie_camera_setup">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="selfie_camera_resolution" class="form-label">Selfie Camera Resolution</label>
                            <input type="text" class="form-control" id="selfie_camera_resolution" name="selfie_camera_resolution">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="selfie_camera_resolution" class="form-label">Selfie Camera Video</label>
                            <input type="text" class="form-control" id="selfie_camera_resolution" name="selfie_camera_video">
                        </div>
                    </div>
                </div>

                <!-- Performance -->
                <div class="form-section">
                    <h4>Performance</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="operating_system" class="form-label">Operating System</label>
                            <input type="text" class="form-control" id="operating_system" name="operating_system">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="chipset" class="form-label">Os Version</label>
                            <input type="text" class="form-control" id="chipset" name="os_version">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="chipset" class="form-label">User Interface</label>
                            <input type="text" class="form-control" id="chipset" name="user_interface">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="chipset" class="form-label">Chipset</label>
                            <input type="text" class="form-control" id="chipset" name="chipset">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="gpu" class="form-label">GPU</label>
                            <input type="text" class="form-control" id="gpu" name="gpu">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cpu" class="form-label">CPU</label>
                            <input type="text" class="form-control" id="cpu" name="cpu">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="cpu" class="form-label">CPU Cores</label>
                            <input type="text" class="form-control" id="cpu" name="cpu_cores">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="cpu" class="form-label">Architecture</label>
                            <input type="text" class="form-control" id="cpu" name="architecture">
                        </div>
                    </div>
                </div>
				
				<!-- Memory -->
                <div class="form-section">
                    <h4>Memory</h4>
                    <div class="row">
						<div class="col-md-6 mb-3">
                            <label for="cpu" class="form-label">Card Slots</label>
                            <input type="text" class="form-control" id="cpu" name="card_slot">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="internal_storage" class="form-label">Internal Storage</label>
                            <input type="text" class="form-control" id="internal_storage" name="internal_storage">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="cpu" class="form-label">Storage Type</label>
                            <input type="text" class="form-control" id="cpu" name="storage_type">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ram" class="form-label">RAM</label>
                            <input type="text" class="form-control" id="ram" name="ram">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ram_type" class="form-label">RAM Type</label>
                            <input type="text" class="form-control" id="ram_type" name="ram_type">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="variant" class="form-label">Variant</label>
                            <input type="text" class="form-control" id="variant" name="variant">
                        </div>
                    </div>
                </div>
				
				<!-- Memory -->
                <div class="form-section">
                    <h4>Network & Connectivity</h4>
                    <div class="row">
						<div class="col-md-6 mb-3">
                            <label for="network" class="form-label">Network</label>
                            <input type="text" class="form-control" id="network" name="network">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sim_slot" class="form-label">SIM Slot</label>
                            <input type="text" class="form-control" id="sim_slot" name="sim_slot">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="sim_size" class="form-label">SIM Size</label>
                            <input type="text" class="form-control" id="sim_size" name="sim_size">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Speed" class="form-label">Speed</label>
                            <input type="text" class="form-control" id="Speed" name="speed">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="volte" class="form-label">VoltE</label>
                            <input type="text" class="form-control" id="volte" name="volte">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="wlan" class="form-label">WLAN</label>
                            <input type="text" class="form-control" id="wlan" name="wlan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bluetooth" class="form-label">Bluetooth</label>
                            <input type="text" class="form-control" id="bluetooth" name="bluetooth">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="gps" class="form-label">GPS</label>
                            <input type="text" class="form-control" id="gps" name="gps">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="nfc" class="form-label">NFC</label>
                            <input type="text" class="form-control" id="nfc" name="nfc">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="usb" class="form-label">USB</label>
                            <input type="text" class="form-control" id="usb" name="usb">
                        </div>
                    </div>
                </div>
				
				<!-- Security & Sensors -->
                <div class="form-section">
                    <h4>Security & Sensors</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fingerprint_sensor" class="form-label">Fingerprint Sensor</label>
                            <input type="text" class="form-control" id="fingerprint_sensor" name="fingerprint_sensor">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="ftype" class="form-label">Fingerprint Sensor Type</label>
                            <input type="text" class="form-control" id="ftype" name="finger_sensor_type">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Fingerprint Sensor Type</label>
                            <input type="text" class="form-control" id="position" name="finger_sensor_position">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="face_unlock" class="form-label">Face Unlock</label>
                            <input type="text" class="form-control" id="face_unlock" name="face_unlock">
                        </div>
                    </div>
                </div>

                <!-- Battery -->
                <div class="form-section">
                    <h4>Battery</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="battery_type" class="form-label">Battery Type</label>
                            <input type="text" class="form-control" id="battery_type" name="battery_type">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="text" class="form-control" id="capacity" name="capacity">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="charging" class="form-label">Charging</label>
                            <input type="text" class="form-control" id="charging" name="charging">
                        </div>
						<div class="col-md-6 mb-3">
                            <label for="battery_usb" class="form-label">Battery USB</label>
                            <input type="text" class="form-control" id="battery_usb" name="battery_usb">
                        </div>
                    </div>
                </div>
				
				<!-- Multimedia -->
                <div class="form-section">
                    <h4>Multimedia</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="loudspeaker" class="form-label">Loudspeaker</label>
                            <input type="text" class="form-control" id="loudspeaker" name="loudspeaker">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="audio_jack" class="form-label">Audio Jack</label>
                            <input type="text" class="form-control" id="audio_jack" name="audio_jack">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="video" class="form-label">Video</label>
                            <input type="text" class="form-control" id="video" name="video">
                        </div>
                    </div>
                </div>
				
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="specificationSubmit">
                        <i class="fas fa-save me-2"></i> Save Specification
                    </button>
                </div>
            </form>
			
			<div style="margin-top: 30px;">
				<?php
				// Show message only if form is submitted
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					echo $submissionMessage;
				}
				?>
			</div>
			
        </div>
    </div>
<?php 
	include_once('footer.php');
?>