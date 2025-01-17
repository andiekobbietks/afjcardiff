<?php
//delete.php

include('../table_connection.php');

if(isset($_POST["checkbox_value"]))
{
 for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
 {
  $query = "DELETE FROM classes WHERE class_id = '".$_POST['checkbox_value'][$count]."'";
  $statement = $connection->prepare($query);
  $statement->execute();
 }
}


?>