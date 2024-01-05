<?php
require_once '../../controllers/AdminController.php';

if(isset($_POST['id']) && isset($_POST['courseId']) && isset($_POST['ngayBatDau']) && isset($_POST['infoPhongHoc'])) {
    $id = $_POST['id'];
    $courseId = $_POST['courseId'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $infoPhongHoc = $_POST['infoPhongHoc'];

    echo $courseId . " " . $ngayBatDau . " " . $infoPhongHoc . " " . $id;

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    $adminController->updateLichHoc($id, $courseId, $ngayBatDau, $infoPhongHoc);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}