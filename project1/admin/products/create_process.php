<?php 

# Không có giao diện, xử lý thêm sản phẩm

# B1: lấy dữ liệu
$product_code = $_POST['product_code'];
$name = $_POST['name'];
$buy_price = $_POST['price'];
$description = $_POST['description'] ?? ''; // Neu khong co mac dinh rong
$image =$_POST['image'] ?? '';
  // Các thông tin chi tiết sản phẩm
  $cpu = $_POST['cpu'];
  $ram = $_POST['ram'];
  $hard_drive = $_POST['hard_drive'];
  $screen = $_POST['screen'];
  $graphics_card = $_POST['graphics_card'];
  $ports = $_POST['ports'];
  $operating_system = $_POST['operating_system'];
  $design = $_POST['design'];
  $dimensions = $_POST['dimensions'];
  $launch_date = $_POST['launch_date'];
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
  $sql_detail = "INSERT INTO laptop_product_detail VALUES (NULL,'$product_code', '$cpu', '$ram', '$hard_drive', '$screen', '$graphics_card', '$ports', '$operating_system', '$design', '$dimensions', '$launch_date')";
}
else{
  $sql = "INSERT INTO products VALUES (NULL,'$product_code','$name','$buy_price',NULL,'$description','$image')";
  $sql_detail = "INSERT INTO laptop_product_detail VALUES (NULL,'$product_code', '$cpu', '$ram', '$hard_drive', '$screen', '$graphics_card', '$ports', '$operating_system', '$design', '$dimensions', '$launch_date')";
}
$result = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql_detail);
// Chuyen huong ve trang chu: home san pham
header("Location: /project1/admin/products/product_list.php");

