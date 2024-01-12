<?php
require_once('../../controllers/NguoiDungController.php');

if(isset($_POST['username']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) && isset($_POST['agree'])) {
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Tạo đối tượng controller
    $userController = new \controllers\NguoiDungController();
    // Kiểm tra xem email đã tồn tại hay chưa?
    if(!$userController->checkEmail($email)) {
        // Gửi email xác nhận
        require 'sendmail.php';
        $code = random_int(000000, 999999);
        $subject = 'Xác nhận email đăng ký';
        $message = 'Mã code của bạn là: ' . $code;
        $isSent = sendMail($email, $subject, $message);

        // Kiểm tra đã gửi email xác nhận chưa?
        if($isSent) {
            // Lưu mã code vào session
            session_start();
            $_SESSION['code'] = $code;
            // Lưu thông tin người dùng vào session
            $_SESSION['userRegister'] = [
                'username' => $username,
                'phoneNumber' => $phoneNumber,
                'email' => $email,
                'password' => $hashed_password
            ];
            header('location: /btl/views/pages/confirmEmail.php');
        } else {
            setcookie('errorRegister', 'Lỗi: Chưa gửi được email xác nhận', time() + 1, '/');
            header('location: /btl/views/pages/register.php');
        }
    }
} else {
    header('location: /btl/views/pages/register.php');
}