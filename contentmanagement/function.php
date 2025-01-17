<?php

function upload_image()
{
    if(isset($_FILES["class_image"]))
    {
        $extension = pathinfo($_FILES['class_image']['name'], PATHINFO_EXTENSION);
        
        // Check if the file extension is valid
        $allowed_extensions = array("gif", "png","PNG", "jpg", "jpeg");
        if (!in_array($extension, $allowed_extensions)) {
            echo "Invalid Image File";
            return false;
        }
        
        // Generate a new name for the image
        $new_name = rand() . '.' . $extension;
        $destination = '../imageuploads/' . $new_name;
        
        // Move the uploaded file to the destination
        move_uploaded_file($_FILES['class_image']['tmp_name'], $destination);
        
        return $new_name;
    }
}

function get_image_name($class_id)
{
    include('../connection.php');
    $statement = $connect->prepare("SELECT class_image FROM classes WHERE class_id = :class_id");
    $statement->execute(array(':class_id' => $class_id));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result["class_image"];
}


function get_total_all_records()
{
 include('../connection.php');
 $statement = $connect->prepare("SELECT * FROM classes");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}
?>
   