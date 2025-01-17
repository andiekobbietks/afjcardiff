<?php
// Set the maximum file size to 100 megabytes
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');

function showSuccessMessage($message) {
    echo '<div class="alert alert-success" id="message">' . $message . '</div>';
    addDisappearScript();
}

function showErrorMessage($message) {
    echo '<div class="alert alert-danger" id="message">' . $message . '</div>';
    addDisappearScript();
}

function addDisappearScript() {
    echo '
    <script>
        setTimeout(function() {
            var messageDiv = document.getElementById("message");
            if (messageDiv) {
                messageDiv.style.display = "none";
            }
        }, 3000);
    </script>';
}

if (!empty($_FILES)) {
    $file_extension = strtolower(pathinfo($_FILES["uploadFile"]["name"], PATHINFO_EXTENSION));

    $new_file_name = rand() . '.' . $file_extension;

    $source_path = $_FILES["uploadFile"]["tmp_name"];

    $target_path = '../imageuploads/' . $new_file_name;

    if (move_uploaded_file($source_path, $target_path)) {
        showSuccessMessage('File uploaded successfully!');

        if (in_array($file_extension, array("jpg", "jpeg", "png"))) { // Check if the file is an image
            echo '<div class="text-center"><img src="' . $target_path . '" class="img-fluid img-thumbnail" alt="Uploaded Image" /></div><br />';
        } elseif (in_array($file_extension, array("mp4", "m4a", "webm", "ogg", "mov", "3gp", "avi", "mkv"))) { // Check if the file is a video
            echo '
            <div class="embed-responsive embed-responsive-16by9 mb-4">
                <video class="embed-responsive-item" controls src="' . $target_path . '"></video>
            </div>';
        }
    } else {
        showErrorMessage('Error: File upload failed.');
    }
} else {
    showErrorMessage('Error: No file uploaded.');
}
?>
