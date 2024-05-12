<?php
session_start();
//Đăng nhập nếu là admin mới cho vào
if(!isset( $_SESSION['auth']['admin'])){
  header("Location:/project1/admin/auth/login.php");
  die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop H&D</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="home.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<style>
  body{
    
    margin: 0px;
    padding: 0px;
    background-color:rgb(223, 237, 250);

  }
</style>

</head>

<body>
  <!-- HEADER START-->
  <header class="p-4 bg-primary text-white">
    <div class="container">
      <!-- LOGO START -->
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="home.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="/project1/img/logo.png" alt="Example Image" width="40" height="32" class="me-2" />
        </a>
        <!-- LOGO END -->
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="home.php" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Hot</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Danh mục</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Liên hệ</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>
        
        <div class="text-end">
          <!-- ACCOUNT START -->
          <button type="button" class="btn btn-outline-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
              class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
              <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1">
              </path>
            </svg>
            <?php echo  $_SESSION['auth']['admin'] ?>
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
            </button>
            <form method="POST" action="/project1/admin/auth/logout.php">
                  <button  name="submit" class="btn btn-outline-light">Đăng Xuất</button>
            </form>
          <!-- CART END-->
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END -->

</body>

</html>