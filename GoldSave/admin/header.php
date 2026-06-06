<?php 
    function active_class($page_name){
		$current_page = basename($_SERVER['PHP_SELF']); 
		if($page_name == $current_page){
			echo 'active';
		}else{
			echo 'nav-link';
		}
		return '';;
	}
?>

    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
			<a href="dashboard.php" class="logoBTN">
				<i class="fas fa-coins"></i> 
				<span><image src="../logo/3532A.png"></span>
			</a>
            <p>Admin Panel</p>
        </div>
        
        <ul class="sidebar-menu">
            <li class="<?php active_class('dashboard.php'); ?>">
                <a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php active_class('findUser.php'); ?>">
                <a href="findUser.php">
                    <i class="fas fa-users"></i>
                    <span>Find User</span>
                </a>
            </li>
            <li class="<?php active_class('goldPrice.php'); ?>">
                <a href="goldPrice.php">
                    <i class="fas fa-gem"></i>
                    <span>Gold Price Settings</span>
                </a>
            </li>
            <li class="<?php active_class('markettingPost.php'); ?>">
                <a href="markettingPost.php">
                    <i class="fas fa-chart-line"></i>
                    <span>Marketting Post</span>
                </a>
            </li>
            <li class="<?php active_class('dailyBonus.php'); ?>">
                <a href="dailyBonus.php">
                    <i class="fas fa-gift"></i>
                    <span>Daily Bonus</span>
                </a>
            </li>
			<li class="<?php active_class('marquePost.php'); ?>">
                <a href="marquePost.php">
                    <i class="fas fa-gift"></i>
                    <span>Offer Post</span>
                </a>
            </li>
            <li class="<?php active_class('withdrawRequest.php'); ?>">
                <a href="withdrawRequest.php">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Withdraw Request</span>
                </a>
            </li>
			<li class="<?php active_class('depositRequest.php'); ?>">
                <a href="depositRequest.php">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Deposit Request</span>
                </a>
            </li>
            <li class="<?php active_class('collectGold.php'); ?>">
                <a href="collectGold.php">
                    <i class="fas fa-hand-holding-heart"></i>
                    <span>Collect Gold Request</span>
                </a>
            </li>
            <li class="<?php active_class('markettingSubmission.php'); ?>">
                <a href="markettingSubmission.php">
                    <i class="fas fa-file-alt"></i>
                    <span>Marketting Submissions</span>
                </a>
            </li>
            <li class="<?php active_class('mobileRecharge.php'); ?>">
                <a href="mobileRecharge.php">
                    <i class="fas fa-mobile-alt"></i>
                    <span>Mobile Recharge</span>
                </a>
            </li>
			<li class="<?php active_class('status.php'); ?>">
                <a href="status.php">
                    <i class="fas fa-user"></i></i>
                    <span>Status</span>
                </a>
            </li>
        </ul>
    </div>
    