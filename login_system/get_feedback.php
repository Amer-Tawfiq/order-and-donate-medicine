<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header("Content-Type: text/html; charset=UTF-8");

include 'db_connect.php';


// جلب كل التعليقات
$result = $conn->query("SELECT id, user_name, comment, rating FROM feedback");

$feedbacks = [];

while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

echo json_encode($feedbacks);

$conn->close();
?>
