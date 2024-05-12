<?php
session_start();
if (isset($_SESSION['auth']['customer'])) {
    header("Location:/project1/customer/home_login.php");
    die();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .rounded-form {
            border-radius: 15px;
            background-color: #f8f9fa;
            padding: 20px;
        }
    </style>
</head>

<body>
<form method="POST" action="/project1/customer/home_logout.php">
                  <button  name="submit" class="btn btn-danger"><-Trang chủ</button>
            </form>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 rounded-form">
                <h1 class="text-center">Đăng Nhập</h1>
                <form method="POST" action="/project1/customer/auth/login_process.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Nhập email của bạn">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Nhập mật khẩu của bạn">
                    </div>
                    <div class="text-center">
                        <button name="submit" class="btn btn-primary">Đăng Nhập</button>
                    </div>
                </form>
                

             


        </div>

    </div>
    </div>
</body>

</html>