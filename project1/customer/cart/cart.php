<?php
session_start();

// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Cập nhật số lượng sản phẩm trong giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
    if ($_POST['action'] == 'increase') {
        $_SESSION['cart'][$product_code]++;
    } elseif ($_POST['action'] == 'decrease') {
        if ($_SESSION['cart'][$product_code] > 1) {
            $_SESSION['cart'][$product_code]--;
        } else {
            unset($_SESSION['cart'][$product_code]);
        }
    }
    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HD STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/project1/css/customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #fafafa, #2290c7);
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .image-container img {
            width: auto;
            height: auto;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-around">
        <div class="navbar navbar-expand-lg navbar-dark">
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
                <a href="/project1/customer/cart/cart.php" class="btn btn-outline text-white ms-2 fa fa-shopping-cart"
                    style="font: size 15px;px;">Giỏ hàng</a>
            </div>
          
        </div>
        
    </header>
    <main class="container">
        <?php

if (isset($_SESSION['auth']['email'])) {
 echo'<a href="/project1/customer/order/index.php"
 style="font: size 15px;px;">Lịch sử đơn hàng</a>';
}


        ?>
   
        <!--Hiển thị giỏ hàng-->
        <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
            <p class='text-center my-3 text-danger'>Chưa có sản phẩm</p>
        <?php else: ?>
            <table class="table table-bordered">
                <tr>
                    <th>STT</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>


                </tr>
                <?php
                $stt = 1;
                $total_price = 0;
                foreach ($_SESSION['cart'] as $product_code => $quantity) {
                    if (empty($product_code))
                        continue;

                    $sql = "SELECT * FROM products WHERE product_code='" . $product_code . "'";
                    $rs = mysqli_query($conn, $sql);

                    if ($rs && $product = mysqli_fetch_assoc($rs)):
                        $subtotal = $product['buy_price'] * $quantity;
                        $total_price += $subtotal;
                        ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><img src="<?php echo $product['image']; ?>" class="img-fluid"
                                    style="max-width: 150px; max-height: 150px;"></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo number_format($product['buy_price'], 0, ',', '.'); ?> VND</td>
                            <td>
                                <form method="POST" action="cart.php" style="display:inline-block;">
                                    <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="btn btn-sm btn-primary">-</button>
                                </form>
                                <?php echo $quantity; ?>
                                <form method="POST" action="cart.php" style="display:inline-block;">
                                    <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="btn btn-sm btn-primary">+</button>

                                </form>
                            </td>
                            <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>

                        </tr>
                    <?php endif;
                } ?>
                <tr>
                    <td colspan="5" class="text-right"><strong>Tổng tiền</strong></td>
                    <td style="color:red "><strong><?php echo number_format($total_price, 0, ',', '.'); ?> VND</strong></td>
                </tr>
            </table>
            <!--Kiểm tra login -->
            <?php
            if (isset($_SESSION['auth']['customer'])) {
               $email = $_SESSION['auth']['email'];
               $sql= "SELECT * FROM customers WHERE email = '$email'";
               $rs = mysqli_query($conn, $sql);
               $user= mysqli_fetch_assoc($rs);
               
               $customerName = $user['name'];
               $customerAddress = $user['address'];
               $customerPhone = $user['phone'];
               
                //Tạo form thanh toán
                echo"<form method='POST' action ='/project1/customer/cart/checkout.php'>";
                echo"<h3>Thông tin thanh toán</h3>";
                echo"<input value='$customerName' name='customerName'    class='form-control mt-3' placeholder='Tên khách hàng'/>";    
                echo"<input value='$customerAddress' name='customerAddress' class='form-control mt-3'placeholder='Địa chỉ'/>";    
                echo"<input value='$customerPhone' name='customerPhone'   class='form-control mt-3' placeholder='Số Điện Thoại'/>";    
                echo"<textarea rows='5' name='customerNote' class='form-control' placeholder='Ghi chú'></textarea>";
                echo"<button name='checkout' class='btn btn-primary mt-3'>Thanh toán đơn hàng</button>";
                echo"</form>";
            } else {
                echo '<a class="btn btn-danger "href="/project1/customer/auth/login_process.php" data-bs-toggle="modal" data-bs-target="#loginModal" name="submit">Đăng nhập để thanh toán</a>';
            }
            ?>

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