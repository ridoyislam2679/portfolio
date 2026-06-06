<?php 
	include_once("header.php");
?>

    <!-- Page Header -->
    <section class="projects-page-header">
        <div class="container">
            <h1 class="projects-page-title" data-aos="fade-down">
                My <span>Projects</span>
            </h1>
            <p class="projects-breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <a href="index.php">Home</a> / Projects
            </p>
            <p class="projects-header-desc" data-aos="fade-up" data-aos-delay="300">
                Explore my portfolio of web development projects including live websites, university projects, and personal creations.
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="projects-filter-section" data-aos="fade-up" data-aos-duration="800">
        <div class="container">
            <div class="projects-filter-wrapper">
                <!-- Search Box -->
                <div class="projects-search-box">
                    <input type="text" class="form-control projects-search-input" id="projectSearch" placeholder="Search projects..." onkeyup="filterProjects()">
                    <i class="bi bi-search projects-search-icon"></i>
                </div>

                <!-- Filter Buttons -->
                <div class="projects-filter-buttons" id="filterButtons">
                    <button class="projects-filter-btn active" onclick="filterProjectsByCategory('all', this)">
                        All Projects
                        <span class="projects-filter-count">7</span>
                    </button>
                    <button class="projects-filter-btn" onclick="filterProjectsByCategory('live', this)">
                        <i class="bi bi-globe me-1"></i> Live Websites
                        <span class="projects-filter-count">3</span>
                    </button>
                    <button class="projects-filter-btn" onclick="filterProjectsByCategory('ecommerce', this)">
                        <i class="bi bi-cart me-1"></i> E-Commerce
                        <span class="projects-filter-count">1</span>
                    </button>
                    <button class="projects-filter-btn" onclick="filterProjectsByCategory('university', this)">
                        <i class="bi bi-mortarboard me-1"></i> University
                        <span class="projects-filter-count">1</span>
                    </button>
                    <button class="projects-filter-btn" onclick="filterProjectsByCategory('php', this)">
                        <i class="bi bi-filetype-php me-1"></i> PHP Projects
                        <span class="projects-filter-count">7</span>
                    </button>
					<!--
                    <button class="projects-filter-btn" onclick="filterProjectsByCategory('other', this)">
                        <i class="bi bi-folder me-1"></i> Other
                        <span class="projects-filter-count">2</span>
                    </button>
					-->
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid Section -->
    <section class="projects-main-section">
        <div class="container">
            
            <!-- Counter Bar -->
            <div class="projects-counter-bar" data-aos="fade-up">
                <div class="projects-counter-text">
                    Showing <strong id="showingCount">7</strong> of <strong>7</strong> projects
                </div>
                <div class="projects-view-toggle">
                    <button class="projects-view-btn active" onclick="toggleView('grid', this)" title="Grid View">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </button>
                    <button class="projects-view-btn" onclick="toggleView('list', this)" title="List View">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="projects-grid" id="projectsGrid">
                
                <!-- Project 1: MobileReviewBD (Live) -->
                <div class="project-card" data-category="live php" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">📱</div>
                        <div class="project-card-overlay">
                            <a href="https://mobilereviewbd.com" target="_blank" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Visit Website
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag live"><i class="bi bi-globe"></i> Live</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">Bootstrap</span>
                        </div>
                        <h4 class="project-card-title">MobileReviewBD</h4>
                        <p class="project-card-desc">
                            A comprehensive mobile phone review platform with detailed specifications, 
                            user reviews, comparison tools, and latest mobile news.
                        </p>
                        <ul class="project-card-features">
                            <li>Mobile comparison system</li>
                            <li>Admin dashboard with analytics</li>
                            <li>Responsive design for all devices</li>
                        </ul>
                        <div class="project-card-footer">
                            <a href="https://mobilereviewbd.com" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-globe"></i> Live
                            </a>
                            <a href="MobileProject/index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-info-circle"></i> Demo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 2: E-Commerce (Live) -->
                <div class="project-card" data-category="live ecommerce php" data-aos="fade-up" data-aos-delay="150">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">💼</div>
                        <div class="project-card-overlay">
                            <a href="https://refonex.com" target="_blank" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Visit Website
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag live"><i class="bi bi-globe"></i> Live</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">AJAX</span>
                        </div>
                        <h4 class="project-card-title">E-Commerce Platform</h4>
                        <p class="project-card-desc">
							Full-featured e-commerce website with product management, shopping cart, 
                            checkout system, and admin panel.
                        </p>
                        <ul class="project-card-features">
                            <li>Business service showcase</li>
                            <li>checkout without register system</li>
                            <li>checkout with register system</li>
                            <li>Modern UI/UX design</li>
                            <li>SEO optimized structure</li>
                        </ul>
                        <div class="project-card-footer">
                            <a href="https://refonex.com" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-globe"></i> Live
                            </a>
                            <a href="PreakithikShad/index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-info-circle"></i> Demo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 3: Gold Save P2P Website -->
                <div class="project-card" data-category="live php other" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">🛒</div>
                        <div class="project-card-overlay">
                            <a href="https://www.goldsaveworld.com/" target="_blank" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> Visit Website
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag live"><i class="bi bi-globe"></i> Live</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">js</span>
                        </div>
                        <h4 class="project-card-title">P2P Platform</h4>
                        <p class="project-card-desc">
                            A professional business solution platform offering innovative digital services 
                            and modern web solutions for businesses.
                        </p>
                        <ul class="project-card-features">
                            <li>User verification system</li>
                            <li>Secure transaction processing</li>
                            <li>Escrow payment protection</li>
                            <li>Transaction history & reports</li>
                        </ul>
                        <div class="project-card-footer">
							<a href="https://www.goldsaveworld.com/" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-globe"></i> Live
                            </a>
                            <a href="GoldSave/index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-info-circle"></i> Demo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 4: Micro Earning Website -->
                <div class="project-card" data-category="php other" data-aos="fade-up" data-aos-delay="250">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">💰</div>
                        <div class="project-card-overlay">
                            <a href="projects/micro-earning.html" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-eye"></i> View Demo
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag local"><i class="bi bi-folder"></i> Local</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">MySQL</span>
                            <span class="project-tag">AJAX</span>
                        </div>
                        <h4 class="project-card-title">Micro Earning Platform</h4>
                        <p class="project-card-desc">
                            A micro-task earning platform where users can complete small tasks 
                            and earn rewards through a point-based system.
                        </p>
                        <ul class="project-card-features">
                            <li>Task completion & verification</li>
                            <li>Points & rewards system</li>
                            <li>User referral program</li>
                            <li>Withdrawal management</li>
                        </ul>
                        <div class="project-card-footer">
                            <a href="Micro/index.php" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-info-circle"></i> View Website
                            </a>
                            <a href="Micro/index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-play-circle"></i> Watch Demo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 5: University Project Website -->
                <div class="project-card" data-category="university php" data-aos="fade-up" data-aos-delay="350">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">🎓</div>
                        <div class="project-card-overlay">
                            <a href="projects/university.html" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-eye"></i> View Demo
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag local"><i class="bi bi-folder"></i> Local</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">Bootstrap</span>
                            <span class="project-tag">MySQL</span>
                        </div>
                        <h4 class="project-card-title">University Project Website</h4>
                        <p class="project-card-desc">
                            A comprehensive university department website with student portal, 
                            course management, and faculty profiles.
                        </p>
                        <ul class="project-card-features">
                            <li>Student management system</li>
                            <li>Course & result portal</li>
                            <li>Faculty & staff profiles</li>
                            <li>Notice & event management</li>
                        </ul>
                        <div class="project-card-footer">
                            <a href="University/index.php" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-info-circle"></i> View Website
                            </a>
                            <a href="University/index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-play-circle"></i> Watch Demo
                            </a>
                        </div>
                    </div>
                </div>
				
				
				<!-- Project 6: Protfolio Local Version -->
                <div class="project-card" data-category="php other" data-aos="fade-up" data-aos-delay="450">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">🌐</div>
                        <div class="project-card-overlay">
                            <a href="projects/Protfolio.html" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-eye"></i> View Demo
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag local"><i class="bi bi-folder"></i> Local</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">JavaScript</span>
                            <span class="project-tag">CSS3</span>
                        </div>
                        <h4 class="project-card-title">Protfolio Website (Local Version)</h4>
                        <p class="project-card-desc">
                            A personal portfolio website that represents your identity, skills, and development work in a simple and professional way.
                        </p>
                        <ul class="project-card-features">
                            <li> Responsive and modern user interface</li>
                            <li> Easy customization and code maintenance</li>
                            <li> Fast loading and optimized performance</li>
                        </ul>
						
                        <div class="project-card-footer">
                            <a href="index.php" target="_blank" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-info-circle"></i> View Website
                            </a>
                            <a href="index.php" target="_blank" class="projects-btn projects-btn-outline projects-btn-sm">
                                <i class="bi bi-play-circle"></i> Watch Demo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 7: Mobile Service Website (Local) -->
                <div class="project-card" data-category="php other" data-aos="fade-up" data-aos-delay="400">
                    <div class="project-card-image">
                        <div class="project-icon-placeholder">🔧</div>
                        <div class="project-card-overlay">
                            <a href="projects/mobile-service.html" class="projects-btn projects-btn-white projects-btn-sm">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <div class="project-card-tags">
                            <span class="project-tag local"><i class="bi bi-folder"></i> Local</span>
                            <span class="project-tag php">PHP</span>
                            <span class="project-tag">Bootstrap</span>
                        </div>
                        <h4 class="project-card-title">Mobile Service Center</h4>
                        <p class="project-card-desc">
                            A mobile repair and service center website with service booking, 
                            price estimation, and customer management.
                        </p>
                        <ul class="project-card-features">
                            <li>Service booking system</li>
                            <li>Price estimation tool</li>
                            <li>Customer database</li>
                            <li>Service status tracking</li>
                        </ul>
                        <div class="project-card-footer">
                            <a href="" class="projects-btn projects-btn-primary projects-btn-sm">
                                <i class="bi bi-info-circle"></i> Project Details
                            </a>
                        </div>
                    </div>
                </div>

            </div><!-- /projects-grid -->

            <!-- No Results Message -->
            <div class="projects-no-results" id="noResults">
                <div class="projects-no-results-icon">🔍</div>
                <h3 class="projects-no-results-title">No Projects Found</h3>
                <p class="projects-no-results-text">Try adjusting your search or filter criteria.</p>
                <button class="projects-btn projects-btn-primary mt-3" onclick="resetFilters()">
                    <i class="bi bi-arrow-repeat"></i> Reset Filters
                </button>
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
            const navbar = document.querySelector('.projects-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('projects-scrolled');
            } else {
                navbar.classList.remove('projects-scrolled');
            }
        });

        // Create Floating Particles
        function createProjectsParticles() {
            const container = document.getElementById('projectsParticles');
            if (!container) return;
            
            for (let i = 0; i < 35; i++) {
                const particle = document.createElement('div');
                particle.className = 'projects-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = Math.random() * 6 + 4 + 's';
                container.appendChild(particle);
            }
        }
        
        createProjectsParticles();

        // ========== FILTER FUNCTIONS ==========
        let currentCategory = 'all';
        let currentSearch = '';

        function filterProjectsByCategory(category, button) {
            currentCategory = category;
            
            // Update active button
            document.querySelectorAll('.projects-filter-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Apply filters
            applyFilters();
        }

        function filterProjects() {
            currentSearch = document.getElementById('projectSearch').value.toLowerCase();
            applyFilters();
        }

        function applyFilters() {
            const projects = document.querySelectorAll('.project-card');
            let visibleCount = 0;
            
            projects.forEach(project => {
                const categories = project.getAttribute('data-category');
                const title = project.querySelector('.project-card-title').textContent.toLowerCase();
                const desc = project.querySelector('.project-card-desc').textContent.toLowerCase();
                
                // Check category match
                const categoryMatch = currentCategory === 'all' || 
                    (categories && categories.split(' ').includes(currentCategory));
                
                // Check search match
                const searchMatch = currentSearch === '' || 
                    title.includes(currentSearch) || 
                    desc.includes(currentSearch);
                
                // Show/hide based on both filters
                if (categoryMatch && searchMatch) {
                    project.style.display = '';
                    visibleCount++;
                } else {
                    project.style.display = 'none';
                }
            });
            
            // Update counter
            document.getElementById('showingCount').textContent = visibleCount;
            
            // Show/hide no results message
            const noResults = document.getElementById('noResults');
            const projectsGrid = document.getElementById('projectsGrid');
            
            if (visibleCount === 0) {
                noResults.style.display = 'block';
                projectsGrid.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                projectsGrid.style.display = '';
            }
        }

        function resetFilters() {
            currentCategory = 'all';
            currentSearch = '';
            document.getElementById('projectSearch').value = '';
            
            // Reset filter buttons
            document.querySelectorAll('.projects-filter-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector('.projects-filter-btn').classList.add('active');
            
            // Show all projects
            applyFilters();
        }

        // ========== VIEW TOGGLE ==========
        function toggleView(view, button) {
            const grid = document.getElementById('projectsGrid');
            const buttons = document.querySelectorAll('.projects-view-btn');
            
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            if (view === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        }
    </script>
</body>
</html>