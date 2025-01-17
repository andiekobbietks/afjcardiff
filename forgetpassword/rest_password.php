<?php
include('../database_connection.php');

$message = '';

if(isset($_GET["token"])) {
    $token = $_GET["token"];
    
    // Check if token exists in the database
    $query = "SELECT * FROM password_reset WHERE token = :token AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
    $statement = $connect->prepare($query);
    $statement->execute(array(':token' => $token));
    $count = $statement->rowCount();

    if($count > 0) {
        // Token is valid, allow the user to reset the password
        if(isset($_POST["submit"])) {
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];
            
            // Check if passwords match
            if($new_password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                // Update the user's password in the database
                $query = "UPDATE staff SET password = :password WHERE email = (
                            SELECT email FROM password_reset WHERE token = :token
                          )";
                $statement = $connect->prepare($query);
                $statement->execute(array(
                    ':password' => $hashed_password,
                    ':token' => $token
                ));

                // Delete the token from the password_reset table
                $query = "DELETE FROM password_reset WHERE token = :token";
                $statement = $connect->prepare($query);
                $statement->execute(array(':token' => $token));
                
                $message = "<div class='alert alert-success'>Password updated successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Passwords do not match.</div>";
            }
        }
    } else {
        // Token is invalid or expired
        $message = "<div class='alert alert-danger'>Invalid or expired token.</div>";
    }
} else {
    $message = "<div class='alert alert-danger'>Token not provided.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Reset Password</title>
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
        <h2>Reset Password</h2>
        <?php echo $message; ?>
        <?php if($count > 0): ?>
        <form method="post">
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="button">Reset Password</button>
            </div>
				<div class="login-link">
					<div class="form-group"> <a class="btn btn-success" href="../contentmanagement/index.php">Login</a>
					</div>
				</div>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
