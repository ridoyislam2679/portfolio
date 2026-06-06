<?php
	include_once('header.php');
	include_once('db/index.php');
	
	$currently_working = 0;
	$id = 1;
	//$sql = "SELECT dean.dean_name, dean_education.*, dean.dean_image FROM dean_education INNER JOIN dean ON dean_education.dean_id=dean.dean_id where dean_education.dean_id = 1 and dean_education.currently_working = '$currently_working'";
	
	if($_GET['profile']){
		$name = $_GET['profile'];		
		$sql = "SELECT * FROM professor WHERE professor_name =?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$name]);
		$row = $stmt->fetch();
		
		$id = $row['professor_id'];
		$sql2 = "SELECT * FROM professor_education WHERE professor_id=?";
		$stmt2 = $connection->prepare($sql2);
		$stmt2->execute([$id]);
		
		$sql3 = "SELECT * FROM professor_work WHERE professor_id=?";
		$stmt3 = $connection->prepare($sql3);
		$stmt3->execute([$id]);
				
	}else{
		header('location:faculty.php');
	}
	
?>
	<main class="profile-main">
		<section class="profile-section basic-info">
			<h2>Basic Information</h2>
			<div class="info-wrapper">
				<img src="assets/<?php echo $row['professor_image']; ?>" alt="Administrator Photo" class="admin-photo">
				<ul>
					<li> <?php echo $row['professor_name']; ?> </li>
					<li> <?php echo $row['professor_type']; ?> </li>
				</ul>
			</div>
		</section>
		
		<section class="profile-section">
			<h2>Education</h2>
			<ul>
				<?php 
					while($row2 = $stmt2->fetch()){						
						?>
							<li>
								<strong><?php echo $row2['subject']; ?></strong> – <?php echo $row2['institution']; ?>
							</li>
						<?php										
					}
				?>
			</ul>
		</section>
	
		<section class="profile-section">
			<h2>Experience</h2>
			<ul>
				<?php 
					while($row3 = $stmt3->fetch()){
						if($row3['currently_working']==0){
							?>
								<li>
									<strong><?php echo $row3['subject']; ?></strong> – <?php echo $row3['institution']; ?> ( <?php echo $row3['start_work']; ?> - <?php echo $row3['end_work']; ?>)
								</li>
							<?php
						}						
					}
				?>											
			</ul>
		</section>
	</main>

<?php
	include_once('footer.php');
?>