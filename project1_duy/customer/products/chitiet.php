<?php
session_start();
//Nếu chưa đăng nhập sẽ sang trang logout


//Kết nối CSDL
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
    $id = $conn->real_escape_string($_GET['id']); // Escape biến id để ngăn chặn SQL Injection

    // Truy vấn dữ liệu từ cả hai bảng products và laptop_product_detail và kết hợp chúng
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/project1/css/customer.css">
</head>

<body>
    <header class="d-flex justify-content-around">
        <div class="navbar navbar-expand-lg navbar-dark ">
     

            <div>
                <a class="navbar-brand" href="/project1/customer/home.php">HD STORE</a>
            </div>
            <form class="d-flex search-bar ms-auto">
                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
            <!-- NÚT MENU KHI MÀN HÌNH THU NHỎ -->

            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item"><a class="nav-link" href="#">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Enterprise</a></li>
                    <?php
if (!isset($_SESSION['auth']['email'])) {
    echo '<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2"
        href="/project1/customer/auth/login_process.php" data-bs-toggle="modal"
        data-bs-target="#loginModal" name="submit">Login</a></li>';
} else {
    
    echo'<li class="nav-item"><a class="nav-link btn btn-outline-light text-white ms-2"
    href="#" data-bs-toggle="modal"
    name="submit">'. $_SESSION['auth']['email'] .'</a></li>';

}
?>


                    <?php
                    if(isset($_SESSION['auth']['email'])){
                        
                        echo'<form method="POST" action="/project1/customer/auth/logout.php">
                        <button name="submit" class="btn btn-outline-light  nav-link text-while">Đăng Xuất</button>
                      </form>';
                    }
                    else{
                        echo'<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2"
                            href="/project1/customer/auth/signup_process.php" data-bs-toggle="modal"
                            data-bs-target="#signupModal" name="submit">Signup</a></li>';
                    }

                    ?>
                    

                </ul>
            </div>
        </div>
    </header>
    <main class="container my-5">
        <div class="row">
            <?php if ($row): ?>
                <div class="col-md-4">
                    <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-img">
                  <a href="/project1/customer/cart/cart_process.php"class="container btn btn-outline-dark">Thêm vào giỏ hàng</a>
                </div>
                <div class="col-md-8">
                    <h2><?php echo $row['name']; ?></h2>
                    <p class="card-text" style="color: red;">Giá niêm yết: <?php echo number_format($row['buy_price'], 0, ',', '.'); ?> VND</p>

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