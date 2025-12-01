<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'db_connect.php';

// جلب الطلبات
$sql = "SELECT customer_name, contact_info, medicines, status FROM orders"; // اسم الجدول حسب اللي عندك
$result = $conn->query($sql);

$orders = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

// إرسال البيانات كـ JSON
header('Content-Type: application/json');
echo json_encode($orders);

$conn->close();
?>
