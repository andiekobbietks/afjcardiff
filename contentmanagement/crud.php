<?php
//crud.php
include('../database_connection.php');
include('../category_details.php');
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Define records per page and current page
$records_per_page = 10; // Number of records to display per page
$page = isset($_POST["page"]) ? (int)$_POST["page"] : 1;
$start_from = ($page - 1) * $records_per_page;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'fetch':
            $query = "SELECT * FROM classes ORDER BY class_id DESC LIMIT :start_from, :records_per_page";
            $stmt = $connect->prepare($query);
            $stmt->bindValue(':start_from', $start_from, PDO::PARAM_INT);
            $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
            $stmt->execute();
            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $total_query = "SELECT COUNT(*) FROM classes";
            $total_stmt = $connect->prepare($total_query);
            $total_stmt->execute();
            $total_row = $total_stmt->fetchColumn();
            $total_pages = ceil($total_row / $records_per_page);

            $output = '';
            foreach ($classes as $object) {
                $output .= '<tr>
                                <td><input type="checkbox" name="object_ids[]" value="' . htmlspecialchars($object['class_id']) . '"></td>
                                <td>' . htmlspecialchars($object['class_id']) . '</td>
                                <td><img src="../imageuploads/' . htmlspecialchars($object['class_image']) . '" class="img-thumbnail" style="max-width:100%;"></td>
                                <td>' . htmlspecialchars($object['class_title']) . '</td>
                                <td>' . htmlspecialchars($object['code_basedtitle']) . '</td>
                                <td>' . htmlspecialchars($object['expected_startdatetime']) . '</td>
                                <td>' . htmlspecialchars($object['expected_enddatetime']) . '</td>
                                <td><button type="button" class="btn btn-warning editObject" data-id="' . htmlspecialchars($object['class_id']) . '">Edit</button></td>
                                <td><button type="button" class="btn btn-danger delete" data-id="' . htmlspecialchars($object['class_id']) . '">Delete</button></td>
                            </tr>';
            }

            // Pagination controls
            $output .= '<nav aria-label="Page navigation example" class="text-center">
                            <ul class="pagination justify-content-center">';

            // Previous button
            if ($page > 1) {
                $prev_page = $page - 1;
                $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $prev_page . '">&laquo; Previous</a></li>';
            }

            // Page numbers
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $page) ? 'active' : '';
                $output .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
            }

            // Next button
            if ($page < $total_pages) {
                $next_page = $page + 1;
                $output .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $next_page . '">Next &raquo;</a></li>';
            }

            $output .= '</ul></nav>';

            echo $output;
            break;

        case 'fetch_single':
            $stmt = $connect->prepare('SELECT * FROM classes WHERE class_id = :id');
            $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
            $stmt->execute();
            $object = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($object);
            break;

        case 'save':
            $class_id = $_POST['class_id'];
            $class_title = $_POST['class_title'];
            $code_basedtitle = $_POST['code_basedtitle'];
            $class_description = $_POST['class_description'];
            $expected_startdatetime = $_POST['expected_startdatetime'];
            $expected_enddatetime = $_POST['expected_enddatetime'];
            $class_image = $_FILES['class_image']['name'];
            $object_image_tmp = $_FILES['class_image']['tmp_name'];

            if ($class_image) {
                move_uploaded_file($object_image_tmp, "../imageuploads/$class_image");
            } else {
                $stmt = $connect->prepare('SELECT class_image FROM classes WHERE class_id = :class_id');
                $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
                $stmt->execute();
                $existing = $stmt->fetch(PDO::FETCH_ASSOC);
                $class_image = $existing['class_image'];
            }

            if ($class_id) {
                // Update existing object
                $stmt = $connect->prepare('UPDATE classes SET class_title = :class_title, code_basedtitle = :code_basedtitle, class_description = :class_description, expected_startdatetime = :expected_startdatetime, expected_enddatetime = :expected_enddatetime, class_image = :class_image WHERE class_id = :class_id');
                $stmt->bindValue(':class_title', $class_title);
                $stmt->bindValue(':code_basedtitle', $code_basedtitle);
                $stmt->bindValue(':class_description', $class_description);
                $stmt->bindValue(':expected_startdatetime', $expected_startdatetime);
                $stmt->bindValue(':expected_enddatetime', $expected_enddatetime);
                $stmt->bindValue(':class_image', $class_image);
                $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                // Insert new object
                $stmt = $connect->prepare('INSERT INTO classes (class_title, code_basedtitle, class_description, expected_startdatetime, expected_enddatetime,class_image) VALUES (:class_title, :code_basedtitle, :class_description, :expected_startdatetime, :expected_enddatetime, :class_image)');
                $stmt->bindValue(':class_title', $class_title);
                $stmt->bindValue(':code_basedtitle', $code_basedtitle);
                $stmt->bindValue(':class_description', $class_description);
                $stmt->bindValue(':expected_startdatetime', $expected_startdatetime);
                $stmt->bindValue(':expected_enddatetime', $expected_enddatetime);
                $stmt->bindValue(':class_image', $class_image);
                $stmt->execute();
            }

            break;

        case 'fetch_multiple':
            $ids = implode(',', array_fill(0, count($_POST['ids']), '?'));
            $stmt = $connect->prepare("SELECT * FROM classes WHERE class_id IN ($ids)");
            $stmt->execute($_POST['ids']);
            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($classes);
            break;

        case 'save_multiple':
            if (isset($_POST['class_title']) && is_array($_POST['class_title'])) {
                $class_titles = $_POST['class_title'];
                $code_basedtitles = $_POST['code_basedtitle'];
                $class_descriptions = $_POST['class_description'];
                $expected_startdatetimes = $_POST['expected_startdatetime'];
                $expected_enddatetimes = $_POST['expected_enddatetime'];
                $object_ids = $_POST['object_ids'] ?? [];
                $uploaded_images = upload_images($_FILES['class_image']);

                $connect->beginTransaction();
                try {
                    for ($i = 0; $i < count($class_titles); $i++) {
                        $image_name = isset($uploaded_images[$i]) ? $uploaded_images[$i] : get_image_name($object_ids[$i]);
                        $stmt = $connect->prepare('UPDATE classes SET class_title = :class_title, code_basedtitle = :code_basedtitle, class_description = :class_description, expected_startdatetime = :expected_startdatetime, expected_enddatetime = :expected_enddatetime, class_image = :class_image WHERE class_id = :class_id');
                        $stmt->bindValue(':class_title', $class_titles[$i]);
                        $stmt->bindValue(':code_basedtitle', $code_basedtitles[$i]);
                        $stmt->bindValue(':class_description', $class_descriptions[$i]);
                        $stmt->bindValue(':expected_startdatetime', $expected_startdatetimes[$i]);
                        $stmt->bindValue(':expected_enddatetime', $expected_enddatetimes[$i]);
                        $stmt->bindValue(':class_image', $image_name);
                        $stmt->bindValue(':class_id', $object_ids[$i], PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    $connect->commit();
                } catch (Exception $e) {
                    $connect->rollBack();
                    die('Error: ' . $e->getMessage());
                }
            }
            break;

        case 'delete_multiple':
            if (isset($_POST['ids'])) {
                $ids = $_POST['ids'];

                foreach ($ids as $id) {
                    // Optional: Remove the image file associated with the object
                    $stmt = $connect->prepare('SELECT class_image FROM classes WHERE class_id = :class_id');
                    $stmt->bindValue(':class_id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $object = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($object && $object['class_image']) {
                        $image_path = "../imageuploads/" . $object['class_image'];
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }

                    $stmt = $connect->prepare('DELETE FROM classes WHERE class_id = :class_id');
                    $stmt->bindValue(':class_id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
            break;

        case 'delete_single':
            if (isset($_POST['id'])) {
                $id = $_POST['id'];

                // Optional: Remove the image file associated with the object
                $stmt = $connect->prepare('SELECT class_image FROM classes WHERE class_id = :class_id');
                $stmt->bindValue(':class_id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $object = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($object && $object['class_image']) {
                    $image_path = "../imageuploads/" . $object['class_image'];
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $stmt = $connect->prepare('DELETE FROM classes WHERE class_id = :class_id');
                $stmt->bindValue(':class_id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            break;

        default:
            echo 'Invalid action';
    }
}

function upload_images($files) {
    $uploaded_images = [];
    foreach ($files['name'] as $key => $image) {
        if ($image) {
            $target = "../imageuploads/" . basename($image);
            if (move_uploaded_file($files['tmp_name'][$key], $target)) {
                $uploaded_images[$key] = $image;
            }
        }
    }
    return $uploaded_images;
}

function get_image_name($class_id) {
    global $connect;
    $stmt = $connect->prepare('SELECT class_image FROM classes WHERE class_id = :class_id');
    $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
    $stmt->execute();
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    return $existing['class_image'];
}
?>
