create database project1;
use project1;
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE
);
CREATE TABLE customers(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    address VARCHAR(200)
);
CREATE TABLE product_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30),
    description VARCHAR(100)
);
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_code VARCHAR(100) UNIQUE,
    name VARCHAR(100),
    buy_price INT,
    type_id INT,
    description VARCHAR(500),
    image VARCHAR(1000),
    FOREIGN KEY (type_id) REFERENCES product_types(id)
);
CREATE TABLE laptop_product_details (    
    id INT PRIMARY KEY AUTO_INCREMENT, -- Cột số thứ tự
    product_code VARCHAR(100),
    cpu VARCHAR(255), -- CPU
    ram VARCHAR(255), -- RAM
    storage VARCHAR(255), -- Ổ cứng
    graphics_card VARCHAR(255), -- Card đồ họa
    display VARCHAR(255), -- Màn hình
    connectivity VARCHAR(255), -- Cổng kết nối
    keyboard VARCHAR(255), -- Bàn phím
    webcam VARCHAR(255), -- Webcam
    security VARCHAR(255), -- Bảo mật
    audio VARCHAR(255), -- Âm thanh
    wifi_bluetooth VARCHAR(255), -- Wifi và Bluetooth
    battery VARCHAR(255), -- Pin
    operating_system VARCHAR(255), -- Hệ điều hành
    weight VARCHAR(50), -- Trọng lượng
    color VARCHAR(50), -- Màu sắc
    dimensions VARCHAR(50),-- Kích thước
    FOREIGN KEY (product_code) REFERENCES products(product_code)
);
CREATE TABLE orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    admin_id INT,
    total_price INT,
    order_date DATE,
    status TINYINT, -- Sử dụng kiểu dữ liệu TINYINT cho trạng thái (chưa duyệt/đã duyệt)
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id)
);
CREATE TABLE order_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    price INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    F
