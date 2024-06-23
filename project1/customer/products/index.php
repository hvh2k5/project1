<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HD STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project1/css/customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #fafafa, #2290c7);
        }

        .carousel-inner img {
            height: 400px;
            object-fit: cover;
        }

        .offer-card {
            background-color: #f8f9fa;
            border: 0;
            border-radius: 0.75rem;
        }

        .offer-card .bi {
            font-size: 3rem;
            color: #007bff;
        }


        .content {
            flex: 1;
            padding: 20px;
        }

        .image-container img {
            width: auto;
            height: auto;
        }

        .brands-container {
            background-color: #e0e0e0;
            border-radius: 15px;
            padding: 10px;
        }

        .brand-logo {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .brand-logo img {
            max-width: 80%;
            max-height: 80%;
        }
        .results {
            margin-top: 20px;
        }
        .result-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .result-item img {
            max-width: 150px;
            margin-right: 20px;
        }
        .filter-container {
            border-right: 1px solid #ccc;
            padding-right: 20px;
        }
    </style>
</head>
<body>
<header class="d-flex justify-content-around">
        <div class="navbar navbar-expand-lg navbar-dark">
            <div>
                <a class="navbar-brand" href="/project1/customer/home.php">HD STORE</a>
            </div>
            <form class="d-flex search-bar ms-auto" method="GET" action="/project1/customer/products/index.php">
                <input class="form-control" name="name" type="search" placeholder="Search" aria-label="Search" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
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

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/project1/customer/home.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                    <?php
                    if (!isset($_SESSION['auth']['email'])) {
                        echo '<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="/project1/customer/auth/login_process.php" data-bs-toggle="modal" data-bs-target="#loginModal" name="submit">Login</a></li>';
                    } else {

                        echo '<li class="nav-item"><a class="nav-link btn btn-outline-light text-white ms-2" href="#"  name="submit">' . $_SESSION['auth']['email'] . '</a></li>';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['auth']['email'])) {
                        echo '<form method="POST" action="/project1/customer/auth/logout.php">
                        <button name="submit" class="btn btn-outline-light nav-link text-white">Đăng Xuất</button>
                      </form>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="/project1/customer/auth/signup_process.php" data-bs-toggle="modal" data-bs-target="#signupModal" name="submit">Signup</a></li>';
                    }
                    ?>
                </ul>
                <a href="/project1/customer/cart/cart.php" class=" btn btn-outline text-white ms-2 fa fa-shopping-cart"
                    style="font: size 15px;px;">Giỏ hàng</a>
            </div>
        </div>
    </header>
    

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 filter-container">
                <h4>Filters</h4>
                <form method="GET" action="index.php">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                    <div class="mb-3">
                        <label class="form-label">Price:</label>
                        <div>
                            <input type="checkbox" name="price[]" value="0-5000000" <?= in_array('0-5000000', $_GET['price'] ?? []) ? 'checked' : '' ?>>
                            <label>0 - 5,000,000 VND</label>
                        </div>
                        <div>
                            <input type="checkbox" name="price[]" value="5000000-10000000" <?= in_array('5000000-10000000', $_GET['price'] ?? []) ? 'checked' : '' ?>>
                            <label>5,000,000 - 10,000,000 VND</label>
                        </div>
                        <div>
                            <input type="checkbox" name="price[]" value="10000000-15000000" <?= in_array('10000000-15000000', $_GET['price'] ?? []) ? 'checked' : '' ?>>
                            <label>10,000,000 - 15,000,000 VND</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CPU:</label>
                        <div>
                            <input type="checkbox" name="cpu[]" value="i5" <?= in_array('i5', $_GET['cpu'] ?? []) ? 'checked' : '' ?>>
                            <label>Intel Core i5</label>
                        </div>
                        <div>
                            <input type="checkbox" name="cpu[]" value="i7" <?= in_array('i7', $_GET['cpu'] ?? []) ? 'checked' : '' ?>>
                            <label>Intel Core i7</label>
                        </div>
                        <div>
                            <input type="checkbox" name="cpu[]" value="Ryzen 5" <?= in_array('Ryzen 5', $_GET['cpu'] ?? []) ? 'checked' : '' ?>>
                            <label>AMD Ryzen 5</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RAM:</label>
                        <div>
                            <input type="checkbox" name="ram[]" value="8GB" <?= in_array('8GB', $_GET['ram'] ?? []) ? 'checked' : '' ?>>
                            <label>8 GB</label>
                        </div>
                        <div>
                            <input type="checkbox" name="ram[]" value="16GB" <?= in_array('16GB', $_GET['ram'] ?? []) ? 'checked' : '' ?>>
                            <label>16 GB</label>
                        </div>
                        <div>
                            <input type="checkbox" name="ram[]" value="32GB" <?= in_array('32GB', $_GET['ram'] ?? []) ? 'checked' : '' ?>>
                            <label>32 GB</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Brand:</label>
                        <div>
                            <input type="checkbox" name="brand[]" value="Dell" <?= in_array('Dell', $_GET['brand'] ?? []) ? 'checked' : '' ?>>
                            <label>Dell</label>
                        </div>
                        <div>
                            <input type="checkbox" name="brand[]" value="HP" <?= in_array('HP', $_GET['brand'] ?? []) ? 'checked' : '' ?>>
                            <label>HP</label>
                        </div>
                        <div>
                            <input type="checkbox" name="brand[]" value="Apple" <?= in_array('Apple', $_GET['brand'] ?? []) ? 'checked' : '' ?>>
                            <label>Apple</label>
                        </div>
                    </div>
                    
                    <button class="btn btn-primary w-100" type="submit">Apply Filters</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="results">
                    <?php
                    // PHP code to fetch and display laptops based on filters
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "project1";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $name = $_GET['name'] ?? '';
                    $price_filters = $_GET['price'] ?? [];
                    $cpu_filters = $_GET['cpu'] ?? [];
                    $ram_filters = $_GET['ram'] ?? [];
                    $brand_filters = $_GET['brand'] ?? [];
                    $min_launch_date = $_GET['min_launch_date'] ?? '';
                    $max_launch_date = $_GET['max_launch_date'] ?? '';

                    $sql = "SELECT p.id, p.product_code, p.name, p.buy_price, p.description, p.image, 
                                   l.cpu, l.ram, l.hard_drive, l.screen, l.graphics_card, l.ports, 
                                   l.operating_system, l.design, l.dimensions, l.launch_date
                            FROM products p
                            JOIN laptop_product_detail l ON p.product_code = l.product_code
                            WHERE 1=1";

                    if ($name) {
                        $sql .= " AND p.name LIKE '%" . $conn->real_escape_string($name) . "%'";
                    }
                    if (!empty($price_filters)) {
                        $price_conditions = [];
                        foreach ($price_filters as $price) {
                            [$min, $max] = explode('-', $price);
                            $price_conditions[] = "(p.buy_price BETWEEN " . intval($min) . " AND " . intval($max) . ")";
                        }
                        $sql .= " AND (" . implode(' OR ', $price_conditions) . ")";
                    }
                    if (!empty($cpu_filters)) {
                        $sql .= " AND (" . implode(' OR ', array_map(function($cpu) use ($conn) {
                            return "l.cpu LIKE '%" . $conn->real_escape_string($cpu) . "%'";
                        }, $cpu_filters)) . ")";
                    }
                    if (!empty($ram_filters)) {
                        $sql .= " AND (" . implode(' OR ', array_map(function($ram) use ($conn) {
                            return "l.ram LIKE '%" . $conn->real_escape_string($ram) . "%'";
                        }, $ram_filters)) . ")";
                    }
                    if (!empty($brand_filters)) {
                        $sql .= " AND (" . implode(' OR ', array_map(function($brand) use ($conn) {
                            return "p.name LIKE '%" . $conn->real_escape_string($brand) . "%'";
                        }, $brand_filters)) . ")";
                    }
                    if ($min_launch_date) {
                        $sql .= " AND l.launch_date >= '" . $conn->real_escape_string($min_launch_date) . "'";
                    }
                    if ($max_launch_date) {
                        $sql .= " AND l.launch_date <= '" . $conn->real_escape_string($max_launch_date) . "'";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="result-item">';
                            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '<div>';
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<p>Price: ' . number_format($row['buy_price']) . ' VND</p>';
                            echo '<p>CPU: ' . htmlspecialchars($row['cpu']) . '</p>';
                            echo '<p>RAM: ' . htmlspecialchars($row['ram']) . '</p>';
                            echo '<p>Hard Drive: ' . htmlspecialchars($row['hard_drive']) . '</p>';
                            echo '<p>Screen: ' . htmlspecialchars($row['screen']) . '</p>';
                            echo '<p>Graphics Card: ' . htmlspecialchars($row['graphics_card']) . '</p>';
                            echo '<p>Launch Date: ' . htmlspecialchars($row['launch_date']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No laptops found.</p>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
                            <input class="form-control" name="cus_phone" type="text" placeholder="Số điện thoại"
                                required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="cus_address" type="text" placeholder="Địa chỉ" required>
                        </div>
                        <button class="btn btn-primary" name="submit" type="submit">Đăng ký</button>
                        <div class="modal-footer">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Đăng
                                nhập nếu đã có tài khoản</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
