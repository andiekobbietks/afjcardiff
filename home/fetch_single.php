<?php
include('../connection.php');
include('function.php');

if (isset($_POST["user_id"])) {
    $output = array();
    try {
        $statement = $connect->prepare(
            "SELECT * FROM classes
            WHERE class_id = :user_id
            LIMIT 1"
        );
        $statement->execute(
            array(
                ':user_id' => $_POST["user_id"]
            )
        );
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $row = $result[0]; // Use the first (and only) row

            $output["class_type"] = $row["code_basedtitle"];
            $output["class_title"] = $row["class_title"];
            $output["class_description"] = $row["class_description"];
            $output["expected_startdatetime"] = $row["expected_startdatetime"];
            $output["expected_enddatetime"] = $row["expected_enddatetime"];
            echo json_encode($output);
        } else {
            echo json_encode(array('error' => 'No records found'));
        }
    } catch (PDOException $e) {
        echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
    }
}
?>
