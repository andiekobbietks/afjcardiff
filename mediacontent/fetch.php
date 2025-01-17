<?php
include('../table_connection.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM media_content ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE content_title LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR codebased_title LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR post_content LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR start_datetime LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR end_datetime LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY media_id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row)
{

 $sub_array = array();
 $sub_array[] = $row["media_id"];
 $sub_array[] = $row["codebased_title"];
 $sub_array[] = $row["content_title"];
 $sub_array[] = $row["post_content"];
 $sub_array[] = $row["start_datetime"];
 $sub_array[] = $row["end_datetime"];
 $sub_array[] = '<button type="button" name="update" class="btn btn-warning  btn-sm update" id="'.$row["media_id"].'" >Update</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["media_id"].'" class="btn btn-danger btn-sm delete">Delete</button>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>