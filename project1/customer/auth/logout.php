<?php
session_start();
if(isset($_POST['submit'])){
    unset( $_SESSION['auth']['customer']);
    unset( $_SESSION['auth']['email']);

}
header("Location:/project1/customer/home_logout.php");




