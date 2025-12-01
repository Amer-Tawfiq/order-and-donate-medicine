<?php
header("Access-Control-Allow-Origin: *"); // السماح لجميع النطاقات
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // السماح بالطلبات من النوع POST وGET
header("Access-Control-Allow-Headers: Content-Type"); // السماح بالرؤوس المطلوبة


include 'db_connect.php';

header('Content-Type: application/json'); // ✅ مهم جداً

$id = $_POST['id'];
$action = $_POST['action'];
$reason = $_POST['reason'] ?? null;

// جلب بيانات الطلب
$stmt = $conn->prepare("SELECT * FROM pending_medicines WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$medicine = $result->fetch_assoc();
$stmt->close();

if (!$medicine) {
    echo json_encode(["status" => "error", "message" => "الطلب غير موجود"]);
    exit;
}

if ($action === 'approve') {
    $stmt = $conn->prepare("INSERT INTO medicines (name, quantity, date, file) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $medicine['name'], $medicine['quantity'], $medicine['date'], $medicine['file']);
    $stmt->execute();
} elseif ($action === 'reject') {
    $stmt = $conn->prepare("INSERT INTO rejected_requests (name, quantity, date, file, reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $medicine['name'], $medicine['quantity'], $medicine['date'], $medicine['file'], $reason);
    $stmt->execute();
}

$stmt = $conn->prepare("DELETE FROM pending_medicines WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["status" => "success", "message" => "تمت المعالجة بنجاح"]);
?>
