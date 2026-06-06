<?php
	include_once('header.php');
	include_once('db/index.php');
	
	if($_GET['profile']){
		$type = $_GET['profile'];		
		$sql = "SELECT * FROM administrator WHERE administrator_name=?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$type]);
		$row = $stmt->fetch();
		
		$id = $row['administrator_id'];
		$sql2 = "SELECT * FROM administrator_education WHERE administrator_id=?";
		$stmt2 = $connection->prepare($sql2);
		$stmt2->execute([$id]);
		
		$sql3 = "SELECT * FROM administrator_work WHERE administrator_id=?";
		$stmt3 = $connection->prepare($sql3);
		$stmt3->execute([$id]);
				
	}else{
		header('location:administration.php');
	}
	
	
	
?>
	<main class="profile-main">
		<section class="profile-section basic-info">
			<h2>Basic Information</h2>
			<div class="info-wrapper">
				<img src="assets/<?php echo $row['administrator_image']; ?>" alt="Administrator Photo" class="admin-photo">
				<ul>
					<li> <?php echo $row['administrator_name']; ?></li>
					<li> <?php echo $row['administrator_type']; ?></li>
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