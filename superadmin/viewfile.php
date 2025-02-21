<?php
if (isset($_GET['memo_file_path'])) {
    $file = urldecode($_GET['memo_file_path']); // Decode the file path
    if (file_exists($file)) {
        $mimeType = mime_content_type($file);
        header("Content-Type: $mimeType");
        header("Content-Disposition: inline; filename=\"" . basename($file) . "\"");
        readfile($file);
        exit;
    } else {
        echo "File not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>