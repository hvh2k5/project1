<?php
if (isset($_POST['submit'])) {

    $name = $_POST["cus_name"];
    $email = $_POST["cus_email"];
    $password = $_POST["cus_password"];

    // Kết nối đến CSDL
    $servername = "localhost"; // Sửa lại tên biến đúng chính tả
    $db_username = "root";
    $db_password = "";
    $dbname = "project2";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Kiểm tra xem tài khoản đã tồn tại chưa
    $check_sql = "SELECT * FROM customers WHERE email='$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "Tài khoản đã tồn tại!";
    } else {
        // Nếu tài khoản chưa tồn tại, chèn vào dữ liệu
        $sql = "INSERT INTO customers (email, password, name) VALUES ('$email', '$password', '$name')";

        // Thực thi lệnh
        $rs = $conn->query($sql);

        if ($rs) {
            header("Location: /project1/customer/home.php");
        } else {
            header("Location: /project1/customer/auth/signup.php");
        }
    }

    // Đóng kết nối
    $conn->close();
}
?>
