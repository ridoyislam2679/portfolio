<?php
	include_once('header.php');
?>

	<!-- Contact Section -->
	<section class="scholarship-section">
		<h1 class="scholarship-title">Scholarship Portal</h1>
		<p class="scholarship-intro">
			Welcome to the Demo University Scholarship Portal. Please log in with your student credentials to apply for or check your scholarship status.
		</p>
	
		<div class="login-box">
			<h2>Student Login</h2>
			<form action="#" method="post">
				<label for="student-id">Student ID</label>
				<input type="text" id="student-id" name="student_id" placeholder="Enter your student ID" required>
		
				<label for="password">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter your password" required>
		
				<button type="submit">Login</button>
		
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