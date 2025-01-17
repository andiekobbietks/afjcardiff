<?php
include('../database_connection.php');
include('../category_details.php');
include('newletter_email.php');
$message = '';
$complete = '';
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AFJCardiff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>

body {
  background: #0D0D0D;
  font-family: "Roboto", arial, sans-serif;
  font-weight: 200;
  font-size: 16px;
  line-height: 1.8;
  color: #fff;
  position: relative;
}


  .site-hero .heading {
    font-family: "Helvetica", times, serif;
    font-weight: bold; }

  .site-hero-inner .heading {
    font-size: 80px;
    font-family: "Helvetica", times, serif;
    color: #fff;
    line-height: 1;
    font-weight: bold; }
	
	
.site_hero_veiw {
  background-size: cover;
  height: 100vh;
  min-height: 700px;
  width: 100%;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.site_hero_veiw .hero-caption {
  margin-top: 20vh; /* Adjust this value as needed */
}

.site_hero_veiw .heading {
  font-family: "Helvetica", times, serif;
  font-weight: bold;
}

.site_hero_veiw .scroll-down {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  color: #fff;
}

.site_hero_veiw.overlay:before {
  background: rgba(0, 0, 0, 0.45);
  content: "";
  position: absolute;
  height: 100vh;
  min-height: 700px;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

@media (max-width: 768px) {
  .site_hero_veiw {
    height: 50vh; /* Reduce height for mobile devices */
    min-height: 300px; /* Minimum height for smaller screens */
  }

  .site_hero_veiw.overlay:before {
    height: 50vh;
    min-height: 300px;
  }

  .site_hero_veiw .heading {
    font-size: 1.5em; /* Adjust font size for smaller screens */
  }

  .btn-outline-white-primary {
    font-size: 0.9em; /* Adjust button font size for smaller screens */
    padding: 0.5em 1em; /* Adjust padding for smaller screens */
  }

  .site_hero_veiw .hero-caption {
    margin-top: 10vh; /* Adjust this value as needed for mobile */
  }
}

	
	
.heading-serif, .heading, .testimonial-section .heading, .slider-section .heading, .blog-post-entry .heading {
  font-size: 60px;
  font-family: "Helvetica", times, serif;
  font-weight: 700; }
  @media (max-width: 991.98px) {
    .heading-serif, .heading, .testimonial-section .heading, .slider-section .heading, .blog-post-entry .heading {
      font-size: 40px; } }

.contact-section .contact-info p {
  font-family: "Helvetica", times, serif;
  font-size: 30px;
  margin-bottom: 30px; }
  
  
  h1, h2, h3, h4, h5 {
  color: #000;
  font-family: "Helvetica", times, serif; }

.font-family-serif {
  font-family: "Helvetica", times, serif; }

.font-family-sans-serif {
  font-family: "Roboto", arial, sans-serif; }


  .site-logo a {
    font-size: 30px;
    color: #fff;
    font-weight: bold;
    line-height: 1;
    font-family: "Helvetica", times, serif; }
    @media (max-width: 991.98px) {
      .site-logo a {
        font-size: 27px; } }
		
		
		    .site-navbar nav .menu {
      font-family: "Helvetica", times, serif; }

.video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.video-container video {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
}

.text-uppercase {
  text-transform: uppercase !important;

  }

.bg-light {
  background: linear-gradient(to bottom, #D99543, rgba(191, 59, 94, 0.8)) !important;
}

#top {  
    position: fixed;  
    bottom: 50px;  
    right: 0px;  
    display: none;  
    width: 70px;
    height: 70px;
    font-size: 20px;
    border-radius: 50%;
	color: black;
    background: linear-gradient(to top, #D99543, rgba(191, 59, 94, 0.8));
    z-index: 9999;
}
.logo-img {
    width: 100px;
    height: auto;
    border-radius: 50%;
}

    .card {
        background-color: #808080; /* Grey color */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .heading {
        color: white;
        margin-bottom: 20px;
    }
	
	
	.transparent-bg {
    background-color: rgba(0, 0, 0, 0.5); /* Black background with 50% opacity */
}

.site-header {
  position: fixed;
  top: 0;
  width: 100%;
  padding: 60px 0;
  z-index: 2;
  -webkit-transition: .3s all ease-in-out;
  -o-transition: .3s all ease-in-out;
  transition: .3s all ease-in-out; }
  .site-header.scrolled {
    padding: 20px 0;
    background: #000;
    -webkit-box-shadow: 0 5px 20px -5px rgba(0, 0, 0, 0.1);
    box-shadow: 0 5px 20px -5px rgba(0, 0, 0, 0.1); }
    .site-header.scrolled .site-menu-toggle {
      top: 10px;
      position: relative; }
      .site-header.scrolled .site-menu-toggle span {
        background: #fff; }
    .site-header.scrolled .site-logo {
      position: relative;
      z-index: 100; }
      .site-header.scrolled .site-logo a {
        color: #fff; }
		
		
.slide-item {
    position: relative;
    display: inline-block; /* or another display value based on your layout needs */
}

.text-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
	background: linear-gradient(to bottom, #BF584E, rgba(217, 126, 74, 0.8));
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

.img-fluid {
    width: 100%;
    height: auto;
}

/* Add this to your custom CSS file */

@media (max-width: 576px) {
    .media media-custom {
        font-size: 14px;
        line-height: 1.5;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .media media-custom {
        font-size: 16px;
        line-height: 1.6;
    }
}

@media (min-width: 769px) {
    .media media-custom {
        font-size: 18px;
        line-height: 1.8;
    }
}

.media-custom .mb-4 {
	height: 200px; /* Set your desired height */
	overflow: hidden; /* Hide overflow content */
	display: flex; /* Use flexbox for centering */
	align-items: center; /* Vertically center content */
	justify-content: center; /* Horizontally center content */
}


    .site_herobook1to1.overlaybook1to1::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
        z-index: 1;
    }
    
    .site_herobook1to1 {
        position: relative;
        z-index: 2;
    }
    
    .site_herobook1to1 h2 {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Optional: adds shadow to text for better readability */
    }
    
    .btn-outline-white-primary {
        border: 2px solid white;
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }
    
    .btn-outline-white-primary:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }


.button-link {
    display: inline-block; /* Ensure the link behaves like a button */
    background-color: black; /* Black background */
    color: white; /* White text */
    text-decoration: none; /* Remove underline from the link */
    padding: 15px 30px; /* Add padding for size */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
}

.button-link h2 {
    margin: 0; /* Remove default margin from heading */
}

/* Fading effect on hover */
.button-link:hover {
    background: linear-gradient(to top, #D99543, rgba(191, 59, 94, 0.8));
    color: black; /* Change text color to black on hover */
}
	</style>
<body>

<header class="site-header js-site-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6 col-lg-4 site-logo" data-aos="fade">
			<a href="index.php"><?php echo afjcardifflogonav($connect); ?></a></div>
            <div class="col-6 col-lg-8">

                <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <!-- END menu-toggle -->
				
                <div class="site-navbar js-site-navbar" style="margin-top: 49px;">
				<br/>
                    <nav role="navigation">
                        <div class="container">
                            <div class="row full-height align-items-center">
                                <div class="col-md-6 mx-auto">
                                    <ul class="list-unstyled menu">
                                        <li class="active"><a href="index.php">Home</a></li>
                                        <li><a href="classes.php">Classes</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="news.php">News</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                        <li><a href="testimonials.php">Testimonials</a></li>
                                        <li><a href="jointheteam.php">Join the Team</a></li>
                                        <li><a href="gallery.php">Gallery</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="site-hero overlay" data-stellar-background-ratio="0.5">
    <div class="video-container">
        <?php echo video($connect); ?>
    </div>
<div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
                <h2><span class="custom-caption text-uppercase text-white d-block mb-3"><span class="fa fa-star text-primary"></span>
				Impact through dance and culture <span class="fa fa-star text-primary"></span></span></h2>
                <h1 class="heading">Home</h1>
            </div>
        </div>
    </div>
</section>

        </div>
    </div>
</div>
</section>


    <!-- END section -->
<button type="button" id="top"><i class="fa fa-arrow-up"></i></button>

  
    <section class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
            <figure class="img-absolute">
			<?php echo afjcardifflogo($connect); ?>
            </figure>
			<?php echo upcomingevent($connect); ?></div>
          <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
           
			<?php echo afjcardiffIntroduction($connect); ?></div>
        </div>
      </div>
    </section>  

	<section class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
         
		
      <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
        <?php echo homepageclassesgallery($connect); ?>
      </div>
			
			</div>
          <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
           
			<?php echo classoffersdetails($connect); ?>
			
			</div>
        </div>
      </div>
    </section>
    
	
    <section class="site_hero section overlay" style="background-image: url(<?php echo jointheteam_hompage_background($connect); ?>)">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading text-white" data-aos="fade">Join The Team</h2>
          </div>
        </div>
        <div class="classdetails-menu-tabs" data-aos="fade">
          <div class="tab-content py-5" id="myTabContent">
            
            
            <div class="tab-pane fade show active text-center site_hero overlay" id="classeprices" role="tabpanel" aria-labelledby="classeprices-tab">
              <div class="row">
            	<?php echo jointypehomepage($connect); ?>
              </div>
              

            </div> <!-- .tab-pane -->
          </div>
        </div>
      </div>
    </section>
	
	
    <section class="section blog-post-entry bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up"><?php echo featurednewstitle($connect); ?></h2>
			<?php echo featurednewsdescription($connect); ?>
          </div>
        </div>
        <div class="row">
     <?php echo newsevents($connect); ?>
        </div>
      </div>
    </section>
	
<section class="section blog-post-entry bg-light" id="next">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
<div class="col-md-7">
    <a href="gallery.php" class="button-link">
        <h2 class="heading" data-aos="fade-up">Gallery</h2>
    </a>
</div>

    </div>
    <div class="col-md-12">
      <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
        <?php echo homepagegallery($connect); ?>
      </div>
        <div class="row">
		<?php echo youtubevideohome($connect); ?>
        </div>
      <!-- Centering the button -->
      <div class="text-center">
        <a href="gallery.php"><button class="btn btn-outline-white-primary text-black" data-aos="fade-up">View More</button></a>
      </div>
    </div>
  </div>
</section>


    
    <!-- END section -->
    <section class="section testimonial-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up" style="color: white;">Testimonials</h2>
          </div>
        </div>
        <div class="row">
           <?php echo reviewdetails($connect); ?>
            <!-- END slider -->
        </div>

      </div>
    </section>
    
<!-- Hero Section with Overlay -->
<section class="site_hero_veiw section overlay" style="background-image: url('<?php echo book1to1($connect); ?>');">
  <div class="row align-items-center justify-content-center">
    <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left hero-caption" data-aos="fade-up">
      <h2 class="text-white font-weight-bold"><?php echo book1to1caption($connect); ?></h2>
    </div>
    <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
      <a href="../classsession/index.php" class="btn btn-outline-white-primary py-3 text-white px-5">Book Now</a>
    </div>
  </div>
</section>


 <?php include('footerpage.php'); ?>
 
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    
    <script src="js/aos.js"></script>
    
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="js/jquery.timepicker.min.js"></script> 

    <script src="js/main.js"></script>
    <script>    $(document).ready(function() {
        $('#newsletterForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                firstname: "required",
                lastname: "required"
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                }
            },
            success: function(label, element) {
                // Add success class to the parent form-group
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        });
    });
	
	/*this code is for scrollTop function */
$(document).ready(function(){  
    $('a[href^="#"]').not('[href="#workshops"]').not('[href="#classeprices"]').not('[href="#EventHires"]').not('[href="#top"]').on('click', function(e){  
         e.preventDefault();  
         var target = this.hash;  
         var $target = $(target);  
         $('html, body').animate({  
              'scrollTop':$target.offset().top  
         }, 1000, 'swing');  
    });  
});  
$(function(){  
    $(window).scroll(function(){  
         if($(this).scrollTop() != 0)  
         {  
              $('#top').fadeIn();  
         }  
         else  
         {  
              $('#top').fadeOut();  
         }  
    });  
    $('#top').click(function(){  
         $('body,html').animate({scrollTop:0},500);  
    });  
});

</script> 
  </body>
</html>