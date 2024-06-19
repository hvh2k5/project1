<?php
session_start();
//Nếu chưa đăng nhập sẽ sang trang logout

//Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

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
    $sql = "SELECT p.id, p.name, p.image, p.buy_price, p.product_code, l.cpu, l.ram, l.hard_drive, l.screen, l.graphics_card, l.ports, l.operating_system, l.design, l.dimensions, l.launch_date 
    FROM products p 
    LEFT JOIN laptop_product_detail l ON p.product_code = l.product_code 
    WHERE p.id = $id";
    $result = $conn->query($sql);

    // Kiểm tra nếu có kết quả trả về
    if ($result->num_rows > 0) {
        // Lấy dữ liệu của sản phẩm
        $row = $result->fetch_assoc();
        $product_code = $row['product_code']; // Lấy mã sản phẩm
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

             <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/project1/customer/home.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>

                    <?php
                    if (!isset($_SESSION['auth']['email'])) {
                        echo '<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="/project1/customer/auth/login_process.php" data-bs-toggle="modal" data-bs-target="#loginModal" name="submit">Login</a></li>';
                    } else {

                        echo '<li class="nav-item"><a class="nav-link btn btn-outline-light text-white ms-2" href="/project1/customer/profile.php"  name="submit">' . $_SESSION['auth']['email'] . '</a></li>';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['auth']['email'])) {
                        echo '<form method="POST" action="/project1/customer/auth/logout.php">
                        <button name="submit" class="btn btn-outline-light nav-link text-white">Đăng Xuất</button>
                      </form>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="/project1/customer/auth/signup_process.php" data-bs-toggle="modal" data-bs-target="#signupModal" name="submit">Signup</a></li>';
                    }
                    ?>
                </ul>
                <a href="/project1/customer/cart/cart.php" class=" btn btn-outline text-white ms-2 fa fa-shopping-cart"
                    style="font: size 15px;px;">Giỏ hàng</a>
            </div>
        </div>
    </header>

    
    <main class="container my-5">
        <div class="row">
            <?php if ($row): ?>
                <div class="col-md-4">
                    <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-img">
                    <form method='POST' action='/project1/customer/cart/cart_process.php'>
                                           <?php echo "<input name='product_code' value ='$product_code'  hidden readonly />" ?>
                                            <button class="w-100 btn btn-primary">Mua Ngay</button>
                                        </form>
                    
           
                </div>
                <div class="col-md-8">
                    <h3><?php echo $row['name']; ?></h3>
                    <h4 class="card-text" style="color: red;"> <?php echo number_format($row['buy_price'], 0, ',', '.'); ?> VND</h4>

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
                                <th>Kích thước</th>
                                <td><?php echo $row['dimensions']; ?></td>
                            </tr>
                            <tr>
                                <th>Ngày ra mắt</th>
                                <td><?php echo $row['launch_date']; ?></td>
                            </tr>

                        </table>
                        <?php else: ?>
                        <p>Thông tin chi tiết sản phẩm đang cập nhật....</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="col-12">
                    <p>Không tìm thấy sản phẩm.</p>
                </div>
            <?php endif; ?>
      
    </main>
  <!-- Modal for Log In -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Đăng Nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/project1/customer/auth/login_process.php">
                        <div class="mb-3">
                            <input class="form-control" name="email" type="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="password" type="password" id="exampleInputPassword1"
                                placeholder="Mật khẩu" required>
                        </div>
                        <button class="btn btn-primary" name="submit" type="submit">Đăng nhập</button>
                        <div class="modal-footer">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Tạo
                                tài khoản nếu chưa có</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Sign Up -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Đăng Ký</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="/project1/customer/auth/signup_process.php">
    <div class="mb-3">
        <input class="form-control" name="cus_name" type="text" placeholder="Tên" required>
    </div>
    <div class="mb-3">
        <input class="form-control" name="cus_email" type="email" aria-describedby="emailHelp" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input class="form-control" name="cus_password" type="password" placeholder="Mật khẩu" required>
    </div>
    <div class="mb-3">
        <input class="form-control" name="cus_phone" type="text" placeholder="Số điện thoại" required>
    </div>
    <div class="mb-3">
        <input class="form-control" name="cus_address" type="text" placeholder="Địa chỉ" required>
    </div>
    <button class="btn btn-primary" name="submit" type="submit">Đăng ký</button>
    <div class="modal-footer">
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Đăng nhập nếu đã có tài khoản</a>
    </div>
</body>

</html>
