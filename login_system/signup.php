<?php
include 'db_connect.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = $_POST['username'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthdate = $_POST['birthdate'];

    // الحساسية: لو ما كتب شي واختار "لا يوجد حساسية"
    if (isset($_POST['no_allergies'])) {
        $allergies = "None";
    } else {
        $allergies = $_POST['allergies'];
    }

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, birthdate, allergies) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $birthdate, $allergies);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
