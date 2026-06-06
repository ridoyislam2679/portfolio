<?php
	include_once('header.php');
	include_once('db/index.php');
?>
	<section class="banner_image">
		<img src="assets/Main-Gate_RU.jpg" alt="University Campus">
	</section>
	<!-- administration Section -->
	<div class="container">
		<h1 class="name">Academic</h1>
		<div class="grid">
			<a href="faculty.php">
				<div class="card">
					<img src="assets/administration.jpg" alt="administration iamage"/>
					<p>Faculty</p>
				</div>
			</a>			
			<a href="department.php">
				<div class="card">
					<img src="assets/administration.jpg" alt="administration iamage"/>
					<p>Departments</p>
				</div>
			</a>
			<a href="affiliated-collage.php">
				<div class="card">
					<img src="assets/administration.jpg" alt="administration iamage"/>
					<p>Affiliated Colleges & Institutions</p>
				</div>
			</a>
			<a href="international-affairs.php">
				<div class="card">
					<img src="assets/administration.jpg" alt="administration iamage"/>
					<p>Office of The International Affairs</p>
				</div>
			</a>
		</div>
	</div>
<?php
	include_once('footer.php');
?>