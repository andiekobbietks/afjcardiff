<?php
include('../connection.php');

// Receive registration inputs
if(isset($_POST["sent_emails"])) {
    $email = trim($_POST["email"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $phone_number = trim($_POST["phone_number"]);

$query = "
    INSERT INTO newsletters 
    ( email, firstname, lastname, phone_number) 
    VALUES (:email, :firstname, :lastname,:phone_number)
";

$data = array(
    ':email' => $email,
    ':firstname' => $firstname,
    ':lastname' => $lastname,
    ':phone_number' => $phone_number
);

$statement = $connect->prepare($query);

if($statement->execute($data)) {
    $complete = '<label class="text-success">Form is complete. Please check your email and Junk box mail.</label>';

    // Send verification email
	$subject = "Newsletter Form";
	$adminsubject = "Newsletter Inquiry";
	$message_body = "<p>Hi $firstname,</p><p>Thanks joining for our newsletter. We will keep you updated unless you decided to unsubcribe.</p><p>Kind Regards,<br />AFJCardiff</p>";
	$adminmessage_body = "<p>Hi Admin,</p><p>$firstname $lastname, has subcribed for the newsletter.</p><p>Their Email is: ".$email."</p>";

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