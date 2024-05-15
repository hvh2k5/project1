<?php
session_start();
//Nếu chưa đăng nhập sẽ sang trang logout
if (isset($_SESSION['auth']['email'])) {
    header("Location:/project1/customer/home_logout.php");
    die();
}

// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project2";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có tham số id được truyền qua URL không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn dữ liệu của sản phẩm dựa trên id
    $sql = "SELECT p.id, p.name, p.image, p.buy_price, l.cpu, l.ram, l.hard_drive, l.screen, l.graphics_card, l.ports, l.operating_system, l.design, l.dimensions, l.launch_date 
            FROM products p 
            LEFT JOIN laptop_product_detail l ON p.product_code = l.product_code 
            WHERE p.id = $id";
    $result = $conn->query($sql);

    // Kiểm tra nếu có kết quả trả về
    if ($result->num_rows > 0) {
        // Lấy dữ liệu của sản phẩm
        $row = $result->fetch_assoc();
    } else {
        // Xử lý khi không tìm thấy sản phẩm
        $row = null;
    }
} else {
    // Xử lý khi không có id được truyền qua URL
    $row = null;
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .product-img {
            max-width: 100%;
            height: auto;
        }

        .product-details {
            width: 100%;
            border-collapse: collapse;
        }

        .product-details th,
        .product-details td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .product-details th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .product-details td {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <!-- HEADER START-->
    <header class="p-4 bg-primary text-white">
        <div class="container">
            <!-- LOGO START -->
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/project1/customer/home_login.php"
                    class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img class="img-fluid" src="/project1/img/logo.png" alt="Example Image" width="150" class="me-2" />
                </a>
                <!-- LOGO END -->
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Hot</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Danh mục</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Liên hệ</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input name="search" type="search" class="form-control form-control-dark" placeholder="Search..."
                        aria-label="Search">
                </form>

                <div class="text-end d-flex">
                    <!-- ACCOUNT START -->
                    <button type="button" class="btn btn-outline-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1">
                            </path>
                        </svg>
                        Guest
                    </button>
                    <!-- ACCOUNT END -->
                    <div class="text-end d-flex align-items-center">
                        <!-- CART START-->
                        <button type="button" class="btn btn-outline-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2">
                                </path>
                            </svg>
                            Giỏ hàng
                        </button>
                        <!-- CART END-->

                        <!-- Đăng Xuất -->
                        <form method="POST" action="/project1/customer/auth/login.php">
                            <button name="submit" class="btn btn-outline-light">Đăng Nhập</button>
                        </form>
                    </div>
    </header>

    <main class="container my-5">
        <div class="row">
            <?php if ($row): ?>
                <div class="col-md-4">
                    <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-img">
                </div>
                <div class="col-md-8">
                    <h2><?php echo $row['name']; ?></h2>
                    <p style="color:red">Giá: <?php echo $row['buy_price']; ?> VND</p>
                    <?php if (!is_null($row['cpu'])): ?>
                        <h3>Thông tin sản phẩm</h3>
                        <table class="product-details">
                            <tr>
                                <th>CPU</th>
                                <td><?php echo $row['cpu']; ?></td>
                            </tr>
                            <tr>
                                <th>RAM</th>
                                <td><?php echo $row['ram']; ?></td>
                            </tr>
                            <tr>
                                <th>Ổ cứng</th>
                                <td><?php echo $row['hard_drive']; ?></td>
                            </tr>
                            <tr>
                                <th>Màn hình</th>
                                <td><?php echo $row['screen']; ?></td>
                            </tr>
                            <tr>
                                <th>Card màn hình</th>
                                <td><?php echo $row['graphics_card']; ?></td>
                            </tr>
                            <tr>
                                <th>Cổng kết nối</th>
                                <td><?php echo $row['ports']; ?></td>
                            </tr>
                            <tr>
                                <th>Hệ điều hành</th>
                                <td><?php echo $row['operating_system']; ?></td>
                            </tr>
                            <tr>
                                <th>Thiết kế</th>
                                <td><?php echo $row['design']; ?></td>
                            </tr>
                            <tr>
                                <th>Kích thước, khối lượng</th>
                                <td><?php echo $row['dimensions']; ?></td>
                            </tr>
                            <tr>
                                <th>Thời điểm ra mắt</th>
                                <td><?php echo $row['launch_date']; ?></td>
                            </tr>
                        </table>
                    <?php else: ?>
                        <p>Thông tin chi tiết sản phẩm đang cập nhật....</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>Sản phẩm không tồn tại.</p>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>