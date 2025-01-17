<?php
include('../table_connection.php');

if(isset($_POST["operation"])) {
    if($_POST["operation"] == "Add") {
        $statement = $connection->prepare("INSERT INTO videos (title) VALUES (:title)");
        $result = $statement->execute(array(':title' => $_POST["video_title"]));
        if(!empty($result)) {
            // Fetch updated data and return HTML content
            ob_start();
            include 'fetch_video.php'; // Fetch the updated data
            $output = ob_get_clean(); // Get the output and clean the buffer
            echo $output; // Return the updated HTML content
        }
    } 
    elseif($_POST["operation"] == "Edit") {
        $statement = $connection->prepare("UPDATE videos SET title = :title WHERE video_id = :video_id");
        $result = $statement->execute(array(
            ':title' => $_POST["video_title"],
            ':video_id'   => $_POST["user_id"]
        ));
        if(!empty($result)) {
            // Fetch updated data and return HTML content
            ob_start();
            include 'fetch_video.php'; // Fetch the updated data
            $output = ob_get_clean(); // Get the output and clean the buffer
            echo $output; // Return the updated HTML content
        }
    }
	
	   if(!empty($result))
    {
        echo 'Data Updated';
    }
}
?>
