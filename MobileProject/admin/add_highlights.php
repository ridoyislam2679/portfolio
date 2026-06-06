<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql = "SELECT mobile_id, model_name, status FROM mobiles ORDER BY created_at DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if(isset($_POST['highlightsSubmit'])){
		$mobile_id  = $_POST['model_name'];
		$highlights = $_POST['highlights']; // এখানে কমা দিয়ে আসবে
		// Comma দিয়ে আলাদা করব
		$highlightsArray = array_map('trim', explode(',', $highlights));

		// Array কে JSON আকারে database এ save করব
		$jsonHighlights = json_encode($highlightsArray, JSON_UNESCAPED_UNICODE);
		
		if($mobile_id && $jsonHighlights && $jsonHighlights != '[""]'){
			$sql = "INSERT INTO mobile_highlights(mobile_id, highlight_text) VALUES (?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$mobile_id, $jsonHighlights]);

			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>
    <!-- Main Content -->
    

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add Highlights</h2>
            
            <form action="" method="POST" enctype="">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>Highlights Information</h4>
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
                            <label for="colors" class="form-label">Highlights</label>
							<textarea name="highlights" class="form-control" id="colors" rows="4" cols="20" placeholder="Enter your Highlights...(seperated by come)"></textarea>
							<h6 class="text-danger"> seperated by come*</h6>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="highlightsSubmit">
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
<?php 
	include_once('footer.php');
?>