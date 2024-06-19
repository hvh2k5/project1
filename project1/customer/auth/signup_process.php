<?php
if (isset($_POST['submit'])) {

    $name = $_POST["cus_name"];
    $email = $_POST["cus_email"];
    $password = $_POST["cus_password"];
    $phone = $_POST["cus_phone"]; // Lấy trường phone từ form
    $address = $_POST["cus_address"];
    // Kết nối đến CSDL
    $servername = "localhost"; // Sửa lại tên biến đúng chính tả
    $db_username = "root";
    $db_password = "";
    $dbname = "project1";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

     // Kiểm tra xem email đã tồn tại chưa
     $check_email_sql = "SELECT * FROM customers WHERE email='$email'";
     $email_result = $conn->query($check_email_sql);
 
     // Kiểm tra xem phone đã tồn tại chưa
     $check_phone_sql = "SELECT * FROM customers WHERE phone='$phone'";
     $phone_result = $conn->query($check_phone_sql);
 
     if ($email_result->num_rows > 0) {
         echo "Tài khoản với email này đã tồn tại!";
     } elseif ($phone_result->num_rows > 0) {
         echo "Tài khoản với số điện thoại này đã tồn tại!";
     } else {
         // Nếu tài khoản chưa tồn tại, chèn vào dữ liệu
         $sql = "INSERT INTO customers (email, password, name, phone, address) VALUES ('$email', '$password', '$name', '$phone', '$address')";
 
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