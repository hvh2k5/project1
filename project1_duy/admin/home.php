<?php
# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if (!isset($_SESSION['auth']['admin'])) {
    header("Location: /project1/admin/auth/login.php");
    die();
}
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
    <title>Trang admin | HD store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            
        }

        .nav-link {
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            color: black;
        }

        .nav-link i {
            margin-right: 10px;
        }

        .navbar {
            box-shadow: 0 4px 2px -2px gray;
        }

        .card-title {
            font-size: 1rem;
        }

        .sidebar-heading {
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            font-weight: bold;
            color: #333;
        }

        .main-content {
            margin-left: 250px;
        }

        .search-bar {
            flex-grow: 1;
        }

        .dropdown-toggle::after {
            margin-left: auto;
        }

        .collapse-inner {
            padding-left: 1.25rem;
        }

        .collapse-inner a {
            display: block;
            padding: 0.25rem 0;
        }

        .rotate {
            transition: transform 0.3s;
        }

        .rotate-90 {
            transform: rotate(90deg);
        }
        * {
            margin: 0;
            padding: auto;
        }
        body {
            background-color: rgb(236, 215, 215);
            color: rgb(0, 0, 0);
            font-family: Arial, sans-serif;
        }
        .left-column::-webkit-scrollbar {
            width: 0; /* Ẩn thanh cuộn */
        }
        .D-container {
            display: flex;
            height: 100vh;
        }
        .left-column {
            width: 17%;
            height: 100vh;
            overflow-y: auto;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            padding: 20px;
        }
        .right-column {
            width: 83%;
            height: 100vh;
            background-color: #ff0000;
            position: relative;
        }
        .iframe-container {
            width: 100%;
            height: calc(100% ); /* Trừ đi phần header */
            overflow: hidden;
            position: absolute;
             /* Bắt đầu từ vị trí của header */
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none; /* Loại bỏ khung viền của iframe */
        }
        .header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">
<div class="D-container">
        <div class="left-column">
        <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="d-flex align-items-center">
                    <a href="/project1/admin/home.php" class="nav-link d-flex align-items-center">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                            <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.6 26.6 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.93.93 0 0 1-.765.935c-.845.147-2.34.346-4.235.346s-3.39-.2-4.235-.346A.93.93 0 0 1 3 9.219zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a25 25 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25 25 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135"></path>
                            <path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2zM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5"></path>
                        </svg> -->
                        <img src="https://cdn.tuoitre.vn/zoom/700_700/tto/i/s626/2015/02/25/KvsVpgTE.jpg" width="70" height="70" alt="">
                        <div class="ms-3">
                            <div class="fs-6 fw-bold ">HD</div>
                            <span class="fs-5 fw-bold">STORE</span>
                        </div>
                    </a>
                </div>
                <hr>
                <div class="position-sticky">
                    <div class="sidebar-heading">MAIN HOME</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                    </ul>
                    <div class="sidebar-heading">ALL PAGE</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ecommerceCollapse" role="button" aria-expanded="false" aria-controls="ecommerceCollapse">
                                <i class="bi bi-cart"></i> Sản phẩm
                                <i class="bi bi-chevron-right rotate ms-auto"></i>
                            </a>
                            <div class="collapse" id="ecommerceCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link mx-3" href="/project1/admin/products/create.php">Thêm sản phẩm</a>
                                    <a class="nav-link mx-3" href="/project1/admin/products/index.php">Danh sách sản phẩm</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#categoryCollapse" role="button" aria-expanded="false" aria-controls="categoryCollapse">
                                <i class="bi bi-card-list"></i> Thể loại
                                <i class="bi bi-chevron-right rotate ms-auto"></i>
                            </a>
                            <div class="collapse" id="categoryCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="#">Danh sách sản phẩm</a>
                                    <a class="nav-link" href="#">Add Category</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#attributesCollapse" role="button" allapsria-expanded="false"  aria-controls="attributesCoe">
                                <i class="bi bi-sliders"></i> Attributes
                                <i class="bi bi-chevron-right rotate ms-auto"></i>
                            </a>
                            <div class="collapse" id="attributesCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="#" target="_blank"><i class="fa-brands fa-d-and-d"></i> Attributes List</a>
                                    <a class="nav-link" href="#"><i class="fas fa-plus"></i> Add Attribute</a>
                                </div>
                            </div>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-box-seam"></i> Order
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person"></i> User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-images"></i> Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-graph-up"></i> Report
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-gear mx-2" viewBox="0 0 16 16">
                        <path
                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                        <path
                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                    </svg>
                    <strong>Settings</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
                    <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                    
                    <li><a class="dropdown-item" href="#">Phone:<?php echo $_SESSION['auth']['phone'] ?></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="/project1/admin/auth/logout.php">
                            <button type="submit" class="dropdown-item" name="submit">Đăng Xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
            </nav>

            <!-- Main content -->
            

        </div>
    </div>
        </div>
        <div class="right-column">
            <!-- Header for the right column -->
             
            <!-- Content for the right column -->
            <div class="iframe-container">
                <iframe src="http://localhost:8080/project1/header.php"></iframe>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var collapses = document.querySelectorAll('.collapse');
            collapses.forEach(function (collapse) {
                var toggleIcon = document.querySelector('[href="#' + collapse.id + '"] .rotate');

                collapse.addEventListener('show.bs.collapse', function () {
                    toggleIcon.classList.add('rotate-90');
                    collapses.forEach(function (otherCollapse) {
                        if (otherCollapse !== collapse) {
                            var otherIcon = document.querySelector('[href="#' + otherCollapse.id + '"] .rotate');
                            otherCollapse.classList.remove('show');
                            otherIcon.classList.remove('rotate-90');
                        }
                    });
                });

                collapse.addEventListener('hide.bs.collapse', function () {
                    toggleIcon.classList.remove('rotate-90');
                });
            });
        });
    </script>
</body>

</html>
