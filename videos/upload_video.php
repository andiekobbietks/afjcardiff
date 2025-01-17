<?php
// upload_video.php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoTitle = $_POST["videoTitle"];

    // Check if file is uploaded successfully
    if (isset($_FILES["videoFile"]) && $_FILES["videoFile"]["error"] == 0) {
        // Increase the allowed maximum size for video ../imageuploads
        ini_set('upload_max_filesize', '100M'); // Set the maximum file size to 100 megabytes
        ini_set('post_max_size', '100M');       // Set the maximum post size to 100 megabytes

        $targetDirectory = "../imageuploads/";
        $targetFile = $targetDirectory . basename($_FILES["videoFile"]["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is a video
        if (in_array($fileType, array("mp3", "mp4", "webm", "ogg", "mov", "3gp", "avi", "mkv"))) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
                // Save video information to the database
                try {
                    include("../connection.php");
                    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $insertQuery = "INSERT INTO videos (title, file_name) VALUES (?, ?)";
                    $statement = $connect->prepare($insertQuery);
                    $statement->execute([$videoTitle, basename($_FILES["videoFile"]["name"])]);

                    echo "Video uploaded successfully!";
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            } else {
                echo "Error uploading video.";
            }
        } else {
            echo "Invalid video format. Please upload an MP4, WebM, OGG, MOV, 3GP, AVI, or MKV file.";
        }
    } else {
        echo "Error uploading video.";
    }
} else {
    echo "Invalid request.";
}
?>
