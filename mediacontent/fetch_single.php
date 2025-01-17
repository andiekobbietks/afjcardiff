<?php
include('../table_connection.php');
include('function.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM media_content 
  WHERE media_id = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["codebased_title"] = $row["codebased_title"];
  $output["content_title"] = $row["content_title"];
  $output["start_datetime"] = $row["start_datetime"];
  $output["end_datetime"] = $row["end_datetime"];
 }
 echo json_encode($output);
}
?>