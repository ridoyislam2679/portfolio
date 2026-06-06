<?php 
	include_once("header.php");
?>
    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="hero-title">
                        <span class="greeting">👋 Hello, I'm</span>
                        <span class="name glow-text">MD Hridoy Islam</span>
                        <span class="role">
                            <span id="typing-text"></span>
                        </span>
                    </h1>
                    <p class="hero-description">
                        Passionate web developer crafting beautiful and functional digital experiences. 
                        Specializing in modern web technologies with a focus on creating stunning, 
                        user-friendly websites that leave a lasting impression.
                    </p>
                    <div class="mt-4">
                        <a href="projects.php" class="btn btn-custom btn-primary-gradient">
                            <i class="bi bi-eye"></i> View My Work
                        </a>
                        <a href="contact.php" class="btn btn-custom btn-outline-gradient">
                            <i class="bi bi-chat-dots"></i> Get In Touch
                        </a>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="mt-4">
                        <a href="#" class="social-icon text-white me-3 fs-4"><i class="bi bi-github"></i></a>
                        <a href="#" class="social-icon text-white me-3 fs-4"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-icon text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon text-white fs-4"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-5" data-aos="fade-left" data-aos-duration="1000">
                    <div class="hero-image-container">
                        <div class="hero-image-wrapper">
                            <div class="hero-image-inner">
                                <img src="assets/hridoyIslam.jpeg" alt="MD Hridoy Islam">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="scroll-indicator">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="about-preview" id="about" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <h2 class="section-title">About <span>Me</span></h2>
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto">
                    <div class="about-preview-card">
                        <h3 class="mb-3">Who I Am</h3>
                        <p class="text-secondary mb-3">
                            I'm a passionate Full Stack Web Developer from Bangladesh with expertise in building 
                            modern web applications. I specialize in creating responsive, user-friendly websites 
                            using PHP, MySQL, JavaScript, and Bootstrap.
                        </p>
                        <p class="text-secondary mb-4">
                            With 2+ years of experience, I've successfully delivered multiple projects including 
                            e-commerce platforms, P2P systems, and micro-earning websites. I'm dedicated to 
                            writing clean, efficient code and creating exceptional digital experiences.
                        </p>
                        <a href="about.php" class="btn btn-custom btn-primary-gradient">
                            <i class="bi bi-person"></i> More About Me
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Projects Section -->
    <section class="section-padding" id="projects" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <h2 class="section-title">Featured <span>Projects</span></h2>
            <div class="row">
                <!-- Project 1: MobileReviewBD -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-icon">📱</div>
                        <h4>MobileReviewBD</h4>
                        <p class="text-secondary">A comprehensive mobile review platform with detailed specifications, user reviews, and comparison features.</p>
                        <div class="mb-3">
                            <span class="project-tag">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">Bootstrap</span>
                        </div>
                        <div class="project-links">
                            <a href="https://mobilereviewbd.com" target="_blank" class="btn btn-custom btn-primary-gradient btn-sm">
                                <i class="bi bi-globe"></i> Live Demo
                            </a>
                            <a href="projects/mobilereviewbd.html" class="btn btn-custom btn-outline-gradient btn-sm">
                                <i class="bi bi-info-circle"></i> Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 2: Reponex -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-icon">💼</div>
                        <h4>P2P Website</h4>
                        <p class="text-secondary">A professional business solution platform with advanced features and modern design.</p>
                        <div class="mb-3">
                            <span class="project-tag">PHP</span>
                            <span class="project-tag">JavaScript</span>
                            <span class="project-tag">SQL</span>
                        </div>
                        <div class="project-links">
                            <a href="https://www.goldsaveworld.com/" target="_blank" class="btn btn-custom btn-primary-gradient btn-sm">
                                <i class="bi bi-globe"></i> Live Demo
                            </a>
                            <a href="projects/goldsaveworld.html" class="btn btn-custom btn-outline-gradient btn-sm">
                                <i class="bi bi-info-circle"></i> Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 3: E-Commerce Platform -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project-card">
                        <div class="project-icon">🛒</div>
                        <h4>E-Commerce Website</h4>
                        <p class="text-secondary">Full-featured e-commerce platform with cart system, payment integration, and admin panel.</p>
                        <div class="mb-3">
                            <span class="project-tag">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">AJAX</span>
                        </div>
                        <div class="project-links">
							<a href="https://www.refonex.com/" target="_blank" class="btn btn-custom btn-primary-gradient btn-sm">
                                <i class="bi bi-globe"></i> Live Demo
                            </a>
                            <a href="projects/ecommerce.html" class="btn btn-custom btn-outline-gradient btn-sm">
                                <i class="bi bi-info-circle"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More Projects Button -->
            <div class="more-projects">
                <a href="projects.php" class="btn btn-custom btn-outline-gradient btn-lg">
                    <i class="bi bi-folder2-open"></i> View All Projects (7+)
                </a>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="section-padding" id="skills" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <h2 class="section-title">My <span>Skills</span></h2>
            <div class="row g-4">
                <!-- Skill items - easily add/remove -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-filetype-html" style="color: #e34f26;"></i>
                        </div>
                        <h5>HTML5</h5>
                        <small class="text-secondary">Advanced</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-filetype-css" style="color: #1572b6;"></i>
                        </div>
                        <h5>CSS3</h5>
                        <small class="text-secondary">Advanced</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-filetype-js" style="color: #f7df1e;"></i>
                        </div>
                        <h5>JavaScript</h5>
                        <small class="text-secondary">Intermediate</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-filetype-php" style="color: #777bb4;"></i>
                        </div>
                        <h5>PHP</h5>
                        <small class="text-secondary">Advanced</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-bootstrap-fill" style="color: #7952b3;"></i>
                        </div>
                        <h5>Bootstrap</h5>
                        <small class="text-secondary">Advanced</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-database" style="color: #00758f;"></i>
                        </div>
                        <h5>MySQL</h5>
                        <small class="text-secondary">Advanced</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-git" style="color: #f05032;"></i>
                        </div>
                        <h5>Git</h5>
                        <small class="text-secondary">Intermediate</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="skill-card">
                        <div class="skill-icon-circle">
                            <i class="bi bi-wordpress" style="color: #21759b;"></i>
                        </div>
                        <h5>WordPress</h5>
                        <small class="text-secondary">Basic</small>
                    </div>
                </div>
            </div>

            <!-- Currently Learning Section -->
            <div class="mt-5" data-aos="fade-up" data-aos-duration="1000">
                <div class="learning-card">
                    <h3 class="text-center mb-4">
                        <i class="bi bi-book-half"></i> Currently Learning & Exploring
                    </h3>
                    <p class="text-center text-secondary mb-4">
                        Always expanding my knowledge base to stay updated with the latest technologies and tools.
                    </p>
                    <div class="text-center">
                        <span class="learning-badge"><i class="bi bi-file-earmark-spreadsheet"></i> Excel</span>
                        <span class="learning-badge"><i class="bi bi-filetype-py"></i> Python</span>
                        <span class="learning-badge"><i class="bi bi-file-ppt"></i> PowerPoint</span>
                        <span class="learning-badge"><i class="bi bi-graph-up-arrow"></i> Forex Trading</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats/Experience Section -->
    <section class="stats-section" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <h2 class="section-title mb-5">My <span>Experience</span></h2>
            <div class="row">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-number">3+</div>
                        <div class="stat-label">Live Websites</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-number">7+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Technologies</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-card">
                        <div class="stat-number">2+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-padding" id="contact" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <h2 class="section-title">Get In <span>Touch</span></h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-info-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Name</h6>
                                        <p class="mb-0 text-secondary">MD Hridoy Islam</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Email</h6>
                                        <p class="mb-0 text-secondary">ridoyislam2679@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Phone</h6>
                                        <p class="mb-0 text-secondary">+880 1763-029679</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-info-item">
                                    <div class="contact-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Location</h6>
                                        <p class="mb-0 text-secondary">Bangladesh</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="text-center mt-4">
                            <h5 class="mb-3">Connect With Me</h5>
                            <div class="social-links-circle">
                                <a href="#" class="social-icon" title="GitHub"><i class="bi bi-github"></i></a>
                                <a href="#" class="social-icon" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="social-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="social-icon" title="Twitter"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>

                        <!-- Contact Button -->
                        <div class="text-center mt-4">
                            <a href="contact.php" class="btn btn-custom btn-primary-gradient btn-lg">
                                <i class="bi bi-send"></i> Contact Details & Form
                            </a>
                        </div>
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

        // Typing Effect
        const roles = [
            "Full Stack Developer",
            "Web Designer",
            "UI/UX Enthusiast",
            "Problem Solver"
        ];
        
        let roleIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typingElement = document.getElementById('typing-text');
        
        function typeEffect() {
            const currentRole = roles[roleIndex];
            
            if (isDeleting) {
                typingElement.textContent = currentRole.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typingElement.textContent = currentRole.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentRole.length) {
                setTimeout(() => { isDeleting = true; }, 2000);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                roleIndex = (roleIndex + 1) % roles.length;
            }
            
            const speed = isDeleting ? 50 : 100;
            setTimeout(typeEffect, speed);
        }
        
        // Start typing effect
        typeEffect();

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Create Floating Particles
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = Math.random() * 6 + 4 + 's';
                container.appendChild(particle);
            }
        }
        
        createParticles();

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Active Nav Link Update on Scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>