<?php
//insert.php
include('../connection.php');

function upload_image($file)
{
    if (isset($file)) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        // Check if the file extension is valid
        $allowed_extensions = array("gif", "png", "jpg", "jpeg");
        if (!in_array($extension, $allowed_extensions)) {
            echo "Invalid Image File";
            return false;
        }
        
        // Generate a new name for the image
        $new_name = rand() . '.' . $extension;
        $destination = '../imageuploads/' . $new_name;
        
        // Move the uploaded file to the destination
        move_uploaded_file($file['tmp_name'], $destination);
        
        return $new_name;
    }
    return '';
}

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        for ($count = 0; $count < count($_POST["class_title"]); $count++) {
            $image = '';
            
            // Check if there is an image file uploaded for this row
            if (!empty($_FILES["class_image"]["name"][$count])) {
                $file = array(
                    'name' => $_FILES["class_image"]["name"][$count],
                    'type' => $_FILES["class_image"]["type"][$count],
                    'tmp_name' => $_FILES["class_image"]["tmp_name"][$count],
                    'error' => $_FILES["class_image"]["error"][$count],
                    'size' => $_FILES["class_image"]["size"][$count]
                );

                // Upload image
                $image = upload_image($file);
            }

            // Prepare and execute the insert statement for each row
            $statement = $connect->prepare("
                INSERT INTO classes (class_title, code_basedtitle, class_description, expected_startdatetime, expected_enddatetime, class_image)
                VALUES (:class_title, :code_basedtitle, :class_description, :expected_startdatetime, :expected_enddatetime, :class_image)
            ");
            $result = $statement->execute(
                array(
                    ':class_title' => $_POST["class_title"][$count],
                    ':code_basedtitle' => $_POST["code_basedtitle"][$count],
                    ':class_description' => $_POST["class_description"][$count],
                    ':expected_startdatetime' => $_POST["expected_startdatetime"][$count],
                    ':expected_enddatetime' => $_POST["expected_enddatetime"][$count],
                    ':class_image' => $image
                )
            );

            if (!empty($result)) {
                echo 'Data Inserted.';
            }
        }
    }
}

?>
