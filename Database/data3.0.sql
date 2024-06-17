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
    id INT AUTO_INCREMENT PRIMARY KEY,
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
VALUES ('Laptop','hang moi');
INSERT INTO products (product_code, name, buy_price, type_id, description, image)
VALUES ('HP15SFQ5229TU', 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 160600, 1, 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/313084/hp-15s-fq5229tu-i3-8u237pa-thumb-600x600.png'),
	   ('HP15SFQ5229TX','Laptop Acer Gaming Aspire 5 A515 58GM 53PZ i5 13420H/8GB/512GB/4GB RTX2050/Win11',123123,NULL,NULL,'https://cdn.tgdd.vn/Products/Images/44/325699/acer-aspire-a515-58gm-53pz-i5-nxkq4sv008-thumb-600x600.jpg'),
       ('HP15SFQ5229TQ','Laptop MSI Gaming GF63 Thin 12UCX i5 12450H/16GB/512GB/4GB RTX2050/144Hz/Win11',4561651,null,null,'https://cdn.tgdd.vn/Products/Images/44/316940/msi-gaming-gf63-thin-12ucx-i5-873vn-glr-thumb-600x600.jpg'),
       ('HP15SFQ5229TQ3','Laptop HP Gaming VICTUS 15 fa1139TX i5 12450H/16GB/512GB/4GB RTX2050/144Hz/Win11',5616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/318163/hp-victus-15-fa1139tx-i5-8y6w3pa-thumb-600x600.jpg'),
       ('HP15SFQ5229TQq','Laptop Lenovo Ideapad Gaming 3 15ACH6 R5 5500H/16GB/512GB/4GB RTX2050/144Hz/Win11',216515,null,null,'https://cdn.tgdd.vn/Products/Images/44/313667/lenovo-ideapad-gaming-3-15ach6-r5-82k2027pvn-600x600.png'),
       ('HP15SFQ5229TQư','Acer Gaming Nitro 5 Tiger AN515 58 769J i7 12700H',2616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/313332/acer-nitro-5-an515-58-769j-i7-nhqfhsv003-thumb-600x600.jpg'),
       ('HP15SFQ5229TQe','Asus TUF Gaming F15 FX507ZC4 i5 12500H',1216515,null,null,'https://cdn.tgdd.vn/Products/Images/44/317709/asus-tuf-gaming-f15-fx507zc4-i5-hn229w-thumb-600x600.jpg'),
       ('HP15SFQ5229TQr','Lenovo LOQ Gaming 15IAX9 i5 12450HX (83GS000JVN)',3336515,null,null,'https://cdn.tgdd.vn/Products/Images/44/322072/lenovo-loq-gaming-15iax9-i5-83gs000jvn-thumb-new-600x600.jpg'),
       ('HP15SFQ5229TQt','MSI Gaming GF63 Thin 12UC i7 12650H (887VN)',6216515,null,null,'https://cdn.tgdd.vn/Products/Images/44/316941/msi-gaming-gf63-thin-12uc-i7-887vn-glr-thumb-600x600.jpg'),
       ('HP15SFQ5229TQy','Asus TUF Gaming F15 FX507ZC4 i5 12500H (HN229W)',3616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/317709/asus-tuf-gaming-f15-fx507zc4-i5-hn229w-thumb-600x600.jpg'),
       ('HP15SFQ5229TQuu','HP Gaming VICTUS 15 fa1139TX i5 12450H (8Y6W3PA)',444515,null,null,'https://cdn.tgdd.vn/Products/Images/44/318163/hp-victus-15-fa1139tx-i5-8y6w3pa-thumb-600x600.jpg'),
       ('HP15SFQ5229TQi','Acer Gaming Aspire 7 A715 43G R8GA R5 5625U',3616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/285961/acer-aspire-7-gaming-a715-43g-r8ga-r5-nhqhdsv002-thumb-600x600.jpg'),
       ('HP15SFQ5229TQo','Lenovo Ideapad Gaming 3 15ACH6 R5 5500H',23616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/313667/lenovo-ideapad-gaming-3-15ach6-r5-82k2027pvn-600x600.png'),
       ('HP15SFQ5229TQp','MSI Gaming Bravo 15 B7ED R5 7535HS (010VN)',9916515,null,null,'https://cdn.tgdd.vn/Products/Images/44/314849/msi-bravo-15-b7ed-r5-010vn-thumb-2-600x600.png'),
       ('HP15SFQ5229TQa','Acer Gaming Nitro V ANV15 51 53NE i5 13420H',2006515,null,null,'https://cdn.tgdd.vn/Products/Images/44/319657/acer-nitro-v-anv15-51-53ne-i5-nhqnasv002-thumb-600x600.jpg'),
       ('HP15SFQ5229TQs','HP Gaming VICTUS 15 fa1139TX i5 12450H (8Y6W3PA)',6616515,null,null,'https://cdn.tgdd.vn/Products/Images/44/263983/acer-nitro-5-gaming-an515-57-5669-i5-11400h-8gb-512gb-144hz-4gb-gtx1650-win11-nhqehsv001-031221-100506-600x600.jpg');
       
-- Thêm dữ liệu vào bảng laptop_product_detail
INSERT INTO laptop_product_detail (product_code, cpu, ram, hard_drive, screen, graphics_card, ports, operating_system, design, dimensions, launch_date)
VALUES
	   ('HP15SFQ5229TU','Ryzen 57535HS3.3GHz','16 GBDDR5 2 khe (1 khe 8 GB + 1 khe 8 GB)4800 MHz','512 GB SSD NVMe PCIe 4.0','15.6"Full HD (1920 x 1080) 144Hz','Card rờiRTX 3050 4GB','LAN (RJ45)Jack tai nghe 3.5 mmHDMI3 x USB 3.21 x USB Type-C (hỗ trợ DisplayPort)','Windows 11 Home SL','Vỏ nhựa','Dài 359 mm - Rộng 256 mm - Dày 24.5 mm - Nặng 2.3 kg','01-02-2024'),
	   ('HP15SFQ5229TX','Ryzen 57535HS3.3GHz','16 GBDDR5 2 khe (1 khe 8 GB + 1 khe 8 GB)4800 MHz','512 GB SSD NVMe PCIe 4.0','15.6"Full HD (1920 x 1080) 144Hz','Card rờiRTX 3050 4GB','LAN (RJ45)Jack tai nghe 3.5 mmHDMI3 x USB 3.21 x USB Type-C (hỗ trợ DisplayPort)','Windows 11 Home SL','Vỏ nhựa','Dài 359 mm - Rộng 256 mm - Dày 24.5 mm - Nặng 2.3 kg','01-02-2024'),
	   ('HP15SFQ5229TQ','Ryzen 57535HS3.3GHz','16 GBDDR5 2 khe (1 khe 8 GB + 1 khe 8 GB)4800 MHz','512 GB SSD NVMe PCIe 4.0','15.6"Full HD (1920 x 1080) 144Hz','Card rờiRTX 3050 4GB','LAN (RJ45)Jack tai nghe 3.5 mmHDMI3 x USB 3.21 x USB Type-C (hỗ trợ DisplayPort)','Windows 11 Home SL','Vỏ nhựa','Dài 359 mm - Rộng 256 mm - Dày 24.5 mm - Nặng 2.3 kg','01-02-2024');
