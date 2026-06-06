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
	$blanceQuery = $pdo->prepare("SELECT  main_blance FROM blance WHERE user_id = ?");
	$blanceQuery->execute([$userId]);
	$blance = $blanceQuery->fetch(PDO::FETCH_ASSOC);
	
	$userQuery = $pdo->prepare("SELECT active_status FROM users WHERE id = ?");
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
                            <h5 class="mb-1">Current Balance</h5>
                            <h2 class="mb-0"><?php echo $blance['main_blance']; ?></h2>
                        </div>
                        <div class="text-end">
                            <small class="d-block">Minimum withdraw: 100.00</small>
                        </div>
                    </div>
                </div>
                
                <!-- Deposit Form -->
                <div class="custom-card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Withdraw Funds</h4>
                        
                        <!-- Step 1: Select Method -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-primary">1. Upcoming Payment Method</h5>
                            <div class="row g-3">
                                
                                <!-- Bank Transfer (Coming Soon) -->
                                <div class="col-md-6">
                                    <div class="custom-method-card p-3 rounded position-relative custom-coming-soon" data-method="bank">
                                        <div class="d-flex align-items-center">
                                            <img src="https://logo.clearbit.com/bank.com" alt="Bank Transfer" class="custom-method-logo">
                                            <div>
                                                <h6 class="mb-1">Bank Transfer</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cryptocurrency (Coming Soon) -->
                                <div class="col-md-6">
                                    <div class="custom-method-card p-3 rounded position-relative custom-coming-soon" data-method="crypto">
                                        <div class="d-flex align-items-center">
                                            <img src="https://logo.clearbit.com/coinbase.com" alt="Crypto" class="custom-method-logo">
                                            <div>
                                                <h6 class="mb-1">Cryptocurrency</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Enter Details -->
                        <div class="mb-4">
                            <h5 class="mb-3">2. Enter Withdraw Details</h5>
                            <form method="POST">
								<label class="form-label">Withdraw Account Number</label>
                                <select class="form-control custom-form-control" name="method">
									<option value=""> Select Payment Method </option>
									<option value="bikash"> Bkash </option>
									<option value="nagod"> Nagad </option>
									<option value="rocket"> Rocket </option>
									<option value="binance"> Binance </option>
								</select>
								<label class="form-label">Account Number/USDT Binance ID</label>
								<input type="text" class="form-control custom-form-control" name="number" placeholder="01XXXXXXXXX" required>
								<label class="form-label">Withdraw Amount (BDT)</label>
								<input type="number" class="form-control custom-form-control" name="amount" placeholder="Enter amount" required>
								
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" name="withdraw_request" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i> Request Withdrawal
                                    </button>
                                </div>
                            </form>
							<?php 
								if(isset($_POST['withdraw_request'])){
									$method =  $_POST['method'];
									$number =  $_POST['number'];
									$amount = $_POST['amount'];
									
									$checkWithdraw = $pdo->prepare("SELECT COUNT(*) FROM withdrawal_requests WHERE user_id = ? AND DATE(request_date) = CURDATE()");
                            		$checkWithdraw->execute([$userId]);
                            		$alreadyWithdrawToday = $checkWithdraw->fetchColumn();
									
									if($user['active_status'] == 1){
										if($blance['main_blance'] >= $amount){
											if($amount >= 100 && $amount <= 500){
											    if($alreadyWithdrawToday < 1){
											        $sql = "INSERT INTO withdrawal_requests(user_id, method, account_number, amount) VALUES (?, ?, ?, ?)";
    												$stmt = $pdo->prepare($sql);
    												$stmt->execute([$userId, $method, $number, $amount]);
    												
    												$sql ="UPDATE blance SET main_blance = main_blance - ? WHERE user_id = ?";
            										$update_blance = $pdo->prepare($sql);
            										$update_blance->execute([$amount, $userId]);
    												
    												header("Location: ".$_SERVER['PHP_SELF']);
    									        	exit();	
											    }else{
											        echo '<span id="copyMsg" style="color: green;">You are already withdraw today</span>';
											    }
											}else{
												echo '<span id="copyMsg" style="color: green;">Minimum Withdraw 100TK & Maximium Withdraw 500Tk</span>';
											}		
										}else{
											echo '<span id="copyMsg" style="color: green;">Insufficient Blance</span>';
										}										
									}else{
										echo '<span id="copyMsg" style="color: green;">You are not active member</span>';
									}								
								}								
							?>
                        </div>
                    </div>
                </div>
                
				<!-- Recent Withdraw -->
				<div class="history-card">
					<div class="history-title">
						<i class="fas fa-history me-2"></i> Your Withdraw History
					</div>
					<div class="table-responsive">
						<table class="history-table">
							<thead>
								<tr>
									<th>Date</th>
									<th>Method</th>
									<th>Number</th>
									<th>Blance</th>
									<th>Request</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$select = "SELECT * FROM withdrawal_requests WHERE user_id = ? ORDER BY request_date DESC LIMIT 10";
									$historyQuery = $pdo->prepare($select);
									$historyQuery->execute([$userId]);
									
									while($history = $historyQuery->fetch()){
									    $time =  $history['request_date'];
										?>
											<tr>
												<td><?php echo date("h:i A", strtotime($time)); ?></td>
												<td><?php echo $history['method']; ?></td>
												<td><?php echo $history['account_number']; ?></td>
												<td><span class="prize-won"><?php echo $history['amount']; ?></span></td>
												<td><span class="prize-won"><?php echo $history['status']; ?></span></td>
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
								echo 'okay';
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