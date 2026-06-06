<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$type = 'international affairs';
	$sql = "SELECT * FROM institute WHERE institute_type = ?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$type]);
	$row = $stmt->fetch();	
?>
	<main class="faculty-page">	
		<section class="faculty-list-section">
			<h3>Affiliated Collage</h3>
			<div class="faculty-boxes">
				<?php 
					while($row = $stmt->fetch()){
						?>
							<a href="<?php echo $row['institute_url'] ?>" class="faculty-box" target="_blank">
								<img src="assets/<?php echo $row['institute_image'] ?>" alt="Faculty of Science">
								<span><?php echo $row['institute_name'] ?></span>
							</a>
						<?php
					}
				?>
			</div>
		</section>
	</main>

<?php
	include_once('footer.php');
?>