<?php
require_once '../../controllers/NguoiDungController.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    // Tao doi tuong NguoiDungController
    $controller = new \controllers\NguoiDungController();
    $controller->dangNhap($email, $password, $remember);
}