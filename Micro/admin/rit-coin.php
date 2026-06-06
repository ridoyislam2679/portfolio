<?php 
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
                <h1 class="h3 mb-0 text-gray-800">Get Rit Coin Information</h1>
            </div>

            <!-- Add Task Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rit Coin Price</h6>
                </div>
                <div class="card-body">
                    <form id="taskForm" method="POST">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="taskTitle" class="form-label">Price *</label>
                                    <input type="number" name="price" class="form-control" id="taskTitle" placeholder="Enter Rit Price" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" name="rit_price" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Price
                            </button>
                        </div>
                    </form>
					<?php 
						if(isset($_POST['rit_price'])){
							$price = $_POST['price'];
							
							$sql = "INSERT INTO rit_coin(rit_coin_price) VALUES (?)";
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$price]);
							
							echo '<div class="alert alert-success mt-3" style="color: red;">Set Rit Coin Price Successfull.</div>';							
						}
					?>					
                </div>
            </div>
        </div>
    </main>

<?php 
	include_once('footer.php');
?>