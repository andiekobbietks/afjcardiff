<?php
// fetch.php

include('../database_connection.php');

if ($_POST["query"] != '') {
    $search_array = explode(",", $_POST["query"]);
    $search_text = "'" . implode("', '", $search_array) . "'";
    $query = "
    SELECT * FROM classes
    WHERE class_title IN (" . $search_text . ")
	AND (code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event')
    ORDER BY class_title DESC
    ";
} else {
    $query = "SELECT * FROM classes WHERE code_basedtitle = 'regular class'
	OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event' ORDER BY class_id DESC";
}


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '
<div align="center">
<h3><span class="label" style="background-color:rgba(192, 192, 192, 0.5);">Dance Session Amount: ' . $total_row . '</span></h3>
</div>
<br/>
<br/>
';

if ($total_row > 0) {
    foreach ($result as $row) {
        $status = $row["class_title"] === "completed" ? '<span class="label label-success">Completed</span>' : 
		'<span class="label label-danger">Pending</span>';
        $output .= '
        <div class="col-md-6">
            <div class="row">
                <div align="center">
                    <div class="column">
                        <div class="tablebox">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class Image</label> 
                                    <img src="../imageuploads/'.$row["class_image"].'" class="img-responsive thumbnail" style="max-width:250px;max-height:100px;"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Class Title</label> 
                                    <p class="form-control">' . $row["class_title"] . '</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Expected Start</b></label>
                                    <p class="form-control">' . $row["expected_startdatetime"] . '</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Expected End</b></label>
                                    <p class="form-control">' . $row["expected_enddatetime"] . '</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
							<div class="col-md-6">
							<div class="form-group">
							<label><b>Class Description</b></label>
							<textarea class="form-control" readonly>' . $row["class_description"] . '</textarea>
							</div>
							</div>
                            <br/>
                            <br/>
                           <button type="button" name="update" id="'.$row["class_id"].'" class="btn btn-lg update buttonselection">Book Session</button>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
} else {
    $output .= '
    <div align="center">No Data Found</div>
    ';
}

echo $output;

?>
