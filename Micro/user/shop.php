<?php 
	include_once('header.php'); 
	include_once('../db/index.php'); 
	ob_start();
	$select = "SELECT * FROM shop WHERE shop_status = 1";
	$stmt = $pdo->prepare($select);
	$stmt->execute();
?>
    
    <!-- Main Content -->
    <div class="container main-body">
        <div class="shop-header">
            <h1><i class="fas fa-shopping-bag me-2"></i> Physical Products</h1>
            <p>If You Purchase Any Physical Products, Please Inbox Your request</p>
        </div>
        
        <div class="row">		
            <div class="col-lg-12">
           
                <!-- Products Grid -->
                <div class="row">
					<?php 
						while($row = $stmt->fetch()){
							
							$description = $row['product_description'];
							$length = strlen($description);
							
							if(strlen($length > 100 )){
								$dsc = substr($description, 0, 90);
								$description = $dsc.'...';						
							}
							
							?>
								<div class="col-md-4">
									<div class="product-card">
										<div style="position: relative;">
											<img src="../admin/shop/<?php echo $row['product_image']; ?>" class="product-image" alt="AI Writer">
										</div>
										<div class="product-body">
											<h5 class="product-title"><?php echo $row['product_name']; ?></h5>
											<div>
												<span class="product-price"><?php echo $row['product_price']; ?>TK / </span>
												<span class="product-price"><?php echo $row['product_coin']; ?>Rit</span>
											</div>
											<p class="product-description"><?php echo $description; ?></p>
											<button class="btn btn-primary btn-shop">
											   Inbox
											</button>
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