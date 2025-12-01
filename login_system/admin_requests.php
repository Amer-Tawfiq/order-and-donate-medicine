<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connect.php';

// تعديل الاستعلام ليشمل اسم المستخدم
$query = "SELECT pm.id, pm.name, pm.quantity, pm.date, pm.file, 
                 COALESCE(u.username, (SELECT username FROM users LIMIT 1)) as user_name
          FROM pending_medicines pm
          LEFT JOIN users u ON pm.user_id = u.id";  // ربط الجدولين


$result = $conn->query($query);

$requests = [];

while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($requests);
?>
