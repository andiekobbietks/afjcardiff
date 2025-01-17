<?php
include('../database_connection.php');
include('../category_details.php');
include('newletter_email.php');
include('class_sessionemail.php');
$message = '';
$complete = '';

$query = "SELECT DISTINCT class_id, class_title, code_basedtitle FROM classes 
WHERE code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event'
ORDER BY class_id DESC";
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

// Receive registration inputs
if(isset($_POST["submit_inquiry"])) {
    $email = trim($_POST["email"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $class_title = trim($_POST["class_title"]);
    $class_type = trim($_POST["class_type"]);
    $start_datetime = trim($_POST["start_datetime"]);
    $end_datetime = trim($_POST["end_datetime"]);
    $phone_number = trim($_POST["phone_number"]);
    $message = trim($_POST["message"]);

$statement = $connect->prepare($query);

if($statement->execute($data)) {
    $complete = '<label class="text-success">Form is complete. Please check your email and Junk box mail.</label>';

    // Send verification email
	$subject = "Dance Classes";
	$adminsubject = "Contact Inquiry";
	$message_body = "<p>Hi $firstname,</p><p>Thanks for Selecting the $class_title class.</p><p>Your class type is:</p><p>$class_type</p><p>The start date is:</p><p>$start_datetime</p><p>End date is:</p><p>$end_datetime</p><p>We look forward to see you soon!</p><p>Kind Regards,<br />AFJCardiff
	</p>";
	$adminmessage_body = "<p>The person is: $firstname $lastname.</p><p>Their Hire Order ID is ".$contact_id." and their inquiry is: ".$inquiry."";

}
        // Send email using SMTP.js
        echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
        echo '<script>
					Email.send({
				    Host : "smtp.elasticemail.com",
					Username : "deziremambule@outlook.com",
					Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
				    To : "'.$email.'",
                    From : "deziremambule@outlook.com",
                    Subject : "'.$subject.'",
                    Body : "'.$message_body.'",
                    Secure: "tls",
                    Port: 587
                }).then(function(messagebox) {
                    alert("Email sent successfully!");
                });
            </script>';    

			// Send email to admin
        echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
        echo '<script>
					Email.send({
				    Host : "smtp.elasticemail.com",
					Username : "deziremambule@outlook.com",
					Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
				    To : "deziremambule@outlook.com",
                    From : "deziremambule@outlook.com",
                    Subject : "'.$adminsubject.'",
                    Body : "'.$adminmessage_body.'",
                    Secure: "tls",
                    Port: 587
                }).then(function(messagebox) {
                    alert("Please check your email and junk box!");
                });
            </script>';
        }
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
 .classdetails-info {
  color: #fff; 
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

  </style>
  <body>
    
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
                                        <li class="active"><a href="classes.php">Classes</a></li>
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
    <!-- END head -->
<section class="site_hero inner-page overlay" style="background-image: url('<?php echo classesbackground($connect); ?>');">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Classes</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.php">Home</a></li>
              <li>&bullet;</li>
              <li>Classes</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
<!-- END section --> 

    
    <section class="section">
      <div class="container">
        <div class="row">
<?php echo classespage($connect); ?>

        </div>
      </div>
    </section>
	
	    <section class="site_hero section bg-image overlay" style="background-image: url(<?php echo payments($connect); ?>);
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 300px;">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading text-white" data-aos="fade">Prices & Payments</h2>
          </div>
        </div>
        <div class="classdetails-menu-tabs" data-aos="fade">
          <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active letter-spacing-2" id="classeprices-tab" data-toggle="tab" href="#classeprices" role="tab" aria-controls="classeprices" aria-selected="true">Classes & 1 2 1s</a>
            </li>
            <li class="nav-item">
              <a class="nav-link letter-spacing-2" id="workshops-tab" data-toggle="tab" href="#workshops" role="tab" aria-controls="workshops" aria-selected="false">Workshops</a>
            </li>
            <li class="nav-item">
              <a class="nav-link letter-spacing-2" id="EventHires-tab" data-toggle="tab" href="#EventHires" role="tab" aria-controls="EventHires" aria-selected="false">Events & Hiring Dancers</a>
            </li>
          </ul>
          <div class="tab-content py-5" id="myTabContent">
            
            
            <div class="tab-pane fade show active text-left" id="classeprices" role="tabpanel" aria-labelledby="classeprices-tab">
              <div class="row">
            	<?php echo classprices($connect); ?>
              </div>
              

            </div> <!-- .tab-pane -->

            <div class="tab-pane fade text-left" id="workshops" role="tabpanel" aria-labelledby="workshops-tab">
              <div class="row">
            	<?php echo workshopprices($connect); ?>
                </div>
              </div>
			  
            <div class="tab-pane fade text-left" id="EventHires" role="tabpanel" aria-labelledby="EventHires-tab">
              <div class="row">
            	<?php echo events_hiringdancers_prices($connect); ?>
              </div>
            </div> <!-- .tab-pane -->
          </div>
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