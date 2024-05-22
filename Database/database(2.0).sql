-- Tạo cơ sở dữ liệu
CREATE DATABASE project1;

-- Sử dụng cơ sở dữ liệu project1
USE project1;

-- Tạo bảng admins
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    phone INT(10) NOT NULL UNIQUE
);

-- Tạo bảng customers
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEYKEY,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    phone INT(10) NOT NULL UNIQUE,
    address VARCHAR(200)
);

-- Tạo bảng product_types
CREATE TABLE product_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30),
    description VARCHAR(100)
);

-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(20) UNIQUE,
    name VARCHAR(100),
    buy_price INT,
    type_id INT,
    description VARCHAR(500),
    image VARCHAR(1000),
    FOREIGN KEY (type_id) REFERENCES product_types(id)
);

-- Tạo bảng laptop_product_detail
CREATE TABLE laptop_product_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(20),
    cpu VARCHAR(50),
    ram VARCHAR(50),
    hard_drive VARCHAR(50),
    screen VARCHAR(50),
    graphics_card VARCHAR(50),
    ports VARCHAR(200),
    operating_system VARCHAR(50),
    design VARCHAR(50),
    dimensions VARCHAR(100),
    launch_date DATE,
    FOREIGN KEY (product_code) REFERENCES products(product_code)
);

-- Tạo bảng orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    admin_id INT,
    total_price INT,
    order_date DATE,
    status TINYINT,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (admin_id) REFERENCES admins(id)
);

-- Tạo bảng order_detail
CREATE TABLE IF NOT EXISTS order_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    price INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
-- Thêm dữ liệu vào bảng products
INSERT INTO product_types(name ,description)
VALUES ('Laptop','hang moiw');
INSERT INTO products (product_code, name, buy_price, type_id, description, image)
VALUES ('HP15SFQ5229TU', 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 16000, 1, 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/313084/hp-15s-fq5229tu-i3-8u237pa-thumb-600x600.png');

-- Thêm dữ liệu vào bảng laptop_product_detail
INSERT INTO laptop_product_detail (product_code, cpu, ram, hard_drive, screen, graphics_card, ports, operating_system, design, dimensions, launch_date)
VALUES ('HP15SFQ5229TU', 'i31215U1.2GHz', '8 GB DDR4 2 khe (1 khe 8 GB + 1 khe rời) 3200 MHz', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080)', 'Card tích hợp Intel UHD', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB Type-A, 1 x USB Type-C (chỉ hỗ trợ truyền dữ liệu)', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 242 mm - Dày 17.9 mm - Nặng 1.69 kg', '2023-01-01');
Select * from product_types;
Select * from laptop_product_detail;
