<?php 
	ob_start();
	include_once('header.php');	
	include_once('../db/index.php');
	
	session_start();

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
				
				<?php
					// Check if status is passed through the URL
					if (isset($_GET['status'])) {
						$status = $_GET['status'];
						if ($status === 'success') {
							echo '<div class="alert alert-success">✅Deposit successful! Amount: ' . $_GET['amount'] . ' BDT</div>';
						} elseif ($status === 'failed') {
							echo '<div class="alert alert-danger">❌Deposit failed. Please try again later.</div>';
						}
					}
				?>
                
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
                        <div class="mb-4">
                            <h5 class="mb-3">2. Enter Deposit Details</h5>
                            <form method="POST">
                                <div class="method-details" id="bikash-details">
									<div class="mb-3">
                                        <label class="form-label">Deposit Method</label>
										<select class="form-control custom-form-control" name="method">
											<option value=""> Select Deposite Method </option>
											<option value="bikash"> Bkash </option>
											<option value="nagod"> Nagad </option>
											<option value="rocket"> Rocket </option>
											<option value="binance"> Binance </option>
										</select>
                                    </div>
									<div class="mb-3">
                                        <label class="form-label">Deposit Number</label>
                                        <input type="text" name="sender" class="form-control custom-form-control" placeholder="01XXXXXXXXX" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deposit Amount (BDT)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">৳</span>
                                            <input type="number" name="amount" class="form-control custom-form-control" placeholder="Enter amount" required>
                                        </div>
                                        <small>Minimum: ৳100</small>
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
								if (isset($_POST['deposite_btn'])) {
									$amount = $_POST['amount'];
									$method = $_POST['method'];
									$number = $_POST['sender'];
									$user_id = $_SESSION['user_id'];
									
									if($amount >= 100){
									    $curl = curl_init();
    									curl_setopt_array($curl, array(
    										CURLOPT_URL => 'https://secure-pay.nagorikpay.com/api/payment/create',
    										CURLOPT_RETURNTRANSFER => true,
    										CURLOPT_POST => true,
    										CURLOPT_HTTPHEADER => array(
    											'API-KEY: vb2lyOWwjUyflaBa7zHmv6Q7WW2OKhMr6zFa0hx0twuwnpraDH',
    											'Content-Type: application/json'
    										),
    										CURLOPT_POSTFIELDS => json_encode([
    											'amount' => $amount,
    											'success_url' => 'https://refonex.com/user/auto-deposite-chack.php?user_id=' . $user_id . '&sender=' . urlencode($number),
    											'cancel_url' => 'https://refonex.com/user/deposite.php',
    											'webhook_url' => 'https://refonex.com/user/webhook.php',
    											'metadata' => [
    												'user_id' => $user_id,
    												'method' => $method,
    												'sender' => $number
    											]
    										])
    
    									));
    
    									$response = curl_exec($curl);
    									curl_close($curl);
    									
    									$data = json_decode($response, true);
    									if (isset($data['payment_url'])) {
    										header("Location: " . $data['payment_url']);
    										exit;
    									} else {
    										echo "Payment initialization failed.";
    									}
									}else{
									    	echo '<span id="copyMsg" style="color: green;">Minimum Diposit 100TK</span>';
									}
									
									
								}
								
							?>	
                        </div>
                    </div>
                </div>
                
                <!-- Recent Deposits 
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
									/*
										$select = "SELECT * FROM deposite WHERE user_id = ? ORDER BY deposite_date DESC LIMIT 10";
										$historyQuery = $pdo->prepare($select);
										$historyQuery->execute([$user_id]);
										
										while($history = $historyQuery->fetch()){
											if($history['approve_status'] == 1){
												$status = "Approve";
											}else{
												$status = "Panding";
											}
											?>
												<tr>
													<td><?php echo $history['deposite_date']; ?></td>
													<td><?php echo $history['deposite_method']; ?></td>
													<td><?php echo $history['deposite_number']; ?></td>
													<td><span class="prize-won"><?php echo $history['deposite_amount']; ?></span></td>
													<td><span class="prize-won"><?php echo $status; ?></span></td>
												</tr>
											<?php								
										}	
										*/
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
				-->
            </div>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
	
</body>
</html>