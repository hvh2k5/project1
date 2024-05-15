<?php 

# Không có giao diện, xử lý thêm sản phẩm

# B1: lấy dữ liệu
$email = $_POST['email'];
$user_password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'] ?? ''; // Neu khong co mac dinh rong

# Lấy hình ảnh và lưu lại

# Lưu ảnh tạm thời vào đường dẫn target_file


# Lưu vào db
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

// Buoc 2: chuan bi cau lenh

$sql = "INSERT INTO customers VALUES (NULL,'$email','$user_password','$phone','$address')";

$result = mysqli_query($conn, $sql);
// Chuyen huong ve trang chu: home san pham
header("Location: /project1/customer/home/auth/login.php");

?>