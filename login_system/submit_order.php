<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'db_connect.php';

// التعامل مع OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// استقبال البيانات
$data = json_decode(file_get_contents('php://input'), true);

// تحقق من البيانات
if (isset($data['fullName'], $data['contact'], $data['medicines'])) {
    $fullName = $conn->real_escape_string($data['fullName']);
    $contact = $conn->real_escape_string($data['contact']);
    $medicines = $conn->real_escape_string(implode(', ', $data['medicines']));  // دمج الأدوية

    // إدخال الطلب في قاعدة البيانات باستخدام prepared statement
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, contact_info, medicines) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullName, $contact, $medicines);
    
    if ($stmt->execute()) {
        foreach ($data['medicines'] as $medicineName) {
            $medicineName = $conn->real_escape_string($medicineName);
            $insertMedicine = $conn->prepare("INSERT INTO medicines (name) VALUES (?)");
            $insertMedicine->bind_param("s", $medicineName);
            $insertMedicine->execute();
            $insertMedicine->close();
        }
    
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
}

$conn->close();
?>
