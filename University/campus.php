<?php
	include_once('header.php');
	include_once('db/index.php');
?>

	
	<section class="campus">
		<h1>Our University Campus</h1>
		<div class="campus-container">
		  <!-- Card 1 - Image -->
			<?php 
				$sql = "SELECT * FROM campus_media";
				$stmt = $connection->prepare($sql);
				$stmt->execute();
				
				while($row = $stmt->fetch()){
					$type = $row['type'];
					if($type == 'image'){
						?>
							<div class="card">
								<img src="assets/<?php echo $row['file_url']; ?>" alt="Campus Image">
								<div class="card-content">
									<h3><?php echo $row['title']; ?></h3>
									<p><?php echo $row['description']; ?></p>
								</div>
							</div>
						<?php
					}else{
						?>						
							<div class="card">
								<video controls>
								<source src="assets/<?php echo $row['file_url']; ?>" type="video/mp4">
								Your browser does not support the video tag.
								</video>
								<div class="card-content">
									<h3><?php echo $row['title']; ?></h3>
									<p><?php echo $row['description']; ?></p>
								</div>
							</div>						
						<?php						
					}
				}				
			?>		 
		</div>
	</section>

<?php
	include_once('footer.php');
?>