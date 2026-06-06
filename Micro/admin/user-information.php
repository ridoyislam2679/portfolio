<?php 
	include_once('../db/index.php');
	include_once('header.php');	
	include_once('sidebar.php');
	
	$stmt = $pdo->prepare("SELECT referral_code FROM users");
	$stmt->execute();
?>
   
    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="h3 mb-0 font-weight-bold text-primary">Get User Details</h3>
            </div>

			<form class="form-inline" method="POST">					
				<input class="form-control mr-sm-2" name="user_id" type="search" placeholder="Search" aria-label="Search" name="query" list="browsers">
				
				<datalist id="browsers">
					<?php 
						while($user = $stmt->fetch()){
							echo "<option value='". $user['referral_code'] ."'>";
						}
					?>
				</datalist>
				<button class="btn btn-success mt-2" type="submit" name="search_button">Search</button>			  
			</form>
			
			<?php 
				if(isset($_POST['search_button'])){
					$reffer = $_POST['user_id'];
					
					if($reffer){
						$stmt = $pdo->prepare("SELECT id, username, referral_code, active_status FROM users WHERE referral_code = ?");
						$stmt->execute([$reffer]);
						$user = $stmt->fetch();						
						if($user){
							$user_id = $user['id'];
							include('user-details.php');
							include('blance-update.php');
							
						}else{
							echo "<h3 class='mt-2 text-danger'> User Not Found </h3>";
						}
					}else{
						echo "<h3 class='mt-2 text-danger'> Please Put Valid User Id </h3>";
					}	
				}
			?>	
			<?php 
				if(isset($_POST['update_blance'])){
					$userId       = $_POST['userId'];
					$userEmail    = $_POST['userEmail'];
					
					$total_blance = $_POST['total_blance'];
					$main_blance  = $_POST['main_blance'];
					$total_coin   = $_POST['total_coin'];
					$rit_coin     = $_POST['rit_coin'];
					$free_spain   = $_POST['free_spain'];
					
					$stmt = $pdo->prepare("SELECT * FROM users WHERE referral_code = ? AND email = ?");
					$stmt->execute([$userId, $userEmail]);
					$user = $stmt->fetch();
					
					if($total_blance && $main_blance && $total_coin && $rit_coin && $free_spain){
						if($user){
						    $user_id = (int) $user['id'];
						    
							$update = "UPDATE blance SET total_earning = ?, main_blance = ?, total_coin = ?, rit_coin = ?, free_spain = ? WHERE user_id = ?";
							$updateQuery = $pdo->prepare($update);
							$updateQuery->execute([$total_blance, $main_blance, $total_coin, $rit_coin, $free_spain, $user_id]);
							
							echo '<div class="alert alert-success mt-3" style="color: red;">User Blance Update successfully.</div>';	
						}else{
							echo '<div class="alert alert-success mt-3" style="color: red;">User Not Found.</div>';	
						}
					}else{
						echo '<div class="alert alert-success mt-3" style="color: red;">Plese Provide Correct Information.</div>';	
					}
				}						
			?>
        </div>
    </main>
	
        
   
<?php 
	include_once('footer.php');
?>