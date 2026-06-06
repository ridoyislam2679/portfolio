<?php
	include_once('header.php');
	include_once('db/index.php');
	
	if(isset($_POST['login_btn'])){
		$name = $_POST['student_name'];
		$pass = $_POST['password'];
		 
		$sql = "SELECT student_pass FROM student_login WHERE student_name = ?";
		$stmt = $connection->prepare($sql);
		$stmt->execute([$name]);
		$row = $stmt->fetch();
		
		/* jehetu register from kora hoi ni tai password hash use kora hoi ni 
		if($row){			
			$password = $row['student_pass'];
			echo $password;
			if(password_verify($pass, $password)){
				echo "okay";
			}else{
				echo "pass no";
			}
		}
		else{
			echo "User Not Found";
		}
		*/
		if($row){			
			$password = $row['student_pass'];
			
			if($password === $pass){
				header('location:student/index.php');
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
			<h2>Student Login</h2>
			<form action="#" method="post">
				<label for="student-id">Student ID</label>
				<input type="text" id="student-id" name="student_name" placeholder="Enter your student name" required>
		
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