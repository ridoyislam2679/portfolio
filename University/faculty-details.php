<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$faculty_name = $_GET['faculty'];
	
	//$sql = "SELECT * FROM faculty";
	$sql = "SELECT dean.dean_name, faculty.faculty_name, dean.welcome_msg, faculty.faculty_id
			FROM dean
			INNER JOIN faculty
			ON dean.dean_id=faculty.faculty_id where faculty_name = ?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$faculty_name]);
	$row = $stmt->fetch();	
?>
	<main class="faculty-page">
		<section class="dean-info">
			<img src="assets/vc.jpg" alt="Dean Image" class="dean-photo">
			<div class="dean-details">
				<h2><?php echo $row['dean_name']; ?></h2>
				<h4>Dean, <?php echo $row['faculty_name']; ?></h4>
				<p> <?php echo $row['welcome_msg']; ?> </p>
				<a href="dean-profile.php?profile=<?php echo $row['dean_name']; ?>" class="view-profile-button">View Profile</a>
			</div>
		</section>
	
		<section class="faculty-list-section">
			<h3>Department</h3>
			<div class="faculty-boxes">
				<?php 
					$id = $row['faculty_id'];
					
					$sql2 = "SELECT department.department_name, faculty.faculty_name, department.department_image
					FROM department
					INNER JOIN faculty
					ON department.department_id=faculty.faculty_id where department.faculty_id = ?";
					$stmt2 = $connection->prepare($sql2);
					$stmt2->execute([$id]);
					
					while($row2 = $stmt2->fetch()){
						?>
							<a href="department-head.php?department=<?php echo $row2['department_name'] ?>" class="faculty-box">
								<img src="assets/<?php echo $row2['department_image'] ?>" alt="Faculty of Science">
								<span><?php echo $row2['department_name'] ?></span>
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