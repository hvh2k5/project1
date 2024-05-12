<?php

session_start();

if (isset($_POST['email'])) {
    $admin_email = $_POST['email'];
} else {
    header("Location:/project1/admin/auth/login.php");
    die();
}
if (isset($_POST['password'])) {
    $admin_password = $_POST['password'];
} else {
    header("Location:/project1/admin/auth/login.php");
    die();
}
//Kết nối đến CSDL
$severname = "localhost";
$username = "root";
$password = "";
$dbname = "project2";

$conn = new mysqli($severname, $username, $password, $dbname);
//Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại:" . $conn->connect_error);
}
$sql = "SELECT * FROM admins WHERE email='$admin_email' AND password='$admin_password'LIMIT 1";
//Thực thi câu lệnh
$rs = mysqli_query($conn, $sql);

if (mysqli_num_rows($rs) == 0) {
    //Sai email hoặc pass 
    die("<h1 style='color: red ;text-align: center;font-size: 300%;'>Sai email hoặc mật khẩu</h1>");
} else {
    $admin = mysqli_fetch_assoc($rs);
    //Đăng nhập thành công lưu vào session
    $_SESSION['auth']['admin']= $admin['name'];
    $_SESSION['auth']['email']= $admin['email'];
    //Về trang Home
    header("Location: /project1/admin/home.php");
   


}