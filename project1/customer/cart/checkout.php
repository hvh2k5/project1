<?php
session_start();

# Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_POST['checkout'])) {
    // Lấy thông tin từ form
    $customerName = $_POST['customerName'];
    $customerPhone = $_POST['customerPhone'];
    $customerAddress = $_POST['customerAddress'];
    $customerNote = $_POST['customerNote'];

    # Tạo hóa đơn: 0 - chưa duyệt, 1 - đã duyệt
    $customerId = $_SESSION['auth']['customer_id'];
    $orderDate = date('Y-m-d');
    $sql = "INSERT INTO orders(customer_id, order_date, status, customerName, customerPhone, customerAddress, note) VALUES
     ('$customerId', '$orderDate', 0, '$customerName', '$customerPhone', '$customerAddress', '$customerNote')";

    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        # Lấy id của hóa đơn vừa tạo
        $order_id = mysqli_insert_id($conn);
        # Sau khi có hóa đơn, tạo hóa đơn chi tiết
        foreach ($_SESSION['cart'] as $product_code => $quantity) {
            # Lấy giá hiện tại
            $sql = "SELECT * FROM products WHERE product_code = '$product_code' LIMIT 1";
            $product = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $price = $product['buy_price'];
            $product_id = $product['id'];  # Gán giá trị cho biến $product_id
            $sql = "INSERT INTO order_detail(order_id, product_id, price, quantity) VALUES ('$order_id', '$product_id', '$price', '$quantity')";
            mysqli_query($conn, $sql);  # Thực hiện câu lệnh SQL
            //xoa gio hang sau khi mua
            unset($_SESSION['cart']);
            header("Location:/project1/customer/home.php");

        }
    }
}
?>