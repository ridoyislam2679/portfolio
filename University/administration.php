<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$sql = "SELECT administrator_image, administrator_type FROM administrator";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	
?>

	<section class="banner_image">
		<img src="assets/Main-Gate_RU.jpg" alt="University Campus">
	</section>
    <!-- administration Section -->
	<div class="container">
		<h1 class="name">ADMINISTRATION</h1>
		<div class="grid">
			<?php 
				while($row = $stmt->fetch()){
					?>
						<a href="administrator-details.php?administrator=<?php echo $row['administrator_type']; ?>">
							<div class="card">
								<img src="assets/<?php echo $row['administrator_image']; ?>" alt="administration iamage"/>
								<p><?php echo $row['administrator_type']; ?></p>
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