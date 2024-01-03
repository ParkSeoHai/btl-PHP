<?php
require_once('../../controllers/NguoiDungController.php');
require_once('../../models/NguoiDung.php');

if(isset($_POST['username']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) && isset($_POST['agree'])) {
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Tạo đối tượng người dùng
    $user = new \models\NguoiDung();
    $user->setTen($username);
    $user->setSoDienThoai($phoneNumber);
    $user->setEmail($email);
    $user->setMatKhau($hashed_password);
    $user->setNgayTao($user->getDateTimeNow());

    // Tạo đối tượng controller
    $userController = new \controllers\NguoiDungController();
    $userController->dangKy($user);
} else {
    header('location: /btl/views/pages/register.php');
}

