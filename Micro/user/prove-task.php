<?php
    session_start();
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
	

	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}
	if (!isset($_SESSION['id']) || !isset($_SESSION['value'])) {
		header('Location: task.php');
		exit();
	}

	$user_id = $_SESSION['user_id'];
	$task_id = $_SESSION['id'];
	$task_value = $_SESSION['value'];
	// user activity chack
	$userQuery = $pdo->prepare("SELECT active_status FROM users WHERE id = ?");
	$userQuery->execute([$user_id]);
	$user = $userQuery->fetch();
	
	$activityChack = $user['active_status'];
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT * FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();
	
	// Get Task Details
	$sql = "SELECT * FROM tasks WHERE task_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$task_id]);
	$task = $stmt->fetch();
	
?>

	<div class="container py-5">
		<div class="card shadow-lg rounded-4 overflow-hidden">
			
			<!-- 🔹 Top Image -->
			<img src="../admin/task/<?php echo $task['task_image']; ?>" class="img-fluid w-100" alt="Task Banner">

			<div class="card-body">
			
				<!-- 🔹 Title & URL Button -->
				<h3 class="mb-3">🎯 Task: <?php echo $task['title']; ?> </h3>
				<p class="mb-3"><?php echo $task['description']; ?></p>
				<a href="<?php echo $task['target_url']; ?>" target="_blank" class="btn btn-primary mb-4">Start Task</a>
	
				<!-- 🔹 Submission Form -->
				<form method="POST" enctype="multipart/form-data" class="mb-5">
					<div class="mb-3">
						<label for="screenshot" class="form-label">📸 Upload Screenshot (Required)</label>
						<input class="form-control" type="file" id="screenshot" name="screenshot" accept="image/*" required>
					</div>
	
					<div class="mb-3">
						<label for="proofText" class="form-label">🔗 Paste Your Profile Link or ID</label>
						<input type="text" class="form-control" id="proofText" name="proofText" placeholder="e.g., https://facebook.com/yourname" required>
					</div>
					
					<input type="hidden" value="<?php echo $task_value; ?>" name="hidden_value">
	
					<div class="d-grid">
						<button type="submit" name="submit_prove" class="btn btn-success btn-lg">✅ Submit Proof</button>
					</div>
				</form>
				
				<?php 
					if(isset($_POST['submit_prove'])){
						$proofURL   = $_POST['proofText'];
						$taskValue = $_POST['hidden_value'];
						
						$screenshot = $_FILES['screenshot']['name'];
						$destination = "task/".$screenshot;
						
						// Get Task Details
                    	$sql = "SELECT * FROM tasks WHERE target_url = ?";
                    	$stmt = $pdo->prepare($sql);
                    	$stmt->execute([$proofURL]);
                    	$activeTask = $stmt->fetch();
						
						// chack Task Details
						$sql = "SELECT COUNT(*) FROM task_submissions WHERE user_id = ? AND DATE(submitted_at) = CURDATE()";
                    	//$sql = "SELECT * FROM task_submissions WHERE proof_text = ? AND user_id = ?";
                    	$chackTask = $pdo->prepare($sql);
                    	$chackTask->execute([$user_id]);
                    	$AvailableTask = $chackTask->fetchColumn();
						
						if($proofURL && $screenshot){
							if($activityChack == 1){
							    if($AvailableTask < 1){
							        $sql = "INSERT INTO task_submissions(user_id, task_id, screenshot_url, proof_text, task_earn) VALUES (?, ?, ?, ?, ?)";
    								$stmt = $pdo->prepare($sql);
    								$stmt->execute([$user_id, $task_id, $screenshot, $proofURL, $taskValue]);
    								move_uploaded_file($_FILES['screenshot']['tmp_name'], $destination);
    								
    								$sql ="UPDATE blance SET total_earning = total_earning + ? , main_blance = main_blance + ? WHERE user_id = ?";
									$update_blance = $pdo->prepare($sql);
									$update_blance->execute([$taskValue, $taskValue, $user_id]);
									
									//header("Location: ".$_SERVER['PHP_SELF']);
									//exit();	
    								
    								echo '<div class="alert alert-success mt-3" style="color: red;">Task request submitted successfully.</div>';
							    }else{
    								echo '<div class="alert alert-success mt-3" style="color: red;">Today already Completed Task</div>';
    							}
							}else{
								echo '<div class="alert alert-success mt-3" style="color: red;">You are not active member</div>';
							}								
						}else{
							echo '<div class="alert alert-success mt-3" style="color: red;">Plese Insert Form.</div>';
						}			
					}
				?>		
	
				<!-- 🔹 Submitted Proof List 
				<h5 class="mb-3">📄 Your Submitted Proofs</h5>
				<div class="table-responsive">
					<table class="history-table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Screenshot</th>
								<th>Url</th>
								<th>Request</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							/*
								$select = "SELECT screenshot_url, proof_text, status, submitted_at FROM task_submissions WHERE user_id = ? ORDER BY submitted_at DESC LIMIT 10";
								$historyQuery = $pdo->prepare($select);
								$historyQuery->execute([$user_id]);
								
								while($history = $historyQuery->fetch()){
									$currentTime = new DateTime($history['submitted_at']);
									$formattedDate = $currentTime->format('Y-m-d h:i:s');
									
									?>
										<tr>
											<td><?php echo $formattedDate ?></td>
											<td> <img src="task/<?php echo $history['screenshot_url']; ?>" height="70px" width="70px"></td>
											<td><span class="prize-won"><?php echo $history['proof_text']; ?></span></td>
											<td><span class="prize-won"><?php echo $history['status']; ?></span></td>
										</tr>
									<?php								
								}
							*/
							?>
						</tbody>
					</table>
				</div>
				-->
			</div>
		</div>
	</div>

<?php
	include_once('footer.php');
?>