<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql = "SELECT mobile_id, model_name, status FROM mobiles ORDER BY created_at DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if(isset($_POST['images_submit'])){
		$mobile_id  = $_POST['model_name'];
		
		$stmt = $pdo->prepare("SELECT status FROM mobiles WHERE mobile_id = ?");
		$stmt->execute([$mobile_id]);
		$status = $stmt->fetchColumn();
		
		$imageArray = [];
		foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
			$file_name = $_FILES['images']['name'][$key];
			
			if($status == 'New'){
				$target = "../images/new/" . $file_name;
			}else{
				$target = "../images/used/" . $file_name;
			}
			

			if (move_uploaded_file($tmp_name, $target)) {
				$imageArray[] = $file_name;
			}
		}
		
		// Array কে JSON আকারে save করবো
		$jsonImages = json_encode($imageArray, JSON_UNESCAPED_SLASHES);
		
		if($mobile_id && $jsonImages && $mobile_id != '#'){
			$sql = "INSERT INTO mobile_images(mobile_id, image_url) VALUES (?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$mobile_id, $jsonImages]);
			
			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>
    
        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add Mobile Images</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Images</h4>
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
                        <div class="col-md-12 mb-3">
                            <label for="brand_id" class="form-label">Mobile Images</label>
                            <input type="file" name="images[]" multiple class="form-control" id="brand_id" required>
							<h5 class="text-danger"> You can select multiple images </h5>
                        </div>
                    </div>
                </div>
				
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="images_submit">
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