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
                <h1 class="h3 mb-0 text-gray-800">Deposite Requests</h1>
            </div>

            <!-- Withdraw Requests Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Deposite Requests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="withdrawTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>transaction Id</th>
                                    <th>Payment Method</th>
                                    <th>Account Number</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php 
									$select = "SELECT deposite.*, users.username, users.email  FROM deposite INNER JOIN users ON deposite.user_id = users.id WHERE deposite.approve_status = 'pending' ORDER BY deposite_date";
									$pandingRequest = $pdo->prepare($select);
									$pandingRequest->execute();
									
									$count = 1;
									
									while($depositeRequest = $pandingRequest->fetch()){
										
										?>
											<tr>
												<td><?php echo $count ?></td>
												<td>
													<?php echo $depositeRequest['username'] ?><br><small><?php echo $depositeRequest['email'] ?></small>
												</td>
												<td>
													<?php echo $depositeRequest['deposite_amount'] ?>
												</td>
												<td>
													<?php echo $depositeRequest['transaction_id'] ?>
												</td>
												<td><?php echo $depositeRequest['deposite_method'] ?></td>
												<td><?php echo $depositeRequest['deposite_number'] ?></td>
												<td><?php echo $depositeRequest['deposite_date'] ?></td>
												<td class="status-pending">
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_amount" value="<?php echo $depositeRequest['deposite_amount'] ?>">
														<input type="hidden" name="hidden_id" value="<?php echo $depositeRequest['deposite_id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $depositeRequest['user_id'] ?>">
														<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
															<i class="fas fa-check"></i> Approve
														</button>
													</form>
												</td>
												<td>
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $depositeRequest['deposite_id'] ?>">
														<input type="hidden" name="hidden_user_id" value="<?php echo $depositeRequest['user_id'] ?>">
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
										$hidden_amount = $_POST['hidden_amount'];
										$id = (int) $_POST['hidden_id'];
										$user_id = $_POST['hidden_user_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE deposite SET approve_status = 'approved', processed_date = ? WHERE deposite_id = ?";
										$update_deposite = $pdo->prepare($sql);
										$update_deposite->execute([$updated_at, $id]);
										
										$sql ="UPDATE blance SET main_blance = main_blance + ? WHERE user_id = ?";
										$update_blance = $pdo->prepare($sql);
										$update_blance->execute([$hidden_amount, $user_id]);
										
										header("Location: ".$_SERVER['PHP_SELF']);
										exit();							
									}
									if(isset($_POST['reject'])){
										$id = (int) $_POST['hidden_id'];
										$updated_at = date('Y-m-d H:i:s');
										
										$sql ="UPDATE deposite SET approve_status = 'rejected', processed_date = ? WHERE deposite_id = ?";
										$update_deposite = $pdo->prepare($sql);
										$update_deposite->execute([$updated_at, $id]);
										
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