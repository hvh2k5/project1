<?php
if (isset($_POST['submit'])) {

    $name = $_POST["cus_name"];
    $email = $_POST["cus_email"];
    $password = $_POST["cus_password"];
    $phone =$_POST["cus_phone"];
    $address=$_POST["cus_address"];

    // Kết nối đến CSDL
    $servername = "localhost"; 
    $db_username = "root";
    $db_password = "";
    $dbname = "project1";

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
        $sql = "INSERT INTO customers (email, password, name,phone,address) VALUES ('$email', '$password', '$name','$phone','$address')";

        // Thực thi lệnh
        $rs = $conn->query($sql);

        if ($rs) {
            header("Location: /project1/header.php");
        } else {
           echo "Đăng ký thất bại";
        }
    }
    
   
    

    // Đóng kết nối
    $conn->close();
}
?>