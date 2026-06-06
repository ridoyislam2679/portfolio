<?php 
    session_start();
	ob_start();
	include_once('header.php');	
	include_once('../db/index.php');
	

	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}

	$user_id = $_SESSION['user_id'];
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT total_earning FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();

?>
    <!-- Main Content -->
    <main class="container pb-5 mt-5">
        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0">Available Tasks</h1>
                <p class="mb-0">Complete tasks and earn money</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-inline-block me-2">
                    <span class="me-2">Total Earning:</span>
                    <span class="badge bg-success fs-6"><?php echo $blance['total_earning']; ?></span>
                </div>
                
            </div>
        </div>
        
        <!-- Tasks Grid -->
        <div class="row g-4">
			<?php 				
				// Get user Blance
				$sql = "SELECT * FROM tasks WHERE task_status = 1";
				$task = $pdo->prepare($sql);
				$task->execute();
				
				while($availableTask = $task->fetch()){
					?>
						<div class="col-lg-4 col-md-6 task-item" data-category="surveys">
							<div class="card task-card">
								<img src="../admin/task/<?php echo $availableTask['task_image']; ?>" class="card-img-top task-img" alt="Survey Task">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-start mb-2">
										<h5 class="task-card-title mb-0"><?php echo $availableTask['title']; ?></h5>
										<span class="badge reward-badge"><?php echo $availableTask['task_earn']; ?></span>
									</div>
									<p class="card-text text-muted small"><?php echo $availableTask['description']; ?></p>
								</div>
								<div class="card-footer bg-transparent">
									<form method="POST">
									    <input type="hidden" value="<?php echo $availableTask['task_earn']; ?>" name="hidden_value">
										<input type="hidden" value="<?php echo $availableTask['task_id']; ?>" name="hidden_id">
										<button class="btn btn-primary w-100" name="start_task">
											<i class="fas fa-play me-1"></i> Start Task
										</button>
									</form>
								</div>
							</div>
						</div>
					<?php
				}
				
				if(isset($_POST['start_task'])){
					$_SESSION['value'] = $_POST['hidden_value'];
					$_SESSION['id'] = $_POST['hidden_id'];
					header('location:prove-task.php');
				}
				
				
			?>			
        </div>
    </main>
    <?php include_once('footer.php'); ?>
</body>
</html>