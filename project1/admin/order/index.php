<?php
# Ket noi den CSDL
# Tat ca cac trang admin deu yeu cau dang nhap thi moi xem dc
session_start();
if (!isset($_SESSION['auth']['admin'])) {
    header("Location:/project1/admin/auth/login.php");
    die();
}

// Ket noi CSDL
$servername = "localhost";
$username = "root";
$password = ""; // Mo tiếng lên nhé, XAMPP ko có password
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Cau lenh 
$sql = "SELECT * FROM orders";

// Thuc thi cau lenh
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính thức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"  rel="stylesheet">
    <link rel="stylesheet" href="/project1/css/admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="/project1/admin/home.html" class="nav-link">
            <img src="/project1/public/img/logo.png" alt="Logo" class="rounded" width="50px">
            <div class="ms-1 text-center">
                <div class="fs-5 fw-bold">HD STORE</div>
            </div>
        </a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm ...">
            <i class="bi bi-search"></i>
        </div>
        <div class="header-icons">
            <i class="bi bi-bell"><span class="badge bg-danger">1</span></i>
            <i class="bi bi-chat"><span class="badge bg-primary">1</span></i>
            <i class="bi bi-grid"></i>
            <div class="profile">
                <img class="img-thumbnail" src="https://art.pixilart.com/6a445ffefff19bc.png" alt="Profile" width="50px">
                <div>
                    <div>Ma Vương Duy</div>
                    <div class="text-muted">Admin</div>
                </div>
            </div>

        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <div class="sidebar-heading">TRANG CHỦ</div>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="bi bi-house-door"></i> Trang chủ
                            </a>
                        </li>
                    </ul>
                    <div class="sidebar-heading">QUẢN LÝ SẢN PHẨM</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ecommerceCollapse" role="button"
                                aria-expanded="false" aria-controls="ecommerceCollapse">
                                <i class="bi bi-inboxes"></i> Sản phẩm
                                <i class="bi bi-chevron-right rotate ms-auto smaller-icon"></i>
                            </a>
                            <div class="collapse" id="ecommerceCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="/project1/admin/home/product_list.php"><i class="bi bi-caret-right"></i>
                                        Danh sách sản phẩm
                                    </a>
                                    <a class="nav-link" href="#"><i class="bi bi-caret-right"></i>
                                        Chi tiết sản phẩm
                                    </a>
                                    <a class="nav-link" href="/project1/admin/home/create.php"><i class="bi bi-caret-right"></i>
                                        Thêm sản phẩm
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#categoryCollapse" role="button"
                                aria-expanded="false" aria-controls="categoryCollapse">
                                <i class="bi bi-tags"></i> Thể loại
                                <i class="bi bi-chevron-right rotate ms-auto smaller-icon"></i>
                            </a>
                            <div class="collapse" id="categoryCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="#"><i class="bi bi-caret-right"></i>
                                        Thêm thể loại
                                    </a>
                                    <a class="nav-link" href="#"><i class="bi bi-caret-right"></i>
                                        Danh sách thể loại
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#orderCollapse" role="button"
                                aria-expanded="false" aria-controls="orderCollapse">
                                <i class="bi bi-box-seam"></i> Hóa đơn
                                <i class="bi bi-chevron-right rotate ms-auto smaller-icon"></i>
                            </a>
                            <div class="collapse" id="orderCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="#"><i class="bi bi-caret-right"></i>
                                        Duyệt hóa đơn
                                    </a>
                                    <a class="nav-link" href="#"><i class="bi bi-caret-right"></i>
                                        Lịch sử hóa đơn 
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> Khách hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-images"></i> Nhân viên
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-graph-up"></i> Doanh thu
                            </a>
                        </li>
                    </ul>
                    <div class="sidebar-heading">SETTING</div>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-geo-alt"></i> Địa chỉ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear"></i> Cài đặt
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="main-content col">
                <div class="container">

            <h1 class="my-3">Quản lý đơn hàng </h1>

            <table class="table table-bordered" id="orders_table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã </th>
                        <th>Khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt </th>
                        <th>Xem chi tiết </th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                       $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td>".(++$count)."</td>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>";
                                    echo "<p>".$row['customerName']."</p>";
                                    echo "<p>".$row['customerPhone']."</p>";
                                echo "</td>";
                                echo "<td>".$row['customerAddress']."</td>";
                                echo "<td>".$row['order_date']."</td>";
                                echo "<td>";

                                echo "</td>";
                                echo "<td>";
                                    $status = $row['status'];
                                    echo "<form method='POST' action='/project1/admin/order/order_process.php'>";
                                    echo "<input hidden name='order_id' value='{$row['id']}'/>";
                                    switch($status){
                                        case -1:
                                            echo "<p class='text-danger'>Đã huỷ</p>";
                                            break;
                                        case 0:
                                            echo "<button name='accept' class='btn btn-primary me-2'>Duyệt</button>";
                                            echo "<button name='cancel' class='btn btn-danger'>Huỷ</button>";
                                            break;

                                        case 1:
                                            echo "<button name='delivery'  class='btn btn-warning'>Giao đơn hàng</button>";
                                            break;
                                        
                                        case 2:
                                            echo "<button name='success' class='btn btn-success'>Thành công</button>";
                                            break;

                                        case 3:
                                            echo "<p class='text-success'>Đã giao thành công!</p>";
                                            break;
                
                                    }
                                    echo "</form>";

                                echo "</td>";

                            echo "</tr>";
                        }
                    ?>
                </tbody>

            </table>
            <script>
                let table = new DataTable('#orders_table');
            </script>
        </div>
    </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/project1/js/admin.js"></script>
</body>

</html>