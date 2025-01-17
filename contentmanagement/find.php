<?php
include("../database_connection.php");
include('../category_details.php');
// Define records per page and current page
$records_per_page = 10; // Number of records to display per page
$page = isset($_POST["page"]) ? $_POST["page"] : 1;
$start_from = ($page - 1) * $records_per_page;
 
// Determine query based on search input
if ($_POST["query"] != '') {
    $search_array = explode(",", $_POST["query"]);
    $search_text = "'" . implode("', '", $search_array) . "'";
    $query = "
    SELECT * FROM classes 
    WHERE class_title IN (" . $search_text . ") 
    ORDER BY class_id DESC 
    LIMIT $start_from, $records_per_page
    ";
    $total_query = "
    SELECT * FROM classes 
    WHERE class_title IN (" . $search_text . ")
    ";
} else {
    $query = "SELECT * FROM classes ORDER BY class_id DESC LIMIT $start_from, $records_per_page";
    $total_query = "SELECT * FROM classes";
}

// Prepare and execute queries
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();

// Fetch total number of records
$total_statement = $connect->prepare($total_query);
$total_statement->execute();
$total_records = $total_statement->rowCount();

$total_pages = ceil($total_records / $records_per_page);

// Prepare replacement array for highlighting search terms
/*
if (isset($_POST["query"])) {
    $replace_array_1 = explode(",", $_POST["query"]);
    foreach ($replace_array_1 as $row_data) {
        $replace_array_2[] = '<span style="background-color:#' . rand(100000, 999999) . '; color:#fff; border-radius: 5px;">' . $row_data . '</span>';
    }
}
*/
$output = '<div class="table-responsive">';

// Display the search results count with a label
/*
$output .= '
    <div align="center">
        <h3><span class="label" style="background-color:#' . rand(100000, 999999) . '; color:#fff; border-radius: 5px;">Search Results: ' . $total_row . '</span></h3>
    </div>';
*/

// Top Pagination with centered and spaced pagination
$output .= '
<style>
    .pagination .page-item {
        margin: 0 5px; /* Increase spacing between page numbers */
    }
</style>
<nav aria-label="Page navigation example" class="text-center">
    <ul class="pagination justify-content-center">';

// Previous button
if ($page > 1) {
    $prev_page = $page - 1;
    $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $prev_page . '">&laquo; Previous</a></li>';
}

// Page numbers
for ($i = 1; $i <= $total_pages; $i++) {
    $active_class = ($i == $page) ? 'active' : '';
    $output .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
}

// Next button
if ($page < $total_pages) {
    $next_page = $page + 1;
    $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $next_page . '">Next &raquo;</a></li>';
}

$output .= '</ul></nav>';

// Table Content
$output .= '
    <table id="" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th width="10%">Select</th>
        <th width="10%">Class ID</th>
        <th width="10%">Class Image</th>
		<th width="10%">Class Title</th>
		<th width="10%">Code Based Title</th>
		<th width="10%">Start DateTime</th>
		<th width="10%">End DateTime</th>
       <th width="10%">Edit</th>
       <th width="10%">Delete</th>
      </tr>
     </thead>
     <tbody>';

if ($total_row > 0) {
    foreach ($result as $row) {
        $highlighted_title = $row["class_title"];

        // Apply highlighting to the class_title
        if (isset($replace_array_2)) {
            foreach ($replace_array_1 as $key => $value) {
                if (stripos($highlighted_title, $value) !== false) {
                    $highlighted_title = str_ireplace($value, $replace_array_2[$key], $highlighted_title);
                }
            }
        }

        $output .= '
    <tr>
        <td><input type="checkbox" name="object_ids[]" value="' . $row['class_id'] . '"></td>
        <td>' . $row["class_id"] . '</td>
        <td><img src="../imageuploads/' . $row["class_image"] . '" class="img-thumbnail" style="max-width:100%;"/></td> 
        <td>' . $highlighted_title . '</td>
        <td>' . $row["code_basedtitle"] . '</td>
        <td>' . $row["expected_startdatetime"] . '</td>
        <td>' . $row["expected_enddatetime"] . '</td>
        <td><button type="button" class="btn btn-warning editObject" data-id="' . $row['class_id'] . '">Edit</button></td>
        <td><button type="button" class="btn btn-danger delete" data-id="' . $row['class_id'] . '">Delete</button></td>
    </tr>
    ';
    }
} else {
    $output .= '
    <tr>
    <td colspan="7" align="center">No Data Found</td>
    </tr>
    ';
}

$output .= '</tbody></table>';

// Bottom Pagination with centered and spaced pagination
$output .= '
<nav aria-label="Page navigation example" class="text-center">
    <ul class="pagination justify-content-center">';

// Previous button
if ($page > 1) {
    $prev_page = $page - 1;
    $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $prev_page . '">&laquo; Previous</a></li>';
}

// Page numbers
for ($i = 1; $i <= $total_pages; $i++) {
    $active_class = ($i == $page) ? 'active' : '';
    $output .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
}

// Next button
if ($page < $total_pages) {
    $next_page = $page + 1;
    $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $next_page . '">Next &raquo;</a></li>';
}

$output .= '</ul></nav></div>';

echo $output;
?>
