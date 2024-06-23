<?php
$id = intval($_POST['product_id']);
$product_code = $_POST['product_code'];
$name = $_POST['name'];
$buy_price = intval($_POST['price']);
$description = $_POST['description'] ?? '';

// Thông số chi tiết sản phẩm
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

// Kiểm tra xem có cập nhật hình hay không
$image_file = "";
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
    $target_dir = "../../public/uploads/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);

    // Lưu ảnh tạm thời vào đường dẫn target_file
    move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);

    $image_file = $target_file;
}

// Chuẩn bị câu lệnh SQL
if ($image_file) {
    $sql = "UPDATE products SET product_code = '$product_code', name='$name', buy_price='$buy_price', description='$description', image='$image_file' WHERE id = '$id'";
} else {
    $sql = "UPDATE products SET product_code = '$product_code', name='$name', buy_price='$buy_price', description='$description' WHERE id = '$id'";
}

// Kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thực thi câu lệnh SQL cho bảng `products`
if ($conn->query($sql) === TRUE) {
    // Cập nhật bảng `laptop_product_detail`
    $sql_details = "UPDATE laptop_product_detail SET 
        cpu = '$cpu',
        ram = '$ram',
        hard_drive = '$hard_drive',
        screen = '$screen',
        graphics_card = '$graphics_card',
        ports = '$ports',
        operating_system = '$operating_system',
        design = '$design',
        dimensions = '$dimensions',
        launch_date = '$launch_date'
        WHERE product_code = '$product_code'";

    if ($conn->query($sql_details) === TRUE) {
        // Chuyển hướng về trang danh sách sản phẩm
        header("Location: /project1/admin/products/product_list.php");
    } else {
        echo "Lỗi cập nhật chi tiết sản phẩm: " . $conn->error;
    }
} else {
    echo "Lỗi cập nhật: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
