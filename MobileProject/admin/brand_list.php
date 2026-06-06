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
                <h2 class="mb-3 mb-md-0">Brand List</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Brand Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>iPhone 14 Pro Max</td>
                            <td><img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-14-pro-model-unselect-gallery-2-202209?wid=5120&hei=2880&fmt=p-jpg&qlt=80&.v=1660753617536" alt="iPhone" class="mobile-img"></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="action-btn edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Samsung Galaxy S23 Ultra</td>
                            <td><img src="" alt="Samsung" class="mobile-img"></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="action-btn edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Google Pixel 7 Pro</td>
                            <td><img src="" alt="Pixel" class="mobile-img"></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="action-btn edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>OnePlus 11</td>
                            <td><img src="#" alt="OnePlus" class="mobile-img"></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="action-btn edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php 
	include_once('footer.php');
?>
   