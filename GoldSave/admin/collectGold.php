<?php 
	ob_start();
	include_once('security.php');	
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Admin Dashboard - Gold Save World</title>
    
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
                <h1>Gold</h1>
                <p>Panding Collect Gold Request</p>
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
		
		<!-- Pending Gold Collect Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-hand-holding-heart"></i> Panding Collect Gold
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Collect No.</th>
                        <th>User ID</th>
                        <th>Collect User</th>
                        <th>User Number</th>
                        <th>User Address</th>
                        <th>Quantity</th>
                        <th>Method</th>
                        <th>Request Date</th>
						<th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "
								SELECT 
									c.collect_id,
									c.user_id,
									c.quantity,
									c.method,
									c.delivery_user,
									c.delivery_user_number,
									c.delivery_address,
									c.collect_date,
									c.delivery_date,
									c.collect_status,
									u.userId
								FROM collectGold c
								JOIN user u ON c.user_id = u.user_id
								WHERE c.collect_status = 'pending'
								ORDER BY c.collect_date DESC
								";

								$collect_gold = $pdo->prepare($select);
								$collect_gold->execute();
						
						$collect_id = 1;
						
						while($gold = $collect_gold->fetch()){
							
							?>
								<tr>
									<td><?php echo $collect_id ?></td>
									<td><?php echo $gold['userId'] ?></td>
									<td><?php echo $gold['delivery_user'] ?></td>
									<td><?php echo $gold['delivery_user_number'] ?></td>
									<td><?php echo $gold['delivery_address'] ?></td>
									<td><?php echo $gold['quantity'] ?></td>
									<td><?php echo $gold['method'] ?></td>
									<td><?php echo $gold['collect_date'] ?></td>
									<td class="status-pending">
										<form class="action-form" method="POST">
											<input type="hidden" name="hidden_amount" value="<?php echo $gold['quantity'] ?>">
											<input type="hidden" name="hidden_id" value="<?php echo $gold['collect_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $gold['user_id'] ?>">
											<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
												<i class="fas fa-check"></i> Approve
											</button>
										</form>
									</td>
									<td>
										<form class="action-form" method="POST">
											<input type="hidden" name="hidden_id" value="<?php echo $gold['collect_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $gold['user_id'] ?>">
											<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
												<i class="fas fa-times"></i> Reject
											</button>
										</form>
									</td>
								</tr>
							<?php
							$collect_id++;
						}		
						if(isset($_POST['approve'])){
							$hidden_amount = $_POST['hidden_amount'];
							$id = (int) $_POST['hidden_id'];
							$user_id = $_POST['hidden_user_id'];
							$updated_at = date('Y-m-d H:i:s');
							
							$sql ="UPDATE collectGold SET collect_status = 'delivered', delivery_date = ? WHERE collect_id = ?";
							$update_collect = $pdo->prepare($sql);
							$update_collect->execute([$updated_at, $id]);
							
							$sql ="UPDATE balance SET gold_balance = gold_balance + ? WHERE user_id = ?";
							$update_blance = $pdo->prepare($sql);
							$update_blance->execute([$hidden_amount, $user_id]);
							
							header("Location: ".$_SERVER['PHP_SELF']);
							exit();							
						}
						if(isset($_POST['reject'])){
							$id = (int) $_POST['hidden_id'];
							$updated_at = date('Y-m-d H:i:s');
							
							$sql ="UPDATE collectGold SET collect_status = 'cancelled', delivery_date = ? WHERE collect_id = ?";
							$update_collect = $pdo->prepare($sql);
							$update_collect->execute([$updated_at, $id]);
							
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