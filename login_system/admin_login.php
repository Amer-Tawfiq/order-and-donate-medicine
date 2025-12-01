<?php

header("Access-Control-Allow-Origin: *"); // السماح لجميع النطاقات
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // السماح بالطلبات من النوع POST وGET
header("Access-Control-Allow-Headers: Content-Type"); // السماح بالرؤوس المطلوبة

include 'db_connect.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    if ($password === $admin['password']) {

        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
