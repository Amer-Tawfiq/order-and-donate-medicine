<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: text/html; charset=UTF-8");

include 'db_connect.php';

// استعلام لجلب الأدوية من قاعدة البيانات
$query = "SELECT * FROM medicines_admin";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo '<div class="product-container">';
    while ($row = $result->fetch_assoc()) {
        // استرجاع بيانات الدواء
        $medicineName = $row['medicine_name'];
        $imageFile = $row['image'];
        
        echo '<div class="product">';
        echo '<div class="image-container">';
        // عرض الصورة إذا كانت موجودة
        if (!empty($imageFile)) {
            echo '<img src="http://localhost/login_system/uploads/' . htmlspecialchars($imageFile) . '" alt="' . htmlspecialchars($medicineName) . '">';
        } else {
            // صورة افتراضية إذا لم توجد صورة
            echo '<img src="images/default.jpg" alt="' . htmlspecialchars($medicineName) . '">';
        }
        echo '</div>';
        echo '<div class="product-info">';
        echo '<h3>' . htmlspecialchars($medicineName) . '</h3>';
        echo '<button class="add-to-cart" onclick="addToCart(\'' . htmlspecialchars($medicineName) . '\', 0)">ADD TO CART</button>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "❌ لا توجد أدوية لعرضها.";
}

$conn->close();
?>
