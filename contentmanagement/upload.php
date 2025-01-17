<?php
//imageuploads.php
include('../database_connection.php');
if(count($_FILES["file"]["name"]) > 0)
{
    //$output = '';
    sleep(3);
    for($count=0; $count<count($_FILES["file"]["name"]); $count++)
    {
        $file_name = $_FILES["file"]["name"][$count];
        $tmp_name = $_FILES["file"]['tmp_name'][$count];
        $file_array = explode(".", $file_name);
        $file_extension = end($file_array);
        if(file_already_uploaded($file_name, $connect))
        {
            $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
        }
        $location = '../imageuploads/' . $file_name;
        if(move_uploaded_file($tmp_name, $location))
        {
            $query = "
            INSERT INTO classes (code_basedtitle, class_title, class_description, expected_startdatetime, class_image, expected_enddatetime) 
            VALUES ('code', 'title', 'description', 'expected_startdatetime', '".$file_name."', 'expected_enddatetime')
            ";
            $statement = $connect->prepare($query);
            $statement->execute();
        }
    }
}

function file_already_uploaded($file_name, $connect)
{
    $query = "SELECT * FROM classes WHERE class_image = '".$file_name."'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $number_of_rows = $statement->rowCount();
    if($number_of_rows > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>
