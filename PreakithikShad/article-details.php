<?php
	include_once('db/index.php');
	if(!isset($_GET['blog'])){
		header('location: help-blog.php');
		exit;
	}
	$article_name = $_GET['blog'];
	include_once('header.php');
	
	$select = "SELECT * FROM article WHERE article_name = ?"; 
	$stmt = $pdo->prepare($select);
	$stmt->execute([$article_name]);				
	$articledetails = $stmt->fetch();
?>
    <!-- Article Hero Section -->
    <section class="article-hero">
        <div class="container">
            <h1 class="article-title"><?php echo $articledetails['article_name']; ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb article-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white">হোম</a></li>
                    <li class="breadcrumb-item"><a href="help-blog.php" class="text-white">গ্রাহক সেবা</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page"><?php echo $articledetails['article_name']; ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <section class="article-container">
        <div class="container">
            <div class="article-image">
                <img src="assets/<?php echo $articledetails['article_image']; ?>" alt="<?php echo $articledetails['article_name']; ?>">
            </div>
			
            <div class="article-content">
				<h2> <?php echo $articledetails['article_name']; ?> </h1>
				<div class="article-meta">
					<div class="article-date">
						<i class="far fa-calendar-alt"></i>
						<span>প্রকাশিত: <?php echo $articledetails['created_at']; ?></span>
					</div>
					<div class="article-author">
						<i class="far fa-user"></i>
						<span>লেখক: রিদয় ইসলাম</span>
					</div>
				</div>
                <div class="article-text">
                    <p>আমরা সরাসরি কৃষকদের কাছ থেকে পণ্য সংগ্রহ করি, তাই মধ্যবর্তী ব্যবসায়ীদের খরচ বাঁচিয়ে আমরা আপনাকে দামে সস্তা এবং গুণে ভালো পণ্য দিতে পারি। আমাদের এই বিশেষত্বের কারণে গ্রাহকরা কম দামে উচ্চ মানের পণ্য পাচ্ছেন এবং কৃষকরা তাদের উৎপাদনের ন্যায্য মূল্য পাচ্ছেন।</p>
                    
                    <p>বাজারে সাধারণত কৃষক থেকে পণ্য ক্রয় করার পর বেশ কয়েকটি মধ্যবর্তী ব্যবসায়ীর মাধ্যমে তা গ্রাহকের কাছে পৌঁছায়। প্রতিটি ধাপে পণ্যের দাম বাড়তে থাকে। কিন্তু আমরা সরাসরি কৃষকদের সাথে কাজ করি, তাই মধ্যবর্তী ধাপগুলো এড়িয়ে যেতে পারি।</p>
                    
                    <div class="article-highlight">
                        <p>"সরাসরি কৃষকদের কাছ থেকে পণ্য সংগ্রহ করার মাধ্যমে আমরা ২০-৩০% কম দামে পণ্য বিক্রি করতে সক্ষম হয়েছি"</p>
                    </div>
                    
                    <p>আমাদের এই পদ্ধতির সুবিধা হলো:</p>
                    
                    <div class="article-features">
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> কৃষকরা তাদের উৎপাদনের ন্যায্য মূল্য পান</li>
                            <li><i class="fas fa-check-circle"></i> গ্রাহকরা কম দামে উচ্চ মানের পণ্য পান</li>
                            <li><i class="fas fa-check-circle"></i> পণ্য দ্রুত বাজারে আসে তাই তাজা থাকে</li>
                            <li><i class="fas fa-check-circle"></i> স্থানীয় অর্থনীতিকে শক্তিশালী করে</li>
                            <li><i class="fas fa-check-circle"></i> পরিবেশবান্ধব কারণ পরিবহন খরচ কম হয়</li>
                        </ul>
                    </div>
                    
                    <p>আমরা দেশের বিভিন্ন অঞ্চলের কৃষকদের সাথে কাজ করি। আমাদের সাথে currently ৫০০+ কৃষক যুক্ত আছেন যারা organic পদ্ধতিতে ফসল উৎপাদন করেন। আমরা regularভাবে তাদের training দেই যাতে তারা আরও ভালো qualityর product produce করতে পারেন।</p>
                    
                    <p>আমাদের পণ্য quality control process非常 কঠোর। প্রতিটি product আমাদের quality control team check করে之后ই marketে release করা হয়। এই কারণে আমাদের product-এর quality始终 একই level-এ থাকে।</p>
                    
                    <p>আমাদের এই initiative不仅 গ্রাহক এবং কৃষকদের জন্য beneficial, বরং এটি দেশের economy-এর জন্যও positive impact ফেলছে। local product-এর demand increase করার মাধ্যমে আমরা import কমাতে সাহায্য করছি।</p>
                </div>
                
                <div class="social-share">
                    <p class="me-3">শেয়ার করুন:</p>
                    <a href="https://www.facebook.com/PrakitikShad" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
	</Section>
		
	<!-- Related Articles -->
	<!-- Articles Section -->
    <section class="articles-section">
        <div class="container">
            <h2 class="relation-section-title">আমাদের সম্পর্কে</h2>
            <div class="row">
				<?php 
					$select = "SELECT * FROM article ORDER BY created_at DESC LIMIT 3"; 
					$stmt = $pdo->prepare($select);
					$stmt->execute();
					
					while($blog = $stmt->fetch()){
						$description = $blog['article_dsc'];
						$length = strlen($description);
						if($length > 100){
							$dsc = substr($description, 0, 90);
							$description = $dsc.'...';
						}
						?>
							<div class="col-md-4 mb-4">
								<div class="article-card card" onclick="window.location.href='article-details.php?blog=<?php echo $blog['article_name']; ?>'">
									<img src="assets/<?php echo $blog['article_image']; ?>" class="article-img card-img-top" alt="কম খরচে ভালো পণ্য">
									<div class="article-content">
										<h5 class="article-title"><?php echo $blog['article_name']; ?></h5>
										<p class="article-excerpt"><?php echo $description; ?></p>
										<button class="btn btn-details">আরও পড়ুন</button>
									</div>
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