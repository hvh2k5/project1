<?php

session_start();

if (isset($_POST['email'])) {
    $customer_email = $_POST['email'];
} else {
    header("Location:/project1/customer/auth/login.php");
    die();
}
if (isset($_POST['password'])) {
    $customer_password = $_POST['password'];
} else {
    header("Location:/project1/customer/auth/login.php");
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
$sql = "SELECT * FROM customers WHERE email='$customer_email' AND password='$customer_password'LIMIT 1";
//Thực thi câu lệnh
$rs = mysqli_query($conn, $sql);

if (mysqli_num_rows($rs) == 0) {
    //Sai email hoặc pass 
    die("<h1 style='color: red ;text-align: center;font-size: 300%;'>Sai email hoặc mật khẩu</h1>");
} else {
    $customer = mysqli_fetch_assoc($rs);
    //Đăng nhập thành công lưu vào session
    $_SESSION['auth']['customer']= $customer['name'];
    $_SESSION['auth']['email']= $customer['email'];
    //Về trang Home
    header("Location: /project1/customer/home_login.php");
   


}