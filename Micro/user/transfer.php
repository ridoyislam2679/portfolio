<?php 
    session_start();
    ob_start();
	include_once('header.php'); 
	include_once('../db/index.php');
	
	if (!isset($_SESSION['user_id'])) {
		header("Location: ../login.php");
		exit();
	}
	$userId = $_SESSION['user_id'];
	$blanceQuery = $pdo->prepare("SELECT main_blance, total_coin FROM blance WHERE user_id = ?");
	$blanceQuery->execute([$userId]);
	$blance = $blanceQuery->fetch(PDO::FETCH_ASSOC);
	
	$userQuery = $pdo->prepare("SELECT active_status, referral_code FROM users WHERE id = ?");
	$userQuery->execute([$userId]);
	$user = $userQuery->fetch();
	
?>
    <!-- Main Content -->
    <main class="container deposite-card pb-5 mt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Balance Card -->
                <div class="custom-balance-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Total Coin</h5>
                            <h2 class="mb-0"><?php echo $blance['total_coin']; ?></h2>
                        </div>
                        <div class="text-end">
                            <small class="d-block">Minimum Transfer: 100.00 Coin</small>
                        </div>
                    </div>
                </div>
                
                <!-- Deposit Form -->
                <div class="custom-card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="mb-3">Transfer Details</h5>
                            <form method="POST">
								<label class="form-label">User ID</label>
								<input type="text" class="form-control custom-form-control" name="transfer_user" placeholder="user id..." required>
								<label class="form-label">Coin</label>
								<input type="number" class="form-control custom-form-control mb-4" name="coin" placeholder="1XXXXXXXXX" required>
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" name="transfer_request" class="btn btn-primary btn-lg">
										Transfer Request
                                    </button>
                                </div>
                            </form>
							<?php 
								if(isset($_POST['transfer_request'])){
									$transfer_user = $_POST['transfer_user'];
									$coin = $_POST['coin'];
									
									if($user['active_status'] == 1){
										if($blance['total_coin'] >= $coin){
											if($coin >= 100){
												if($transfer_user !== $user['referral_code']){
													$select = "SELECT * FROM users WHERE referral_code = ?";
													$nUser = $pdo->prepare($select);
													$nUser->execute([$transfer_user]);
													
													$transfer_new_user = $nUser->fetch();
													
													if($transfer_new_user){
														$upNEW = "UPDATE blance SET total_coin = total_coin + ? WHERE user_id = ?";
														$upNUser = $pdo->prepare($upNEW);
														$upNUser->execute([$coin, $transfer_user]);
														
														$upOLD = "UPDATE blance SET total_coin = total_coin - ? WHERE user_id = ?";
														$upOLD_User = $pdo->prepare($upOLD);
														$upOLD_User->execute([$coin, $userId]);
														
														$transfer_details = "INSERT INTO transfer(user_id, transfer_user_id, blance_type, transfer_amount) VALUES (?, ?, 'Coin', ?)";
														$transfer_query = $pdo->prepare($transfer_details);
														$transfer_query->execute([$userId, $transfer_user, $coin ]);
														
														header("Location: ".$_SERVER['PHP_SELF']);
														exit();	
													}else{
														echo '<span id="copyMsg" style="color: green;">User Not Found</span>';
													}
												}else{
													echo '<span id="copyMsg" style="color: green;">You are not transfer your id</span>';
												}												
											}else{
												echo '<span id="copyMsg" style="color: green;">Minimum Transfer 100 Coin</span>';
											}
										}else{
											echo '<span id="copyMsg" style="color: green;">Insufficient Coin</span>';
										}										
									}else{
										echo '<span id="copyMsg" style="color: green;">You are not active member</span>';
									}								
								}								
							?>
                        </div>
                    </div>
                </div>
                
				<!-- Recent Transfer -->
				<div class="history-card">
					<div class="history-title">
						<i class="fas fa-history me-2"></i> Your Transfer History
					</div>
					<div class="table-responsive">
						<table class="history-table">
							<thead>
								<tr>
									<th>Date</th>
									<th>Transfer Id</th>
									<th>Transfer Coin</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$select = "SELECT * FROM transfer WHERE user_id = ? ORDER BY transfer_date DESC LIMIT 10";
									$historyQuery = $pdo->prepare($select);
									$historyQuery->execute([$userId]);
									
									while($history = $historyQuery->fetch()){
										$currentTime = new DateTime($history['transfer_date']);
										$formattedDate = $currentTime->format('Y-m-d h:i:s');
										?>
											<tr>
												<td><?php echo $formattedDate; ?></td>
												<td><?php echo $history['transfer_user_id']; ?></td>
												<td><span class="prize-won"><?php echo $history['transfer_amount']; ?></span></td>
											</tr>
										<?php								
									}							
								?>
							</tbody>
						</table>				
					</div>
				</div>  
            </div>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
	
</body>
</html>