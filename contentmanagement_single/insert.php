<?php
include('../connection.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        for ($count = 0; $count < count($_POST["class_title"]); $count++) {
            $image = '';
            
            // Check if there is an image file uploaded for this row
            if (!empty($_FILES["class_image"]["name"][$count])) {
                // Prepare the single file array for upload_image function
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

            $statement = $connect->prepare("
                INSERT INTO classes (class_title, code_basedtitle, class_description, class_image, expected_startdatetime, expected_enddatetime)
                VALUES (:class_title, :code_basedtitle, :class_description, :class_image, :expected_startdatetime, :expected_enddatetime)
            ");

            $result = $statement->execute(
                array(
                    ':class_title' => $_POST["class_title"][$count],
                    ':code_basedtitle' => $_POST["code_basedtitle"][$count],
                    ':class_description' => $_POST["class_description"][$count],
                    ':class_image' => $image,
                    ':expected_startdatetime' => $_POST["expected_startdatetime"][$count],
                    ':expected_enddatetime' => $_POST["expected_enddatetime"][$count]
                )
            );
        }

        if (!empty($result)) {
            echo 'Data Inserted.';
        }
    }
}

if (isset($_POST["operation_edit"])) {
    if ($_POST["operation_edit"] == "Edit") {
        $image = '';
        if (!empty($_FILES["class_image"]["name"])) {
            $image = upload_image($_FILES["class_image"]);
        } else {
            $image = $_POST["hidden_user_image"];
        }

        $statement = $connect->prepare("
            UPDATE classes 
            SET class_title = :class_title,
                code_basedtitle = :code_basedtitle, 
                class_description = :class_description, 
                class_image = :class_image,
                expected_startdatetime = :expected_startdatetime, 
                expected_enddatetime = :expected_enddatetime
            WHERE class_id = :class_id
        ");
        $result = $statement->execute(
            array(
                ':class_title' => $_POST["class_title"],
                ':code_basedtitle' => $_POST["code_basedtitle"],
                ':class_description' => $_POST["class_description"],
                ':class_image' => $image,
                ':expected_startdatetime' => $_POST["expected_startdatetime"],
                ':expected_enddatetime' => $_POST["expected_enddatetime"],
                ':class_id' => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated.';
        }
    }
}
?>
