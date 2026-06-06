<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$sql = "SELECT facilities_name, facilities_image FROM facilities";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch();
?>

	
	<section class="banner_image">
		<img src="assets/facilities.jpg" alt="University Campus">
	</section>

   
    <!-- facilities Section -->
	<div class="container">
		<h1 class="name">Facilities</h1>
		<div class="grid">			
				<?php 
					while($row = $stmt->fetch()){
						?>
							<a href="facilities-details.php?facilities=<?php echo $row['facilities_name'] ?>">
								<div class="card">
									<img src="assets/<?php echo $row['facilities_image'] ?>" alt="<?php echo $row['facilities_image'] ?>" />
									<p><?php echo $row['facilities_name'] ?></p>
								</div>
							</a>
						<?php
					}
				?>
			
		</div>
	</div>
<?php
	include_once('footer.php');
?>
