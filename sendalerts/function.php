<?php
function get_total_all_records()
{
 include('../connection.php');
 $statement = $connect->prepare("SELECT * FROM classes");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
?>
   