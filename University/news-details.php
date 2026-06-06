<?php 
	include_once('header.php');
	include_once('db/index.php');
	
	if(isset($_GET['news'])){
		$news_hedline = $_GET['news'];
		
		$sql = "SELECT * FROM news WHERE news_hedline = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$news_hedline]);		
		$row = $stmt->fetch();	
	
		$date = $row['news_date'];
		$timestamp = strtotime($date);
		$day = date('d', $timestamp); 
		$monthName = date('F', $timestamp);
		$year = date('Y', $timestamp);
		
	}else{
		header('location:http://localhost/mamun/news.php');
	}
	
?>
	<div class="news-details-container">
        <!-- Main News Details Section -->
        <div class="news-details-main">
            <img src="assets/<?php echo $row['news_image']; ?>" alt="News Image" class="news-image">
            
            <div class="news-content">
                <h1 class="details-news-title"><?php echo $row['news_hedline']; ?></h1>
                <span class="details-news-date">
					Published on: <?php echo $day.' '.$monthName.' '.$year ?>
				</span>
                <p class="details-news-description">
                    <?php echo $row['news_dsc']; ?>
                </p>
            </div>
        </div>
        
        <!-- Top 3 News Section -->
        <div class="top-news-section">
            <h2 class="top-news-heading">Top Related News</h2>
            
            <div class="top-news-grid">
				<?php 
					$offset = $row['news_hedline'];
					//$sql = "SELECT * FROM news ORDER BY DESC LIMIT 3 OFFSET $offset";
					$sql2 = "SELECT * 
						FROM news
						WHERE news_hedline != '".$offset."'
						ORDER BY news_date DESC LIMIT 3";
					$stmt2 = $connection->prepare($sql2);
					$stmt2->execute();						
					
					while($row2 = $stmt2->fetch()){
						$date = $row2['news_date'];
						$timestamp = strtotime($date);
						$day = date('d', $timestamp); 
						$monthName = date('F', $timestamp);
						$year = date('Y', $timestamp);
						?>
							<a href="news-details.php?news=<?php echo $row2['news_hedline']; ?>">
								<div class="top-news-item">
									<img src="assets/<?php echo $row2['news_image']; ?>" alt="Related News 1" class="top-news-image">
									<div class="top-news-content">
										<h3 class="top-news-title"><?php echo $row2['news_hedline']; ?></h3>
										<span class="top-news-date">
											Published on: <?php echo $day.' '.$monthName.' '.$year ?>
										</span>
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