<?php
require_once '../../controllers/AdminController.php';

if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phoneNumber']) && isset($_POST['role'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $role = $_POST['role'];

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    // Kiểm tra email
    if($adminController->checkEmail($id, $email)) {
        setcookie('message', 'Email đã tồn tại', time() + 1, '/');
        header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
    } else {
        $adminController->updateUser($id, $username, $email, $phoneNumber, $role);
    }
} else {
    echo "Lỗi: Không đủ dữ liệu";
}