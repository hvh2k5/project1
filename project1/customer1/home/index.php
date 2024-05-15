<?php

# Đây là trang khách hàng

// session_start();
// if (!isset($_SESSION['auth']['customer'])) {
//     header("Location: /project1/customer/home/auth/login.php");
//     die();
// }


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
//Phần tìm kiếm:
if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT id, name, image, buy_price FROM products WHERE name like '%$search%' OR 
  buy_price like '%$search%' ";

}
// Lấy sản phẩm laptop:
else {
  $sql = "SELECT id, name, image, buy_price FROM products";
}
// Bước 3.Thực thi và xem kết quả:
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="/project1/img/logoms.png" type="image/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HD Computer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="index.css">

</head>

<body>
  <div class="fixed-header">
    <!-- HEADER START-->
    <header class="p-4 bg-primary text-white">
      <div class="container ">
        <div class="d-flex flex-wrap align-items-center justify-content-center ">
          <!-- LOGO START -->
          <div class="d-flex align-items-center">
            <a href="/project1/customer/home/index.php" class="nav-link d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-robot"
                viewBox="0 0 16 16">
                <path
                  d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.6 26.6 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.93.93 0 0 1-.765.935c-.845.147-2.34.346-4.235.346s-3.39-.2-4.235-.346A.93.93 0 0 1 3 9.219zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a25 25 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25 25 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135">
                </path>
                <path
                  d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2zM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5">
                </path>
              </svg>

              <div class="ms-3">
                <div class="fs-6 fw-bold ">HD</div>
                <span class="fs-5 fw-bold">COMPUTER</span>
              </div>
            </a>
          </div>
          <!-- LOGO END -->

          <div class="col-12 col-lg-6 mb-3 mb-lg-0 me-lg-3  ms-3">
            <!-- SEARCH START -->
            <form class="w-100 d-flex justify-content-left align-items-center">
              <input name="search" type="search" class="form-control form-control-dark"
                placeholder="Tìm kiếm sản phẩm...">
            </form>
            <!-- SEARCH END -->
            
          </div>
          

          <div class="text-end ms-auto ">
            <!-- ACCOUNT START -->
            <button type="button" class="btn btn-outline-light me-lg-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
                <path fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1">
                </path>
              </svg>
              Tài khoản
            </button>
            <!-- ACCOUNT END -->
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
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
  </div>
  <div class="content">
    <!-- MENU START -->

    <!-- MENU END -->
    <!-- CONTENT START -->

    <!-- BANNER START -->
    <div id="carouselExampleAutoplaying" class="carousel slide d-flex" data-bs-ride="carousel" style="height: 300px;">

      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://cdn.tgdd.vn/2024/05/banner/Gaming-MSI-Desk-min-1200x300.png" class="d-block w-100"
            alt="...">
        </div>
        <div class="carousel-item active">
          <img src="https://cdn.tgdd.vn/2024/04/banner/intel-1200-300-1200x300.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item active">
          <img src="https://cdn.tgdd.vn/2024/04/banner/1200x300-1200x300-1.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- BANNER END -->
    <!-- PRODUCT LAPTOP START -->
    <main class="container">
      <h1 class="my-3 text-center ">Nổi bật</h1>
      <div class="container mt-4" id="laptop">
        <div class="row my-3 row-cols-4">
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col my-3 zoom-img">
              <div class="card product-card">
                <img src="<?php echo $row['image']; ?>" class="card-img-top " alt="Product Image">
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo $row['name']; ?>
                  </h5>
                  <p class="card-text" style="color: red;">Giá niêm yết:
                    <?php echo $row['buy_price']; ?>
                  </p>
                  <a href="chitietgaming.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Chi tiết</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </main>
    <!-- PRODUCT LAPTOP END -->
    <!-- CONTENT END -->
  </div>

  <!-- FOOTER START -->

  <!-- FOOTER END -->

  <!-- Bảng mã JavaScript Bootstrap và jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

</body>

</html>