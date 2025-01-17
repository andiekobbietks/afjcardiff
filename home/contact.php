<?php
include('../database_connection.php');
include('../category_details.php');
include('newletter_email.php');
$message = '';
$complete = '';

// Receive registration inputs
if(isset($_POST["submit_inquiry"])) {
    $email = trim($_POST["email"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $phone_number = trim($_POST["phone_number"]);
    $inquiry = trim($_POST["inquiry"]);
  //  $check_query = "SELECT * FROM contactus WHERE email = :email";
   // $statement = $connect->prepare($check_query);
   // $check_data = array(':email' => $email);
  //  $statement->execute($check_data);

/*     if($statement->rowCount() > 0) {
        $message .= '<label>Email already exists</label><br/>';
    } else {
        if(empty($email)) {
            $message .= '<label>Email is required</label><br/>';
        } */

// Encrypt password
$user_activation_code = md5(rand()); 
$contact_id = rand(); // Generate a random contact_id

$query = "
    INSERT INTO contactus 
    (contact_id, email, firstname, lastname, phone_number, inquiry) 
    VALUES (:contact_id, :email, :firstname, :lastname,:phone_number, :inquiry)
";

$data = array(
    ':contact_id' => $contact_id, // Use the generated contact_id
    ':email' => $email,
    ':firstname' => $firstname,
    ':lastname' => $lastname,
    ':phone_number' => $phone_number,
    ':inquiry' => $inquiry
);

$statement = $connect->prepare($query);

if($statement->execute($data)) {
    $complete = '<label class="text-success">Form is complete. Please check your email and Junk box mail.</label>';

    // Send verification email
	$subject = "Contact Form";
	$adminsubject = "Contact Inquiry";
	$message_body = "<p>Hi $firstname,</p><p>Thanks for Contacting us. Your inquiry number is ".$contact_id.". We will get back to you as soon as we have a response.</p><p>Kind Regards,<br />AFJCardiff</p>";
	$adminmessage_body = "<p>Hi Admin,</p><p>The person is: $firstname $lastname.</p><p>Has this inquiry: ".$inquiry."</p><p>Their Number is: ".$phone_number."</p><p>Their Contact Order ID is ".$contact_id."</p>";

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
  .registerbox{
	  
	background: linear-gradient(to bottom, #BF584E, rgba(217, 126, 74, 0.8));
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
                                        <li><a href="classes.php">Classes</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="news.php">News</a></li>
                                        <li class="active"><a href="contact.php">Contact</a></li>
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

    <section class="site_hero inner-page overlay" style="background-image: url(
    <?php echo contactusbackground($connect); ?>);">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Contact</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.php">Home</a></li>
              <li>&bullet;</li>
              <li>Contact</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="section contact-section" id="next" align="center">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            
     <div class="card registerbox">
        <div class="card-header">
            <h3 class="text-center" >Contact us</h3>
        </div>
        <h3 class="text-danger"><?php echo $message; ?></h3>
        <h3 class="text-success"><?php echo $complete; ?></h3>
        <div class="card-body">
            <form id="registrationForm" method="post">
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
                    <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" required />
                </div>
				<label>Inquiry</label>
                <div class="form-group">
                    <select type="text" name="inquiry" class="form-control" placeholder="inquiry" required>
						<option value="">Please Select</option>
						<option> <?php echo inquiry($connect); ?></option>
					</select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit_inquiry" class="btn" value="Submit Inquiry" />
                </div>
            </form>
        </div>
    </div>
	
          </div>
        </div>
      </div>
    </section>

    <section class="section testimonial-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Testimonials</h2>
          </div>
        </div>
        <div class="row">
          <?php echo reviewdetails($connect); ?>
            <!-- END slider -->
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
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registrationForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                firstname: "required",
                lastname: "required",
                phone_number: "required",
                inquiry: "required"
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