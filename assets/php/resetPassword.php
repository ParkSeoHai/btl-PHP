<?php
if(isset($_POST['emailConfirm']) && isset($_POST['newPassword'])) {
    $email = $_POST['emailConfirm'];
    $newPassword = $_POST['newPassword'];
    // Hash password
    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    echo $email . ' ' . $newPassword;

    require_once('../../controllers/NguoiDungController.php');
    $nguoiDungController = new \controllers\NguoiDungController();
    $nguoiDungController->resetPassword($email, $newPassword);
}