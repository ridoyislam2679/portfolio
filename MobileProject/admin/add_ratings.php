<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql = "SELECT mobile_id, model_name, status FROM mobiles ORDER BY created_at DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if(isset($_POST['ratingsSubmit'])){
		$mobile_id   = $_POST['model_name'];
		$display     = $_POST['display'];
		$design      = $_POST['design']; 
		$pefomance   = $_POST['pefomance']; 
		$camera      = $_POST['camera']; 
		$conectivity = $_POST['conectivity']; 
		$battery     = $_POST['battery']; 
		$price       = $_POST['price']; 
		
		if($mobile_id && $display && $design && $pefomance && $camera && $conectivity && $battery && $price && $mobile_id != '#'){
			$sql = "INSERT INTO mobile_ratings(mobile_id, display_rating, design_rating, performance_rating, camera_rating, connectivity_rating, battery_rating, price_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$mobile_id, $display, $design, $pefomance, $camera, $conectivity, $battery,  $price]);

			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add Mobile Rating</h2>
            
            <form action="" method="POST" enctype="">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Rating Information</h4>
                    <div class="row">
						<div class="col-md-12 mb-3">
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
                            <label for="height" class="form-label">Display</label>
							<select class="form-control" id="height" name="display" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Design</label>
							<select class="form-control" id="height" name="design" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Perfomance</label>
							<select class="form-control" id="height" name="pefomance" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label">Camera</label>
							<select class="form-control" id="height" name="camera" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label"> Connectivity </label>
							<select class="form-control" id="height" name="conectivity" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label"> Battery </label>
							<select class="form-control" id="height" name="battery" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
						<div class="col-md-4 mb-3">
                            <label for="height" class="form-label"> Price </label>
							<select class="form-control" id="height" name="price" required>
								<option value="10"> 10 </option>
								<option value="9"> 9 </option>
								<option value="8"> 8 </option>
								<option value="7"> 7 </option>
								<option value="6"> 6 </option>
								<option value="5"> 5 </option>
							</select>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="ratingsSubmit">
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