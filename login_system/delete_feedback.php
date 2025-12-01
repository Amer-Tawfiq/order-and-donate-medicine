<?php
// عرض جميع الأخطاء للتصحيح
ini_set('display_errors', 1);
error_reporting(E_ALL);

// إعدادات CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: text/plain");

// الاتصال بقاعدة البيانات
include 'db_connect.php';

// استلام البيانات
$data = json_decode(file_get_contents("php://input"), true);

// التأكد من أن هناك ID مرسل
if (isset($data['id'])) {
    $id = intval($data['id']); // تأكد من أن id هو عدد صحيح

    // اختبار: هل الـ ID موجود فعلاً في قاعدة البيانات؟
    $check = $conn->prepare("SELECT id FROM feedback WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // الـ ID موجود - نكمل الحذف
        $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "success"; // تم الحذف بنجاح
        } else {
            echo "error deleting"; // حدث خطأ أثناء الحذف
        }
        $stmt->close();
    } else {
        echo "id_not_found"; // الـ ID غير موجود في قاعدة البيانات
    }
    $check->close();
} else {
    echo "invalid_request"; // لا يوجد ID مرسل في الطلب
}

$conn->close();
?>
