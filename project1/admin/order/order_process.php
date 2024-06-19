<?php
# Ket noi den CSDL
# Tat ca cac trang admin deu yeu cau dang nhap thi moi xem dc
session_start();
if (!isset($_SESSION['auth']['admin'])) {
    header("Location:/project1/admin/auth/login.php");
    die();
}

$order_id = $_POST['order_id'];

// Ket noi CSDL
$servername = "localhost";
$username = "root";
$password = ""; // Mo tiếng lên nhé, XAMPP ko có password
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


if(isset($_POST['accept'])){
    $sql = "UPDATE orders SET status = 1 WHERE id = '{$order_id}'";
}
elseif(isset($_POST['cancel'])){
    $sql = "UPDATE orders SET status = -1 WHERE id = '{$order_id}'";
}
elseif(isset($_POST['delivery'])){
    $sql = "UPDATE orders SET status = 2 WHERE id = '{$order_id}'";
}
elseif(isset($_POST['success'])){
    $sql = "UPDATE orders SET status = 3 WHERE id = '{$order_id}'";
}

mysqli_query($conn, $sql);

header("Location:/project1/admin/order/index.php");

