<?php
	include_once('header.php');
	include_once('db/index.php');
?>
	
	<section class="banner_image">
		<img src="assets/facilities.jpg" alt="University Campus">
	</section>

   
    <!-- Admission Section -->
	<section class="admission-section">
		<h1 class="admission-title">Admission Information</h1>
		<p class="admission-intro">
			Welcome to the University Admission Portal. Here you will find all necessary information regarding undergraduate and postgraduate admissions.
		</p>
	
		<div class="admission-box">
			<h2>Undergraduate Admission</h2>
			<ul>
				<?php
					$type = 'Undergraduate';
					$sql = "SELECT * FROM admission_news WHERE type =:admission_type ORDER BY publish_date DESC";
					$stmt = $connection->prepare($sql);
					$stmt->execute(['admission_type'=>$type]);
					//$stmt->execute();

					while($row = $stmt->fetch()){
						?>
						<li> 
							<a href="assets/<?php echo $row['pdf_url'] ?>" target="_blank"><?php echo $row['title'] ?> </a> 
						</li>;
						<?php
					}					
				?>
				
			</ul>
		</div>
	
		<div class="admission-box">
			<h2>Postgraduate Admission</h2>
			<ul>
				<?php
					$type = 'Postgraduate';
					
					$sql = "SELECT * FROM admission_news WHERE type =:admission_type ORDER BY publish_date DESC";
					$stmt = $connection->prepare($sql);
					$stmt->execute(['admission_type'=>$type]);
					//$stmt->execute();

					while($row = $stmt->fetch()){
						?>
						<li> 
							<a href="assets/<?php echo $row['pdf_url'] ?>" target="_blank"><?php echo $row['title'] ?> </a> 
						</li>;
						<?php
					}					
				?>
			</ul>
		</div>
	
		<div class="admission-note">
			<p><strong>Note:</strong> All applicants must read the instructions carefully before applying.</p>
		</div>
	</section>

<?php
	include_once('footer.php');
?>

