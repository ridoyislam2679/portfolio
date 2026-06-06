<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$sql = "SELECT * FROM department";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch();	
?>
	<main class="faculty-page">	
		<section class="faculty-list-section">
			<h3>Department</h3>
			<div class="faculty-boxes">
				<?php 
					while($row = $stmt->fetch()){
						?>
							<a href="department-head.php?department=<?php echo $row['department_name'] ?>" class="faculty-box">
								<img src="assets/<?php echo $row['department_image'] ?>" alt="Faculty of Science">
								<span><?php echo $row['department_name'] ?></span>
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