<?php
// fetch.php
include('../connection.php');
$output = '';
$replace_array_1 = [];
$replace_array_2 = [];

if(isset($_POST["query"])) {
    $search = $_POST["query"];
    $query = "
        SELECT * FROM classes 
        WHERE code_basedtitle LIKE :search
        OR  class_title LIKE :search
        OR class_description LIKE :search
        OR expected_startdatetime LIKE :search
        OR expected_enddatetime LIKE :search
    ";
    $statement = $connect->prepare($query);
    $statement->execute(array(':search' => '%' . $search . '%'));

    $replace_array_1 = explode("%", $search);
    foreach ($replace_array_1 as $row_data) {
        $replace_array_2[] = '<span style="background-color:#' . rand(100000, 999999) . '; color:#fff">' . $row_data . '</span>';
    }
} else {
    $query = "
        SELECT * FROM classes ORDER BY class_id DESC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
}
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
';

if(count($result) > 0) {
    $output .= '
	<div align="center">
<h3><span class="label" style="background-color:#' . rand(100000, 999999) . '; color:#fff">Search Results: ' . $total_row . '</span></h3>
</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Class Image</th>
                    <th>Code BasedTitle</th>
                    <th>Class Title</th>
                    <th>Class Description</th>
                    <th>Start Date Time</th>
					<th>End Date Time</th>
				    <th width="10%">Edit</th>
				    <th width="10%">Delete</th>
                </tr>
    ';

    foreach($result as $row) {
        $code_basedtitle = str_ireplace($replace_array_1, $replace_array_2, $row["code_basedtitle"]);
        $class_title = str_ireplace($replace_array_1, $replace_array_2, $row["class_title"]);
        $class_description = str_ireplace($replace_array_1, $replace_array_2, $row["class_description"]);
        $expected_startdatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_startdatetime"]);
        $expected_enddatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_enddatetime"]);

        $output .= '
            <tr>
                <td><img src="../imageuploads/' . $row["class_image"] . '" style="max-width:50%;"/></td>
                <td>'.$code_basedtitle.'</td>
                <td>'.$class_title.'</td>
                <td>'.$class_description.'</td>
                <td>'.$expected_startdatetime.'</td>
                <td>'.$expected_enddatetime.'</td>
				<td><button type="button" name="update" id="' . $row["class_id"] . '" class="btn btn-warning btn-xs update">Update</button></td>
				<td><button type="button" name="delete" id="' . $row["class_id"] . '" class="btn btn-danger btn-xs delete">Delete</button></td>
            </tr>
        ';
    }

    $output .= '
            </table>
        </div>
    ';

    echo $output;
} else {
    echo 'Data Not Found';
}

?>
