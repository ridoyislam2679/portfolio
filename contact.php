<?php 
	include_once("header.php");
?>
    <!-- Page Header -->
    <section class="contact-page-header">
        <div class="container">
            <h1 class="contact-page-title" data-aos="fade-down">
                Get In <span>Touch</span>
            </h1>
            <p class="contact-breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <a href="index.html">Home</a> / Contact
            </p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="contact-main-section">
        <div class="container">
            
            <!-- Contact Info Cards Row -->
            <div class="row g-4 mb-5" data-aos="fade-up" data-aos-duration="800">
                <!-- Email Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-info-icon-circle">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h4 class="contact-info-title">Email</h4>
                        <p class="contact-info-text">
                            <a href="mailto:your.email@example.com">ridoyislam2679@gmail.com</a>
                        </p>
                    </div>
                </div>

                <!-- Phone Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-info-icon-circle">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h4 class="contact-info-title">Phone</h4>
                        <p class="contact-info-text">
                            <a href="tel:+8801XXXXXXXXX">+880 1763-029679</a>
                        </p>
                    </div>
                </div>

                <!-- Location Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-info-icon-circle">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h4 class="contact-info-title">Location</h4>
                        <p class="contact-info-text">Rajshahi Division, Bangladesh</p>
                    </div>
                </div>

                <!-- Availability Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="contact-info-card">
                        <div class="contact-info-icon-circle">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <h4 class="contact-info-title">Availability</h4>
                        <p class="contact-info-text">Available for Freelance & Collaboration</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Contact Form - Left Side -->
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="800">
                    <div class="contact-form-card">
                        <h3 class="contact-form-title">Send Me a Message</h3>
                        <p class="contact-form-subtitle">
                            Have a question or want to work together? Fill out the form below and I'll get back to you as soon as possible.
                        </p>

                        <!-- Availability Status -->
                        <div class="contact-status-card mb-4">
                            <div class="contact-status-dot"></div>
                            <div class="contact-status-text">
                                Available for New Projects
                                <small>Typically responds within 24 hours</small>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <form id="contactForm" onsubmit="handleSubmit(event)">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="contact-form-label">
                                        <i class="bi bi-person me-1"></i> Your Name *
                                    </label>
                                    <input type="text" class="form-control contact-form-control" placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="contact-form-label">
                                        <i class="bi bi-envelope me-1"></i> Your Email *
                                    </label>
                                    <input type="email" class="form-control contact-form-control" placeholder="Enter your email address" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="contact-form-label">
                                    <i class="bi bi-bookmark me-1"></i> Subject *
                                </label>
                                <input type="text" class="form-control contact-form-control" placeholder="What is this about?" required>
                            </div>
                            <div class="mb-4">
                                <label class="contact-form-label">
                                    <i class="bi bi-chat-text me-1"></i> Your Message *
                                </label>
                                <textarea class="form-control contact-form-control contact-form-textarea" placeholder="Write your message here..." required></textarea>
                            </div>
                            <button type="submit" class="contact-btn contact-btn-primary">
                                <i class="bi bi-send-fill me-2"></i> Send Message
                            </button>
                        </form>

                        <!-- Success Message (Hidden by Default) -->
                        <div class="contact-success-msg mt-4" id="contactSuccessMsg">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Your message has been sent successfully! I'll get back to you soon.
                        </div>
                    </div>
                </div>

                <!-- Right Side - Social & Map -->
                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- Social Links Card -->
                    <div class="contact-social-card mb-4">
                        <h3 class="contact-social-title">Connect With Me</h3>
                        <p class="contact-social-subtitle">Find me on social media platforms</p>
                        
                        <div class="contact-social-grid">
                            <!-- GitHub -->
                            <a href="https://github.com/yourusername" target="_blank" class="contact-social-btn github-btn" title="GitHub">
                                <i class="bi bi-github"></i>
                            </a>
                            <!-- LinkedIn -->
                            <a href="https://linkedin.com/in/yourusername" target="_blank" class="contact-social-btn linkedin-btn" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <!-- Facebook -->
                            <a href="https://facebook.com/yourusername" target="_blank" class="contact-social-btn facebook-btn" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <!-- Instagram -->
                            <a href="https://instagram.com/yourusername" target="_blank" class="contact-social-btn instagram-btn" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <!-- Twitter/X -->
                            <a href="https://twitter.com/yourusername" target="_blank" class="contact-social-btn twitter-btn" title="Twitter/X">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <!-- WhatsApp -->
                            <a href="https://wa.me/8801XXXXXXXXX" target="_blank" class="contact-social-btn whatsapp-btn" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <!-- Telegram -->
                            <a href="https://t.me/yourusername" target="_blank" class="contact-social-btn telegram-btn" title="Telegram">
                                <i class="bi bi-telegram"></i>
                            </a>
                            <!-- YouTube -->
                            <a href="https://youtube.com/@yourchannel" target="_blank" class="contact-social-btn youtube-btn" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Contact Options -->
                    <div class="contact-social-card mb-4">
                        <h3 class="contact-social-title" style="font-size: 1.2rem;">Quick Actions</h3>
                        <div class="d-grid gap-3">
                            <a href="mailto:ridoyislam2679@gmail.com" class="contact-btn contact-btn-outline w-100">
                                <i class="bi bi-envelope me-2"></i> Email Me Directly
                            </a>
                            <a href="https://wa.me/8801763029679" target="_blank" class="contact-btn contact-btn-primary w-100">
                                <i class="bi bi-whatsapp me-2"></i> Chat on WhatsApp
                            </a>
                            <a href="https://drive.google.com/file/d/1zgVgkK85klSS1aBzE5BX6yLNNt8uIl1A/view?usp=sharing"  target="_blank" class="contact-btn contact-btn-gold w-100">
                                <i class="bi bi-download me-2"></i> Download My Resume
                            </a>
                        </div>
                    </div>

                    <!-- Map Card -->
                    <div class="contact-map-card">
                        <iframe 
                            class="contact-map-iframe"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12236.994576118426!2d89.0075755369304!3d24.238971693341934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fc1c00d4679ea7%3A0x673c1789bdc3dd5f!2sChaknazirpur%20Bazar!5e0!3m2!1sen!2sbd!4v1780655556512!5m2!1sen!2sbd"
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php 
		include_once("footer.php");
	?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS Animation
        AOS.init({
            duration: 1000,
            once: true
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.contact-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('contact-scrolled');
            } else {
                navbar.classList.remove('contact-scrolled');
            }
        });

        // Create Floating Particles
        function createContactParticles() {
            const container = document.getElementById('contactParticles');
            if (!container) return;
            
            for (let i = 0; i < 35; i++) {
                const particle = document.createElement('div');
                particle.className = 'contact-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = Math.random() * 6 + 4 + 's';
                container.appendChild(particle);
            }
        }
        
        createContactParticles();

        // Contact Form Handler
        function handleSubmit(event) {
            event.preventDefault();
            
            // Hide form
            const form = document.getElementById('contactForm');
            form.style.display = 'none';
            
            // Show success message
            const successMsg = document.getElementById('contactSuccessMsg');
            successMsg.style.display = 'block';
            
            // Scroll to success message
            successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Reset after 5 seconds (optional: remove this if you want to keep the message)
            setTimeout(() => {
                successMsg.style.display = 'none';
                form.style.display = 'block';
                form.reset();
            }, 5000);
            
            // ⬇️ এখানে তুমি চাইলে ফর্ম ডাটা সার্ভারে পাঠানোর কোড লিখতে পারো
            // উদাহরণ: fetch('/api/contact', { method: 'POST', body: new FormData(form) });
            
            return false;
        }
    </script>
</body>
</html>