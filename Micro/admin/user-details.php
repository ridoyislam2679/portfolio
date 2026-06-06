<?php 
	
	// total reffer
	$stmt = $pdo->prepare("SELECT COUNT(*) as referral_count FROM referrals WHERE referrer_id = ?");
	$stmt->execute([$user_id]);
	$stats = $stmt->fetch();
	
	// Get user Blance
	$stmt = $pdo->prepare("SELECT total_earning, main_blance, total_coin, rit_coin, free_spain FROM blance WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$blance = $stmt->fetch();
	
	// total Withdraw
	$stmt = $pdo->prepare("SELECT COUNT(*) as withdraw_count FROM withdrawal_requests WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$total_withdraw = $stmt->fetch();
	
	// total Recharge
	$stmt = $pdo->prepare("SELECT COUNT(*) as recharge_count FROM mobile_recharge WHERE user_id = ?");
	$stmt->execute([$user_id]);
	$total_recharge = $stmt->fetch();
?>
        

            <!-- User Statistics -->
            <div class="row mt-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User Id</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $user['username'] ?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Reffer Code</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $user['referral_code'] ?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        User Active Status</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php 
											if($user['active_status'] == 1 ){
												echo 'Active User';
											}else{
												echo 'None Active User';
											}
											
										?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-star fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Reffer/Pratner</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $stats['referral_count']; ?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cannabis fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Balance</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $blance['total_earning']; ?>TK
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Main Balance</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $blance['main_blance']; ?>TK
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total RIT Coins</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $blance['rit_coin']; ?>Rit Coin
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bitcoin-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Coins</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $blance['total_coin']; ?>Coin
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Free Spin</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
										<?php echo $blance['free_spain']; ?>
									</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Withdraw</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_withdraw['withdraw_count']; ?>TK</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-transfer fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Total Mobile Recharge</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_recharge['recharge_count']; ?>TK</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-mobile fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    