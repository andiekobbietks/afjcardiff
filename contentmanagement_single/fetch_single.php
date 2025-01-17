<?php
include('../connection.php');
include('function.php');
//fetch_single.php

if(isset($_POST["user_id"])) {
    $output = array();
    $statement = $connect->prepare(
        "SELECT * FROM classes
        WHERE class_id = :user_id
        LIMIT 1"
    );
    $statement->execute(array(':user_id' => $_POST["user_id"]));
    $result = $statement->fetchAll();
    foreach($result as $row) {
        $output["class_image"] = $row["class_image"];
        $output["code_basedtitle"] = $row["code_basedtitle"];
        $output["class_title"] = $row["class_title"];
        $output["class_description"] = $row["class_description"];
        $output["expected_startdatetime"] = $row["expected_startdatetime"];
        $output["expected_enddatetime"] = $row["expected_enddatetime"];
        if($row["class_image"] != '') {
            $output['class_image'] = '<img src="../imageuploads/'.$row["class_image"].'" class="img-thumbnail" width="50%" height="50%" /><input type="hidden" name="hidden_user_image" value="'.$row["class_image"].'" />';
        } else {
            $output['class_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
        }
    }
    echo json_encode($output);
}
?>
