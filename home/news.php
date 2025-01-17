<?php
include('../database_connection.php');
include('../category_details.php');
include('newletter_email.php');

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
  <body>
  <style>
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
  </style>
    
    <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="index.php">
			<?php echo afjcardifflogonav($connect); ?></a></div>
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
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="classes.php">Classes</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li class="active"><a href="news.php">News</a></li>
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
    <!-- END head -->

    <section class="site_hero inner-page overlay" style="background-image: url(<?php echo newsbackground($connect); ?>);">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">News</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.php">Home</a></li>
              <li>&bullet;</li>
              <li>News</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="section blog-post-entry bg-light" id="next">
      <div class="container">
        <div class="row">
		<?php echo eventspage($connect); ?>
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
    <script src="js/aos.js"></script>
    <script src="js/bootstrap-datepicker.js"></script> 
    <script src="js/jquery.timepicker.min.js"></script> 
    <script src="js/main.js"></script>
	
<script>
	/*this code is for scrollTop function */
$(document).ready(function(){  
	$('a[href^="#"]').on('click', function(e){  
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