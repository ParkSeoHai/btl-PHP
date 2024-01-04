<?php
require_once '../../controllers/AdminController.php';

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $role = $_POST['role'];

    // Tao doi tuong AdminController

} else {
    echo "Lỗi: Không đủ dữ liệu";
}