<?php
include('../connection.php');
include('function.php');

// Check if class_id is set in the POST request
if (isset($_POST["class_id"])) {
    $output = array();

    // Prepare the SQL query to fetch data from the classes table based on class_id
    $statement = $connect->prepare(
        "SELECT * FROM classes
        WHERE class_id = :class_id"  // Use class_id to fetch the specific class data
    );

    // Execute the query with the provided class_id
    $statement->execute(array(':class_id' => $_POST["class_id"]));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the results to populate the output array
    foreach ($result as $row) {
        $class_data = array();
        $class_data["class_id"] = $row["class_id"];  // Store class_id for future reference
        $class_data["class_title"] = $row["class_title"];
        $class_data["code_basedtitle"] = $row["code_basedtitle"];
        $class_data["class_description"] = $row["class_description"];
        $class_data["expected_startdatetime"] = $row["expected_startdatetime"];
        $class_data["expected_enddatetime"] = $row["expected_enddatetime"];
        
        // Handle the image display and hidden input field
        if ($row["class_image"] != '') {
            $class_data['class_image'] = '<img src="../imageuploads/'.$row["class_image"].'" class="img-thumbnail" width="50%" height="50%" /><input type="hidden" name="hidden_user_image[]" value="'.$row["class_image"].'" />';
        } else {
            $class_data['class_image'] = '<input type="hidden" name="hidden_user_image[]" value="" />';
        }
        
        // Add the class data to the output array
        $output[] = $class_data;
    }

    // Return the output as JSON
    echo json_encode($output);
}
?>
