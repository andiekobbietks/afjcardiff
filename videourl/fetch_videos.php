<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=afjcardiff", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM videourl";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';

    if ($total_row > 0) {
        foreach ($result as $row) {
            $output .= '
            <div class="col-md-6 mb-4">
                <div class="custom-card">
                    <iframe width="100%" height="400" src="' . $row['video_url'] . '" frameborder="0" allowfullscreen></iframe>
					<div align="center">
                    <button type="button" name="delete" id="' . $row["url_id"] . '" class="btn btn-danger btn-sm delete">Delete</button>
                </div>
                </div>
            </div>';
        }
    } else {
        $output .= '<div align="center">No Data Found</div>';
    }


    echo $output;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
