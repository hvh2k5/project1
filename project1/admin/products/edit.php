<?php
session_start();
if (!isset($_SESSION['auth']['admin'])) {
    header("Location: /project1/admin/auth/login.php");
    die();
}

$product_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($product_id <= 0) {
    header("Location: /project1/admin/products/index.php");
    die();
}

// Kết nối CSDL
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

// Chuẩn bị câu lệnh SQL
$sql = "SELECT 
    p.id,
    p.product_code,
    p.name,
    p.buy_price,
    p.type_id,
    p.description,
    p.image,
    lpd.cpu,
    lpd.ram,
    lpd.hard_drive,
    lpd.screen,
    lpd.graphics_card,
    lpd.ports,
    lpd.operating_system,
    lpd.design,
    lpd.dimensions,
    lpd.launch_date
FROM 
    products p
INNER JOIN 
    laptop_product_detail lpd ON p.product_code = lpd.product_code
WHERE 
    p.id = $product_id";

// Thực thi và xem kết quả
$result = $conn->query($sql);

if ($result === false) {
    die("Lỗi truy vấn: " . $conn->error);
}

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    header("Location: /project1/admin/products/index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/project1/public/img/link.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính thức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
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
                                        <button name="submit" class="nav-link">
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
    <div class="container">
        <h1>Cập nhật thông tin sản phẩm </h1>
        <form class="my-3" id='form_update' method='POST' action="update_process.php" enctype="multipart/form-data">
            <input value="<?php echo $product_id ?>" name='product_id' hidden />
            <div class="mb-3">
                <label for="product_code" class="form-label">Mã sản phẩm</label>
                <input type="text" value="<?php echo $product['product_code'] ?>" class="form-control" id="product_code" name='product_code' placeholder="Nhập mã sản phẩm" required />
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" value="<?php echo $product['name'] ?>" class="form-control" id="name" name='name' placeholder="Nhập tên sản phẩm" required />
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" value="<?php echo $product['buy_price'] ?>" class="form-control" id="price" name='price' placeholder="Nhập giá sản phẩm" required />
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh sản phẩm</label><br>
                <img width='300px' src="<?php echo $product['image'] ?>" /><br>
                <input type="file" name="image_file" class="form-control mt-2" id="image" />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="description" rows="5" name="description"><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
            </div>

            <!-- Additional Fields for Laptop Details -->
            <div class="row">
                <div class="col-md-6">
                    <label for="cpu" class="form-label">CPU</label>
                    <input value="<?php echo $product['cpu'] ?>" class="form-control" id="cpu" name='cpu' placeholder="Nhập CPU" required />
                </div>
                <div class="col-md-6">
                    <label for="ram" class="form-label">RAM</label>
                    <input value="<?php echo $product['ram'] ?>" class="form-control" id="ram" name='ram' placeholder="Nhập RAM" required />
                </div>
                <div class="col-md-6">
                    <label for="hard_drive" class="form-label">Ổ cứng</label>
                    <input value="<?php echo $product['hard_drive'] ?>" class="form-control" id="hard_drive" name='hard_drive' placeholder="Nhập Ổ cứng" required />
                </div>
                <div class="col-md-6">
                    <label for="screen" class="form-label">Màn hình</label>
                    <input value="<?php echo $product['screen'] ?>" class="form-control" id="screen" name='screen' placeholder="Nhập Màn hình" required />
                </div>
                <div class="col-md-6">
                    <label for="graphics_card" class="form-label">Card đồ họa</label>
                    <input value="<?php echo $product['graphics_card'] ?>" class="form-control" id="graphics_card" name='graphics_card' placeholder="Nhập Card đồ họa" required />
                </div>
                <div class="col-md-6">
                    <label for="ports" class="form-label">Cổng kết nối</label>
                    <input value="<?php echo $product['ports'] ?>" class="form-control" id="ports" name='ports' placeholder="Nhập Cổng kết nối" required />
                </div>
                <div class="col-md-6">
                    <label for="operating_system" class="form-label">Hệ điều hành</label>
                    <input value="<?php echo $product['operating_system'] ?>" class="form-control" id="operating_system" name='operating_system' placeholder="Nhập Hệ điều hành" required />
                </div>
                <div class="col-md-6">
                    <label for="design" class="form-label">Thiết kế</label>
                    <input value="<?php echo $product['design'] ?>" class="form-control" id="design" name='design' placeholder="Nhập Thiết kế" required />
                </div>
                <div class="col-md-6">
                    <label for="dimensions" class="form-label">Kích thước</label>
                    <input value="<?php echo $product['dimensions'] ?>" class="form-control" id="dimensions" name='dimensions' placeholder="Nhập Kích thước" required />
                </div>
                <div class="col-md-6">
                    <label for="launch_date" class="form-label">Ngày ra mắt</label>
                    <input value="<?php echo $product['launch_date'] ?>" class="form-control" id="launch_date" name='launch_date' placeholder="Nhập Ngày ra mắt" required />
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Cập nhật sản phẩm</button>
        </form>
    </div>
</main>

            <!-- CONTENT END -->
        </div>
    </div>
    <!-- Bảng mã JavaScript Bootstrap và jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>