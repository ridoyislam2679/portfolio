<?php
	include_once('header.php');
?>

    <!-- About Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1 class="about-title">আমাদের সম্পর্কে</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb about-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html" class="text-white">হোম</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">আমাদের সম্পর্কে</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-container">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">আমাদের গল্প</h2>
                <p class="about-text">
                    গুরবাজার শুরু হয়েছিল ২০১৫ সালে একটি ছোট্ট উদ্যোগ হিসেবে, যার মূল লক্ষ্য ছিল শহুরে ভোক্তাদের কাছে পৌঁছে দেওয়া তাজা, প্রাকৃতিক এবং রাসায়নিক মুক্ত পণ্য। আমরা সরাসরি কৃষকদের কাছ থেকে পণ্য সংগ্রহ করি, যা মধ্যবর্তী ব্যবসায়ীদের খরচ বাঁচিয়ে গ্রাহকদের দামে সস্তা এবং গুণে ভালো পণ্য দিতে সাহায্য করে।
                </p>
                
                <p class="about-text">
                    আমাদের সকল পণ্য রাসায়নিক মুক্ত এবং সম্পূর্ণ প্রাকৃতিক উপায়ে উৎপাদিত। আমরা কোনো প্রিজারভেটিভ বা কৃত্রিম রং ব্যবহার করি না। আমাদের পণ্য কেনার মাধ্যমে আপনি দেশের গ্রামীণ অর্থনীতিকে সমর্থন করছেন এবং কৃষকদের ন্যায্য মূল্য নিশ্চিত করছেন।
                </p>
                
                <h3 class="mt-5 mb-4">আমাদের বিশেষত্ব</h3>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> সরাসরি বাগান থেকে প্রাকৃতিক ও জৈব ফল সংগ্রহ</li>
                    <li><i class="fas fa-check-circle"></i> রাসায়নিক ও ফরমালিন মুক্ত পণ্য</li>
                    <li><i class="fas fa-check-circle"></i> কৃষকদের কাছ থেকে সরাসরি ক্রয় - ন্যায্য মূল্য নিশ্চিতকরণ</li>
                    <li><i class="fas fa-check-circle"></i> দ্রুত ডেলিভারি সেবা - অর্ডার করলে ১-২ দিন মধ্যে</li>
                    <li><i class="fas fa-check-circle"></i> ১০০% তাজা পণ্যের গ্যারান্টি</li>
                    <li><i class="fas fa-check-circle"></i> পরিবেশবান্ধব প্যাকেজিং</li>
                </ul>
            </div>
            
            <!-- Image Gallery -->
            <div class="image-gallery">
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
            
            <!-- Video Section -->
            <div class="video-container">
                <h2 class="section-title">আমাদের কাজের ধারা</h2>
                <p class="about-text text-center mb-4">
                    নিচের ভিডিওতে আপনি দেখতে পাবেন কিভাবে আমরা সরাসরি বাগান থেকে তাজা ফল সংগ্রহ করি এবং তা আপনার দোরগোড়ায় পৌঁছে দিই।
                </p>
                <div class="video-wrapper">
                    <!-- Replace with your actual video embed code -->
                    <iframe src="https://www.youtube.com/embed/5qap5aO4i9A" title="আমাদের কাজের ধারা" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            
            <!-- Stats Section -->
            <div class="stats-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="stat-number">৫00+</div>
                                <div class="stat-text">সন্তুষ্ট গ্রাহক</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="stat-number">২ বছর</div>
                                <div class="stat-text">অভিজ্ঞতা</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="stat-number">৫0+</div>
                                <div class="stat-text">কৃষক পার্টনার</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="stat-number">১০০%</div>
                                <div class="stat-text">প্রাকৃতিক পণ্য</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Team Section -->
            <div class="team-section">
                <h2 class="section-title">আমাদের টিম</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="team-card">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="team-img" alt="রহিম মিয়া">
                            <div class="team-info">
                                <h4 class="team-name">রহিম মিয়া</h4>
                                <p class="team-role">প্রতিষ্ঠাতা ও সিইও</p>
                                <p>২ বছরের বেশি অভিজ্ঞতা নিয়ে গুরবাজার প্রতিষ্ঠা করেছেন</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="team-card">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="team-img" alt="সালমা আক্তার">
                            <div class="team-info">
                                <h4 class="team-name">সালমা আক্তার</h4>
                                <p class="team-role">গুণগত মান নিয়ন্ত্রক</p>
                                <p>পণ্যের গুণগত মান নিশ্চিত করতে কাজ করেন</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="team-card">
                            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="team-img" alt="করিম উদ্দিন">
                            <div class="team-info">
                                <h4 class="team-name">করিম উদ্দিন</h4>
                                <p class="team-role">কৃষি সম্পর্ক বিশেষজ্ঞ</p>
                                <p>কৃষকদের সাথে সরাসরি কাজ করে ভালো পণ্য সংগ্রহ করেন</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
	include_once('footer.php');
?>