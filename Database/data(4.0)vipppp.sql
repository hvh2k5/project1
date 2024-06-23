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
VALUES
    ('NJ776W', 'Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11', 20728849, 1, 'Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Chuột/Win11', 'https://cdn.tgdd.vn/Products/Images/44/311178/asus-vivobook-go-15-e1504fa-r5-nj776w-glr-2.jpg'),
    ('NJ102W', 'Laptop Asus Vivobook 15 X1504ZA i3 1215U/8GB/512GB/Win11', 14958902, 1, 'Laptop Asus Vivobook 15 X1504ZA i3 1215U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/312414/asus-vivobook-15-x1504za-i3-nj102w-hinh-2.jpg'),
    ('L1337W', 'Laptop Asus Vivobook 15 OLED A1505ZA i5 12500H/16GB/512GB/Win11', 28738456, 1, 'Laptop Asus Vivobook 15 OLED A1505ZA i5 12500H/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/311180/asus-vivobook-15-oled-a1505za-i5-l1337w-hinh-2.jpg'),
    ('NK376W', 'Laptop Asus Vivobook X1404ZA i5 1235U/16GB/512GB/Win11', 20478677, 1, 'Laptop Asus Vivobook X1404ZA i5 1235U/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/322270/asus-vivobook-x1404za-i5-nk376w-glr-2.jpg'),
    ('NK246W', 'Laptop Asus Vivobook X1404ZA i3 1215U/8GB/512GB/Win11', 15294765, 1, 'Laptop Asus Vivobook X1404ZA i3 1215U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/317712/asus-vivobook-x1404za-i3-nk246w-glr-2.jpg'),
    ('L1341W', 'Laptop Asus Vivobook 15 OLED A1505VA i5 13500H/16GB/512GB/Chuột/Win11', 29915842, 1, 'Laptop Asus Vivobook 15 OLED A1505VA i5 13500H/16GB/512GB/Chuột/Win11', 'https://cdn.tgdd.vn/Products/Images/44/310839/asus-vivobook-15-oled-a1505va-i5-l1341w-2.jpg'),
    ('HN012W', 'Laptop Asus TUF Gaming A15 FA506NF R5 7535HS/16GB/512GB/4GB RTX2050/144Hz/Win11', 26973621, 1, 'Laptop Asus TUF Gaming A15 FA506NF R5 7535HS/16GB/512GB/4GB RTX2050/144Hz/Win11', 'https://cdn.tgdd.vn/Products/Images/44/322269/asus-tuf-gaming-a15-fa506nf-r5-hn012w-glr-2.jpg'),
    ('MB360W', 'Laptop Asus Vivobook 16 X1605VA i5 1335U/16GB/512GB/Win11', 23490543, 1, 'Laptop Asus Vivobook 16 X1605VA i5 1335U/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/309375/asus-vivobook-16-x1605va-i5-mb360w-glr-2-1.jpg'),
    ('HN229W', 'Laptop Asus TUF Gaming F15 FX507ZC4 i5 12500H/16GB/1TB/4GB RTX3050/144Hz/Win11', 29867251, 1, 'Laptop Asus TUF Gaming F15 FX507ZC4 i5 12500H/16GB/1TB/4GB RTX3050/144Hz/Win11', 'https://cdn.tgdd.vn/Products/Images/44/317709/asus-tuf-gaming-f15-fx507zc4-i5-hn229w-hinh-2.jpg'),
    ('NK050W', 'Laptop Asus Vivobook 14 X1404VA i5 1335U/16GB/512GB/Win11', 21378954, 1, 'Laptop Asus Vivobook 14 X1404VA i5 1335U/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/317704/asus-vivobook-14-x1404va-i5-nk050w-glr-2.jpg'),
    ('25P231', 'Laptop Dell Inspiron 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/KYHD/Win11', 24015879, 2, 'Laptop Dell Inspiron 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/KYHD/Win11', 'https://cdn.tgdd.vn/Products/Images/44/321192/dell-inspiron-15-3520-i5-25p231-1-2.jpg'),
    ('i5U165W11GRU', 'Laptop Dell Vostro 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/KYHD/Win11', 26384563, 2, 'Laptop Dell Vostro 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/KYHD/Win11', 'https://cdn.tgdd.vn/Products/Images/44/324340/dell-vostro-15-3520-i5-i5u165w11gru-2.jpg'),
    ('N5I5052W1', 'Laptop Dell Inspiron 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/Win11', 25273804, 2, 'Laptop Dell Inspiron 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/325242/dell-inspiron-15-3520-i5-n5i5052w1-1.jpg'),
    ('5M2TT2', 'Laptop Dell Vostro 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/Win11', 19428753, 2, 'Laptop Dell Vostro 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/303835/dell-vostro-15-3520-i5-5m2tt2-glr-2.jpg'),
    ('i5U085W11BLU', 'Laptop Dell Inspiron 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/Win11', 17146985, 2, 'Laptop Dell Inspiron 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/296921/dell-inspiron-15-3520-i5u085w11blu-ab-2.jpg'),
    ('i3U082W11BLU', 'Laptop Dell Inspiron 15 3520 i3 1215U/8GB/256GB/120Hz/OfficeHS/Win11', 12689765, 2, 'Laptop Dell Inspiron 15 3520 i3 1215U/8GB/256GB/120Hz/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/302266/dell-inspiron-15-3520-i3-i3u082w11blu-glr-2-1.jpg'),
    ('V5I3614W1', 'Laptop Dell Vostro 15 3520 i3 1215U/8GB/256GB/OfficeHS/Win11', 12459872, 2, 'Laptop Dell Vostro 15 3520 i3 1215U/8GB/256GB/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/305655/dell-vostro-3520-i3-v5i3614w1-glr-2.jpg'),
    ('N3530I716W1', 'Laptop Dell Inspiron 15 3530 i7 1355U/16GB/512GB/2GB MX550/OfficeHS/Win11', 29865842, 2, 'Laptop Dell Inspiron 15 3530 i7 1355U/16GB/512GB/2GB MX550/OfficeHS/Win11', 'https://cdn.tgdd.vn/Products/Images/44/314841/dell-inspiron-15-3530-i7-n3530i716w1-2-1.jpg'),
    ('V5I5610W1', 'Laptop Dell Vostro 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/KYHD/Win11', 23689754, 2, 'Laptop Dell Vostro 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/KYHD/Win11', 'https://cdn.tgdd.vn/Products/Images/44/322070/dell-vostro-15-3520-i5-v5i5610w1-2.jpg'),
    ('71027003', 'Laptop Dell Inspiron 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/KYHD/Win11', 25378421, 2, 'Laptop Dell Inspiron 15 3520 i5 1235U/8GB/512GB/120Hz/OfficeHS/KYHD/Win11', 'https://cdn.tgdd.vn/Products/Images/44/321193/dell-inspiron-15-3520-i5-71027003-glr-2.jpg'),
    ('8U237PA', 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 18349872, 3, 'Laptop HP 15s fq5229TU i3 1215U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/313084/hp-15s-fq5229tu-i3-8u237pa-glr-1.jpg'),
    ('7C0Q4PA', 'Laptop HP Pavilion 15 eg2081TU i5 1240P/16GB/512GB/Win11', 27987254, 3, 'Laptop HP Pavilion 15 eg2081TU i5 1240P/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/309565/hp-pavilion-15-eg2081tu-i5-7c0q4pa-2.jpg'),
    ('6L1X7PA', 'Laptop HP 240 G9 i3 1215U/8GB/256GB/Win11', 16298754, 3, 'Laptop HP 240 G9 i3 1215U/8GB/256GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/311114/hp-240-g9-i3-6l1x7pa-glr-2.jpg'),
    ('6L1Y2PA', 'Laptop HP 240 G9 i5 1235U/8GB/512GB/Win11', 21389765, 3, 'Laptop HP 240 G9 i5 1235U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/285963/hp-240-g9-i5-6l1y2pa-fix-2-1.jpg'),
    ('8F155PA', 'Laptop HP 245 G10 R5 7520U/8GB/512GB/Win11', 20987543, 3, 'Laptop HP 245 G10 R5 7520U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/312871/hp-245-g10-r5-8f155pa-glr-2.jpg'),
    ('94F19PA', 'Laptop HP Gaming VICTUS 15 fb1022AX R5 7535HS/16GB/512GB/4GB RTX2050/144Hz/Win11', 27659872, 3, 'Laptop HP Gaming VICTUS 15 fb1022AX R5 7535HS/16GB/512GB/4GB RTX2050/144Hz/Win11', 'https://cdn.tgdd.vn/Products/Images/44/321467/hp-victus-15-fb1022ax-r5-94f19pa-hinh-2.jpg'),
    ('7C134PA', 'Laptop HP 15s fq5162TU i5 1235U/8GB/512GB/Win11', 23498765, 3, 'Laptop HP 15s fq5162TU i5 1235U/8GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/302532/hp-15s-fq5162tu-i5-7c134pa-2.jpg'),
    ('7C0P2PA', 'Laptop HP Pavilion 14 dv2073TU i5 1235U/16GB/512GB/Win11', 24987543, 3, 'Laptop HP Pavilion 14 dv2073TU i5 1235U/16GB/512GB/Win11', 'https://cdn.tgdd.vn/Products/Images/44/322223/hp-pavilion-14-dv2073tu-i5-7c0p2pa-2-2.jpg');



	   
       
