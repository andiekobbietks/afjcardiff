<?php

function get_total_all_records()
{
 include('../table_connection.php');
 $statement = $connection->prepare("SELECT * FROM media_content");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

?>
   