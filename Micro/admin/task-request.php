<?php 
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
?>
<?php 
	include_once('sidebar.php');
?>
    
   <!-- Withdraw Requests Table -->
      <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Task Requests</h1>
            </div>

            <!-- Withdraw Requests Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Task Requests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="withdrawTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Image</th>
                                    <th>Task Url</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
									$select = "SELECT task_submissions.*, users.username, users.email  FROM task_submissions INNER JOIN users ON task_submissions.user_id = users.id WHERE task_submissions.status = 'pending' ORDER BY submitted_at";
									$pandingTask = $pdo->prepare($select);
									$pandingTask->execute();
									
									$task_count = 1;
									
									while($taskRequest = $pandingTask->fetch()){
										
										?>
											<tr>
												<td><?php echo $task_count ?></td>
												<td>
													<?php echo $taskRequest['username'] ?><br><small><?php echo $taskRequest['email'] ?></small>
												</td>
												<td>
													<img src="../user/task/<?php echo $taskRequest['screenshot_url'] ?>" class="task_image">
												</td>
												<td><?php echo $taskRequest['proof_text'] ?></td>
												<td><?php echo $taskRequest['submitted_at'] ?></td>
												<td class="status-pending">
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $taskRequest['id'] ?>">
														<input type="hidden" name="hidden_value" value="<?php echo $taskRequest['task_earn'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $taskRequest['user_id'] ?>">
														<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
															<i class="fas fa-check"></i> Approve
														</button>
													</form>
												</td>
												<td>
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $taskRequest['id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $taskRequest['user_id'] ?>">
														<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
															<i class="fas fa-times"></i> Reject
														</button>
													</form>
												</td>
											</tr>
										<?php	
										$task_count++;
									}	
									
									if(isset($_POST['approve'])){
										$id = (int) $_POST['hidden_id'];
										$value = (int) $_POST['hidden_value'];
										$user_id = $_POST['hidden_user_id'];
										
										$sql ="UPDATE task_submissions SET status = 'approved' WHERE id = ?";
										$update_task = $pdo->prepare($sql);
										$update_task->execute([$id]);
										
										$sql ="UPDATE blance SET total_earning = total_earning + ? , main_blance = main_blance + ? WHERE user_id = ?";
										$update_blance = $pdo->prepare($sql);
										$update_blance->execute([$value, $value, $user_id]);
										
										header("Location: ".$_SERVER['PHP_SELF']);
										exit();							
									}
									if(isset($_POST['reject'])){
										$id = (int) $_POST['hidden_id'];
										
										$sql ="UPDATE task_submissions SET status = 'rejected' WHERE id = ?";
										$update_task = $pdo->prepare($sql);
										$update_task->execute([$id]);
										
										header("Location: ".$_SERVER['PHP_SELF']);
										exit();							
									}
									
								?>
								
                            </tbody>
                        </table>					
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
	include_once('footer.php');
?>