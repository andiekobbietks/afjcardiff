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
                                        <li><a href="news.php">News</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                        <li><a href="testimonials.php">Testimonials</a></li>
                                        <li><a href="jointheteam.php">Join the Team</a></li>
                                        <li class="active"><a href="gallery.php">Gallery</a></li>
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

<section class="site_hero inner-page overlay" style="background-image: url(<?php echo videosbackground($connect); ?>);">
  <div class="container">
    <div class="row site-hero-inner justify-content-center align-items-center">
      <div class="col-md-10 text-center" data-aos="fade">
        <h1 class="heading mb-3">Gallery</h1>
        <ul class="custom-breadcrumbs mb-4">
          <li><a href="index.php">Home</a></li>
          <li>&bullet;</li>
          <li>Gallery</li>
        </ul>
      </div>
    </div>
  </div>
</section>


    <!-- END section -->
<section class="section blog-post-entry bg-light" id="next">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-7">
        <h2 class="heading" data-aos="fade-up">Gallery Content</h2>
      </div>
    </div>
    <div class="col-md-12">
      <!-- Image Gallery Section -->
      <div class="image-gallery-section">
        <h3 class="subheading" data-aos="fade-up" data-aos-delay="200">Image Gallery</h3>
        <div class="image-gallery" data-aos="fade-up" data-aos-delay="200">
          <?php echo galleryimages($connect); ?>
        </div>
      </div>
	  <hr>
      <!-- Video Gallery Section -->
      <div class="video-gallery-section">
        <h3 class="subheading" data-aos="fade-up" data-aos-delay="200">Video Gallery</h3>
        <div class="row" id="video-gallery">
          <?php echo youtubevideo($connect); ?>
        </div> 
		<hr>
		<div class="row" id="video-gallery">
          <?php echo videos($connect); ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Remove the blue line under the heading */
.section.blog-post-entry h2.heading {
  border-bottom: none;
  text-decoration: none;
}

.section.blog-post-entry h2.heading::after {
  content: none;
}

.subheading {
  font-size: 2rem;
  font-weight: 600;
  margin: 20px 0;
}

.image-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 16px;
}

.image-gallery .slide-item {
  position: relative;
  width: 100%;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.image-gallery .slide-item:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.image-gallery .slide-item img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 8px;
}

.image-gallery .slide-item .overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.6);
  color: #fff;
  font-size: 2rem;
  opacity: 0;
  border-radius: 8px;
  transition: opacity 0.3s ease;
}

.image-gallery .slide-item:hover .overlay {
  opacity: 1;
}

#video-gallery iframe {
  width: 100%;
  height: 100%;
  border: none;
  border-radius: 0px;
}

.section {
  padding: 60px 0;
}

.bg-light {
  background-color: #f8f9fa;
}

.heading {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 30px;
  position: relative;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  margin: 5% auto;
  padding: 20px;
  width: 80%;
  max-width: 1200px;
  background-color: #fff;
  border-radius: 8px;
  position: relative; /* Added for positioning buttons */
}

.modal-content img {
  width: 50%;
  height: auto;
  margin-right: 20px;
  border-radius: 8px;
}

.modal-text {
  width: 50%;
  text-align: left;
}

.modal-text h5 {
  margin-bottom: 10px;
  font-size: 1.5rem;
}

.modal-text p {
  font-size: 1rem;
  line-height: 1.5;
}

.close {
  position: absolute;
  top: 10px;
  right: 20px;
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
  z-index: 10; /* Ensure close button is above other elements */
}

.close:hover,
.close:focus {
  color: #000;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById("myModal");
  var modalImage = document.getElementById("modalImage");
  var modalTitle = document.getElementById("modalTitle");
  var modalDescription = document.getElementById("modalDescription");
  var span = document.getElementsByClassName("close")[0];
  var currentIndex = 0;
  var items = document.querySelectorAll('.slide-item');

  function showModal(index) {
    var item = items[index];
    modalImage.src = item.getAttribute('data-image');
    modalTitle.textContent = item.getAttribute('data-title');
    modalDescription.textContent = item.getAttribute('data-description');
    modal.style.display = "block";
  }

  items.forEach((item, index) => {
    item.addEventListener('click', function() {
      currentIndex = index;
      showModal(currentIndex);
    });
  });

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
</script>



<?php

?>


<?php

?>



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