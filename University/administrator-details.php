<?php
	include_once('header.php');
	include_once('db/index.php');
	
	if($_GET['administrator']){
		$type = $_GET['administrator'];	
		$sql = "SELECT * FROM administrator WHERE administrator_type=?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$type]);
		$row = $stmt->fetch();
	}else{
		header('location:administration.php');
	}
	
	
	
?>
	<section class="admin-section">
		<div class="admin-image">
			<img src="assets/<?php echo $row['administrator_image']; ?>" alt="Administrator">
		</div>
		<div class="admin-details">
			<h2 class="admin-name"><?php echo $row['administrator_name']; ?></h2>
			<p class="admin-type"><?php echo $row['administrator_type']; ?></p>
			<a href="administrator-profile.php?profile=<?php echo $row['administrator_name']; ?>" class="view-profile">View Profile</a>
			<div class="welcome-msg">
				<p><?php echo $row['welcome_msg']; ?></p>
			</div>
		</div>
	</section>

	
<?php
	include_once('footer.php');
?>