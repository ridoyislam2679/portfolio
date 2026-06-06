<?php 
	include_once('header.php');
	include_once('../db/index.php');
	
	$sql = "SELECT mobile_id, model_name, status FROM mobiles ORDER BY created_at DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	
	if(isset($_POST['faqSubmit'])){
		$mobile_id   = $_POST['model_name'];
		$question    = $_POST['question'];
		$answer      = $_POST['answer']; 
		
		if($mobile_id && $question && $answer && $mobile_id != '#'){
			$sql = "INSERT INTO mobile_faq(mobile_id, FAQ_Question, FAQ_Answer) VALUES (?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$mobile_id, $question, $answer]);

			$submissionMessage =  '<div class="alert alert-success mt-3" style="color: red;">Form Submitted Successfully.</div>';	
		}else{
			$submissionMessage = '<div class="alert alert-success mt-3" style="color: red;">Submission failed!</div>';	
		}
	}	
	
?>

        <!-- Mobile Specification Form -->
        <div class="specification-form">
            <h2 class="mb-4">Add FAQ</h2>
            
            <form action="" method="POST" enctype="">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4>FAQ Information</h4>
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
                            <label for="colors" class="form-label">Question</label>
							<textarea name="question" class="form-control" id="colors" rows="4" cols="20" placeholder="Enter your Content..."></textarea>
                        </div>
						<div class="col-md-12 mb-3">
                            <label for="colors" class="form-label">Answer</label>
							<textarea name="answer" class="form-control" id="colors" rows="8" cols="40" placeholder="Enter your Content..."></textarea>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
					<button type="reset" class="btn btn-secondary me-2">
						<i class="fas fa-undo"></i> Reset
					</button>
                    <button type="submit" class="submit-btn" name="faqSubmit">
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