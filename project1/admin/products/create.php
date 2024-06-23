<?php
# Tat ca cac trang admin deu yeu cau dang nhap thi moi xem dc
session_start();
if (!isset($_SESSION['auth']['admin_email'])) {
    header("Location:/lego/admin/auth/login.php");
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
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h2 class="card-title mb-4">Thêm sản phẩm</h2>
                                    <form method='POST' action="/project1/admin/products/create_process.php"
                                        enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="product_code" class="form-label">Mã sản phẩm</label>
                                            <input type="text" class="form-control" id="product_code"
                                                name='product_code' required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name" name='name' required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Giá sản phẩm</label>
                                            <input type="number" step="1" min="0" class="form-control" id="price"
                                                name='price' required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô tả sản phẩm</label>
                                            <textarea rows="5" class="form-control" id="description"
                                                name="description"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image_file" class="form-label">Ảnh sản phẩm</label>
                                            <input type="file" class="form-control" id="image_file" name='image_file' />
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Link ảnh sản phẩm</label>
                                            <input type="text" class="form-control" id="image" name='image' />
                                        </div>
                                        <hr>
                                        <h3 class="mb-3">Thông tin chi tiết sản phẩm</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="cpu" class="form-label">CPU</label>
                                                    <input type="text" class="form-control" id="cpu" name='cpu' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ram" class="form-label">RAM</label>
                                                    <input type="text" class="form-control" id="ram" name='ram' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="hard_drive" class="form-label">Ổ cứng</label>
                                                    <input type="text" class="form-control" id="hard_drive"
                                                        name='hard_drive' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="screen" class="form-label">Màn hình</label>
                                                    <input type="text" class="form-control" id="screen" name='screen' />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="graphics_card" class="form-label">Card đồ họa</label>
                                                    <input type="text" class="form-control" id="graphics_card"
                                                        name='graphics_card' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ports" class="form-label">Các cổng kết nối</label>
                                                    <input type="text" class="form-control" id="ports" name='ports' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="operating_system" class="form-label">Hệ điều
                                                        hành</label>
                                                    <input type="text" class="form-control" id="operating_system"
                                                        name='operating_system' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="design" class="form-label">Thiết kế</label>
                                                    <input type="text" class="form-control" id="design" name='design' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dimensions" class="form-label">Kích thước</label>
                                                    <input type="text" class="form-control" id="dimensions"
                                                        name='dimensions' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="launch_date" class="form-label">Ngày ra mắt</label>
                                                    <input type="date" class="form-control" id="launch_date"
                                                        name='launch_date' />
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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