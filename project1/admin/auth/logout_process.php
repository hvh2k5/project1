<?php
# tất cả các trang admin yêu cầu đăng nhập thì mới xem đc

session_start();
if(isset($_POST['submit'])){
    unset($_SESSION['auth']['admin_name']);
    unset($_SESSION['auth']['admin_email']);
    unset($_SESSION['auth']['admin_phone']);
}
header("Location: /project1/admin/auth/login.php");

die();
