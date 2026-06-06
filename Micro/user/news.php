<?php 
	include_once('header.php'); 
	include_once('../db/index.php'); 
	
	$select = "SELECT * FROM news WHERE news_status = 1";
	$stmt = $pdo->prepare($select);
	$stmt->execute();
?>
    
    <!-- Main Content -->
    <div class="container main-body">
        <div class="shop-header">
            <h1><i class="fas fa-shopping-bag me-2"></i> Availabe Offer</h1>
        </div>
        
        <div class="row">		
            <div class="col-lg-12">
           
                <!-- Products Grid -->
                <div class="row">
					<?php 
						while($row = $stmt->fetch()){
							/*
							$title = $row['news_title'];
							$length = strlen($description);
							
							if(strlen($length > 100 )){
								$dsc = substr($description, 0, 90);
								$description = $dsc.'...';						
							}
							*/
							
							?>
								<div class="col-md-4">
									<div class="product-card">
										<div style="position: relative;">
											<img src="../admin/task/<?php echo $row['news_image']; ?>" class="product-image" alt="AI Writer">
										</div>
										<div class="product-body">
											<h5 class="product-title"><?php echo $row['news_title']; ?></h5>
											<p class="product-description"><?php echo $row['news_dsc']; ?></p>
										</div>
									</div>
								</div>
							<?php
						}
					
					?>
                    
                </div>
            </div>
        </div>
    </div>
	
    <?php include_once('footer.php'); ?>
</body>
</html>