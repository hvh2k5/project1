<?php
session_start();

?>

<?php
// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = ""; // Ensure this is the correct password for your MySQL root user
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT id, name, image, buy_price, product_code FROM products WHERE name LIKE '%$search%' OR buy_price LIKE '%$search%' OR product_code LIKE '%$search%' ";
} else {
    $sql = "SELECT id, name, image, buy_price, product_code FROM products";
}
$rs = mysqli_query($conn, $sql);

if (!$rs) {
    die("Truy vấn thất bại: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/project1/public/img/link.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HD STORE</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #fafafa, #2290c7);
        }

        .carousel-inner img {
            height: 400px;
            object-fit: cover;
        }

        .offer-card {
            background-color: #f8f9fa;
            border: 0;
            border-radius: 0.75rem;
        }

        .offer-card .bi {
            font-size: 3rem;
            color: #007bff;
        }


        .content {
            flex: 1;
            padding: 20px;
        }

        .image-container img {
            width: auto;
            height: auto;
        }

        .brands-container {
            background-color: #e0e0e0;
            border-radius: 15px;
            padding: 10px;
        }

        .brand-logo {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .brand-logo img {
            max-width: 80%;
            max-height: 80%;
        }

        .mess-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            z-index: 1000;
        }

        .mess-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .mess-icon img:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-around">
        <div class="navbar navbar-expand-lg navbar-dark">
            <div>
                <a class="navbar-brand" href="/project1/customer/home.php">HD STORE</a>
            </div>
            <form class="d-flex search-bar ms-auto" method="GET" action="/project1/customer/products/index.php">
                <input class="form-control" name="name" type="search" placeholder="Search" aria-label="Search"
                    value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                <button type="submit">
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

                        echo '<li class="nav-item"><a class="nav-link btn btn-outline-light text-white ms-2" href="#"  name="submit">' . $_SESSION['auth']['email'] . '</a></li>';
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
    <!-- Banner -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://cdn.tgdd.vn/2024/06/banner/tuan-le-lenovo-desk-1200x300.png" class="d-block w-100"
                    alt="Banner 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Chào Mừng Đến Với Cửa Hàng Laptop</h5>
                    <p>Các sản phẩm chất lượng và giá cả hợp lý.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.tgdd.vn/2024/06/banner/Laptop-Xin-Via-Desk-1200x300.png" class="d-block w-100"
                    alt="Banner 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Khuyến Mãi Hấp Dẫn</h5>
                    <p>Giảm giá đến 50% cho các sản phẩm mới.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Offers -->
    <section class="container my-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 offer-card">
                    <i class="bi bi-truck"></i>
                    <h5 class="mt-3">Miễn Phí Giao Hàng</h5>
                    <p>Miễn phí giao hàng cho đơn hàng trên 1 triệu đồng.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 offer-card">
                    <i class="bi bi-shield-check"></i>
                    <h5 class="mt-3">Bảo Hành 2 Năm</h5>
                    <p>Bảo hành 2 năm cho tất cả sản phẩm.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 offer-card">
                    <i class="bi bi-phone"></i>
                    <h5 class="mt-3">Hỗ Trợ 24/7</h5>
                    <p>Hỗ trợ khách hàng 24/7 qua điện thoại và email.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Các Nhãn Hàng Laptop</h2>
        <div class="container my-4">
            <div class="d-flex justify-content-around align-items-center brands-container">
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-hp-149x40-1.png" alt="HP">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-asus-149x40.png" alt="ASUS">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-acer-149x40.png" alt="Acer">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-lenovo-149x40.png" alt="Lenovo">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-dell-149x40.png" alt="Dell">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-msi-149x40.png" alt="MSI">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/logo-macbook-149x40.png" alt="MacBook">
                </div>
                <div class="brand-logo">
                    <img src="https://cdn.tgdd.vn/Brand/1/Masstel42-b0-200x48-1.png" alt="Masstel">
                </div>
            </div>
        </div>
    </section>
    <h2 class="text-center mb-4">Sản Phẩm Nổi Bật</h2>
    <main class="container-fluid">
        <div class="row">

            <div class="col-md-9 content">

                <div class="container mt-4" id="laptop">
                    <div class="row my-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                        <?php while ($row = mysqli_fetch_assoc($rs)): ?>
                            <div class="col my-3 d-flex align-items-stretch">
                                <div class="card product-card">

                                    <a href="/project1/customer/products/chitiet.php?id=<?php echo $row['id']; ?>">
                                        <div class="image-container">
                                            <?php if ($row['image']): ?>
                                                <img src="<?php echo $row['image']; ?>" alt="Product Image">
                                            <?php else: ?>
                                                <img src="/path/to/placeholder.png" alt="No Image Available">
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <?php $product_code = $row['product_code']; ?>
                                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                        <p class="card-text" style="color: red;">Giá:
                                            <?php echo number_format($row['buy_price'], 0, ',', '.'); ?> VND
                                        </p>
                                        <form method='POST' action='/project1/customer/cart/cart_process.php'>
                                            <?php echo "<input name='product_code' value ='$product_code'  hidden readonly />" ?>
                                            <button class="btn btn-primary">Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
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
                            <input class="form-control" name="cus_email" type="email" aria-describedby="emailHelp"
                                placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cus_password" type="password" placeholder="Mật khẩu"
                                required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cus_phone" type="text" placeholder="Số điện thoại"
                                required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cus_address" type="text" placeholder="Địa chỉ" required>
                        </div>
                        <button class="btn btn-primary" name="submit" type="submit">Đăng ký</button>
                        <div class="modal-footer">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Đăng
                                nhập nếu đã có tài khoản</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Icon mess -->
    <div class="mess-icon">
        <a href="https://www.facebook.com/aitiniubi" target="_blank">
            <img src="/project1/public/img/logo_mess.png" alt="Messenger">
        </a>
    </div>
</body>

</html>