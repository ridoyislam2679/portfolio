<?php
	include_once('header.php');
?>
	<!-- Banner Section -->
	<section class="banner_image">
		<img src="assets/facilities.jpg" alt="University Campus">
	</section>

	<!-- Contact Section -->
	<section class="contact-section">
		<h1 class="contact-title">Contact Demo University</h1>

		<div class="contact-container">
		<!-- Contact Info -->
			<div class="contact-info">
				<h2>Main Contact Information</h2>
				<p><strong>Address:</strong> 123 University Road, City Center, Country</p>
				<p><strong>Phone:</strong> +123 456 7890</p>
				<p><strong>Email:</strong> info@demouniversity.edu</p>
				<p><strong>Office Hours:</strong> Sunday – Thursday | 9:00 AM – 5:00 PM</p>

				<h3>Department Contacts</h3>
				<ul>
				<li><strong>Admission Office:</strong> admission@demouniversity.edu</li>
				<li><strong>Library:</strong> library@demouniversity.edu</li>
				<li><strong>ICT Center:</strong> ict@demouniversity.edu</li>
			</ul>

			<h3>Follow Us</h3>
			<ul class="social-links">
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Twitter</a></li>
				<li><a href="#">LinkedIn</a></li>
			</ul>
			</div>

			<!-- Contact Form -->
			<div class="contact-form">
			<h2>Send Us a Message</h2>
			<form action="#" method="post">
				<input type="text" name="name" placeholder="Your Name" required>
				<input type="email" name="email" placeholder="Your Email" required>
				<textarea name="message" rows="5" placeholder="Your Message" required></textarea>
				<button type="submit">Send Message</button>
			</form>
			</div>
		</div>

		<!-- Google Map Embed -->
		<div class="map-section">
			<h2>Our Location</h2>
			<div class="map-container">
			<iframe 
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8369813857195!2d90.40301217577556!3d23.75090388882685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b88005e481ef%3A0x6f770c1601e7b1be!2sDhaka%20University!5e0!3m2!1sen!2sbd!4v1713261800000!5m2!1sen!2sbd" 
				width="100%" 
				height="350" 
				style="border:0;" 
				allowfullscreen="" 
				loading="lazy" 
				referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</section>


<?php
	include_once('footer.php');
?>