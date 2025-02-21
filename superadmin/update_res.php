<?php
include '../connection.php';

if (isset($_POST['update_res'])) {
    $res_id = $_POST['res_id'];
    $res_title = $_POST['res_title'];
    $res_number = $_POST['res_number'];

    // Handle file upload if a new file is provided
    if (!empty($_FILES['res_file']['name'])) {
        $file_name = basename($_FILES['res_file']['name']);
        $file_tmp = $_FILES['res_file']['tmp_name'];
        $upload_path = "uploads/" . $file_name; // Ensure the 'uploads' folder exists

        // Move the uploaded file
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $update_query = "UPDATE tbl_reso SET res_title='$res_title', res_number='$res_number', res_file_path='$upload_path' WHERE res_id='$res_id'";
        } else {
            echo "<script>alert('File upload failed!');</script>";
            exit();
        }
    } else {
        // Update without changing the file
        $update_query = "UPDATE tbl_reso SET res_title='$res_title', res_number='$res_number' WHERE res_id='$res_id'";
    }

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Resolution updated successfully!'); window.location.href='reso.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
