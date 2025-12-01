<?php
$host = "localhost";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إنشاء قاعدة البيانات
$sql = "CREATE DATABASE IF NOT EXISTS login_system";
if ($conn->query($sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// استخدام قاعدة البيانات
$conn->select_db("login_system");

// إنشاء جدول users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    birthdate DATE,
    allergies VARCHAR(255) NULL
)";
if ($conn->query($sql)) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql)) {
    echo "Table 'admins' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// إنشاء جدول medicines
$sql = "CREATE TABLE IF NOT EXISTS medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    date DATE NOT NULL,
    file VARCHAR(255)
)";
if ($conn->query($sql)) {
    echo "Table 'medicines' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// إنشاء جدول medicine_orders
$sql = "CREATE TABLE IF NOT EXISTS medicine_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(100) NOT NULL,
    medicine_name VARCHAR(100) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    rejection_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql)) {
    echo "Table 'medicine_orders' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// إنشاء جدول pending_medicines
$sql = "CREATE TABLE IF NOT EXISTS pending_medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    quantity INT,
    date DATE,
    file VARCHAR(255),
    status ENUM('pending') DEFAULT 'pending'
)";
if ($conn->query($sql)) {
    echo "Table 'pending_medicines' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}
$sql = "CREATE TABLE IF NOT EXISTS rejected_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    quantity INT,
    date DATE,
    file VARCHAR(255),
    reason TEXT
)";
if ($conn->query($sql)) {
    echo "Table 'rejected_requests' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS medicines_admin  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_name  VARCHAR(100),
    image VARCHAR(255)
)";
if ($conn->query($sql)) {
    echo "Table 'medicines_admin' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}
$sql = "CREATE TABLE IF NOT EXISTS feedback  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255),
    comment TEXT,
    rating INT
)";
if ($conn->query($sql)) {
    echo "Table 'feedback' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}



$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255) NOT NULL,
    medicines TEXT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
    status VARCHAR(50) DEFAULT 'pending'
);
    
";
if ($conn->query($sql)) {
    echo "Table 'orders' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>


