CREATE DATABASE login_system;
USE login_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    date DATE NOT NULL,
    file VARCHAR(255)
);

ALTER TABLE orders
ADD COLUMN birthdate DATE,
ADD COLUMN allergies VARCHAR(255) NULL;


CREATE TABLE IF NOT EXISTS medicine_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(100) NOT NULL,
    medicine_name VARCHAR(100) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    rejection_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pending_medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    quantity INT,
    date DATE,
    file VARCHAR(255),
    status ENUM('pending') DEFAULT 'pending'
);
CREATE TABLE  feedback   (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255),
    comment TEXT,
    rating INT
);