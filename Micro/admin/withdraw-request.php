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
                <h1 class="h3 mb-0 text-gray-800">Withdraw Requests</h1>
            </div>

            <!-- Withdraw Requests Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Withdrawal Requests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="withdrawTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>UserId & Email</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Account Number</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
									$select = "SELECT withdrawal_requests.*, users.username, users.email, users.referral_code FROM withdrawal_requests INNER JOIN users ON withdrawal_requests.user_id = users.id WHERE withdrawal_requests.status = 'pending' ORDER BY request_date";
									$pandingRequest = $pdo->prepare($select);
									$pandingRequest->execute();
									
									$count = 1;
									
									while($withRequest = $pandingRequest->fetch()){
									    $time =  $withRequest['request_date'];
										
										?>
											<tr>
												<td><?php echo $count ?></td>
												<td>
													<?php echo $withRequest['referral_code'] ?><br><small><?php echo $withRequest['email'] ?></small>
												</td>
												<td>
													<?php echo $withRequest['amount'] ?>
												</td>
												<td><?php echo $withRequest['method'] ?></td>
												<td><?php echo $withRequest['account_number'] ?></td>
												<td><?php echo date("h:i A", strtotime($time)); ?></td>
												<td class="status-pending">
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $withRequest['request_id'] ?>">
														<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
															<i class="fas fa-check"></i> Approve
														</button>
													</form>
												</td>
												<td>
													<form class="action-form" method="POST">
													    <input type="hidden" name="hidden_amount" value="<?php echo $withRequest['amount'] ?>">
														<input type="hidden" name="hidden_id" value="<?php echo $withRequest['request_id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $withRequest['user_id'] ?>">
														<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
															<i class="fas fa-times"></i> Reject
														</button>
													</form>
												</td>
											</tr>
										<?php	
										$count++;
									}
									
									if(isset($_POST['approve'])){
										$id = (int) $_POST['hidden_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE withdrawal_requests SET status = 'approved', processed_date = ? WHERE request_id = ?";
										$update_withdraw = $pdo->prepare($sql);
										$update_withdraw->execute([$updated_at, $id]);
										
										header("Location: ".$_SERVER['PHP_SELF']);
										exit();							
									}
									if(isset($_POST['reject'])){
									    $hidden_amount = $_POST['hidden_amount'];
									    $user_id = $_POST['hidden_user_id'];
										$id = (int) $_POST['hidden_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE blance SET main_blance = main_blance + ? WHERE user_id = ?";
										$update_blance = $pdo->prepare($sql);
										$update_blance->execute([$hidden_amount, $user_id]);
										
										$sql ="UPDATE withdrawal_requests SET status = 'rejected', processed_date = ? WHERE request_id = ?";
										$update_task = $pdo->prepare($sql);
										$update_task->execute([$updated_at, $id]);
										
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