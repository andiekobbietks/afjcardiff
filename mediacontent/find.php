<?php

include('../database_connection.php');

if($_POST["query"] != '')
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "
 SELECT * FROM media_content 
 WHERE content_title IN (".$search_text.") 
 ORDER BY content_title ASC
 ";
}
else
{
 $query = "SELECT * FROM media_content ORDER BY content_title DESC";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if($total_row > 0)
{
 foreach($result as $row)
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
     <td><button type="button" name="delete" id="'.$row["media_id"].'" class="btn btn-danger btn-sm delete">Delete</button></td>
   </tr>
   
 
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="5" align="center">No Data Found</td>
 </tr>
 ';
}

echo $output;


?>
