<?php
	include_once('header.php');
?>
    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="contact-title">যোগাযোগ</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb contact-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html" class="text-white">হোম</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">যোগাযোগ</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-container">
        <div class="container">
            <div class="contact-content">
                <h2 class="section-title">আমাদের সাথে যোগাযোগ করুন</h2>
                <p class="contact-text">
                    আপনার যে কোনো প্রশ্ন, মতামত বা পরামর্শ আমাদের জানান। আমরা সর্বদাই আপনার সেবায় готов। নিচের ফর্মটি পূরণ করুন অথবা সরাসরি আমাদের সাথে যোগাযোগ করুন।
                </p>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="info-title">ঠিকানা</h3>
                            <div class="info-details">
                                <p>ওয়ালিয়া, লালপুর, নাটোর</p>
                                <p>বাংলাদেশ</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h3 class="info-title">ফোন</h3>
                            <div class="info-details">
                                <p><a href="tel:+8801712345678">+880 1763 029679</a></p>
                                <p><a href="tel:+8801812345678">+880 1893 331426</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="info-title">ইমেইল</h3>
                            <div class="info-details">
                                <p><a href="mailto:ridoyislam2679@gmail.com">ridoyislam2679@gmail.com</a></p>
                                <p><a href="mailto:hridoyislam2679@gmail.com">hridoyislam2679@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="info-title">কর্মঘণ্টা</h3>
                            <div class="info-details">
                                <p>শনি - শুক্রবার: সকাল ৯টা - রাত ১০টা</p>
                                <p>নামাজের সময় সকল সেবা বন্ধ থাকবে</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3 class="info-title">সাপোর্ট</h3>
                            <div class="info-details">
                                <p><a href="tel:+8801712000000">+880 1763 029679</a></p>
                                <p>২৪/৭ হেল্পলাইন</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="info-title">ডেলিভারি</h3>
                            <div class="info-details">
                                <p><a href="tel:+8801712345678">+880 1763 029679</a></p>
                                <p>ডেলিভারি সম্পর্কিত যেকোনো প্রশ্ন</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h2 class="section-title">মেসেজ পাঠান</h2>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">আপনার নাম *</label>
                                        <input type="text" class="form-control input-coz" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">ইমেইল *</label>
                                        <input type="email" class="form-control input-coz" id="email" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">ফোন নম্বর *</label>
                                        <input type="tel" class="form-control input-coz" id="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">বিষয় *</label>
                                        <input type="text" class="form-control input-coz" id="subject" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">মেসেজ *</label>
                                <textarea class="form-control input-coz" id="message" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn-submit">মেসেজ পাঠান</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="social-contact">
                        <h2 class="section-title">সোশ্যাল মিডিয়া</h2>
                        <p>সোশ্যাল মিডিয়াতে আমাদের ফলো করুন এবং সর্বশেষ আপডেট পেতে থাকুন</p>
                        
                        <div class="social-icons-large">
                            <a href="https://www.facebook.com/PrakitikShad" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        </div>
                        
                        <div class="mt-5">
                            <h3>জরুরি যোগাযোগ</h3>
                            <p>জরুরি প্রয়োজনে সরাসরি কল করুন</p>
                            <a href="tel:+8801763029679" class="btn btn-danger mt-2">
                                <i class="fas fa-phone-alt me-2"></i>জরুরি হেল্পলাইন
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Map Section -->
            <div class="map-container">
                <h2 class="section-title">আমাদের অবস্থান</h2>
                <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227.3647891471405!2d89.03569548372955!3d24.247492200008153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fc19884dcc22f7%3A0x87633dd3ceb885ce!2sDreamer%20IT%20%7C%20Best%20place%20to%20fulfill%20your%20dreams!5e0!3m2!1sen!2sbd!4v1756745492028!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <!-- FAQ Section -->
            <div class="faq-section">
                <h2 class="section-title">প্রায়শই জিজ্ঞাসিত প্রশ্ন</h2>
                
                <div class="accordion" id="contactFAQ">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                কত时间内 উত্তর পাব?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                আমরা收到您的消息后的 24 ঘন্টার之内答复 করার চেষ্টা করি।周末বার的情况下, উত্তর немного বিলম্বিত হতে পারে।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                কি কি বিষয়ে যোগাযোগ করতে পারি?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                আপনি পণ্য সম্পর্কিত যেকোনো প্রশ্ন, অর্ডার সম্পর্কিত সমস্যা, ডেলিভারি, পেমেন্ট, রিটার্ন বা অন্য任何 বিষয়ে联系我们 করতে পারেন।
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                সরাসরি দোকানে আসতে পারি?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#contactFAQ">
                            <div class="accordion-body">
                                হ্যাঁ, আপনি আমাদের দোকানে সরাসরি আসতে পারেন। দোকানের ঠিকানা: ১২/৪, পান্থপথ, ঢাকা-১২১৫। দোকান খোলার সময়: শনি-বৃহস্পতিবার সকাল ৯টা থেকে রাত ১০টা।
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