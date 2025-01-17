<?php
include('../connection.php');
include("function.php");

if(isset($_POST["user_id"])) {
    $image = get_image_name($_POST["user_id"]);
    if($image != '') {
        unlink("../imageuploads/" . $image);
    }
    
    $statement = $connect->prepare("DELETE FROM classes WHERE class_id = :class_id");
    $result = $statement->execute(array(':class_id' => $_POST["user_id"]));
    
    if(!empty($result)) {
        echo 'Data Deleted';
    }
}
?>
