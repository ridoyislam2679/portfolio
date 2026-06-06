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
	//$user_id = 1;
	// Get user data
	$stmt = $pdo->prepare("SELECT username, active_status FROM users WHERE id = ?");
	$stmt->execute([$user_id]);
	$user = $stmt->fetch();
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT total_earning, main_blance FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();
	
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
                            <small class="d-block">Minimum Deposit: 100.00TK</small>
                        </div>
                    </div>
                </div>
                
                <!-- Deposit Form -->
                <div class="custom-card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="mb-3">Upcoming Deposite way</h5>
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
                                                <small class="text-muted">Coming Soon</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Enter Details -->
						<h1 class="deposite-number"> *Must Deposit this account number: 01XXXXXXXXX</h1>
                        <div class="mb-4">
                            <h5 class="mb-3">2. Enter Deposit Details</h5>
                            <form method="GET">
                                <div class="method-details" id="bikash-details">
									<div class="mb-3">
                                        <label class="form-label">Deposite Method</label>
										<select class="form-control custom-form-control" name="method">
											<option value=""> Select Deposite Method </option>
											<option value="bikash"> Bikash </option>
											<option value="nagod"> Nagod </option>
											<option value="rocket"> Rocket </option>
											<option value="binance"> Binance </option>
										</select>
                                    </div>
									<div class="mb-3">
                                        <label class="form-label">Deposit Number</label>
                                        <input type="text" name="sender" class="form-control custom-form-control" placeholder="01XXXXXXXXX" required>
                                    </div>
									<div class="mb-3">
                                        <label class="form-label">Tranjection Id</label>
                                        <input type="text" name="tranjection_id" class="form-control custom-form-control" placeholder="01-XXyXX-XXXX" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deposit Amount (BDT)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">৳</span>
                                            <input type="number" name="amount" class="form-control custom-form-control" placeholder="Enter amount" min="100" step="10" required>
                                        </div>
                                        <small>Minimum: ৳500 (~$5)</small>
                                    </div>
                                </div>                                
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" name="deposite_btn" class="btn btn-primary btn-lg">
                                        <i class="fas fa-arrow-circle-down me-2"></i> Proceed to Deposit
                                    </button>
                                </div>
                            </form>
							<?php
								if(isset($_GET['deposite_btn'])){
									$method = $_GET['method'];
									$number = $_GET['sender'];
									$trn_id = $_GET['tranjection_id'];
									$amount = $_GET['amount'];
									
									if($method && $number && $trn_id && $amount && $user_id){
										if($amount >= 100){
											try {
												$sql = "INSERT INTO deposite(user_id, deposite_number, deposite_method, deposite_amount, transaction_id) VALUES (?, ?, ?, ?, ?)";
												$stmt = $pdo->prepare($sql);
												$stmt->execute([$user_id, $number, $method, $amount, $trn_id]);
												
												header("Location: deposite.php?success=1");
												exit;
											}catch (PDOException $e) {
												if ($e->getCode() == 23000) {
													// 23000 = Integrity constraint violation (e.g., duplicate trxid)
													$error = "This transaction ID has already been used.";
												} else {
													$error = "Database error: " . $e->getMessage();
												}
											}
										}else{
											echo '<span id="copyMsg" style="color: red;">Minimum deposite 100TK</span>';
										}
									}else{
										echo 'error';
									}						
								}
								
							?>	
							<!-- HTML Part -->
							<?php if (isset($_GET['success'])): ?>
								<div class="alert alert-success mt-4" style="color: red;">Deposit request submitted successfully.</div>
							<?php elseif (!empty($error)): ?>
								<div class="alert alert-danger"><?= $error ?></div>
							<?php endif; ?>
							
                        </div>
                    </div>
                </div>
                
                <!-- Recent Deposits -->
                <div class="custom-card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Recent Panding Deposits</h4>
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
										$select = "SELECT * FROM deposite WHERE user_id = ? ORDER BY deposite_date DESC LIMIT 10";
										$historyQuery = $pdo->prepare($select);
										$historyQuery->execute([$user_id]);
										
										while($history = $historyQuery->fetch()){
											
											?>
												<tr>
													<td><?php echo $history['deposite_date']; ?></td>
													<td><?php echo $history['deposite_method']; ?></td>
													<td><?php echo $history['deposite_number']; ?></td>
													<td><span class="prize-won"><?php echo $history['deposite_amount']; ?></span></td>
													<td>
														<span class="prize-won">
															<?php echo $history['approve_status']; ?>
														</span>
													</td>
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
        </div>
    </main>

    <?php include_once('footer.php'); ?>
	
</body>
</html>