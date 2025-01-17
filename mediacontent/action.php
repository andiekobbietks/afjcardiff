<?php
//action.php
include('../database_connection.php');
if(isset($_POST['action']))
{
 $output = '';
 if($_POST['action'] == 'insert') //set up parameters for inserting posted content
 {
  $data = array(
   ':codebased_title' => 'CodeBased Title',
   ':content_title' => 'Content Title',
   ':post_content'  => $_POST["post_content"],
   ':start_datetime'  => date("d-m-Y") . '',
   ':end_datetime'  => date("d-m-Y") . '',
  );
  $query = "
  INSERT INTO media_content 
  (codebased_title, content_title, post_content, start_datetime, end_datetime) 
  VALUES (:codebased_title, :content_title, :post_content, :start_datetime, :end_datetime)
  ";

  $statement = $connect->prepare($query);
  $statement->execute($data);
//set up parameters for inserting follow content

 }

 if($_POST['action'] == 'fetch_post') //set up parameters for getting all user's details relating to post content
 {
  $query = "
  SELECT * FROM media_content 
  ORDER BY media_id DESC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="5%">ID</th>
       <th width="5%">CodeBased Title</th>
       <th width="5%">Location Title</th>
       <th width="5%">Post Content</th>
       <th width="5%">Start</th>
       <th width="5%">End</th>
       <th width="5%">Update</th>
       <th width="5%">Delete</th>
      </tr>
	  </thead>
	    <tr>
      <td></td>
     </tr>	
  ';
  if($total_row > 0)
  {
   foreach($result as $row) //user foreach to get images tied to the user
   {
  
    $output .= '
  <tr>
   <td> '.$row["media_id"].'</td>
   <td> '.$row["codebased_title"].'</td>
   <td> '.$row["content_title"].'</td>
   <td>'.$row["post_content"].'</td>
   <td>'.$row["start_datetime"].'</td>
   <td>'.$row["end_datetime"].'</td>
    <td><button type="button" name="update" class="btn btn-warning  btn-sm update" id="'.$row["media_id"].'" >Update</button></td>
     <td><button type="button" name="delete" id="'.$row["media_id"].'" class="btn btn-danger btn-lg delete">Delete</button></td>
   </tr>
   
 
    ';
   }
  }
  else
  {
   $output = '<h4>No Post Found</h4>';
  }
  
  $output .= '
</table>
';
  echo $output;
 } 
 
   if($_POST["action"] == "fetch_link_content")
 {
  echo file_get_contents($_POST["url"][0]);
 }
 
}

?>
