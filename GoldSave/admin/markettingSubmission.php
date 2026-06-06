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
                <h1>Marketting</h1>
                <p>Panding Marketting Submissions Request</p>
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
        
        <!-- Pending Marketing Submissions -->
        <div class="table-container">
            <div class="section-title">
                <i class="fas fa-file-alt"></i> Panding Marketting Submissions Request
            </div>
            <table class="custom-table">
                <thead>
					<tr>
                        <th>Post No</th>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Post Link</th>
						<th>Status</th>
                        <th>Post Date</th>
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						$select = "
								SELECT 
									m.submission_id, 
									m.post_link,
									m.Submission_date,
									m.submission_status,
									m.user_id,
									u.user_name,
									u.userId
								FROM marketing_submissions m
								JOIN user u ON m.user_id = u.user_id
								WHERE m.submission_status = 'pending'
								ORDER BY m.submission_date DESC
								";

								$submission_post = $pdo->prepare($select);
								$submission_post->execute();
						
						$submission_no = 1;
						
						while($sub = $submission_post->fetch()){
							
							?>
								<tr>
									<td><?php echo $submission_no ?></td>
									<td><?php echo $sub['userId'] ?></td>
									<td><?php echo $sub['user_name'] ?></td>
									<td><?php echo $sub['post_link'] ?></td>
									<td><?php echo $sub['submission_status'] ?></td>
									<td><?php echo $sub['Submission_date'] ?></td>
									<td class="status-pending">
										<form class="action-form" method="POST">
											<!--<input type="hidden" name="hidden_amount" value="<?php //echo $sub['quantity'] ?>"> !-->
											<input type="hidden" name="hidden_id" value="<?php echo $sub['submission_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $sub['user_id'] ?>">
											<button type="submit" name="approve" class="btn btn-success btn-sm action-btn">
												<i class="fas fa-check"></i> Approve
											</button>
										</form>
									</td>
									<td>
										<form class="action-form" method="POST">
											<input type="hidden" name="hidden_id" value="<?php echo $sub['submission_id'] ?>">
											<input type="hidden" name="hidden_user_id" value="<?php echo $sub['user_id'] ?>">
											<button type="submit" name="reject" class="btn btn-danger btn-sm action-btn">
												<i class="fas fa-times"></i> Reject
											</button>
										</form>
									</td>
								</tr>
							<?php
							$submission_no++;
						}		
						if(isset($_POST['approve'])){    
							$id = (int) $_POST['hidden_id'];
							$user_id = $_POST['hidden_user_id'];

							$pdo->beginTransaction();

							try {

								// get coin
								$stmt = $pdo->prepare("SELECT coin FROM marketing_drop ORDER BY marketing_id DESC LIMIT 1");
								$stmt->execute();
								$coinRow = $stmt->fetch();
								$freeCoin = $coinRow['coin'] ?? 0;

								// approve only if pending
								$stmt = $pdo->prepare("
									UPDATE marketing_submissions 
									SET submission_status = 'approve' 
									WHERE submission_id = ? AND submission_status = 'pending'
								");
								$stmt->execute([$id]);

								if($stmt->rowCount() == 0){
									throw new Exception("Already processed");
								}

								// add coin
								$stmt = $pdo->prepare("
									UPDATE balance 
									SET coin_balance = coin_balance + ? 
									WHERE user_id = ?
								");
								$stmt->execute([$freeCoin, $user_id]);

								$pdo->commit();

								header("Location: ".$_SERVER['PHP_SELF']);
								exit();

							} catch(Exception $e){
								$pdo->rollBack();
								echo $e->getMessage();
							}
						}
						if(isset($_POST['reject'])){
							$id = (int) $_POST['hidden_id'];
							$updated_at = date('Y-m-d H:i:s');
							
							$sql ="UPDATE marketing_submissions SET submission_status = 'rejected' WHERE submission_id = ?";
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