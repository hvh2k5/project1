<?php

# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if (!isset($_SESSION['auth']['admin'])) {
    header("Location: /project1/admin/auth/login.php");
    die();
}


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
    <title>Trang admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
</head>

<body>
    <div class="d-flex min-vh-100">
        <!-- SIDEBAR START -->

        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light " style="width: 280px;">
            <!--LOGO START-->
            <a href="/project1/admin/home.php"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <span class="fs-4 ms-2 float-start">MA VƯƠNG DUY
                    <div class="clearfix">
                        <span class="fs-6 float-start">Chức vụ: Boss</span>
                    </div>
                </span>
            </a>
            <!--LOGO END-->
            <hr>
            <!-- MENU START -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/project1/admin/home.php" class="nav-link link-dark d-flex align-items-center"
                        aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-house me-1 align-self-center " viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Trang chủ
                    </a>
                </li>
                <li>
                    <a href="/project1/admin/products/index.php" class="nav-link active d-flex align-items-center"
                        aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-house me-1 align-self-center " viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Sản phẩm
                    </a>
                </li>
                <li class="ms-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed " data-bs-toggle="collapse"
                        data-bs-target="#dashboard-collapse" aria-expanded="false" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-house me-1 align-self-center " viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                            Sản phẩm
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/project1/admin/products/create.php" class="link-dark rounded">Thêm sản
                                    phẩm</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark d-flex align-items-center" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-house me-1 align-self-center " viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Đơn hàng
                    </a>
                    
                </li>
                
                <li>
                    <a href="#" class="nav-link link-dark d-flex align-items-center" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-house me-1 align-self-center " viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Thống kê doanh thu
                    </a>
                </li>

            </ul>
            <!-- MENU END -->
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <!-- SIDEBAR END -->

        <!-- CONTENT START -->
        <div class="container">
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
                                <img style="width: 200px;" class="img-fluid" src="<?php echo $row['image']; ?>" alt="">
                            </td>
                            <td>
                                <?php echo $row['buy_price']; ?>₫
                            </td>
                            <td>
                                <?php $product_id = $row['id']; ?>
                                <a href="/project1/admin/products/edit.php?id=<?php echo $product_id; ?>">
                                    <button class="btn btn-info mx-2 my-2">Sửa</button>
                                </a>
                                <form onsubmit="return confirm('Xác nhận xóa')" method='POST' action="delete.php">

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
        <!-- CONTENT END -->

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