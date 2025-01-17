<?php
// fetch.php
include('../connection.php');
$output = '';
$replace_array_1 = [];
$replace_array_2 = [];

$statement = null; // Initialize $statement variable

if(isset($_POST["query"]) && $_POST["query"] != '') {
    $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
    $condition = trim($condition);
    $condition = str_replace(" ", "%", $condition);

    $sample_data = array(
        ':expected_startdatetime' => '%' . $condition . '%',
        ':expected_enddatetime' => '%' . $condition . '%',
        ':class_title' => '%' . $condition . '%',
        ':class_description' => '%' . $condition . '%'
    );

    $query = "
        SELECT class_id, code_basedtitle, class_title, class_description, class_image, expected_startdatetime, expected_enddatetime
        FROM classes 
        WHERE (expected_startdatetime LIKE :expected_startdatetime 
        OR expected_enddatetime LIKE :expected_enddatetime 
        OR class_title LIKE :class_title
        OR class_description LIKE :class_description)
        AND (code_basedtitle = 'regular class' OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event')
        ORDER BY class_id DESC
    ";

    $statement = $connect->prepare($query);

    $statement->execute($sample_data);

    $result = $statement->fetchAll();

    $replace_array_1 = explode("%", $condition);
    foreach ($replace_array_1 as $row_data) {
        $replace_array_2[] = '<span style="background-color:#' . rand(100000, 999999) . '; color:#fff">' . $row_data . '</span>';
    }
} else {
    $query = "
        SELECT * FROM classes WHERE code_basedtitle = 'regular class'
        OR code_basedtitle = '1 to 1' OR code_basedtitle = 'Special Event' ORDER BY class_id DESC
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
}

$output = '';

if(count($result) > 0) {
    $output .= '
<div align="center">
<h3><span class="label" style="background-color:#' . rand(100000, 999999) . '; color:#fff">Search Results: ' . count($result) . '</span></h3>
</div>
<br/>
<br/>
';

    foreach($result as $row) {
        $class_title = str_ireplace($replace_array_1, $replace_array_2, $row["class_title"]);
        $class_description = str_ireplace($replace_array_1, $replace_array_2, $row["class_description"]);
        $expected_startdatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_startdatetime"]);
        $expected_enddatetime = str_ireplace($replace_array_1, $replace_array_2, $row["expected_enddatetime"]);

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
                                    <p class="form-control">' . $class_title . '</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Expected Start</b></label>
                                    <p class="form-control">' . $expected_startdatetime. '</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Expected End</b></label>
                                    <p class="form-control">' . $expected_enddatetime.'</p>
                                </div>
                            </div>
                            <br/>
                            <br/>
							<div class="col-md-6">
							<div class="form-group">
							<label><b>Class Description</b></label>
							<textarea class="form-control" readonly>'.$row["class_description"].'</textarea>
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
