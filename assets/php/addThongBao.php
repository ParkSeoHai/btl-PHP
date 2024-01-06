<?php session_start();
if(isset($_POST['title']) && isset($_POST['noidung']) && isset($_SESSION['userId'])) {
    $title = $_POST['title'];
    $noidung = $_POST['noidung'];
    $nguoiTaoId = $_SESSION['userId'];

    echo $title . " " . $noidung . " " . $nguoiTaoId;

    // Tao doi tuong AdminController
    require_once '../../controllers/AdminController.php';

    $adminController = new \controllers\AdminController();
    $adminController->addThongBao($title, $noidung, $nguoiTaoId);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}