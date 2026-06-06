<?php
	include_once('header.php');
	include_once('db/index.php');
	
	if(isset($_POST['login_btn'])){
		$name = $_POST['administrator_name'];
		$pass = $_POST['password'];
		 
		$sql = "SELECT administrator_pass FROM administrator_login WHERE administrator_name = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$name]);
		$row = $stmt->fetch();
		
		if($row){			
			$password = $row['administrator_pass'];
			
			if($password === $pass){
				header('location:administrator/index.php');
			}else{
				echo "<h2 style='text-align:center; color: red; font-size: 40px;'> Password Invalid! </h2>";
			}
		}
		else{
			echo "<h2 style='text-align:center; color: red; font-size: 40px;'> User Not Found </h2>";
		}
	}
?>

	<!-- Contact Section -->
	<section class="scholarship-section">
		<div class="login-box">
			<h2>Administrator Login</h2>
			<form action="#" method="post">
				<label for="administrator-id">Administrator ID</label>
				<input type="text" id="administrator-id" name="administrator_name" placeholder="Enter your administrator name" required>
		
				<label for="password">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter your password" required>
		
				<button type="submit" name="login_btn">Login</button>
		
				<div class="form-footer">
					<a href="#">Forgot Password?</a> |
					<a href="#">Create New Account</a>
				</div>
			</form>
		</div>
	</section>

<?php
	include_once('footer.php');
?>