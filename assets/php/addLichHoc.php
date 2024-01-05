<?php
require_once '../../controllers/AdminController.php';

if(isset($_POST['courseId']) && isset($_POST['ngayBatDau']) && isset($_POST['infoPhongHoc'])) {
    $courseId = $_POST['courseId'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $infoPhongHoc = $_POST['infoPhongHoc'];

    echo $courseId . " " . $ngayBatDau . " " . $infoPhongHoc;

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    $adminController->addLichHoc($courseId, $ngayBatDau, $infoPhongHoc);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}