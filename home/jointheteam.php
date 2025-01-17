<?php
include('../database_connection.php');
include('../category_details.php');
include('newletter_email.php');

$message = '';
$complete = '';

if(isset($_POST["submit_join"])) {
    // Handle other form fields
    $recipient_email = trim($_POST["recipient_email"]);
    $sender_email = trim($_POST["sender_email"]);
    $subject = trim($_POST["subject"]);
    $reasonmessage = trim($_POST["reasonmessage"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $phone_number = trim($_POST["phone_number"]);
    $dancestyle = trim($_POST["dancestyle"]);
    $danceexperience = trim($_POST["danceexperience"]);
    $jointheteam = trim($_POST["jointheteam"]);

    // Handle image upload
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['profile_image']['name'];
        $file_tmp = $_FILES['profile_image']['tmp_name'];

        // Specify the upload directory
        $upload_dir = "../imageuploads/";

        // Move the uploaded file to the specified directory
        if(move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            // Insert form data along with the file name into the database
            $query = "
                INSERT INTO jointheteam 
                (recipient_email, sender_email, subject, message, firstname, lastname, phone_number, dancestyle, danceexperience, join_team, profile_image) 
                VALUES (:recipient_email, :sender_email, :subject, :message, :firstname, :lastname, :phone_number, :dancestyle, :danceexperience, 
				:join_team, :profile_image)
            ";

            $data = array(
                ':recipient_email' => $recipient_email,
                ':sender_email' => $sender_email,
                ':subject' => $subject,
                ':message' => $reasonmessage,
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':phone_number' => $phone_number,
                ':dancestyle' => $dancestyle,
                ':danceexperience' => $danceexperience,
                ':join_team' => $jointheteam,
                ':profile_image' => $file_name
            );

            $statement = $connect->prepare($query);

            if($statement->execute($data)) {
                $complete = '<label class="text-success">Form is complete. Please check your email and Junk box mail.</label>';

                // Send email notifications here
                $adminsubject = "Joining AFJCardiff";
                $message_body = "<p>Hi $firstname,</p><p>Thank you for requesting to the join us on a $jointheteam level! We will reach out to you ASAP with to regards to this decision.</p><p>Kind Regards,<br />AFJCardiff</p>";
                $adminmessage_body = "<p>Hi Admin,</p><p>$firstname $lastname has requested to the join AFJCardiff Team!</p> <p>This is their profile:</p><p>Dancing Style: $dancestyle.</p><p>Dancing Experience: $danceexperience.</p><p>Position: $jointheteam.</p><p>Reason: $reasonmessage.</p><p>Phone: $phone_number.</p>";

                // Send recipient_email using SMTP.js
                echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
                echo '<script>
                    Email.send({
                    Host : "smtp.elasticemail.com",
                    Username : "deziremambule@outlook.com",
                    Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                    To : "'.$recipient_email.'",
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
            } else {
                $message = '<label class="text-warning">Error inserting data into database.</label>';
            }
        } else {
            $message = '<label class="text-warning">Error uploading profile image.</label>';
        }
    } else {
        $message = '<label class="text-warning">Please select a profile image.</label>';
    }
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
 .joinbox {
    width: 100%;
    padding: 10px;
	background: linear-gradient(to bottom, #BF584E, rgba(217, 126, 74, 0.8));
    border: 1px solid #ccc;
    border-radius: 1px;
    margin-top: 0;
	color: #000;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.1);
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
                                        <li><a href="contact.php">Contact</a></li>
                                        <li><a href="testimonials.php">Testimonials</a></li>
                                        <li class="active"><a href="jointheteam.php">Join the Team</a></li>
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

    <section class="site-hero inner-page overlay" style="background-image: url(
    <?php echo jointheteambackground($connect); ?>);">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Join the Team</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="index.php">Home</a></li>
              <li>&bullet;</li>
              <li>Join the Team</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="section contact-section" id="next">
     <div class="container">
    <div class="row">
        <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <div class="card p-1">
                <div class="card joinbox">
                    <div class="card-header">
						<?php echo joinusdescription($connect); ?>
                    </div>
                    <h3 class="text-warning"><?php echo $message; ?></h3>
                    <h3 class="text-success"><?php echo $complete; ?></h3>
                    <div class="card-body">
                        <form id="registrationForm" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="profile_image">Profile Image:</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <input type="email" name="recipient_email" id="recipient_email" class="form-control" placeholder="Recipient Email" required />
                                <div id="emailSuccess" class="valid-feedback">Valid email address!</div>
                            </div>
                            <div class="form-group">
							<label>Preselected Email:</label>
                                <select name="sender_email" id="sender_email" class="form-control" required>
                                    <option><?php echo user_email($connect); ?></option>
                                </select>
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
                                <select name="subject" class="form-control" required>
                                    <option value="Join The Team">Join The Team</option>
                                </select>
                            </div>  

							<div class="form-group">
							<labels>Select Joining Type</label>
                                <select name="jointheteam" class="form-control" placeholder="Join the team" required>
									<option value="">Please Select</option>
									<option> <?php echo jointheteam($connect); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="reasonmessage" class="form-control" placeholder="Reason or Insperation to Join?" required></textarea>
                            </div>
							
                            <div class="form-group">
							<label>Dance Style:</label>
                                <select name="dancestyle" class="form-control" required>
                                  <option><?php echo dancestyle($connect); ?></option>
                                </select>
                            </div>
							
                            <div class="form-group">
							<label>Dance Experience:</label>
                                <select name="danceexperience" class="form-control" required>
                                  <option><?php echo danceexperience($connect); ?></option>
                                </select>
                            </div>
                            <div class="form-group" align="center">
                                <input type="submit" name="submit_join" class="btn btn-success" value="Submit Form" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>

<button type="button" id="top"><i class="fa fa-arrow-up"></i></button>

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
	<script src="https://smtpjs.com/v3/smtp.js"></script>	
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
                startdate: "required",
                enddate: "required",
                address: "required",
                postcode: "required",
                phone_number: "required",
                numberofdancers: "required",
                reason: "required"
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