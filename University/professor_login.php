<?php
	include_once('header.php');
	include_once('db/index.php');
	
	if(isset($_POST['login_btn'])){
		$name = $_POST['professor_name'];
		$pass = $_POST['password'];
		 
		$sql = "SELECT professor_pass FROM professor_login WHERE professor_name = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$name]);
		$row = $stmt->fetch();
		
		if($row){			
			$password = $row['professor_pass'];
			
			if($password === $pass){
				header('location:professor/index.php');
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
			<h2>Professor Login</h2>
			<form action="#" method="post">
				<label for="professor-id">Professor ID</label>
				<input type="text" id="professor-id" name="professor_name" placeholder="Enter your Professor name" required>
		
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