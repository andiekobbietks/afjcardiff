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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Uploader</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
  <style>
/* Custom card styling */
.custom-card {
	background-color: #fff;
	border-radius: 0.25rem;
	padding: 1rem;
	box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Box shadow */
}

/* Custom margin for spacing */
.mb-4 {
	margin-bottom: 1rem;
}

/* Container width and center alignment */
.container {
	width: 90%;
	margin: 0 auto;
}

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
<body>
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
                    <li class="active"><a href="../videourl/index.php">YouTube Videos</a></li>
					<li><a href="../videos/index.php">Videos</a></li>
					<li><a href="../sendalerts/index.php">Send Email Alerts</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center text-3xl font-bold my-6">YouTube Video Uploader</h1>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="videoForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="videoUrl">YouTube Video URL:</label>
                                <input type="text" class="form-control" id="videoUrl" name="videoUrl" placeholder="https://www.youtube.com/embed/videoID" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Video</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-8">

 <div class="container">
        <h2 class="text-center text-2xl font-bold mb-4">Uploaded Videos</h2>
        <div id="videoList" class="row">
            <!-- Video list will be displayed here -->
            <!-- Each video will be displayed as a card -->
            <div class="col-md-3">
                <div class="custom-card">
                    <div class="card-body">
                        <!-- Video Content -->
                        Sample Video Content
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
      <br><br>
	   <footer class="footer">
       	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart-o" aria-hidden="true"></i>
	<a href="../home/index.php" style="text-decoration: none; color:black;" >AFJCardiff</a>
    </footer>
</body>
</html>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load videos on page load
            loadVideos();

            // Handle form submission
            $('#videoForm').submit(function (event) {
                event.preventDefault();
                var videoUrl = $('#videoUrl').val();
                if (videoUrl) {
                    $.ajax({
                        url: 'upload_video.php',
                        type: 'POST',
                        data: {
                            videoUrl: videoUrl
                        },
                        success: function (response) {
                            alert(response); // Display success or error message
                            loadVideos(); // Reload the video list
                            $('#videoUrl').val(''); // Clear URL input field
                        }
                    });
                }
            });

            // Function to load uploaded videos
            function loadVideos() {
                $.ajax({
                    url: 'fetch_videos.php',
                    type: 'GET',
                    success: function (response) {
                        $('#videoList').html(response);
                    }
                });
            }
$(document).on('click', '.delete', function(){
    var user_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?")) {
        $.ajax({
            url: "delete.php",
            method: "POST",
            data: { user_id: user_id },
			 success: function (response) {
			alert(response); // Display success or error message
			loadVideos(); // Reload the video list
			$('#videoUrl').val(''); // Clear URL input field
		}
        });
    } else {
        return false;
    }
});

});
    </script>