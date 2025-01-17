<?php
include('../table_connection.php');

if(isset($_POST["user_id"]))
{

 $statement = $connection->prepare(
  "DELETE FROM videourl WHERE url_id = :url_id"
 );
 $result = $statement->execute(
  array(
   ':url_id' => $_POST["user_id"]
  )
 );
 
 if(!empty($result))
 {
  echo 'Data Deleted';
 }
}



?>