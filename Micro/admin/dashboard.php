<?php 
	include_once('header.php');
	include_once('../db/index.php');
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	// Get referral stats
	$stmt = $pdo->prepare("SELECT COUNT(*) as id FROM users");
	$stmt->execute();
	$user = $stmt->fetch();
	
	// Get Panding withdrawal Requests
	$stmt = $pdo->prepare("SELECT COUNT(*) as request_id FROM withdrawal_requests");
	$stmt->execute();
	$withdrawal = $stmt->fetch();
	
	// Get Panding Task
	$stmt = $pdo->prepare("SELECT COUNT(*) as task_id FROM tasks");
	$stmt->execute();
	$task = $stmt->fetch();
	
	// Get Rit Coin Price
	$stmt = $pdo->prepare("SELECT rit_coin_price FROM rit_coin ORDER BY rit_coin_price DESC LIMIT 1");
	$stmt->execute();
	$rit_coin = $stmt->fetch();
	
?>
<?php 
	include_once('sidebar.php');
?>
    
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Users
									</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $user['id'];?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pending Withdrawals</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $withdrawal['request_id'];?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Tasks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $task['task_id'];?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- RIT Coin Price Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        RIT Coin Price</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $rit_coin['rit_coin_price'];?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- Recent Withdrawals -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Withdrawal Requests</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>User Id</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
											//$stmt = $pdo->prepare("SELECT username, referral_code, active_status FROM users");
											//->execute();
											//$user_details = $stmt->fetch();
											
											//$select = "SELECT * FROM withdrawal_requests ORDER BY request_date DESC LIMIT 10";
											
                                            $select = "SELECT withdrawal_requests.*, users.username, users.referral_code, users.active_status
                                            FROM withdrawal_requests
                                            INNER JOIN users ON withdrawal_requests.user_id = users.id ORDER BY withdrawal_requests.request_date DESC LIMIT 10";
											$historyQuery = $pdo->prepare($select);
											$historyQuery->execute();
											
											while($history = $historyQuery->fetch()){
												if($history['status'] == 'pending'){
													$style = 'badge bg-warning';
												}else if($history['status'] == 'approved'){
													$style = 'badge bg-success';
												}else{
													$style = 'badge bg-danger';
												}
												?>
													<tr>
														<td><?php echo $history['username']; ?></td>
														<td>
															<?php echo $history['referral_code']; ?>
														</td>
														<td><?php echo $history['method']; ?></td>
														<td><span class="prize-won"><?php echo $history['amount']; ?></span></td>
														<td>
														<span class="prize-won <?php echo $style; ?>">
															<?php echo $history['status']; ?>
														</span>
														</td>
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
                
                <!-- Recent Tasks -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Added Task</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Task No</th>
                                            <th>Task</th>
                                            <th>Target url</th>
                                            <th>Earn Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
											$select = "SELECT title, target_url, task_earn FROM tasks ORDER BY created_at DESC LIMIT 10";
											$pandingTask = $pdo->prepare($select);
											$pandingTask->execute();
											
											$task_count = 1;
											
											while($history = $pandingTask->fetch()){
												
												?>
													<tr>
														<td><?php echo $task_count ?></td>
														<td><?php echo $history['title'] ?></td>
														<td><?php echo $history['target_url'] ?></td>
														<td><span class="prize-won"><?php echo $history['task_earn']; ?></span></td>
													</tr>
												<?php	
												$task_count++;
											}							
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
	include_once('footer.php');
?>