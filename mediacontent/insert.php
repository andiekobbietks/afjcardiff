<?php
include('../table_connection.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $statement = $connection->prepare("
   INSERT INTO media_content (codebased_title, content_title, start_datetime, end_datetime) 
   VALUES (:codebased_title, :content_title, :start_datetime, :end_datetime)
  ");
  $result = $statement->execute(
   array(
    ':codebased_title' => $_POST["codebased_title"],
    ':content_title' => $_POST["content_title"],
    ':start_datetime' => $_POST["start_datetime"],
    ':end_datetime' => $_POST["end_datetime"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
 
  $statement = $connection->prepare(
   "UPDATE media_content 
   SET codebased_title = :codebased_title, content_title = :content_title,
   start_datetime = :start_datetime, end_datetime = :end_datetime
   WHERE media_id = :media_id
   "
  );
  $result = $statement->execute(
   array(
    ':codebased_title' => $_POST["codebased_title"],
    ':content_title' => $_POST["content_title"],
    ':start_datetime' => $_POST["start_datetime"],
    ':end_datetime' => $_POST["end_datetime"],
    ':media_id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>