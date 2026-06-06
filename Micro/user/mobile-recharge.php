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
	$blanceQuery = $pdo->prepare("SELECT total_coin FROM blance WHERE user_id = ?");
	$blanceQuery->execute([$userId]);
	$blance = $blanceQuery->fetch(PDO::FETCH_ASSOC);	
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
                            <small class="d-block">Maximum Recharge: 20.00</small>
                        </div>
                    </div>
                </div>
                
                <!-- Deposit Form -->
                <div class="custom-card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="mb-3"> Enter Recharge Details</h5>
                            <form method="POST">
								<label class="form-label">Mobile Number</label>
								<input type="text" class="form-control custom-form-control" name="number" placeholder="01XXXXXXXXX" required>
								<label class="form-label">Recharge Amount (BDT)</label>
								<input type="number" class="form-control custom-form-control" name="amount" placeholder="Enter amount" required>
								
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" name="recharge_request" class="btn btn-primary btn-lg">
										Recharge Request
                                    </button>
                                </div>
                            </form>
							<?php
								if(isset($_POST['recharge_request'])){
									$number =  $_POST['number'];
									$amount = $_POST['amount'];
									$requre_coin = ($amount * 1);
									
									$checkReacharge = $pdo->prepare("SELECT COUNT(*) FROM mobile_recharge WHERE user_id = ? AND DATE(approve_date) = CURDATE()");
                            		$checkReacharge->execute([$userId]);
                            		$alreadyReachargeToday = $checkReacharge->fetchColumn();
									
									if($number && $amount && $blance['total_coin'] >= $requre_coin){
										if($amount >= 20 && $amount <= 50){
										    if($alreadyReachargeToday < 1){
										        $sql = "INSERT INTO mobile_recharge(user_id, recharge_number, recharge_amount, recharge_coin) VALUES (?, ?, ?, ?)";
    											$stmt = $pdo->prepare($sql);
    											$stmt->execute([$userId, $number, $amount, $requre_coin]);
    											
    											$sql ="UPDATE blance SET total_coin = total_coin - ? WHERE user_id = ?";
        										$update_blance = $pdo->prepare($sql);
        										$update_blance->execute([$amount, $userId]);
    											
    											header("Location: ".$_SERVER['PHP_SELF']);
    									    	exit();	
										    }else{
										        echo '<span id="copyMsg" style="color: green;">You are already mobile recharge today.</span>';
										    }
										}else{
											echo '<span id="copyMsg" style="color: green;">Minimum Recharge 20Tk & Maximum Recharge 50TK</span>';
										}		
									}else{
										echo '<span id="copyMsg" style="color: green;">Insufficient Coin</span>';
									}
								}								
							?>
                        </div>
                    </div>
                </div>
                
				<!-- Recent Withdraw -->
				<div class="history-card">
					<div class="history-title">
						<i class="fas fa-history me-2"></i> Your Recharge History
					</div>
					<div class="table-responsive">
						<table class="history-table">
							<thead>
								<tr>
									<th>Date</th>
									<th>Number</th>
									<th>Amount</th>
									<th>Request</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$select = "SELECT * FROM mobile_recharge WHERE user_id = ? ORDER BY recharge_date DESC LIMIT 10";
									$historyQuery = $pdo->prepare($select);
									$historyQuery->execute([$userId]);
									
									while($history = $historyQuery->fetch()){
										$currentTime = new DateTime($history['recharge_date']);
										$formattedDate = $currentTime->format('Y-m-d h:i:s');
										?>
											<tr>
												<td><?php echo $formattedDate; ?></td>
												<td><?php echo $history['recharge_number']; ?></td>
												<td><span class="prize-won"><?php echo $history['recharge_amount']; ?></span></td>
												<td><span class="prize-won"><?php echo $history['approve_status']; ?></span></td>
											</tr>
										<?php								
									}							
								?>
							</tbody>
						</table>
						<?php 
						/*
							$sql = "SELECT * FROM withdrawal_requests WHERE user_id = ? ORDER BY request_date DESC";
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$userId]);
							$row = $stmt->fetch();
							
							$with_amount = $row['amount'];
							$with_status = $row['status'];
							
							if($with_status == 'approved'){
								//echo 'okay';
								//$sql ="UPDATE blance SET main_blance = main_blance - ? WHERE user_id = ?";
								//$update_blance = $pdo->prepare($sql);
								//$update_blance->execute([$with_amount, $userId]);
							}	
						*/
						?>						
					</div>
				</div>  
            </div>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
	
</body>
</html>