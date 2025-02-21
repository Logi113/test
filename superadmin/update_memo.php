<?php
include '../connection.php';

if (isset($_POST['update_memo'])) {
    $memo_id = $_POST['memo_id'];
    $memo_title = $_POST['memo_title'];
    $memo_number = $_POST['memo_number'];

    // Handle file upload if a new file is provided
    if (!empty($_FILES['memo_file']['name'])) {
        $file_name = basename($_FILES['memo_file']['name']);
        $file_tmp = $_FILES['memo_file']['tmp_name'];
        $upload_path = "uploads/" . $file_name; // Ensure the 'uploads' folder exists

        // Move the uploaded file
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $update_query = "UPDATE tbl_memo SET memo_title='$memo_title', memo_number='$memo_number', memo_file_path='$upload_path' WHERE memo_id='$memo_id'";
        } else {
            echo "<script>alert('File upload failed!');</script>";
            exit();
        }
    } else {
        // Update without changing the file
        $update_query = "UPDATE tbl_memo SET memo_title='$memo_title', memo_number='$memo_number' WHERE memo_id='$memo_id'";
    }

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Memo updated successfully!'); window.location.href='memo.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
