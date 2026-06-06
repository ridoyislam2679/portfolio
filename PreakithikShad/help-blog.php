<?php
	include_once('db/index.php');
	include_once('header.php');
?>

    <!-- Service Hero Section -->
    <section class="service-hero">
        <div class="container">
            <h1 class="service-title">গ্রাহক সেবা</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb service-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php" class="text-white">হোম</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">গ্রাহক সেবা</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Service Content -->
    <section class="service-container">
        <div class="container">
            <!-- Articles Section -->
            <div class="articles-section">
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
            
            <!-- FAQ Section -->
            <div class="faq-section">
                <h2 class="section-title">প্রায়শই জিজ্ঞাসিত প্রশ্ন</h2>
                
                <div class="accordion" id="serviceFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                অর্ডার করতে কি রেজিস্ট্রেশন প্রয়োজন?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#serviceFAQ">
                            <div class="accordion-body">
                                না, রেজিস্ট্রেশন ছাড়াই আপনি অর্ডার করতে পারেন। তবে রেজিস্ট্রেশন করলে আপনার অর্ডার হিস্ট্রি, উইশলিস্ট এবং অন্যান্য সুবিধা পাবেন।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                পণ্য ডেলিভারি করতে কত সময় লাগে?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#serviceFAQ">
                            <div class="accordion-body">
                                ঢাকা শহরের মধ্যে অর্ডার করলে ২৪ ঘন্টার মধ্যে এবং ঢাকার বাইরে ২-৩ কর্মদিবসের মধ্যে ডেলিভারি প্রদান করা হয়।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                পণ্য ফেরত দেওয়ার নিয়ম কি?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#serviceFAQ">
                            <div class="accordion-body">
                                পণ্য ডেলিভারির ২৪ ঘন্টার之内 যদি পণ্যে কোনো সমস্যা থাকে, তাহলে আপনি ফেরত দিতে পারেন। পণ্য অপরিবর্তিত অবস্থায় এবং মূল প্যাকেজিং完好 থাকতে হবে।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                পেমেন্ট পদ্ধতি有哪些?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#serviceFAQ">
                            <div class="accordion-body">
                                আমরা ক্যাশ অন ডেলিভারি, বিকাশ, নগদ, রকেট এবং ব্যাংক কার্ডের মাধ্যমে পেমেন্ট গ্রহণ করি।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                পণ্যের গুণগত মান কিভাবে নিশ্চিত করবেন?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#serviceFAQ">
                            <div class="accordion-body">
                                আমরা সরাসরি কৃষকদের কাছ থেকে পণ্য সংগ্রহ করি এবং প্রতিটি পণ্য পাঠানোর আগে quality check করা হয়। আমাদের所有 পণ্য ১০০% প্রাকৃতিক এবং রাসায়নিক মুক্ত।
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info">
                <h2 class="section-title">যোগাযোগ করুন</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h3 class="info-title">ফোন</h3>
                            <div class="info-details">
                                <p><a href="tel:+8801712345678">+৮৮০ ১৭১২ ৩৪৫৬৭৮</a></p>
                                <p><a href="tel:+8801812345678">+৮৮০ ১৮১২ ৩४৫६৭৮</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="info-title">ইমেইল</h3>
                            <div class="info-details">
                                <p><a href="mailto:support@gurbazaar.com">support@gurbazaar.com</a></p>
                                <p><a href="mailto:info@gurbazaar.com">info@gurbazaar.com</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="info-title">কর্মঘণ্টা</h3>
                            <div class="info-details">
                                <p>শনি - বৃহস্পতিবার: সকাল ৯টা - রাত ১০টা</p>
                                <p>শুক্রবার: বন্ধ</p>
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