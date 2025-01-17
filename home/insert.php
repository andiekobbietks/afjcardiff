<?php
include('../database_connection.php');
include('function.php');

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Confirm") {
        try {
            $statement = $connect->prepare("
                UPDATE coachsession
                SET complete_status = :complete_status
                WHERE coachsession_id = :coachsession_id
            ");
            $result = $statement->execute(
                array(
                    ':complete_status' => $_POST["complete_status"],
                    ':coachsession_id' => $_POST["user_id"]
                )
            );

            $query = "
                SELECT * FROM admin_check_coachsession 
                WHERE memberuser_id = '".$_SESSION["memberuser_id"]."'
            ";
            $statement = $connect->prepare($query);
            $statement->execute();

            $query = "
                INSERT INTO admin_check_coachsession 
                (memberuser_id, coachsession_id) 
                VALUES ('".$_SESSION["memberuser_id"]."', '".$_POST["user_id"]."')
            ";
            $statement = $connect->prepare($query);
            $statement->execute();

            if (!empty($result)) {
                echo 'Data Updated';
            } else {
                echo 'Update failed';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
