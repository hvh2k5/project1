<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project2";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define the SQL query
$sql = "SELECT name, address, phone FROM customers WHERE id = 1"; // Assuming you want to fetch details of the customer with id 1

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful and fetch the data
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $address = $row['address'];
    $phone = $row['phone'];
} else {
    die("Query failed: " . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Thông tin khách hàng</h1>
        <p>Tên: <?php echo htmlspecialchars($name); ?></p>
        <p>Địa chỉ: <?php echo htmlspecialchars($address); ?></p>
        <p>Số Điện thoại: <?php echo htmlspecialchars($phone); ?></p>
    </div>
</body>
</html>
