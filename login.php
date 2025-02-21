<?php
session_start();
include 'connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Please enter both username and password.";
        exit();
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM tbl_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

     // Verify password (plain text comparison)
if ($password === $user['password']) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    echo "success"; // AJAX will handle the redirection
    header("Location: superadmin/dash.php");
    exit();
} else {
    echo "Invalid credentials";
}

    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>
