<?php
session_start();
//Nếu chưa đăng nhập sẽ sang trang logout

/*if (!isset($_SESSION['auth']['email'])) {
  header("Location:/project1/customer/home_logout.php");
  die();
}*/
?>

<?php
//KẾt nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại " . $conn->connect_error);
}
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT id,name,image,buy_price FROM products WHERE name like '%$search%' OR buy_price like '%$search%' OR product_code like '%$search%' ";

} else {
    $sql = "SELECT id,name,image,buy_price FROM products";
}
$rs = mysqli_query($conn, $sql);
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
                <a class="navbar-brand" href="/project1/header.php">HD STORE</a>
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

                    <li class="nav-item"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"></a></li>
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
    <main class="container">
    
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
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text" style="color: red;">Giá:
                                    <?php echo number_format($row['buy_price'], 0, ',', '.'); ?> VND
                                </p>


                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
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
                            <input class="form-control" name="cus_phone" type="number" placeholder="Nhập SĐT"
                                required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cus_address" type="address" placeholder="Nhập địa chỉ"
                                required>
                        </div>
                      
                        <button class="btn btn-primary" name="submit" type="submit">Đăng ký</button>

                        <div class="modal-footer">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Bạn
                                đã có tài khoản?</a>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    

</body>

</html>