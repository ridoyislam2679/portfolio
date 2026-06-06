<?php 
	include_once('header.php');
?>
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Contact Mobile Review BD</h1>
            <p class="lead">We're here to help with all your mobile needs</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-section">
        <div class="container">
            <!-- Google Map -->
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d41160.21016164895!2d89.02142738515033!3d24.238876864307837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fc19480ab9e8f1%3A0xb81c6954c89f1ccb!2sWalia%20Bazar!5e0!3m2!1sen!2sbd!4v1759120400102!5m2!1sen!2sbd" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            
            <div class="row">
                <div class="col-md-6 contact-area">
                    <h2>Our Location</h2>
                    <p><i class="fas fa-map-marker-alt"></i> Waliya Bazar, Lalpur, Natore, Bangladesh</p>
                    <p><i class="fas fa-phone"></i> +880 1763 029679</p>
                    <p><i class="fas fa-envelope"></i> mobilebareviewbd247@gmail.com</p>
                    <p><i class="fas fa-clock"></i> Contact Time: 9:00 AM - 10:00 PM (Everyday)</p>
                    
                    <h3 class="mt-4">Connect With Us</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/hridoy42679" class="social-link"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/hridoy42679/" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="https://web.whatsapp.com/" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Send Us a Message</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="userName" class="form-control" placeholder="Your Name"  autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" autocomplete="off" name="userEmail" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="userNumber" autocomplete="off" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" autocomplete="off" name="userMsg" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" name="msgSubmit" class="btn btn-primary">Send Message</button>
                    </form>
					<?php 
						if(isset($_POST['msgSubmit'])){
							$name   = $_POST['userName'];
							$email  = $_POST['userEmail'];
							$number = $_POST['userNumber'];
							$msg    = $_POST['userMsg'];
							
							if($name && $email && $number && $msg){
								$sql = "INSERT INTO conatct(user_name, user_email, user_number, user_msg) VALUES (?,?,?,?)";
								$stmt = $pdo->prepare($sql);
								$stmt->execute([$name, $email, $number, $msg]);
								echo "<h5 class='no-found'> submit your messege please wait few time i will contact with you! </h5>";
							}else{
								echo "<h5 class='no-found'>please submit properly <h5>";
							}								
						}
					?>
                </div>
            </div>
            
            <!-- Team Members -->
            <h2 class="text-center mt-5 mb-4">Our Team</h2>
            <div class="row">
                <!-- Member 1 -->
                <div class="col-6 col-md-3">
                    <div class="team-card">
                        <img src="images/hridoy_islam.jpg" alt="Team Member" class="team-img">
                        <h4>Md Hridoy Islam</h4>
                        <p class="text-muted">MANAGING DIRECTOR & CEO</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#member1Modal">
                            Contact Md Hridoy
                        </button>
                    </div>
                </div>
                
                <!-- Member 2 -->
                <div class="col-6 col-md-3">
                    <div class="team-card">
                        <img src="images/asmaul_khan.jpg" alt="Team Member" class="team-img">
                        <h4>Md Asmaul Khan</h4>
                        <p class="text-muted">Prdouct Manager</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#member2Modal">
                            Contact Asmaul
                        </button>
                    </div>
                </div>
                
                <!-- Member 3 -->
                <div class="col-6 col-md-3">
                    <div class="team-card">
                        <img src="images/mehedi_hasan_mithu.jpg" alt="Team Member" class="team-img">
                        <h4>Md Mehedi Hasan Mithu</h4>
                        <p class="text-muted">Support Specialist</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#member3Modal">
                            Contact Mehedi
                        </button>
                    </div>
                </div>
				
				<!-- Member 4 -->
                <div class="col-6 col-md-3">
                    <div class="team-card">
                        <img src="images/jahudul_islam.jpg" alt="Team Member" class="team-img">
                        <h4>Jahidul Islam</h4>
                        <p class="text-muted">YouTube Specialist</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#member4Modal">
                            Contact Mehedi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Member 1 Modal -->
    <div class="modal fade" id="member1Modal" tabindex="-1" aria-labelledby="member1ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="member1ModalLabel">Contact Md Hridoy Islam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info">
						<img src="images/hridoy_islam.jpg" class="modal-image">
						<p>
							Hi, I am Hridoy Islam, am proudly associated with **Mobile Review BD** as the CEO and Managing Director.My vision is to transform Mobile Review BD into one of the **top mobile review platforms in Bangladesh**. Our mission is to deliver **accurate and reliable information** in the simplest way possible, helping people make smarter decisions when buying mobile phones.
						</p>
                        <p><i class="fas fa-map-marker-alt"></i> Waliya Bazar, Lalpur, Natore</p>
                        <p><i class="fas fa-phone"></i> +880 1763 029679</p>
                        <p><i class="fab fa-whatsapp"></i> +880 189 3331426</p>
                        <p><a href="https://www.facebook.com/hridoy42679"> <i class="fab fa-facebook"></i> facebook </p></a>
                        <p><a href="https://www.instagram.com/hridoy42679/"> <i class="fab fa-instagram"></i> instagram</p></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Member 2 Modal -->
    <div class="modal fade" id="member2Modal" tabindex="-1" aria-labelledby="member2ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="member2ModalLabel">Contact Asmaul </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info">
						<img src="images/asmaul_khan.jpg" class="modal-image">
						<p>I am Asmaul Khan, a student at the University of Frontier Technology, Bangladesh, and an SEO Content Specialist at MobileReviewBD. I create and manage content to help mobile users get correct information and make smart choices. I believe technology is not just about devices, it helps people make informed decisions.</p>
                        <p><i class="fas fa-map-marker-alt"></i> Waliya Bazar, Lalpur, Natore</p>
                        <p><i class="fas fa-phone"></i> +880 17* *******</p>
                        <p><i class="fab fa-whatsapp"></i> +880 17* *******</p>
						<p><a href="https://www.facebook.com/md.asmaul.khan.675612"> <i class="fab fa-facebook"></i> facebook </p></a>
                        <p><a href="https://bd.linkedin.com/in/md-asmaul-khan-a3a59a232?trk=people-guest_people_search-card"> <i class="fab fa-instagram"></i> linkedin</p></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Member 3 Modal -->
    <div class="modal fade" id="member3Modal" tabindex="-1" aria-labelledby="member3ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="member3ModalLabel">Contact Mehedi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info">
						<img src="images/mehedi_hasan_mithu.jpg" class="modal-image">
						<p>I am Mehedi Hasan Mithu, a skilled Support Specialist at MobileReviewBD. i am excels at providing quick solutions to user issues and ensuring seamless service. I am active in teamwork and provide professional support. I continuously work on improving service quality by quickly learning new tools and technologies.</p>
                        <p><i class="fas fa-map-marker-alt"></i> Waliya Bazar, Lalpur, Natore</p>
                        <p><i class="fas fa-phone"></i> +880 17* *******</p>
                        <p><i class="fab fa-whatsapp"></i> +880 17* *******</p>
						<p><a href="https://www.facebook.com/md.mehedi.hasan.mithu.892225"> <i class="fab fa-facebook"></i> facebook </p></a>
                        <p><a href="https://www.instagram.com/md_mehedi_hasan_mithu"> <i class="fab fa-instagram"></i> instagram</p></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Member 4 Modal -->
    <div class="modal fade" id="member4Modal" tabindex="-1" aria-labelledby="member4ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="member4ModalLabel">Contact Jahidul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info">
						<img src="images/jahudul_islam.jpg" class="modal-image">
						<p> 
							I’m Jahidul Islam, and I’ve been working on the YouTube platform for the past year. Currently, I’m a YouTube Specialist at MobileReviewBD, where I focus on channel content optimization, video SEO, audience engagement, and performance analytics.
							<ul>
								<li>I regularly research YouTube algorithms, content reach, and viewer retention strategies. </li>
								<li>I contribute to the channel’s growth by improving video titles, thumbnails, and keyword rankings.</li>
								<li>My goal is to bring technology-based content to a wider audience and help make MobileReviewBD one of the leading tech channels in Bangladesh.</li>
							</ul>
						</p>
						</pre>
                        <p><i class="fas fa-map-marker-alt"></i> Waliya Bazar, Lalpur, Natore</p>
                        <p><i class="fas fa-phone"></i> +880 17* *******</p>
                        <p><i class="fab fa-whatsapp"></i> +880 17* *******</p>
						<p><a href="https://www.facebook.com/jahidul.islam.598407"> <i class="fab fa-facebook"></i> facebook </p></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
<?php 
	include_once('footer.php');
?>