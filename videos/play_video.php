<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Play Video</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script src="https://smtpjs.com/v3/smtp.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="bg-gray-100">

<!-- Video Player -->
<div class="container mx-auto mt-10">
    <video controls class="mx-auto">
        <?php
        try {
			include("../connection.php");
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $selectQuery = "SELECT * FROM videos ORDER BY created_at DESC LIMIT 1";
            $statement = $connect->query($selectQuery);

            if ($statement->rowCount() > 0) {
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                echo '<source src="../imageuploads/' . $row["file_name"] . '" type="video/mp4">';
                echo 'Your browser does not support the video tag.';
            } else {
                echo 'No videos available.';
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>
    </video>
</div>

</body>
</html>
