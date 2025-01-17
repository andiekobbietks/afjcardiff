<?php
include('../table_connection.php');

if(isset($_POST["user_id"]))
{

 $statement = $connection->prepare(
  "DELETE FROM media_content WHERE media_id = :media_id"
 );
 $result = $statement->execute(
  array(
   ':media_id' => $_POST["user_id"]
  )
 );
 
 if(!empty($result))
 {
  echo 'Data Deleted';
 }
}



?>