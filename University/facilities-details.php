<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$facilities_name = $_GET['facilities'];
	
	$sql = "SELECT * FROM facilities WHERE facilities_name = ?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$facilities_name]);
	$row = $stmt->fetch();	
?>
	<main class="faculty-page">
		<section class="dean-info">
			<img src="assets/<?php echo $row['facilities_image']; ?>" alt="<?php echo $row['facilities_name']; ?>" class="dean-photo">
			<div class="dean-details">
				<h2><?php echo $row['facilities_name']; ?></h2>
				<p> <?php echo $row['facilities_details']; ?> </p>
			</div>
		</section>	
	</main>

<?php
	include_once('footer.php');
?>