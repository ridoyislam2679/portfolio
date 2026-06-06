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
                <h1 class="h3 mb-0 text-gray-800">Add New News</h1>
            </div>

            <!-- Add Task Form -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">News Information</h6>
                </div>
                <div class="card-body">
                    <form id="taskForm" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskTitle" class="form-label">News Title *</label>
                                    <input type="text" name="title" class="form-control" id="taskTitle" placeholder="Enter news title" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="taskDescription" class="form-label">News Description *</label>
                            <textarea class="form-control" name="dsc" id="taskDescription" rows="4" placeholder="Enter detailed news description" required></textarea>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="taskImage" class="form-label">News Image</label>
                            <input type="file" name="image" class="form-control" id="taskImage" accept="image/*">
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" name="add_news" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save News
                            </button>
                        </div>
                    </form>
					<?php 
						if(isset($_POST['add_news'])){
							$title   = $_POST['title'];
							$dsc   = $_POST['dsc'];
							
							$image = $_FILES['image']['name'];
							$destination = "task/".$image;
							
							$sql = "INSERT INTO news(news_title, news_dsc, news_image) VALUES (?, ?, ?)";
							$stmt = $pdo->prepare($sql);
							$stmt->execute([$title, $dsc, $image]);
							move_uploaded_file($_FILES['image']['tmp_name'], $destination);
							
							echo '<div class="alert alert-success mt-3" style="color: red;">Add new News successfully.</div>';				
						}						
					?>
                </div>
            </div>
        </div>
    </main>
	

<?php 
	include_once('footer.php');
?>