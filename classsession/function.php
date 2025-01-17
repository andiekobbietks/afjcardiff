<?php
function get_total_all_records()
{
 include('../database_connection.php');
 try {
    $statement = $connect->prepare("SELECT * FROM classes");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
 } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
 }
}
?>
