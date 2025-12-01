<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Log received data (check server error logs)
error_log("Received POST data: " . print_r($_POST, true));

include 'db_connect.php';

// Check if all required fields exist
if (empty($_POST['user_name']) || empty($_POST['comment']) || !isset($_POST['rating'])) {
    echo "error: Missing required data (user_name, comment, or rating)";
    exit();
}

$userName = $_POST['user_name'];
$comment = $_POST['comment'];
$rating = (int)$_POST['rating']; // Convert to integer

// Validate rating (e.g., 1-5)
if ($rating < 1 || $rating > 5) {
    echo "error: Rating must be between 1 and 5";
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO feedback (user_name, comment, rating) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $userName, $comment, $rating);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>