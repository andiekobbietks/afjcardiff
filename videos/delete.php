<?php
include('../table_connection.php');

if(isset($_POST["user_id"]))
{
    $statement = $connection->prepare(
        "DELETE FROM videos WHERE video_id = :video_id"
    );
    $result = $statement->execute(
        array(
            ':video_id' => $_POST["user_id"]
        )
    );
    
    if(!empty($result))
    {
        echo 'Data Deleted';
    }
}
?>
