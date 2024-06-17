<?php
session_start();

if (isset($_POST['product_code'])) {
    // Nếu tồn tại thì bỏ vào giỏ
    $product_code = $_POST['product_code'];
    // Check if the product is already in the cart
    if(isset($_SESSION['cart'][$product_code])) {
        // If it's already there, increment the quantity
        $_SESSION['cart'][$product_code]++;
    } else {
        // If it's not there, add it with quantity 1
        $_SESSION['cart'][$product_code] = 1;
    }
}
// Chuyển về trang trước đó
header("Location: {$_SERVER['HTTP_REFERER']}");
die();
?>
