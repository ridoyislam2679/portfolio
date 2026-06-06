<?php 
	include_once('header.php');
	include_once('db/index.php');
	
	$sql = "SELECT * FROM events
			WHERE events_date >= NOW()
			ORDER BY events_date, events_time DESC;
			";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
?>
	<!-- Events Section -->
	<section class="events-section">
		<h1 class="events-title">University Events</h1>

		<!-- Highlighted Upcoming Events -->
		<div class="highlighted-events">
			<h2>Upcoming Events</h2>
			<?php
				while($row= $stmt->fetch()){
					$description = $row['events_dsc'];
					$length = strlen($description);
					if($length > 60){
						$dsc = substr($description, 0, 50);
						$description = $dsc.'...';					
					}
					$date = $row['events_date'];
					$dateToString = strtotime($date);
					$day = date('d', $dateToString);
					$monthName = date('F', $dateToString);
					$year = date('Y', $dateToString);
					
					?>
						<a href="event-details.php?event=<?php echo $row['events_hedline']; ?>">
							<div class="event-card highlight">
								<h3><?php echo $row['events_hedline']; ?></h3>
								<p><?php echo $description ?></p>
								<span class="event-date">
									<?php echo $day.' '.$monthName.' '.$year; ?>
								</span>
							</div>
						</a>
					<?php
				}
			?>
			
		</div>

	  <!-- All Events (DESC) -->
		<div class="all-events">
			<h2>All Events</h2>
			<?php 	
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
				if($page < 1) $page = 1;
				
				$itemperpage = 5;
				$offset = ($page-1)*$itemperpage;
				
				$sql2 = "SELECT * FROM events ORDER BY events_date, events_time DESC LIMIT $itemperpage OFFSET $offset";
				$stmt2 = $connection->prepare($sql2);
				$stmt2->execute();
				
				while($row2 = $stmt2->fetch()){
					$description = $row2['events_dsc'];
					$length = strlen($description);
					if($length > 60){
						$dsc = substr($description, 0, 50);
						$description = $dsc.'...';					
					}
					$date = $row2['events_date'];
					$dateToString = strtotime($date);
					$day = date('d', $dateToString);
					$monthName = date('F', $dateToString);
					$year = date('Y', $dateToString);
					?>
						<a href="event-details.php?event=<?php echo $row2['events_hedline']; ?>">
							<div class="event-card">
								<h3><?php echo $row2['events_hedline']; ?></h3>
								<p><?php echo $description ?></p>
								<span class="event-date"><?php echo $day.' '.$monthName.' '.$year; ?></span>
							</div>
						</a>
					<?php 
				}
				
			?>
			
		</div>
		
		
		<!-- Pagination -->
		<?php 
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			if($page < 1) $page = 1;
			
			//$page_number = $_GET['page']; 
			//$current_url = $_SERVER['REQUEST_URI'];
			
			$countSql = "SELECT COUNT(*) FROM events";
			$totalevents = $connection->query($countSql)->fetchColumn();
			$totalPages = ceil($totalevents / $itemperpage);
		?>
		<div class="pagination">
			<a href="?page=<?php echo $page-1; ?>" class="page-link"> prev </a>
			<?php 
				for($i = 1; $i <= $totalPages; $i++){				
					if($i == $page){
						$class='class="page-link active"';
					}else{
						$class='class="page-link"';
					}
					?>
						<a href="?page=<?php echo $i; ?>" <?php echo $class; ?> > <?php echo $i; ?> </a>
					<?php				
				}			
			?>
			<a href="?page=<?php echo $page+1; ?>" <?php echo $class; ?> > Next </a>
			
		</div>
		
	</section>


<?php include_once('footer.php'); ?>