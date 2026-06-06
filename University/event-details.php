<?php 
	include_once('header.php');
	include_once('db/index.php');
	
	if(isset($_GET['event'])){
		$event_hedline = $_GET['event'];
		$event_hedline = htmlspecialchars($event_hedline);;
		
		$sql = "SELECT * FROM events WHERE events_hedline = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$event_hedline]);		
		$row = $stmt->fetch();	
	
		$date = $row['events_date'];
		$timestamp = strtotime($date);
		$day = date('d', $timestamp); 
		$monthName = date('F', $timestamp);
		$year = date('Y', $timestamp);
		
	}else{
		header('location:events.php');
	}
	
?>
	<div class="news-details-container">
        <!-- Main News Details Section -->
        <div class="news-details-main">
                        
            <div class="news-content">
                <h1 class="details-news-title"><?php echo $row['events_hedline']; ?></h1>
                <span class="details-news-date">
					Published on: <?php echo $day.' '.$monthName.' '.$year ?>
				</span>
                <p class="details-news-description">
                    <?php echo $row['events_dsc']; ?>
                </p>
            </div>
        </div>
        
        <!-- Top 3 News Section -->
        <div class="top-news-section">
            <h2 class="top-news-heading">Top Related Events</h2>
            
            <div class="top-news-grid">
				<?php 
					$offset = $row['events_hedline'];
					//$sql = "SELECT * FROM events ORDER BY DESC LIMIT 3 OFFSET $offset";
					$sql2 = "SELECT * 
						FROM events
						WHERE events_hedline != '".$offset."'
						ORDER BY events_date DESC LIMIT 3";
					$stmt2 = $connection->prepare($sql2);
					$stmt2->execute();						
					
					while($row2 = $stmt2->fetch()){
						$date = $row2['events_date'];
						$timestamp = strtotime($date);
						$day = date('d', $timestamp); 
						$monthName = date('F', $timestamp);
						$year = date('Y', $timestamp);
						
						$description = $row['events_dsc'];
						$length = strlen($description);
						if($length > 60){
							$dsc = substr($description, 0, 50);
							$description = $dsc.'...';					
						}
						
						?>
							<a href="event-details.php?event=<?php echo $row2['events_hedline']; ?>">
								<div class="top-news-item">
									<div class="top-news-content">
										<h3 class="top-news-title"><?php echo $row2['events_hedline']; ?></h3>
										<span class="top-news-date">
											Published on: <?php echo $day.' '.$monthName.' '.$year ?>
										</span>
										<p class=""><?php echo $description; ?></p>
									</div>
								</div>
							</a>
						<?php 
					}
					
				?>
                
                
            </div>
        </div>
    </div>

<?php 
	include_once('footer.php');
?>