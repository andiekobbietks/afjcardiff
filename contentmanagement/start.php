<?php
 include('../database_connection.php');
 include('../category_details.php');

if(!isset($_SESSION["staff_id"]))
{
	header("location:login.php");
}

$query = "SELECT DISTINCT class_title FROM classes ORDER BY class_title DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
?>