<?php
# Tat ca cac trang admin deu yeu cau dang nhap thi moi xem dc
session_start();
if (!isset($_SESSION['auth']['admin_email'])) {
    header("Location:/lego/admin/auth/login.php");
    die();
}

?>
<?php

// Phần 1.Kết nối CSDL: 
$_servername = "localhost";
$_username = "root";
$password = "";
$dbname = "project1";
$conn = new mysqli($_servername, $_username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// Phần 2.Câu lệnh:
// Lấy sản phẩm laptop:

$sql = "SELECT * FROM products";

// Bước 3.Thực thi và xem kết quả:
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính thức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
        
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
    <link rel="stylesheet" href="/project1/css/admin.css">
</head>

<body>
<header>
        <div class="logo">
            <a href="/project1/admin/home.php" class="nav-link">
                <img src="/project1/public/img/logo.png" alt="Logo" class="rounded" width="50px">
                <div class="ms-1 text-center">
                    <div class="fs-5 fw-bold">HD STORE</div>
                </div>
            </a>
        </div>

        <div class="header-icons">
            <div class="profile">
                <img class="img-thumbnail" src="https://art.pixilart.com/6a445ffefff19bc.png" alt="Profile"
                    width="50px">
                <div>
                    <div><?php echo $_SESSION['auth']['admin_name'] ?></div>
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
                            <a class="nav-link active" aria-current="page" href="/project1/admin/home.php">
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
                                    <a class="nav-link" href="/project1/admin/products/product_list.php"><i
                                            class="bi bi-caret-right"></i>
                                        Danh sách sản phẩm
                                    </a>
                                    <a class="nav-link" href="/project1/admin/products/create.php"><i
                                            class="bi bi-caret-right"></i>
                                        Thêm sản phẩm
                                    </a>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#categoryCollapse" role="button"
                                aria-expanded="false" aria-controls="categoryCollapse">
                                <i class="bi bi-tags"></i> Nhãn hàng
                                <i class="bi bi-chevron-right rotate ms-auto smaller-icon"></i>
                            </a>
                            <div class="collapse" id="categoryCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <a class="nav-link" href="/project1/admin/products/brand.php"><i
                                            class="bi bi-caret-right"></i>
                                        Thêm nhãn hàng
                                    </a>
                                    <a class="nav-link" href="/project1/admin/products/brand_list.php"><i
                                            class="bi bi-caret-right"></i>
                                        Danh sách nhãn hàng
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
                                    <a class="nav-link" href="/project1/admin/order/index.php"><i
                                            class="bi bi-caret-right"></i>
                                        Duyệt hóa đơn
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="sidebar-heading">SETTING</div>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#settingCollapse" role="button"
                                aria-expanded="false" aria-controls="settingCollapse">
                                <i class="bi bi-gear"></i> Cài đặt
                                <i class="bi bi-chevron-right rotate ms-auto smaller-icon"></i>
                            </a>
                            <div class="collapse" id="settingCollapse" data-bs-parent="#sidebarMenu">
                                <div class="collapse-inner">
                                    <form method="POST" action="/project1/admin/auth/logout_process.php">
                                        <button name="submit" class="nav-link" >
                                            <i class="bi bi-caret-right"></i> Đăng suất
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="main-content col">
                <div class="container scrollable right">
                    <table class="table table-bordered" id="product_table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Gía bán</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <?php $count++; ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td>
                                        <img style="width: 200px;" class="img-fluid" src="<?php echo $row['image']; ?>"
                                            alt="">
                                    </td>
                                    <td>
                                        <?php echo $row['buy_price']; ?>₫
                                    </td>
                                    <td>
                                        <?php $product_id = $row['id']; ?>
                                        <a href="/project1/admin/products/edit.php?id=<?php echo $product_id; ?>">
                                            <button class="btn btn-info mx-2 my-2">Sửa</button>
                                        </a>
                                        <form onsubmit="return confirm('Xác nhận xóa')" method='POST' action="delete_process.php">

                                            <input name="product_id" value="<?php echo $product_id; ?>" hidden />
                                            <button type="submit" class="btn btn-danger mx-2">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                    <script>
                        let table = new DataTable('#product_table')
                    </script>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="/project1/js/admin.js"></script>
</body>

</html>