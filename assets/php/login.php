<?php
use controllers\NguoiDungController;
require_once('../../controllers/NguoiDungController.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $nguoiDung = new NguoiDungController();
    $nguoiDung->dangNhap($email, $password);
}