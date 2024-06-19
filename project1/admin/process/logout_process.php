<?php
# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if(isset($_POST['submit'])){
    unset($_SESSION['auth']['admin']);
    unset($_SESSION['auth']['email']);
}
header("Location: /project1/admin/auth/login.php");

die();
