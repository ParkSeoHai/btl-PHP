<?php
require_once '../../controllers/AdminController.php';

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $role = $_POST['role'];

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    // Kiểm tra email
    if($adminController->checkEmail(0, $email)) {
        setcookie('message', 'Email đã tồn tại', time() + 1, '/');
        header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
    } else {
        $adminController->addUser($username, $email, $phoneNumber, $role);
    }
} else {
    echo "Lỗi: Không đủ dữ liệu";
}