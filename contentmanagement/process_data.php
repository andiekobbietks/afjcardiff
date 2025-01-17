<?php
// process_data.php
include('../connection.php');
include('../category_details.php');
// Define records per page and current page
$records_per_page = 10; // Number of records to display per page
$page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
$start_from = ($page - 1) * $records_per_page;


$output = '';
$replace_array_1 = [];
$replace_array_2 = [];

// Determine query based on search input
if(isset($_POST["query"])) {
    $search = $_POST["query"];
    $query = "
        SELECT * FROM classes 
        WHERE class_title LIKE :search
        OR code_basedtitle LIKE :search
        OR class_description LIKE :search
        OR expected_startdatetime LIKE :search
        OR expected_enddatetime LIKE :search
        ORDER BY class_id DESC
        LIMIT $start_from, $records_per_page
    ";
    $total_query = "
        SELECT * FROM classes 
        WHERE class_title LIKE :search
        OR code_basedtitle LIKE :search
        OR class_description LIKE :search
        OR expected_enddatetime LIKE :search
    ";
    $statement = $connect->prepare($query);
    $statement->execute(array(':search' => '%' . $search . '%'));

    $total_statement = $connect->prepare($total_query);
    $total_statement->execute(array(':search' => '%' . $search . '%'));
} else {
    $query = "
        SELECT * FROM classes 
        ORDER BY class_id DESC
        LIMIT $start_from, $records_per_page
    ";
    $total_query = "SELECT * FROM classes";
    $statement = $connect->prepare($query);
    $statement->execute();

    $total_statement = $connect->prepare($total_query);
    $total_statement->execute();
}

$result = $statement->fetchAll();
$total_row = $total_statement->rowCount();
$total_pages = ceil($total_row / $records_per_page);

// Prepare replacement array for highlighting search terms
if(isset($_POST["query"])) {
    $replace_array_1 = explode("%", $search);
    foreach ($replace_array_1 as $row_data) {$replace_array_2[] = '<span style="background-color:#' . rand(100000, 999999) . '; color:#fff; border-radius: 5px;">' . $row_data . '</span>';

    }
}

$output = '';

if(count($result) > 0) {
    // Top Pagination
    $output .= '
    <style>
        .pagination .page-item {
            margin: 0 5px; /* Increase spacing between page numbers */
        }
    </style>
    <div align="center">
        <h3><span class="label" style="background-color:#' . rand(100000, 999999) . '; color:#fff; border-radius: 5px;">Search Results: ' . $total_row . '</span></h3>
    </div>
	<br/>
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
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
                    </tr>
                </thead>
			<tbody>';

    foreach($result as $row) {
        $class_title = str_ireplace($replace_array_1, $replace_array_2, $row["class_title"]);
        $class_id = str_ireplace($replace_array_1, $replace_array_2, $row["class_id"]);
        $code_basedtitle = str_ireplace($replace_array_1, $replace_array_2, $row["code_basedtitle"]);
        $expected_startdatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_startdatetime"]);
        $expected_enddatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_enddatetime"]);

		$output .= '
            <tr>
                <td><input type="checkbox" name="object_ids[]" value="' . $row['class_id'] . '"></td>
                <td>'.$class_id.'</td>
                <td><img src="../imageuploads/' . $row["class_image"] . '" class="img-thumbnail" style="max-width:100%;"/></td>
                <td>'.$class_title.'</td>
                <td>'.$code_basedtitle.'</td>
                <td>'.$expected_startdatetime.'</td>
                <td>'.$expected_enddatetime.'</td>
                <td><button type="button" class="btn btn-warning editObject" data-id="' . $row['class_id'] . '">Edit</button></td>
                <td><button type="button" class="btn btn-danger delete" data-id="' . $row['class_id'] . '">Delete</button></td>
            </tr>
        ';
    }

    // Bottom Pagination
    $output .= '</tbody></table>
        </div>
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
} else {
    $output .= 'Data Not Found';
}

echo $output;
?>
