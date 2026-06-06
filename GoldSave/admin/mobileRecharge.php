<?php 
	ob_start();
	include_once('security.php');	
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Mobile Recharge - Save World</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="CSS/dashboard.css">
	<link rel="stylesheet" href="CSS/header.css">
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </div>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <?php include_once('header.php'); ?>
	
    <!-- Main Content -->
    <div class="main-content">
        <!-- Fixed Top Header with Logout Form -->
        <div class="top-header">
            <div class="page-title">
                <h1>Recharge</h1>
                <p>Panding Mobile Recharge Request</p>
            </div>
            <div class="admin-info">
                <div class="admin-name">
                    <div class="name"><?php echo $admin_name; ?></div>
                    <div class="role">সুপার অ্যাডমিন</div>
                </div>
                <form class="logout-form" method="POST" action="logout.php">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        লগআউট
                    </button>
                </form>
            </div>
        </div>
        
        
        <!-- Pending Mobile Recharge Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-mobile-alt"></i> Panding Mobile Recharge Request
            </div>
            <table class="custom-table">
                <thead>
					<tr>
                        <th>User No.</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Mobile Number</th>
                        <th>Amount</th>
                        <th>Joinig Date</th>
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "
								SELECT 
									r.recharge_id, 
									r.user_id,
									r.mobile_number,
									r.recharge_amount,
									r.recharge_date,
									r.recharge_status,
									u.user_name,
									u.userId
								FROM recharge r
								JOIN user u ON r.user_id = u.user_id
								WHERE r.recharge_status = 'pending'
								ORDER BY r.recharge_date DESC
								";

								$recharge_rqt = $pdo->prepare($select);
								$recharge_rqt->execute();
						
						$recharge_no = 1;
						
						while($sub = $recharge_rqt->fetch()){
							
							?>
								<tr>
									<td><?php echo $recharge_no; ?></td>
									<td><?php echo $sub['userId'] ?></td>
									<td><?php echo $sub['user_name'] ?></td>
									<td><?php echo $sub['mobile_number'] ?></td>
									<td><?php echo $sub['recharge_amount'] ?></td>
									<td><?php echo $sub['recharge_date'] ?></td>
									<td><?php echo $sub['recharge_status'] ?></td>
									<td class="status-pending">
										<form class="action-form" method="POST">
											<input type="hidden" name="hidden_amount" value="<?php echo $sub['recharge_amount'] ?>">
											<input type="hidden" name="hidden_id" value="<?php echo $sub['recharge_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $sub['user_id'] ?>">
											<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
												<i class="fas fa-check"></i> Approve
											</button>
										</form>
									</td>
									<td>
										<form class="action-form" method="POST">
											<input type="hidden" name="hidden_id" value="<?php echo $sub['recharge_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $sub['user_id'] ?>">
											<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
												<i class="fas fa-times"></i> Reject
											</button>
										</form>
									</td>
								</tr>
							<?php
							$recharge_no++;
						}		
						if(isset($_POST['approve'])){
							//$hidden_amount = $_POST['hidden_amount'];
							$id = (int) $_POST['hidden_id'];
							$user_id = $_POST['hidden_user_id'];
							$updated_at = date('Y-m-d H:i:s');
							
							$sql ="UPDATE recharge SET recharge_status = 'approve' WHERE recharge_id = ?";
							$submission = $pdo->prepare($sql);
							$submission->execute([$id]);
							
							header("Location: ".$_SERVER['PHP_SELF']);
							exit();							
						}
						if(isset($_POST['reject'])){
							$id = (int) $_POST['hidden_id'];
							$updated_at = date('Y-m-d H:i:s');
							
							$sql ="UPDATE recharge SET recharge_status = 'rejected' WHERE recharge_id = ?";
							$update_collect = $pdo->prepare($sql);
							$update_collect->execute([$id]);
							
							header("Location: ".$_SERVER['PHP_SELF']);
							exit();							
						}
					?>
                </tbody>
            </table>
        </div>
    </div>
	<script src="JS/menu.js"> </script>
</body>
</html>