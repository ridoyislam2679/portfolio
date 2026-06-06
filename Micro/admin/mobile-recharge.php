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
                <h1 class="h3 mb-0 text-gray-800">Mobile Recharge</h1>
            </div>

            <!-- Withdraw Requests Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Mobile Recharge Requests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="withdrawTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Account Number</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
									$select = "SELECT mobile_recharge.*, users.username, users.email  FROM mobile_recharge INNER JOIN users ON mobile_recharge.user_id = users.id WHERE mobile_recharge.approve_status = 'pending' ORDER BY recharge_date";
									$pandingRecharge = $pdo->prepare($select);
									$pandingRecharge->execute();
									
									$count = 1;
									
									while($RechargeRequest = $pandingRecharge->fetch()){
										
										?>
											<tr>
												<td><?php echo $count ?></td>
												<td>
													<?php echo $RechargeRequest['username'] ?><br><small><?php echo $RechargeRequest['email'] ?></small>
												</td>
												<td>
													<?php echo $RechargeRequest['recharge_amount'] ?>
												</td>
												<td><?php echo $RechargeRequest['recharge_number'] ?></td>
												<td><?php echo $RechargeRequest['recharge_date'] ?></td>
												<td class="status-pending">
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $RechargeRequest['recharge_id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $RechargeRequest['user_id'] ?>">
														<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
															<i class="fas fa-check"></i> Approve
														</button>
													</form>
												</td>
												<td>
													<form class="action-form" method="POST">
													    <input type="hidden" name="hidden_amount" value="<?php echo $RechargeRequest['recharge_amount'] ?>">
														<input type="hidden" name="hidden_id" value="<?php echo $RechargeRequest['recharge_id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $RechargeRequest['user_id'] ?>">
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
										$user_id = $_POST['hidden_user_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE mobile_recharge SET approve_status = 'approved', approve_date = ? WHERE recharge_id = ?";
										$update_recharge = $pdo->prepare($sql);
										$update_recharge->execute([$updated_at, $id]);
										
										header("Location: ".$_SERVER['PHP_SELF']);
										exit();							
									}
									if(isset($_POST['reject'])){
									    $hidden_amount = $_POST['hidden_amount'];
									    $user_id = $_POST['hidden_user_id'];
										$id = (int) $_POST['hidden_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE mobile_recharge SET approve_status = 'rejected', approve_date = ? WHERE recharge_id = ?";
										$update_recharge = $pdo->prepare($sql);
										$update_recharge->execute([$updated_at, $id]);
										
										$sql ="UPDATE blance SET total_coin = total_coin + ? WHERE user_id = ?";
										$update_blance = $pdo->prepare($sql);
										$update_blance->execute([$hidden_amount, $user_id]);
										
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