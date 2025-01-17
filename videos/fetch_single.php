<?php
//fetch_single.php

include('../table_connection.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM videos 
  WHERE video_id = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["video_title"] = $row["title"];
 }
 echo json_encode($output);
}
?>