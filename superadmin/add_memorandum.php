<?php
ob_start(); // Start output buffering
include '../connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
ob_clean(); // Clear any previous output

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memoNumber = $_POST['memo_number'] ?? '';
    $memoTitle = $_POST['memo_title'] ?? '';
    $filePath = null;

    if (empty($memoNumber) || empty($memoTitle)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    // Handle File Upload
    if (!empty($_FILES['memo_file_path']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = basename($_FILES['memo_file_path']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowedTypes = ['pdf', 'doc', 'docx'];
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["success" => false, "message" => "Invalid file format."]);
            exit;
        }

        if (!move_uploaded_file($_FILES['memo_file_path']['tmp_name'], $targetFilePath)) {
            echo json_encode(["success" => false, "message" => "File upload failed."]);
            exit;
        }

        $filePath = $targetFilePath;
    }

    // Insert into database
    $query = "INSERT INTO tbl_memo (memo_number, memo_title, memo_file_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Database error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("sss", $memoNumber, $memoTitle, $filePath);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Memorandum added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Database insertion failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
