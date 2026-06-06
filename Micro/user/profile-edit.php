<?php
    session_start();
    ob_start();
	include_once('header.php');
	include_once('../db/index.php');
	

	if (!isset($_SESSION['user_id'])) {
		header('Location: ../login.php');
		exit();
	}

	$user_id = $_SESSION['user_id'];
	//$user_id = 1;
	// Get user data
	$stmt = $pdo->prepare("SELECT username, email, password ,image FROM users WHERE id = ?");
	$stmt->execute([$user_id]);
	$user = $stmt->fetch();
	
	if(isset($_POST['update_profile'])){
	    
		$image = $_FILES['image']['name'];
		$destination = "assets/".$image;
		
		//$update = "UPDATE users set username = ?, email = ?, password = ?, image= ?";
		//move_uploaded_file($_FILES['image']['tmp_name'], $destination);
		if($image){
			try{
				$update = "UPDATE users set image= ? WHERE id = ?";
				$updateQuery = $pdo->prepare($update);
				$updateQuery ->execute([$image, $user_id]);
				move_uploaded_file($_FILES['image']['tmp_name'], $destination);
				
				header("Location: ".$_SERVER['PHP_SELF']);
				exit();	
			}catch(PDOException $e){
			    echo "<div style='color: red;'>Update failed: " . $e->getMessage() . "</div>";
			}	
		}else{
			echo '<span id="copyMsg" style="color: red;">Password Provide Valid input!</span>';
		}
		
	}
	
	
?>    
    <!-- Main Content -->
    <div class="profile-container p-4 mb-0">
        <div class="profile-card">
            <div class="profile-header">
                <h1><i class="fas fa-user-edit me-2"></i> Edit Profile</h1>
                <p>Update your personal information</p>
            </div>
            
            <form id="profileForm" method="POST" enctype='multipart/form-data'>
                <!-- Profile Image -->
                <div class="profile-image-container">
                    <img src="assets/<?php echo $user['image']; ?>" class="profile-image" id="profileImage">
				</div>
              
				<!-- Image -->
                <div class="form-group">
                    <label for="Image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="Image">
                </div>
                
                
                <!-- Buttons -->
                <div class="d-flex justify-content-center mt-4">
                    <button type="button" class="btn btn-danger btn-cancel">
                        <i class="fas fa-times me-2"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success btn-save" name="update_profile">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
 <?php
	include_once('footer.php');
?>