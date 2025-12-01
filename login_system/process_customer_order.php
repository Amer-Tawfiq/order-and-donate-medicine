<?php
file_put_contents("php://stdout", print_r($_POST, true));

header("Access-Control-Allow-Origin: *"); // السماح لجميع النطاقات
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // السماح بالطلبات من النوع POST وGET
header("Access-Control-Allow-Headers: Content-Type"); // السماح بالرؤوس المطلوبة
header('Content-Type: application/json');


include 'db_connect.php';

// استلام البيانات من الفورم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // معرّف الطلب
    $action = $_POST['action']; // إما "approve" أو "reject"
    $reason = isset($_POST['reason']) ? $_POST['reason'] : ''; // سبب الرفض (إذا كان الرفض)

    // إذا كانت العملية قبول
    if ($action === 'approve') {
        // تحديث حالة الطلب إلى "مقبول"
        $stmt = $conn->prepare("UPDATE orders SET status = 'Approved' WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order approved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error approving the order']);
        }
    }
    // إذا كانت العملية رفض
    elseif ($action === 'reject') {
        // تحديث حالة الطلب إلى "مرفوض" مع سبب الرفض
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error rejecting the order']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// إغلاق الاتصال
$conn->close();
?>
