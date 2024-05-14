<?php
session_start();
//Nếu chưa đăng nhập sẽ sang trang logout

if (!isset($_SESSION['auth']['email'])) {
  header("Location:/project1/customer/home_logout.php");
  die();
}
?>

<?php
//KẾt nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project2";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop H&D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" inte
    grity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="home.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <style>
    body {

      margin: 0px;
      padding: 0px;
      background-color: rgb(223, 237, 250);

    }


    .product-card {
      transition: transform 0.5s ease-in-out;
    }

    .product-card:hover {
      transform: scale(1.05);
    }
  </style>

</head>

<body>
  <!-- HEADER START-->
  <header class="p-4 bg-primary text-white">
    <div class="container">
      <!-- LOGO START -->
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/project1/customer/home_login.php"
          class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img class="img-fluid" src="/project1/img/logo.png" alt="Example Image" width="150" class="me-2" />
        </a>
        <!-- LOGO END -->
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Hot</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Danh mục</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Liên hệ</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input name="search" type="search" class="form-control form-control-dark" placeholder="Search..."
            aria-label="Search">
        </form>

        <div class="text-end d-flex">
          <!-- ACCOUNT START -->
          <button type="button" class="btn btn-outline-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
              <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1">
              </path>
            </svg>
            <?php echo $_SESSION['auth']['email'] ?>
          </button>
          <!-- ACCOUNT END -->
          <div class="text-end d-flex align-items-center">
            <!-- CART START-->
            <button type="button" class="btn btn-outline-light">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart"
                viewBox="0 0 16 16">
                <path
                  d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2">
                </path>
              </svg>
              Giỏ hàng
            </button>
            <!-- CART END-->

            <!-- Đăng Xuất -->
            <form method="POST" action="/project1/customer/auth/logout.php">
              <button name="submit" class="btn btn-outline-light">Đăng Xuất</button>
            </form>
          </div>


  </header>
  <main class="container">
    <h1 class="my-3 text-center ">Nổi bật</h1>
    <div class="container mt-4" id="laptop">
      <div class="row my-3 row-cols-4">
        <?php while ($row = mysqli_fetch_assoc($rs)): ?>
          <div class="col my-3 zoom-img">
            <div class="card product-card">
              <a href="/project1/customer/products/product_detail_login.php?id=<?php echo $row['id']; ?>">
                <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Product Image">
              </a>

              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $row['name']; ?>
                </h5>
                <p class="card-text" style="color: red;">Giá niêm yết:
                  <?php echo $row['buy_price']; ?>
                </p>

              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </main>


</body>

</html>