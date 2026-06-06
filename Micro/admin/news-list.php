<?php 
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
?>
<?php 
	include_once('sidebar.php');
?>
    
   <!-- Withdraw Requests Table -->
      <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Your Submitted News</h1>
            </div>

            <!-- Withdraw Requests Table -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="withdrawTable" width="100%" cellspacing="0">
                            <thead>
								<tr>
									<th>News Date</th>
									<th>News Title</th>
									<th>News Description</th>
									<th>Product Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$select = "SELECT * FROM news WHERE news_status = 1";
									$historyQuery = $pdo->prepare($select);
									$historyQuery->execute();
									
									while($history = $historyQuery->fetch()){
										$currentTime = new DateTime($history['created_at']);
										$formattedDate = $currentTime->format('Y-m-d h:i:s');
										
										?>
											<tr>
												<td><?php echo $formattedDate ?></td>
												<td> <p><?php echo $history['news_title']; ?></p></td>
												<td> <p><?php echo $history['news_dsc']; ?></p></td>
												<td> <img src="task/<?php echo $history['news_image']; ?>" height="70px" width="70px"></td>
												<td class="status-pending">
													<form class="action-form" method="POST">
														<input type="hidden" name="hidden_id" value="<?php echo $history['news_id'] ?>">
														<button type="submit" name="delete" class="btn btn-danger btn-sm action-btn">
															<i class="fas fa-check"></i> Delete
														</button>
													</form>
												</td>
											</tr>
										<?php								
									}							
								?>
							</tbody>
                        </table>	
						<?php 
							if(isset($_POST['delete'])){
								$id = (int) $_POST['hidden_id'];
								
								$sql ="UPDATE news SET news_status = '0' WHERE news_id = ?";
								$update_task = $pdo->prepare($sql);
								$update_task->execute([$id]);
								
								header("Location: ".$_SERVER['PHP_SELF']);
								exit();							
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php 
	include_once('footer.php');
?>
