<?php

if(isset($_POST['email'])) {
    $email = $_POST['email'];

    require_once('../../controllers/NguoiDungController.php');
    $nguoiDungController = new \controllers\NguoiDungController();
    $isEmail = $nguoiDungController->checkEmail($email);
    if($isEmail) {
        // Gửi email xác nhận
        require 'sendmail.php';

        // Random mã xác nhận
        $code = rand(100000, 999999);

        $isSent = sendMail($email, 'Xác nhận quên mật khẩu', 'Mã xác nhận của bạn là: ' . $code);
        if($isSent) {
            // Lưu mã xác nhận vào session
            session_start();
            $_SESSION['code'] = $code;
            $_SESSION['email'] = $email;
            setcookie('success', 'Gửi email thành công', time() + 1, '/');
            header('Location: /btl/views/pages/forgot-pass.php');
        } else {
            setcookie('error', 'Gửi email thất bại', time() + 1, '/');
            header('location: /btl/views/pages/forgot-pass.php');
        }
    } else {
        setcookie('error', 'Email không tồn tại', time() + 1, '/');
        header('location: /btl/views/pages/forgot-pass.php');
    }
}