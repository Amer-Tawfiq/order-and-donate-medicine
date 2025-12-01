<?php
header("Access-Control-Allow-Origin: *"); // السماح لجميع النطاقات
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // السماح بالطلبات من النوع POST وGET
header("Access-Control-Allow-Headers: Content-Type"); // السماح بالرؤوس المطلوبة

include 'db_connect.php';

// تحقق من إرسال البيانات
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // جلب البيانات من النموذج
    $name = $_POST['name'];
    $image = $_FILES['image'];

    // التحقق من صحة البيانات
    if (empty($name) || empty($image)) {
        die("Medication name and image are required.");
    }

    // معالجة الصورة (رفعها إلى مجلد `uploads`)
    $image_name = basename($image['name']);
    $image_tmp = $image['tmp_name'];
    $image_path = 'uploads/' . $image_name;

    if (!move_uploaded_file($image_tmp, $image_path)) {
        die("Error uploading the image.");
    }

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO medicines_admin (medicine_name, image) VALUES ('$name', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        echo "Medication added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // إغلاق الاتصال
    mysqli_close($conn);
}
?>
