<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	if(isset($_POST['brands_submit'])){
		$brand_name = $_POST['brand_name'];
		$brand_logo = $_FILES['brand_image']['name'];
		$destination = "../images/brands/".$brand_logo;
		
		if($brand_name && $brand_logo){
			$sql = "INSERT INTO brands(brand_name, brand_logo) VALUES (?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$brand_name, $brand_logo]);
			move_uploaded_file($_FILES['brand_image']['tmp_name'], $destination);
								
			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>
    <!-- Main Content -->
    

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add Mobile Brands</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Brands Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mobile_id" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" id="mobile_id" name="brand_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand_id" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" id="brand_id" name="brand_image" required>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="brands_submit">
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