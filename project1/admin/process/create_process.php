<?php 

# Không có giao diện, xử lý thêm sản phẩm

# B1: lấy dữ liệu
$product_code = $_POST['product_code'];
$name = $_POST['name'];
$buy_price = $_POST['price'];
$description = $_POST['description'] ?? ''; // Neu khong co mac dinh rong
$image =$_POST['image'] ?? '';
# Lấy hình ảnh và lưu lại
$target_dir = "../../public/uploads";
$target_file = $target_dir . basename($_FILES["image_file"]["name"]);

# Lưu ảnh tạm thời vào đường dẫn target_file

move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);

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
if($image==''){
  $sql = "INSERT INTO products VALUES (NULL,'$product_code','$name','$buy_price',NULL,'$description','$target_file')";
}
else{
  $sql = "INSERT INTO products VALUES (NULL,'$product_code','$name','$buy_price',NULL,'$description','$image')";
}

  
$result = mysqli_query($conn, $sql);
// Chuyen huong ve trang chu: home san pham
header("Location: /project1/admin/home.php");

?>