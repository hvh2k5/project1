<?php
# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if (isset($_SESSION['auth']['email'])) {
    header("Location: /project1/customer/home.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/project1/img/link.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập |HD Computer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Syne">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: linear-gradient(to right, #fafafa, #2290c7);
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .image-container {
            text-align: center;
            width: 100%;
        }

        .links-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
    </style>
    <script>
        function openLoginModal() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }

        function closeLoginModal() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.hide();
        }
    </script>
</head>

<body class="bg-white">
    <!-- Image and name container. Change to your picture here. -->
    <div class="image-container">
       

        <!-- Content. Add your bio here. -->
        <div class="my-3">
            <h2 class="text-primary"><strong>HD Store</strong></h2>
            <b>Xin chào</b>
        </div>

        <!-- Links section 1. Replace the # inside of the "" with your links. -->
        <div class="links-container">
            <a href="/project1/customer/home.php" class="btn btn-primary btn-lg" style="width: 350px;">Đến cửa hàng</a>
            <button onclick="openLoginModal()" class="btn btn-primary btn-lg" style="width: 350px;">Đăng nhập</button>
            <a href="/project1/customer/auth/signup.php" class="btn btn-primary btn-lg" style="width: 350px;">Đăng ký</a>
        </div>

        <!-- Add links to your social networks here. -->
        <div class="container text-center my-4">
            <i class="fa fa-facebook-official fa-2x mx-2"></i>
            <i class="fa fa-instagram fa-2x mx-2"></i>
            <i class="fa fa-linkedin fa-2x mx-2"></i>
        </div>
    </div>

    <!-- The Contact Section -->
    <div class="container my-5" style="max-width: 390px;">
        <h5 class="text-center">Get in touch.</h5>
        <div class="row py-4">
            <div class="col-12 mb-3">
                <i class="fa fa-map-marker" style="width: 30px;"></i> Bình nguyên vô tận<br>
                <i class="fa fa-phone" style="width: 30px;"></i> Phone: +84 113<br>
                <i class="fa fa-envelope" style="width: 30px;"></i> Email: mavuongduy@mail.com<br>
            </div>
        </div>
       
      
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/project1/customer/auth/login_process.php">
                        <div class="mb-3">
                            <input class="form-control" name="email" type="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="password" type="password" id="exampleInputPassword1" placeholder="Mật khẩu" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Đăng nhập</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Bạn chưa có tài khoản? <a href="/project1/customer/auth/signup.php">Đăng ký ngay</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
