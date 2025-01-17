<?php
include('../database_connection.php');

$message = '';

if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    
    // Check if email exists in the database
    $query = "SELECT * FROM staff WHERE email = :email";
    $statement = $connect->prepare($query);
    $statement->execute(array(':email' => $email));
    $count = $statement->rowCount();

    if($count > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16)); // Example of token generation, you may use your own method
        
        // Save the token, email, and timestamp in the database
        $query = "INSERT INTO password_reset (email, token, timestamp) VALUES (:email, :token, NOW())";
        $statement = $connect->prepare($query);
        $statement->execute(array(
            ':email' => $email,
            ':token' => $token
        ));

        // Send reset password email with the token
		$reset_link = "http://localhost/afjcardiff/forgetpassword/rest_password.php?token=$token";
		//$reset_link = "http://mambulecode.infinityfreeapp.com/paradigmshift/forgetpassword/rest_password.php?token=$token";
		$subject = "Password Reset";
		$message_body = "Please click the following link to reset your password: <a href=".$reset_link.">Here</a>";


        
        // Send email using SMTP.js
        echo '<script src="https://smtpjs.com/v3/smtp.js"></script>'; // Include SMTP.js library
        echo '<script>
					Email.send({
				    Host : "smtp.elasticemail.com",
				    Username : "deziremambule@gmail.com",
				    Password : "E281A3D3531651D975BD6B9317EA2EFDC7A8",
				    To : "'.$email.'",
                    From : "deziremambule@gmail.com",
                    Subject : "'.$subject.'",
                    Body : "'.$message_body.'",
                    Secure: "tls",
                    Port: 587
                }).then(function(messagebox) {
                    alert("Email sent successfully! Please check your email and junk box!");
                });
            </script>';
        
        $message = "<div class='alert alert-success'>Password reset link has been sent to your email.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Email not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .loginbox {
            width: 350px;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .loginbox h2 {
            margin-bottom: 20px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
        
        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            width: 100%;
        }
        
        .button:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="loginbox">
        <h2>Forgot Password</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required />
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="button">Submit</button>
            </div>
            <div class="login-link">
                <a class="btn btn-success" href="../contentmanagement/index.php">Home</a>
            </div>
        </form>
        <br/>
        <br/>
        <br/>
        <?php echo $message; ?>
    </div>
</body>
</html>

</html>

