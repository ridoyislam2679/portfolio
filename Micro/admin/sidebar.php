<?php 
	function active_class($page_name){
		$current_page = basename($_SERVER['PHP_SELF']); 
		if($page_name == $current_page){
			echo 'sidebar-link active';
		}else{
			echo 'sidebar-link';
		}
		return '';;
	}
?>
    <!-- Sidebar Navigation -->
    <nav class="sidebar" id="sidebar">
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="dashboard.php" class="<?php active_class('dashboard.php'); ?>">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="withdraw-request.php" class="<?php active_class('withdraw-request.php'); ?>">
                    <span>Withdraw Requests</span>
                </a>
            </li>
			<li class="sidebar-item">
                <a href="deposite-request.php" class="<?php active_class('deposite-request.php'); ?>">
                    <span>Deposite Requests</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="mobile-recharge.php" class="<?php active_class('mobile-recharge.php'); ?>">
                    <span>Mobile Recharge</span>
                </a>
            </li>
			<li class="sidebar-item">
                <a href="add-task.php" class="<?php active_class('add-task.php'); ?>">
                    <span>Add Task</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="task-list.php" class="<?php active_class('task-list.php'); ?>">
                    <span>Task List</span>
                </a>
            </li>
            <!--
            <li class="sidebar-item">
                <a href="task-request.php" class="<?php active_class('task-request.php'); ?>">
                    <span>Task Requests</span>
                </a>
            </li>
            -->
            <li class="sidebar-item">
                <a href="user-information.php" class="<?php active_class('user-information.php'); ?>">
                    <span>User Information</span>
                </a>
            </li>
            <!--
            <li class="sidebar-item">
                <a href="blance-update.php" class="<?php //active_class('blance-update.php'); ?>">
                    <span>User Blance Update</span>
                </a>
            </li>
            -->
            <li class="sidebar-item">
                <a href="rit-coin.php" class="<?php active_class('rit-coin.php'); ?>">
                    <span>RIT Coin Price</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="add-shop.php" class="<?php active_class('add-shop.php'); ?>">
                    <span>Add Shop Item</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="shop-list.php" class="<?php active_class('shop-list.php'); ?>">
                    <span>Shop List</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="add-news.php" class="<?php active_class('add-news.php'); ?>">
                    <span>Add News</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="news-list.php" class="<?php active_class('news-list.php'); ?>">
                    <span>News List</span>
                </a>
            </li>
        </ul>
    </nav>
   