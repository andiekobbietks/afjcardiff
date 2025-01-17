<?php
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

    // Email body for recipient
    $recipient_message = "<p>Hi $firstname,</p><p>Thank you for joining our $class_title class.</p><p>This is a $class_type Session.<p>This is the class's date and time.<br/>Start: $expected_startdatetime.</p><p>End: $expected_enddatetime.</p>We look forward to seeing you there!</p><p>Kind Regards,<br/>AFJCardiff</p>";

    // Email body for admin
    $admin_message = "<p>Hi Admin,</p><p>$firstname $lastname has applied for the following class:</p><p>Class Title: $class_title.</p><p>Class Type: $class_type.</p>";

    // Simulated sending of emails using SMTP.js
    // Email to recipient
    echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
    echo '<script>
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "deziremambule@outlook.com",
                Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                To : "'.$recipient_email.'",
                From : "'.$sender_email.'",
                Subject : "'.$subject.'",
                Body : "'.$recipient_message.'",
                Secure: "tls",
                Port: 587
            }).then(function(messagebox) {
                alert("Email sent successfully! ");
            });
        </script>';    

    // Email to admin
    echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
    echo '<script>
            Email.send({
                Host : "smtp.elasticemail.com",
                Username : "deziremambule@outlook.com",
                Password : "98C6740F817373FC4EB409E73EC2CBA3E745",
                To : "deziremambule@outlook.com",
                From : "deziremambule@outlook.com",
                Subject : "'.$subject.'",
                Body : "'.$admin_message.'",
                Secure: "tls",
                Port: 587
            }).then(function(messagebox) {
                alert("Please Check you Junk Box just incase!");
            });
        </script>';
}
?>