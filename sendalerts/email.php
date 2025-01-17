<?php
include('../connection.php');

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}

$complete = '';
// Receive registration inputs
if(isset($_POST["submit_session"])) {
    // Handle form fields
    $recipient_email = trim($_POST["recipient_email"]);
    $sender_email = trim($_POST["sender_email"]);
    $subject = trim($_POST["subject"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $class_title = trim($_POST["class_title"]);
    $class_type = trim($_POST["class_type"]);
    $expected_startdatetime = trim($_POST["expected_startdatetime"]);
    $expected_enddatetime = trim($_POST["expected_enddatetime"]);

    
    $complete = "<div id='notification' class='text-center'><label class='label label-success'>Email Notification Sent</label></div>";
    $complete .= "<script>
                setTimeout(function(){
                    $('#notification').fadeOut('slow');
                }, 3000); // 3000 milliseconds = 3 seconds
            </script>";

// Simulated sending of emails using SMTP.js
// Email to recipient
$subject = 'Class Alert Reminder'; // Set subject here
$recipient_message = "<p>Hi $firstname,</p><p>This is a reminder for $class_title class.</p> <p>This a $class_type Session.<p>This is the class's date and time.<br/>Start: $expected_startdatetime.</p><p>End: $expected_enddatetime.</p>We look forward to seeing you there!</p><p>Kind Regards,<br/>AFJCardiff</p>";

// Send bulk emails to other recipients
$email_bulk = isset($_POST['email_bulk']) ? $_POST['email_bulk'] : array(); // Set email bulk array here
$bulk_subject = 'Class Alert Reminder';
$bulk_message = "<p>Hi $firstname,</p><p>Thank you for joining our $class_title $class_type Session.<p>This is the class's date and time.<br/>Start: $expected_startdatetime.</p><p>End: $expected_enddatetime.</p>We look forward to seeing you there!</p><p>Kind Regards,<br/>AFJCardiff</p>";

// Email to recipient
echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
echo '<script>
        Email.send({
            Host : "smtp.elasticemail.com",
            Username : "deziremambule@outlook.com",
            Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
            To : "'.$recipient_email.'",
            From : "deziremambule@outlook.com",
            Subject : "'.$subject.'",
            Body : "'.$recipient_message.'",
            Secure: "tls",
            Port: 587
        }).then(function(messagebox) {
        });
      </script>';

// Send bulk emails to other recipients
foreach($email_bulk as $email) {
    echo '<script>
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "deziremambule@outlook.com",
                Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                To : "'.$email.'",
                From : "deziremambule@outlook.com",
                Subject : "'.$bulk_subject.'",
                Body : "'.$bulk_message.'",
                Secure: "tls",
                Port: 587
            }).then(function(messagebox) {
            });
          </script>';
	}
}
 
?>