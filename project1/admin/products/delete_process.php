<?php 
$product_id = $_POST['product_id'];

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
$sql_laptop_product_detail = "DELETE FROM laptop_product_detail WHERE product_code IN (SELECT product_code FROM products WHERE id='$product_id')";
$sql = "DELETE FROM products WHERE id='$product_id'";

// Thuc thi lenh
mysqli_query($conn, $sql_laptop_product_detail);
mysqli_query($conn, $sql);

// Chuyen huong ve 
header("Location: /project1/admin/products/product_list.php");

?>
