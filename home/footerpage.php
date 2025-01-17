<style>
 .site_hero {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 300px; /* Default for smaller screens */
  }

  @media (min-width: 576px) {
    .site-hero {
      min-height: 400px; /* For small screens (e.g., larger mobile devices) */
    }
  }

  @media (min-width: 768px) {
    .site-hero {
      min-height: 500px; /* For medium screens (e.g., tablets) */
    }
  }

  @media (min-width: 992px) {
    .site-hero {
      min-height: 600px; /* For large screens (e.g., laptops) */
    }
  }

  @media (min-width: 1200px) {
    .site-hero {
      min-height: 700px; /* For extra-large screens (e.g., desktops) */
    }
  }
</style>

<button type="button" id="top"><i class="fa fa-arrow-up"></i></button>

<footer class="section footer-section">
      <div class="container">
        <div class="row mb-4">	
          <div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
              <li><a href="about.php">About Us</a></li>
              <li><a href="#">Terms &amp; Conditions</a></li>
              <li><a href="#">Privacy Policy</a></li>
             <li><a href="classes.php">Classes</a></li>
            </ul>
          </div>     
		  <div class="col-md-3 mb-5">
            <ul class="list-unstyled link">
             <li><a href="jointheteam.php">Join Us</a></li>
             <li><a href="testimonials.php">Testimonials</a></li>
             <li><a href="gallery.php">Watch Us</a></li>
            </ul>
          </div>
         
          <div class="col-md-3">
            <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 435 3533</span></p>
            <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span>admin@afjcardiff.com</span></p>
			</div>
          <div class="col-md-3 mb-5">
            <p>Sign up for our Newsletter</p>
  
            <form method="post" class="footer-newsletter">
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                    <div id="emailSuccess" class="valid-feedback">Valid email address!</div>
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required />
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required />
                </div>
                <div class="form-group">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required />
                </div>
                <div class="form-group">
                <button type="submit" name="sent_emails" class="btn"><span class="fa fa-paper-plane"></span></button>
                </div>
            </form>
          </div>
        </div>
		<div class="row">
			 <div class="col-md-6" align="center">
            <p><span class=""><span class="ion-ios-location h5 mr-3 text-primary"></span>Main Dance Studio Address:</span> <span> 
			<?php echo maindancestudio($connect); ?></span></p>
		</div>
			 <div class="col-md-6" align="center">
            <p><span class=""><span class="ion-ios-location h5 mr-3 text-primary"></span>J1 Studio Address:</span> <span> 
			<?php echo seconddancestudio($connect); ?></span></p>
		</div>
		</div>
        <div class="row pt-5">
          <p class="col-md-6 text-left">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
			<a href="index.php" >AFJCardiff</a>
          </p>
            
          <p class="col-md-6 text-right social">
            <a href="https://www.facebook.com/afrojamdancesociety"><span class="fa fa-facebook" style="color:#BF3B5E;"></span></a>
            <a href="https://www.instagram.com/afj_cardiff?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><span class="fa fa-instagram" style="color:#BF3B5E;"></span></a>
            <a href="https://www.tiktok.com/@afjcardiff"><span style="color:#BF3B5E;"><?php echo tiktok($connect); ?></span></a>
            <a href="https://youtube.com/@afjcardiff?si=_UuAneH_O7QvsukI"><span class="fa fa-youtube" style="color:#BF3B5E;"></span></a>
			<a href="https://www.linkedin.com/company/afj-cardiff-afro-jam-cardiff">
			<span style="color:#BF3B5E;"><?php echo linkedin($connect); ?></span></a>

          </p>
        </div>
      </div>
    </footer>

    