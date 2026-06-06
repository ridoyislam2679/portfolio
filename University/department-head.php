<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$department_name = $_GET['department'];
	
	$sql ="SELECT professor.professor_name, professor.professor_type, department.department_name, professor.professor_image, professor.welcome_msg
	FROM professor
	INNER JOIN department
	ON professor.professor_id=department.department_id where department.department_name = ?";
	
	$stmt = $connection->prepare($sql);
	$stmt->execute([$department_name]);
	$row = $stmt->fetch();	
?>
	<main class="faculty-page">
		<section class="dean-info">
			<img src="assets/<?php echo $row['professor_image']; ?>" alt="Dean Image" class="dean-photo">
			<div class="dean-details">
				<h2><?php echo $row['professor_name']; ?></h2>
				<h4><?php echo $row['professor_type']; ?>, <?php echo $row['department_name']; ?></h4>
				<p><?php echo $row['welcome_msg']; ?></p>
				<a href="department-head-profile.php?profile=<?php echo $row['professor_name']; ?>" class="view-profile-button">View Profile</a>
			</div>
		</section>
	</main>

<?php
	include_once('footer.php');
?>