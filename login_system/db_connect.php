<?php
$host = "localhost";
$user = "root"; // غيره إذا كان لديك اسم مستخدم مختلف
$pass = ""; // ضع كلمة المرور الخاصة بك إذا كنت تستخدم واحدة
$dbname = "login_system";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
