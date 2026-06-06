<?php 
	include_once('header.php');
?>
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        <div class="header d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="logo d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/906/906361.png" alt="Logo">
                    <h1 class="ms-2 mb-0 fs-4">MobileStore Admin</h1>
                </div>
            </div>
            <div class="user-info d-flex align-items-center w-100 justify-content-md-end justify-content-between">
                <span class="me-3 d-none d-sm-block">Welcome, Admin User</span>
                <button class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </div>
        </div>

        <!-- Recent Mobiles Table -->
        <div class="recent-mobiles">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <h2 class="mb-3 mb-md-0">Mobile List</h2>
            </div>
				<h4> Loading... </h4>
            </div>
        </div>
    </div>
<?php 
	include_once('footer.php');
?>
   