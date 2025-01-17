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
            <div class="col-md-4 mb-4">
                <div class="thumbnail">
                    <video width="100%" height="auto" controls>
                        <source src="../imageuploads/' . $row['file_name'] . '" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="caption">
                        <h5 class="text-lg font-semibold mb-2">' . $row['title'] . '</h5>
                        <button type="button" name="update" class="btn btn-warning btn-sm update" id="update' . $row["video_id"] . '">Update</button>
                        <button type="button" name="delete" class="btn btn-danger btn-sm delete" id="delete' . $row["video_id"] . '">Delete</button>
                    </div>
                </div>
            </div>';
        }
    } else {
        $output = "<p class='text-lg font-medium'>No videos found.</p>";
    }
    echo $output;
} catch (PDOException $e) {
    echo "<p class='text-lg font-medium'>Error: Unable to fetch videos. Please try again later.</p>";
}
?>
