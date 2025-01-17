<?php
try {
    // Create a new PDO instance
    $connect = new PDO("mysql:host=localhost;dbname=afjcardiff", "root", "");
    // Set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}

// Handle form submission
if(isset($_POST['videoUrl'])){
    $videoUrl = $_POST['videoUrl'];
    // Validate and sanitize video title and URL if needed

    try {
        // Prepare SQL statement to insert video title and URL into the database
        $query = $connect->prepare("INSERT INTO videourl (video_url) VALUES (:videoUrl)");
        $query->bindParam(':videoUrl', $videoUrl);
        // Execute query
        $query->execute();
        echo "Video uploaded successfully!";
    } catch(PDOException $e) {
        // Display error message if query execution fails
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Video title and URL are required!";
}
?>
