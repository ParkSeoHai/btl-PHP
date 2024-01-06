<?php session_start();

if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['noidung'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $noidung = $_POST['noidung'];

    echo $title . " " . $noidung . " " . $id;

    // Tao doi tuong AdminController
    require_once '../../controllers/AdminController.php';

    $adminController = new \controllers\AdminController();
    $adminController->updateThongBao($id, $title, $noidung);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}