-- Thêm dữ liệu vào bảng laptop_product_detail
INSERT INTO laptop_product_detail (product_code, cpu, ram, hard_drive, screen, graphics_card, ports, operating_system, design, dimensions, launch_date)
 VALUES
        ('NJ776W', 'Ryzen 5 7520U 2.8GHz', '16 GB LPDDR5 (Onboard) 5500 MHz', '512 GB SSD NVMe PCIe (removable, up to 1 TB)', '15.6" Full HD (1920 x 1080)', 'Integrated Radeon Graphics', 'USB Type-C, 1 x Headphone jack 3.5mm, HDMI, 1 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Plastic case', '360.3 mm (L) x 232.5 mm (W) x 17.9 mm (H), 1.63 kg', '2023-05-18'),
        ('NJ102W', 'i3-1215U 1.2GHz', '8 GB DDR4 3200 MHz (1 x 8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080)', 'Intel UHD', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 359.7 mm - Rộng 232.5 mm - Dày 17.9 mm - Nặng 1.7 kg', '2023-05-18'),
		('L1337W', 'i5-12500H 2.5GHz', '16 GB DDR4 2933 MHz (8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 1 TB)', '15.6" Full HD (1920 x 1080) OLED', 'Intel Iris Xe', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 356.8 mm - Rộng 227.6 mm - Dày 19.9 mm - Nặng 1.7 kg', '2023-05-18'),
		('NK376W', 'i5-1235U 1.3GHz', '16 GB DDR4 3200 MHz (8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '14" Full HD (1920 x 1080)', 'Intel Iris Xe', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 324.9 mm - Rộng 213.9 mm - Dày 17.9 mm - Nặng 1.4 kg', '2023-05-18'),
		('NK246W', 'i3-1215U 1.2GHz', '8 GB DDR4 2933 MHz (1 x 8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '14" Full HD (1920 x 1080)', 'Intel UHD', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 324.9 mm - Rộng 213.9 mm - Dày 17.9 mm - Nặng 1.4 kg', '2023-05-18'),
		('L1341W', 'i5-13500H 2.6GHz', '16 GB DDR4 3200 MHz (8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) OLED', 'Intel Iris Xe', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB Type-C (chỉ hỗ trợ Power Delivery), 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 356.8 mm - Rộng 227.6 mm - Dày 19.9 mm - Nặng 1.7 kg', '2023-05-18'),
		('HN012W', 'Ryzen 5 7535HS 3.3GHz', '16 GB DDR5 4800 MHz (1 x 8 GB + 1 x 8 GB)', '512 GB SSD NVMe PCIe 4.0 (Có thể tháo ra, lắp thanh khác tối đa 1 TB)', '15.6" Full HD (1920 x 1080) 144Hz', 'RTX 2050 4GB', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 3 x USB 3.2, 1 x USB Type-C (hỗ trợ DisplayPort)', 'Windows 11 Home SL', 'Vỏ nhựa - nắp lưng bằng kim loại', 'Dài 359 mm - Rộng 256 mm - Dày 24.5 mm - Nặng 2.3 kg', '2023-05-18'),
		('MB360W', 'i5-1335U 1.3GHz', '16 GB DDR4 3200 MHz (8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '16" WUXGA (1920 x 1200)', 'Intel Iris Xe', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB Type-C (chỉ hỗ trợ Power Delivery), 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 358.7 mm - Rộng 249.5 mm - Dày 19.9 mm - Nặng 1.88 kg', '2023-04-20'),
		('HN229W', 'i5-12500H 2.5GHz', '16 GB DDR4 3200 MHz (1 x 8 GB + 1 x 8 GB)', '1 TB SSD M.2 PCIe (Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng)', '15.6" Full HD (1920 x 1080) 144Hz', 'RTX 3050 4GB', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB Type-C 3.2 (hỗ trợ DisplayPort / G-SYNC), 1 x Thunderbolt 4 (hỗ trợ DisplayPort)', 'Windows 11 Home SL', 'Vỏ nhựa - nắp lưng bằng kim loại', 'Dài 354 mm - Rộng 251 mm - Dày 22.4 ~ 24.9 mm - Nặng 2.2 kg', '2023-04-20'),
		('NK050W', 'i5-1335U 1.3GHz', '16 GB DDR4 2933 MHz (8 GB onboard + 1 x 8 GB)', '512 GB SSD NVMe PCIe 4.0 (Có thể tháo ra, lắp thanh khác tối đa 1 TB)', '14" Full HD (1920 x 1080)', 'Intel Iris Xe', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 324.9 mm - Rộng 213.9 mm - Dày 17.9 mm - Nặng 1.4 kg', '2023-04-20'),
		('25P231', 'i5-1235U 1.3GHz', '16 GB DDR4 2666 MHz (1 x 8 GB + 1 x 8 GB)', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel Iris Xe', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student vĩnh viễn', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 18.99 mm - Nặng 1.9 kg', '2022'),
		('i5U165W11GRU', 'i5-1235U 1.3GHz', '16 GB DDR4 2666 MHz (1 x 8 GB + 1 x 8 GB)', '512 GB SSD NVMe PCIe Gen 4.0', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel Iris Xe', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student vĩnh viễn', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 18.99 mm - Nặng 1.9 kg', '2023-04-20'),
        ('i3U082W11BLU', 'i31215U 1.2GHz', '8 GB DDR4', '256 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel UHD', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 16.96 ~ 18.99 mm - Nặng 1.9 kg', '2022-05-15'),
		('V5I3614W1', 'i31215U 1.2GHz', '8 GB DDR4', '256 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel UHD', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 18.99 mm - Nặng 1.83 kg', '2022-06-12'),
		('N3530I716W1', 'i71355U 1.7GHz', '16 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'MX550 2GB', 'Jack tai nghe 3.5 mm, HDMI, USB Type-C 3.2, 1 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 234.9 mm - Dày 17.5 mm - Nặng 1.65 kg', '2023-04-20'),
		('V5I5610W1', 'i51235U 1.3GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel UHD', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 234.9 mm - Dày 17.5 mm - Nặng 1.85 kg', '2023-07-01'),
		('71027003', 'i51235U 1.3GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 120Hz', 'Intel UHD', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB 2.0', 'Windows 11 Home SL + Office Home & Student', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 235.56 mm - Dày 18.99 mm - Nặng 1.9 kg', '2022-08-28'),
		('8U237PA', 'i31215U 1.2GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080)', 'Intel UHD', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB Type-A, 1 x USB Type-C', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 242 mm - Dày 17.9 mm - Nặng 1.69 kg', '2023-09-05'),
		('7C0Q4PA', 'i51240P 1.7GHz', '16 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080)', 'Intel Iris Xe', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2, 1 x USB Type-C', 'Windows 11 Home SL', 'Vỏ nhựa - chiếu nghỉ tay bằng kim loại', 'Dài 360.2 mm - Rộng 234 mm - Dày 17.9 mm - Nặng 1.72 kg', '2022-12-10'),
		('6L1X7PA', 'i31215U 1.2GHz', '8 GB DDR4', '256 GB SSD NVMe PCIe', '14" Full HD (1920 x 1080)', 'Intel UHD', 'USB Type-C, LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 324 mm - Rộng 225.9 mm - Dày 19.9 mm - Nặng 1.41 kg', '2022-11-17'),
		('6L1Y2PA', 'i51235U 1.3GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '14" Full HD (1920 x 1080)', 'Intel UHD', 'USB Type-C, LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.1', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 324 mm - Rộng 225.9 mm - Dày 19.9 mm - Nặng 1.47 kg', '2022-11-30'),
		('8F155PA', 'Ryzen 5 7520U 2.8GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '14" Full HD (1920 x 1080)', 'Radeon', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa - nắp lưng bằng kim loại', 'Dài 324 mm - Rộng 215 mm - Dày 17.9 mm - Nặng 1.36 kg', '2023-02-25'),
		('94F19PA', 'Ryzen 5 7535HS 3.3GHz', '16 GB DDR5', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080) 144Hz', 'RTX 2050 4GB', 'LAN (RJ45), Jack tai nghe 3.5 mm, HDMI, 2 x USB Type-A, 1 x USB Type-C', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 357.9 mm - Rộng 255 mm - Dày 23.5 mm - Nặng 2.29 kg', '2023-05-18'),
		('7C134PA', 'i51235U 1.3GHz', '8 GB DDR4', '512 GB SSD NVMe PCIe', '15.6" Full HD (1920 x 1080)', 'Intel Iris Xe', 'USB Type-C, Jack tai nghe 3.5 mm, HDMI, 2 x USB 3.2', 'Windows 11 Home SL', 'Vỏ nhựa', 'Dài 358.5 mm - Rộng 242 mm - Dày 17.9 mm - Nặng 1.7 kg', '2022-10-09'),
		('7C0P2PA', 'i51235U 1.3GHz', '16 GB DDR4', '512 GB SSD PCIe M.2 (2280)', '14" Full HD (1920 x 1080)', 'Intel Iris Xe', 'Jack tai nghe 3.5 mm, HDMI, 2 x USB Type-A, 1 x USB Type-C', 'Windows 11 Home SL', 'Nắp lưng và chiếu nghỉ tay bằng kim loại', 'Dài 325 mm - Rộng 216.6 mm - Dày 17 mm - Nặng 1.41 kg', '2022-09-14');
