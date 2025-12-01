<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("يجب تسجيل الدخول أولاً.");
}
echo "مرحباً بك!";
?>
