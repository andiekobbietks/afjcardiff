<?php
include('../connection.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM classes "; // Updated table name to "classes"
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE class_title LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR code_basedtitle LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR class_description LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR expected_startdatetime LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR expected_enddatetime LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY class_id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row) {
	
	  $image = '';
    if($row["class_image"] != '') {
        $image = '<img src="../imageuploads/'.$row["class_image"].'" class="img-thumbnail" width="50%" height="50%" />';
    } else {
        $image = '';
    }
    $sub_array = array();
    $sub_array[] =  '<input type="checkbox" class="delete_checkbox" value="'.$row["class_id"].'" />';
    $sub_array[] = $image;
    $sub_array[] = $row["code_basedtitle"];
    $sub_array[] = $row["class_title"];
    $sub_array[] = $row["class_description"];
    $sub_array[] = $row["expected_startdatetime"];
    $sub_array[] = $row["expected_enddatetime"];
    $data[] = $sub_array;
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(), // Assuming this function is defined elsewhere
 "data"    => $data
);
echo json_encode($output);
?>
