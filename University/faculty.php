<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$sql = "SELECT * FROM faculty";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
		
?>
	<section class="banner_image">
		<img src="assets/Main-Gate_RU.jpg" alt="University Campus">
	</section>
	<main class="faculty-page">
		<section class="faculty-list-section">
			<h3>Faculties</h3>
			<div class="faculty-boxes">
				<?php 
					while($row = $stmt->fetch()){
						?>
							<a href="faculty-details.php?faculty=<?php echo $row['faculty_name']; ?>" class="faculty-box">
								<img src="assets/<?php echo $row['faculty_image']; ?>" alt="Faculty of Science">
								<span><?php echo $row['faculty_name']; ?></span>
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