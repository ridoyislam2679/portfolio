<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql ="SELECT * FROM brands";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();	
	
	if(isset($_POST['mobile_submit'])){
		$brand_name      = $_POST['brand_name'];
		$model_name      = $_POST['model_name'];
		$phn_title       = $_POST['phn_title'];
		$specalist       = $_POST['specalist'];
		$phone_condition = $_POST['phone_condition'];
		$battery_health  = $_POST['battery_health'];
		$status 		 = $_POST['status'];
		$phone_price 	 = $_POST['phone_price'];
		$release_date 	 = $_POST['release_date'];
		$meta_dsc 		 = $_POST['meta_dsc'];
			
		$main_image = $_FILES['phone_image']['name'];
		
		if($status == 'New' || 'Upcoming'){
			$destination = "../images/new/".$main_image;
		}else{
			$destination = "../images/used/".$main_image;
		}
		
		if($brand_name && $phn_title && $model_name && $meta_dsc && $specalist && $release_date && $phone_condition &&   $battery_health && $phone_price && $main_image && $status && $brand_name != '#'){
			$sql = "INSERT INTO mobiles(brand_id, model_name, phone_title, meta_description, specalist, release_date, phone_condition, battery_helth, price, main_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$brand_name, $model_name, $phn_title, $meta_dsc, $specalist, $release_date, $phone_condition,  $battery_health, $phone_price, $main_image, $status]);
			move_uploaded_file($_FILES['phone_image']['tmp_name'], $destination);
								
			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>
    

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add New Mobile</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Model Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mobile_id" class="form-label">Brand Name</label>
							<select class="form-control" id="mobile_id" name="brand_name" required>
								<option value="#"> --Chose-- </option>
								<?php 
									while($row = $stmt->fetch()){
										?>	
										<option value="<?= $row['brand_id']; ?>"> <?= $row['brand_name']; ?> </option>
										<?php
									}
								?>
							</select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand_id" class="form-label">Model Name</label>
                            <input type="text" class="form-control" id="brand_id" name="model_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="colors" class="form-label">Phone Title</label>
							<textarea name="phn_title" class="form-control" id="colors" rows="4" cols="20" placeholder="Enter your phone title..."></textarea>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Specalist</label>
							<select class="form-control" id="height" name="specalist" required>
								<option value="Overall"> Overall </option>
								<option value="Gaming-phone"> Gaming-phone </option>
								<option value="Camera-Phone"> Camera-Phone </option>
							</select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="width" class="form-label">Phone Condition</label>
                            <input type="text" class="form-control" id="width" name="phone_condition">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="thickness" class="form-label">Battery Health</label>
                            <input type="text" class="form-control" id="thickness" name="battery_health">
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Status</label>
							<select class="form-control" id="height" name="status" required>
								<option value="New"> New </option>
								<option value="Upcoming"> Upcoming </option>
								<option value="Pre-Owned"> Pre-Owned </option>
							</select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="build" class="form-label">Phone Price</label>
                            <input type="text" class="form-control" id="build" name="phone_price">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="weight" class="form-label">Release Date</label>
                            <input type="date" class="form-control" id="weight" name="release_date">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="colors" class="form-label">Meta Description</label>
							<textarea name="meta_dsc" class="form-control" id="colors" rows="8" cols="40" placeholder="Enter your Meta Description..."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="phone_image">
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="mobile_submit">
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