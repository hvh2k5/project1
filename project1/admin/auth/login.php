<?php
# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if(isset($_SESSION['auth']['admin'])){
    header("Location: /project1/admin/home.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">H&D Computer</h1>
    <div class="card w-50 mx-auto">
        <div class="card-body"></div>
        <form method="POST" action="/project1/admin/auth/login_process.php">
            <div class="mb-3 ms-1 mx-1">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text" hidden>We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3 ms-1 mx-1">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit"
                    class="btn btn-primary ">Đăng nhập</button>
                </div>

        </form>
    </div>
</body>

</html>