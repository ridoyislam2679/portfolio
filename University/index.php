<?php 
	include_once('header.php');
	include_once('db/index.php');
	
	$sql ="SELECT * FROM administrator LIMIT 3";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	
?>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slider-container">
            <div class="slide active">
                <img src="assets/slide1.jpg" alt="University Campus">
                <div class="slide-content">
                    <h2>Welcome to Our University</h2>
                    <p>Excellence in Education Since 1953</p>
                </div>
            </div>
            <div class="slide">
                <img src="assets/slide2.jpg" alt="University Library">
                <div class="slide-content">
                    <h2>World Class Library</h2>
                    <p>500,000+ Books and Digital Resources</p>
                </div>
            </div>
            <div class="slide">
                <img src="assets/slide3.jpg" alt="Graduation Ceremony">
                <div class="slide-content">
                    <h2>Join Our Community</h2>
                    <p>Apply for 2023-2024 Academic Year</p>
                </div>
            </div>
            <div class="slider-nav">
                <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
                <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="slider-dots"></div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="leadership">
        <div class="container">
            <div class="section-header">
                <h2>University Leadership</h2>
            </div>
            <div class="leaders-grid">
				
				<?php 
					while($row = $stmt->fetch()){
						$msg = $row['welcome_msg'];
						$length = strlen($msg);
						if($length > 100){
							$message = substr($msg, 0, 90);
							$msg = $message.'...';
						}
						?>
							<a href="administrator-details.php?administrator=<?php echo $row['administrator_type']; ?>">
								<div class="leader-card">
									<div class="leader-img">
										<img src="assets/vc.jpg" alt="Vice Chancellor">
									</div>
									<div class="leader-info">
										<h3><?php echo $row['administrator_name']; ?></h3>
										<p><?php echo $row['administrator_type']; ?></p>
										<div class="leader-message">
											<p><?php echo $msg ?></p>
										</div>
									</div>
								</div>
							</a>
						<?php
					}
				?>
            </div>
        </div>
    </section>

    <!-- University Stats -->
    <section class="university-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h3 class="counter" data-target="15000">0</h3>
                    <p>Students</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3 class="counter" data-target="850">0</h3>
                    <p>Teachers</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-building"></i>
                    <h3 class="counter" data-target="42">0</h3>
                    <p>Departments</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <h3 class="counter" data-target="25">0</h3>
                    <p>Facilities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Welcome Message -->
    <section class="welcome-message">
        <div class="container">
            <div class="welcome-content">
                <h2>Welcome to University Name</h2>
                <p>Established in 1953, University Name has been a beacon of higher education in the region. Our university is committed to providing quality education, fostering research, and developing skilled professionals who can contribute to national development.</p>
                <p>With state-of-the-art facilities, experienced faculty members, and a vibrant campus life, we offer an enriching environment for academic and personal growth. Our graduates are making significant contributions in various fields both nationally and internationally.</p>
				
                <a href="about.php" class="btn">Learn More About Us</a>
				
            </div>
            <div class="welcome-img">
                <img src="assets/university-building.jpg" alt="University Building">
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="top-news-section">
        <div class="container">
            <div class="section-header">
                <h2>Latest News</h2>
                <a href="news.php" class="view-all">View All News</a>
            </div>
            <div class="news-grid">
				<?php 
					$sql = "SELECT * FROM news ORDER BY news_date DESC LIMIT 3";
					$stmt = $connection->prepare($sql);
					$stmt->execute();
					
					while($row = $stmt->fetch()){
						
						$date = $row['news_date'];
						$timestamp = strtotime($date);
						$day = date('d', $timestamp); 
						$monthName = date('F', $timestamp);
						$year = date('Y', $timestamp);
						
						$description = $row['news_dsc'];
						$length = strlen($description);
						
						if(strlen($length > 100 )){
							$dsc = substr($description, 0, 90);
							$description = $dsc.'...';						
						}
						
						?>
							<div class="news-card">
								<div class="news-img">
									<img src="assets/<?php echo $row['news_image']; ?>" alt="News Image">
									<div class="news-date">
										<span><?php echo $day; ?></span>
										<span><?php echo $monthName; ?></span>
										<span><?php echo $year; ?></span>
									</div>
								</div>
								<div class="news-content">
									<h3><?php echo $row['news_hedline']; ?></h3>
									<p><?php echo $description; ?></p>
									<a href="news-details.php?news=<?php echo $row['news_hedline']; ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						<?php						
					}
					
				?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="top-events-section">
        <div class="container">
            <div class="section-header">
                <h2>Upcoming Events</h2>
                <a href="events.php" class="view-all">View All Events</a>
            </div>
            <div class="events-grid">
				<?php 
				
					//$sql2 = "SELECT * FROM events ORDER BY events_date DESC LIMIT 3";
					$sql2 = "SELECT * FROM events
							WHERE events_date >= NOW()
							ORDER BY events_date, events_time DESC LIMIT 3;
							";
					$stmt2 = $connection->prepare($sql2);
					$stmt2->execute();
					
					while($event = $stmt2->fetch()){
						$date = $event['events_date'];
						$timestamp = strtotime($date);
						$day = date('d', $timestamp); 
						$monthName = date('F', $timestamp);
						$year = date('Y', $timestamp);
						?>
							<div class="event-card">
								<div class="event-date">
									<span><?php echo $day; ?></span>
									<span><?php echo $monthName; ?></span>
									<span><?php echo $year; ?></span>
								</div>
								<div class="event-content">
									<h3><?php echo $event['events_hedline']; ?></h3>
									<p><i class="fas fa-clock"></i> <?php echo $event['events_time']; ?> - <?php echo $event['end_time']; ?></p>
									<p><i class="fas fa-map-marker-alt"></i> <?php echo $event['location']; ?></p>
									<a href="event-details.php?event=<?php echo $event['events_hedline']; ?>" class="btn">Details</a>
								</div>
							</div>
						<?php
					}
				
				?>
                
            </div>
        </div>
    </section>
<?php 
	include_once('footer.php');
?>
