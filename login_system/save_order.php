<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'db_connect.php';

$data = json_decode(file_get_contents('php://input'), true);

// طباعة البيانات المرسلة لفحصها
var_dump($data);

if ($data && isset($data['name']) && isset($data['contact']) && isset($data['medicines'])) {
    $customerName = $data['name'];
    $contactInfo = $data['contact'];
    $medicines = implode(', ', $data['medicines']); // تحويل المصفوفة إلى نص مفصول بفواصل

    // إدخال البيانات في قاعدة البيانات
    foreach ($data['medicines'] as $medicine_name) {
        $medicine_name = $conn->real_escape_string($medicine_name);
        $sql = "INSERT INTO orders (customer_name, contact_info, medicines, status)
                VALUES ('$customerName', '$contactInfo', '$medicine_name', 'pending')";
        $conn->query($sql);
    }
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing or invalid data']);
}

$conn->close();
?>
