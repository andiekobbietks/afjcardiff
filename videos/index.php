<?php
include("../database_connection.php");

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Video Upload and Play</title>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script src="https://smtpjs.com/v3/smtp.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
.footer {
   padding: 10px;
   font-size: 20px;
   width: 100%;
   background-color: rgba(192, 192, 192, 0.5);
   color: black;
   text-align: left;
   flex-shrink: 0; /* Prevents footer from shrinking */
}
</style>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="../contentmanagement/index.php">AFJCardiff</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../contentmanagement/index.php">Content Management</a></li>
                <li><a href="../mediacontent/index.php">Media Content</a></li>
                <li><a href="../videourl/index.php">YouTube Videos</a></li>
                <li class="active"><a href="../videos/index.php">Videos</a></li>
                <li><a href="../sendalerts/index.php">Send Email Alerts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<body class="bg-gray-100">
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="videoForm" enctype="multipart/form-data" class="max-w-md mx-auto">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="videoTitle" class="font-medium">Video Title:</label>
                    <input type="text" name="videoTitle" id="videoTitle" required class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="videoFile" class="font-medium">Choose a Video:</label>
                    <input type="file" name="videoFile" id="videoFile" accept="video/*" required class="form-control">
                </div>
                </div>
                <div align="center">
                <button type="submit" class="btn btn-primary mt-4">Upload Video</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Video Player -->
<div class="container mx-auto mt-5">
    <div class="mt-5" id="videoGallery">
        <h2 class="mb-4 text-2xl font-semibold">Video Gallery</h2>
        <div class="row">
            <?php
            try {
                include("../connection.php");
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $selectQuery = "SELECT * FROM videos ORDER BY created_at DESC";
                $statement = $connect->query($selectQuery);
                $total_row = $statement->rowCount();
                $output = '';

                if ($total_row > 0) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        $output .= '
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <video width="100%" height="auto" controls>
                                    <source src="../imageuploads/' . $row['file_name'] . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="caption">
                                    <h5 class="text-lg font-semibold mb-2">' . $row['title'] . '</h5>
                                        <button type="button" name="update" class="btn btn-warning btn-sm update" id="' . $row["video_id"] . '">Update</button>
                                        <button type="button" name="delete" class="btn btn-danger btn-sm delete" id="' . $row["video_id"] . '">Delete</button>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    $output = "<p class='text-lg font-medium'>No videos found.</p>";
                }
                echo $output;
            } catch (PDOException $e) {
                echo "<p class='text-lg font-medium'>Connection failed: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
</div>

<!-- User Modal -->
<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Video Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-4">
                    <label>Video Title</label>
                    <input type="text" name="video_title" id="video_title" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" id="user_id" />
                <input type="hidden" name="operation" id="operation" />
                <input type="submit" name="action" id="action" class="btn btn-success mr-2" value="Add" />
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

      <br><br>
	   <footer class="footer">
       	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
	<a href="../home/index.php" style="text-decoration: none; color:black;" >AFJCardiff</a>
    </footer>
</body>
</html>


<script>
$(document).on('submit', '#user_form', function(event){
    event.preventDefault();
    var video_title = $('#video_title').val();
    if(video_title != '') {
        $.ajax({
            url:"insert.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data) {
			$('#videoGallery').html(data); // Update video gallery with new data
			$('#user_form')[0].reset();
			$('#userModal').modal('hide');
            }
        });
    } else {
        alert("All Fields are Required");
    }
});

$(document).on('click', '.update', function() {
    var user_id = $(this).attr("id");
    $.ajax({
        url: "fetch_single.php",
        method: "POST",
        data: { user_id: user_id },
        dataType: "json",
        success: function(data) {
            $('#userModal').modal('show');
            $('#video_title').val(data.video_title);
            $('.modal-title').text("Edit Video Details");
            $('#user_id').val(user_id);
            $('#action').val("Edit");
            $('#operation').val("Edit");
        }
    });
});

$(document).on('click', '.delete', function() {
    var user_id = $(this).attr("id");
    var videoElement = $(this).closest('.thumbnail'); // Get the parent element of the video to remove
    if(confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url:"delete.php",
            method:"POST",
            data:{user_id:user_id},
            success:function(data) {
                if(data === 'Data Deleted') {
                    videoElement.remove(); // Remove the video element from the gallery
                }
                alert(data);
            }
        });
    } else {
        return false;
    }
});


$(document).ready(function () {
    $("#videoForm").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "upload_video.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                alert(data); // Display success or error message
                // Clear the form
                $('#videoForm')[0].reset();
                // Reload videos after upload
                $.ajax({
                    url: 'fetch_video.php',
                    type: 'GET',
                    success: function (response) {
                        $('#videoGallery').html(response);
                    }
                });
            }
        });
    });
});

</script>