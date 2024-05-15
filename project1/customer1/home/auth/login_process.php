<?php
session_start();

if (isset($_POST['email'])) {
    $user_email = $_POST['email'];
}
else{
    header("Location: /project1/customer/home/auth/login.php");
    die();
}

if (isset($_POST['password'])) {
    $user_password = $_POST['password'];
}
else{
    header("Location: /project1/customer/home/auth/login.php");
    die();
}


// Ket noi CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql= "SELECT id,  email, password, phone, address FROM customers WHERE email='$user_email' AND password='$user_password' LIMIT 1";

// Thuc thi cau lenh
$rs = mysqli_query($conn, $sql);
if(mysqli_num_rows($rs) ==0){
    // Sai email hoac password
    die("<h1> Sai email or password</h1>");
}
else{
    $user = mysqli_fetch_assoc($rs);
    // Đăng nhập thành công
    $_SESSION['auth']['customer'] = $user['email'];
    $_SESSION['auth']['email'] = $user['adress'];
    $_SESSION['auth']['phone'] = $user['phone'];
    
    //chuyen huong:
    header("Location: /project1/customer/home/index.php");

}
