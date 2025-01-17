<?php
include("../database_connection.php");

if ($_POST["query"] != '') {
    $search_array = explode(",", $_POST["query"]);
    $search_text = "'" . implode("', '", $search_array) . "'";
    $query = "
    SELECT * FROM classes 
    WHERE code_basedtitle IN (" . $search_text . ") 
    ORDER BY class_id DESC
    ";
} else {
    $query = "SELECT * FROM classes ORDER BY class_id DESC";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '<div class="table-responsive">
    <table id="" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="10%">Class Image</th>
	   <th width="10%">Code BasedTitle</th>
       <th width="10%">Class Title</th>
       <th width="10%">Class Description</th>
       <th width="10%">Expected StartDate</th>
       <th width="10%">Expected EndDate</th>
       <th width="10%">Edit</th>
       <th width="10%">Delete</th>
      </tr>
     </thead>
    </table>
</div>';

if ($total_row > 0) {
    foreach ($result as $row) {
        $output .= '
    <tr>
    <td><img src="../imageuploads/' . $row["class_image"] . '" class="img-thumbnail" width="100" height="100" /></td>
    <td>' . $row["code_basedtitle"] . '</td>     
    <td>' . $row["class_title"] . '</td>
    <td>' . $row["class_description"] . '</td>
    <td>' . $row["expected_startdatetime"] . '</td>
    <td>' . $row["expected_enddatetime"] . '</td>
    <td><button type="button" name="update" id="' . $row["class_id"] . '" class="btn btn-warning btn-xs update">Update</button></td>
    <td><button type="button" name="delete" id="' . $row["class_id"] . '" class="btn btn-danger btn-xs delete">Delete</button></td>
    </tr>
    ';
    }
} else {
    $output .= '
    <tr>
    <td colspan="9" align="center">No Data Found</td>
    </tr>
    ';
}

echo $output;

?>
