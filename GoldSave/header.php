<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

	function active_class($page_name){
		$current_page = basename($_SERVER['PHP_SELF']); 
		if($page_name == $current_page){
			echo 'nav-link active';
		}else{
			echo 'nav-link';
		}
		return '';;
	}
	
	$timeout = 600;

	if (isset($_SESSION['last_activity'])) {
		if (time() - $_SESSION['last_activity'] > $timeout) {
			session_unset();
			session_destroy();
			header("Location: login.php?msg=timeout");
			exit();
		}
	}

	$_SESSION['last_activity'] = time();
?>