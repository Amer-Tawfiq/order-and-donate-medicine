<?php
header("Access-Control-Allow-Origin: *"); // السماح لجميع النطاقات
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // السماح بالطلبات من النوع POST وGET
header("Access-Control-Allow-Headers: Content-Type"); // السماح بالرؤوس المطلوبة

include 'db_connect.php';

// التأكد أن الفورم أرسل بيانات
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];

    // التعامل مع الصورة
    $file_name = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $uploads_dir = 'uploads';
        $file_name = basename($_FILES['file']['name']);
        $target_path = $uploads_dir . '/' . $file_name;
        
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            die("فشل رفع الصورة");
        }
    }

    // تجهيز واستدعاء أمر الإدخال
    $stmt = $conn->prepare("INSERT INTO pending_medicines (name, quantity, date, file) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $quantity, $date, $file_name);

    if ($stmt->execute()) {
        echo "✅ تم حفظ الدواء بنجاح في قاعدة البيانات.";
    } else {
        echo "❌ خطأ أثناء الحفظ: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ لم يتم إرسال البيانات بشكل صحيح.";
}

$conn->close();
?>
