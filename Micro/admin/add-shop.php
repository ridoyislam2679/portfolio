<?php 
	ob_start();
	include_once('header.php');
	include_once('../db/index.php');
?>
<?php 
	include_once('sidebar.php');
?>
    
   
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Add New Shop Item</h1>
            </div>

            <!-- Add Task Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Shop Information</h6>
                </div>
                <div class="card-body">
                    <form id="taskForm" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskTitle" class="form-label">Shop Title *</label>
                                    <input type="text" name="title" class="form-control" id="taskTitle" placeholder="Enter Shop title" required>
                                </div>
                            </div>
							<div class="form-group mb-4">
								<label for="taskDescription" class="form-label">Shop Description *</label>
								<textarea class="form-control" name="dsc" id="taskDescription" rows="4" placeholder="Enter detailed Shop description" required></textarea>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskCredit" class="form-label">Shop Price *</label>
                                    <input type="number" name="amount" class="form-control" id="taskCredit" placeholder="Enter Shop Price" min="0" step="0.01" required>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskCredit" class="form-label">Coin Price *</label>
                                    <input type="number" name="coin" class="form-control" id="taskCredit" placeholder="Enter Shop Coin Price" min="0" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="taskImage" class="form-label">Shop Image</label>
                            <input type="file" name="image" class="form-control" id="taskImage" accept="image/*">
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" name="add_item" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Item
                            </button>
                        </div>
                    </form>
					<?php 
						if(isset($_POST['add_item'])){
							$title   = $_POST['title'];
							$amount  = $_POST['amount'];
							$coin    = $_POST['coin'];
							$dsc     = $_POST['dsc'];
							
							$image = $_FILES['image']['name'];
							$destination = "shop/".$image;
							
							$sql = "INSERT INTO shop(product_name, product_description, product_price, product_coin, product_image) VALUES (?, ?, ?, ?, ?)";
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$title, $dsc, $amount, $coin, $image]);
							move_uploaded_file($_FILES['image']['tmp_name'], $destination);
							
							echo '<div class="alert alert-success mt-3" style="color: red;">Shop Item submitted successfully.</div>';				
						}						
					?>
                </div>
            </div>
        </div>
    </main>
	

<?php 
	include_once('footer.php');
?>