
<?php

include('../database_connection.php');

$message = '';

if(isset($_SESSION['staff_id']))
{
 header('location:index.php');
}

if(isset($_POST["login"]))
{
 $query = "
 SELECT * FROM staff 
    WHERE username = :username
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
      ':username' => $_POST["username"]
     )
 );
 $count = $statement->rowCount();
 if($count > 0)
 {
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   if(password_verify($_POST['password'], $row['password']))
   {
    $_SESSION['staff_id'] = $row['staff_id'];
    $_SESSION['username'] = $row['username'];
    header('location:index.php');
   }
   else
   {
    $message = '<label>Wrong Password</label>';
   }
  }
 }
 else
 {
  $message = '<label>Wrong Username</labe>';
 }
}


?>

<html>

<head>
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/logincss.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style>
.adminloginbox {
    width: 50%;
    padding: 20px;
    background-color: rgba(255, 215, 0, 0.5);
    border: 1px solid #ccc;
    border-radius: 15px;
    margin-top: 100px;
    box-shadow: 0 4px 8px 4px rgba(192, 192, 192);
}

</style>
<body>
    <div class="container adminloginbox" align="center">
        <form method="post">
			<div align="center">
				<h3 class="text-danger"><?php echo $message; ?></h3>
				<h2 align="center">Admin Login</a></h2>
				<br />
			<div class="col-md-6">
			<div class="form-group">
			<label>Enter Username</label>
			<input type="text" name="username" class="form-control" required />
			</div>
			</div>

			<div class="col-md-6">
			<div class="form-group">
			<label>Enter Password</label>
			<input type="password" name="password" class="form-control" required />
			</div>
			</div>

			<div class="col-md-12">
			<div class="form-group">
			<button type="submit" name="login" class="button">Login</button>
			</div>
			</div>
				<div class="col-md-12">
					<div class="form-group">
					<a class="btn btn-success" href="../forgetpassword/forgot_password.php">Forgot Password?</a>
					</div>
				</div>
            </div>
        </form>
    </div>
</body>
</html>