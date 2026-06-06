<?php
	include_once('header.php');
	include_once('db/index.php');
?>
	<!-- Banner -->
	<section class="banner_image">
		<img src="assets/facilities.jpg" alt="University Campus">
	</section>

	
	<!-- ICT Center -->
	<section class="ict-section">
		<h1 class="ict-title">ICT Center</h1>

		<p class="ict-intro">
			The ICT Center supports all digital infrastructure of the university — offering services, resources, and training to students and staff.
		</p>

		<div class="ict-content">			
			<div class="ict-box">
				<h2>Latest News</h2>
				<ul>
					<?php 
						$news_type = 'ict';
						$sql = "SELECT * FROM news WHERE news_type= :type ORDER BY news_date DESC";			
						$stmt = $connection->prepare($sql);
						$stmt->execute(['type' => $news_type]);		
						
						while($row = $stmt->fetch()){
							$date = $row['news_date'];
							$timestamp = strtotime($date);
							$day = date('d', $timestamp); 
							$monthName = date('F', $timestamp);
							$year = date('Y', $timestamp);
							?>
							<li>
								<a href="news-details.php?news=<?php echo $row['news_hedline']; ?>">
									<?php echo $row['news_hedline']; ?>
								</a>
								<span class="date"><?php echo $day.' '.$monthName.' '.$year; ?></span>
							</li>
							<?php
						}
					?>					
				</ul>
			</div>

			<div class="ict-box">
				<h2>Upcoming Events</h2>
				<ul>
					<?php 
						$events_type = 'ict';
						$sql2 = "SELECT * FROM events WHERE events_type= :type ORDER BY events_date DESC";			
						$stmt2 = $connection->prepare($sql2);
						$stmt2->execute(['type' => $events_type]);		
						
						while($row2 = $stmt2->fetch()){
							$date = $row2['events_date'];
							$timestamp = strtotime($date);
							$day = date('d', $timestamp); 
							$monthName = date('F', $timestamp);
							$year = date('Y', $timestamp);
							?>
							<li>
								<a href="event-details.php?event=<?php echo $row2['events_hedline']; ?>">
									<?php echo $row2['events_hedline']; ?>
								</a>
								<span class="date"><?php echo $day.' '.$monthName.' '.$year; ?></span>
							</li>
							<?php
						}
					?>	
				</ul>
			</div>
		</div>

		<div class="ict-grid">
			<div class="ict-card">
				<h3>Help Desk</h3>
				<p>Get instant support for technical issues and general IT help.</p>
			</div>
			<div class="ict-card">
				<h3>Software Support</h3>
				<p>Licensed software and installation assistance for students and faculty.</p>
			</div>
			<div class="ict-card">
				<h3>High-Speed Internet</h3>
				<p>Campus-wide Wi-Fi with 24/7 tech support for seamless connectivity.</p>
			</div>
			<div class="ict-card">
				<h3>Computer Lab</h3>
				<p>Fully equipped lab with modern PCs for academic use and training.</p>
			</div>
			<div class="ict-card">
				<h3>Training Room</h3>
				<p>Interactive training sessions on programming, cybersecurity, and more.</p>
			</div>
			<div class="ict-card">
				<h3>Printing & Scanning</h3>
				<p>Access to printing, scanning, and photocopy services at affordable rates.</p>
			</div>
		</div>
	</section>
<?php
	include_once('footer.php');
?>