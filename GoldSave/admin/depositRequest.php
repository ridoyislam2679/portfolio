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
    
    <?php include_once('header.php'); ?>
	
    <!-- Main Content -->
    <div class="main-content">
        <!-- Fixed Top Header with Logout Form -->
        <div class="top-header">
            <div class="page-title">
                <h1>Deposit</h1>
                <p>Panding deposit request</p>
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
		
        <!-- Pending Withdraw Requests -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-money-bill-wave"></i> Panding deposit request
            </div>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User id</th>
                        <th>User Name</th>
                        <th>Amount</th>
                        <th>Number</th>
                        <th>Mathod</th>
                        <th>Deposit Date</th>
                        <th>Status</th>
						<th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
					//$select = "SELECT deposit_id, deposit_amount, deposit_method, deposit_date, user_id, user_name, userId FROM deposit JOIN user ON deposit.user_id = user.user_id WHERE deposit_status = 'pending' ORDER BY deposit_date";
					$select = "SELECT 
							deposit.deposit_id,
							deposit.deposit_amount,
							deposit.deposit_number,
							deposit.deposit_method,
							deposit.deposit_date,
							deposit.user_id,
							user.user_name,
							user.userId
						FROM deposit 
						JOIN user ON deposit.user_id = user.user_id
						WHERE deposit.deposit_status = 'pending'
						ORDER BY deposit.deposit_date";
					$new_deposit = $pdo->prepare($select);
					$new_deposit->execute();
					
					$user_count = 1;
					
					while($deposit = $new_deposit->fetch()){
						
						?>
							<tr>
								<td><?php echo $user_count ?></td>
								<td><?php echo $deposit['user_name'] ?></td>
								<td><?php echo $deposit['userId'] ?></td>
								<td><?php echo $deposit['deposit_amount']; ?></td>
								<td><?php echo $deposit['deposit_number']; ?></td>
								<td><?php echo $deposit['deposit_method'] ?></td>
								<td><?php echo $deposit['deposit_date']; ?></td>
								<td class="status-pending">
									<form class="action-form" method="POST">
										<input type="hidden" name="hidden_amount" value="<?php echo $deposit['deposit_amount'] ?>">
										<input type="hidden" name="hidden_id" value="<?php echo $deposit['deposit_id'] ?>">
										<input type="hidden" name="hidden_user_id" value="<?php echo $deposit['user_id'] ?>">
										<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
											<i class="fas fa-check"></i> Approve
										</button>
									</form>
								</td>
								<td>
									<form class="action-form" method="POST">
										<input type="hidden" name="hidden_id" value="<?php echo $deposit['deposit_id'] ?>">
										<input type="hidden" name="hidden_user_id" value="<?php echo $deposit['user_id'] ?>">
										<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
											<i class="fas fa-times"></i> Reject
										</button>
									</form>
								</td>
							</tr>
						<?php	
						$user_count++;
					}				
					
					if(isset($_POST['approve'])){
						$hidden_amount = $_POST['hidden_amount'];
						$id = (int) $_POST['hidden_id'];
						$user_id = $_POST['hidden_user_id'];
						$updated_at = date('Y-m-d H:i:s');
						
						$sql ="UPDATE deposit SET deposit_status = 'approve' WHERE deposit_id = ?";
						$update_deposite = $pdo->prepare($sql);
						$update_deposite->execute([$id]);
						
						$sql ="UPDATE balance SET total_balance = total_balance + ? WHERE user_id = ?";
						$update_blance = $pdo->prepare($sql);
						$update_blance->execute([$hidden_amount, $user_id]);
						
						header("Location: ".$_SERVER['PHP_SELF']);
						exit();							
					}
					if(isset($_POST['reject'])){
						$id = (int) $_POST['hidden_id'];
						$updated_at = date('Y-m-d H:i:s');
						
						$sql ="UPDATE deposit SET deposit_status = 'cancle' WHERE deposit_id = ?";
						$update_deposite = $pdo->prepare($sql);
						$update_deposite->execute([$id]);
						
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