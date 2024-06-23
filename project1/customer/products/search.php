<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_GET['name'] ?? '';
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';
$cpu = $_GET['cpu'] ?? '';
$ram = $_GET['ram'] ?? '';
$brand = $_GET['brand'] ?? '';
$min_launch_date = $_GET['min_launch_date'] ?? '';
$max_launch_date = $_GET['max_launch_date'] ?? '';

$sql = "SELECT p.id, p.product_code, p.name, p.buy_price, p.description, p.image, 
               l.cpu, l.ram, l.hard_drive, l.screen, l.graphics_card, l.ports, 
               l.operating_system, l.design, l.dimensions, l.launch_date
        FROM products p
        JOIN laptop_product_detail l ON p.product_code = l.product_code
        WHERE 1=1";

if ($name) {
    $sql .= " AND p.name LIKE '%" . $conn->real_escape_string($name) . "%'";
}
if ($min_price) {
    $sql .= " AND p.buy_price >= " . $conn->real_escape_string($min_price);
}
if ($max_price) {
    $sql .= " AND p.buy_price <= " . $conn->real_escape_string($max_price);
}
if ($cpu) {
    $sql .= " AND l.cpu LIKE '%" . $conn->real_escape_string($cpu) . "%'";
}
if ($ram) {
    $sql .= " AND l.ram LIKE '%" . $conn->real_escape_string($ram) . "%'";
}
if ($brand) {
    $sql .= " AND p.name LIKE '%" . $conn->real_escape_string($brand) . "%'";
}
if ($min_launch_date) {
    $sql .= " AND l.launch_date >= '" . $conn->real_escape_string($min_launch_date) . "'";
}
if ($max_launch_date) {
    $sql .= " AND l.launch_date <= '" . $conn->real_escape_string($max_launch_date) . "'";
}

$result = $conn->query($sql);

$laptops = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $laptops[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($laptops);

$conn->close();
?>
