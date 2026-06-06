<?php 
	include_once('header.php');
	include_once('db/index.php');
?>
	<!-- Banner Section -->
	<section class="banner_image">
		<img src="assets/facilities.jpg" alt="University Campus">
	</section>

	<!-- News Section -->
	<section class="news-section">
	  <h1 class="news-title">All News</h1>

	  <div class="news-list">
		<!-- News Card 1 -->
		<?php 
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if($page < 1) $page = 1;
			
			$itemperpage = 5;
			$offset = ($page-1)*$itemperpage;
			
			$sql = "SELECT * FROM news ORDER BY news_date DESC LIMIT $itemperpage OFFSET $offset";
			$stmt = $connection->prepare($sql);
			$stmt->execute();
			
			
			while($row=$stmt->fetch()){
				$description = $row['news_dsc'];
				$length = strlen($description);
				
				$date = $row['news_date'];
				$timestamp = strtotime($date);
				$day = date('d', $timestamp); 
				$monthName = date('F', $timestamp);
				$year = date('Y', $timestamp);
				
				if(strlen($length > 250 )){
					$dsc = substr($description, 0, 150);
					$description = $dsc.'...';
					
				}
				?>
				<div class="news-card">
					<h3>
						<a href="news-details.php?news=<?php echo $row['news_hedline']; ?>"><?php echo $row['news_hedline']; ?></a>
					</h3>
					<p><?php echo $description; ?></p>
					<span class="news-date">
						<?php echo $day.' '.$monthName.' '.$year;?> 
					</span>
				</div>
				<?php
			}
			
		?>
		
	  <!-- Pagination -->
	  <?php 
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		if($page < 1) $page = 1;
		
		//$page_number = $_GET['page']; 
		$current_url = $_SERVER['REQUEST_URI'];
		
		$countSql = "SELECT COUNT(*) FROM news";
		$totalNews = $connection->query($countSql)->fetchColumn();
		$totalPages = ceil($totalNews / $itemperpage);
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


<?php 
	include_once('footer.php');
?>