<?php

if(isset($_GET['id'])) {
    require_once '../../controllers/AdminController.php';

    $id = $_GET['id'];

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    $adminController->removeKhoaHoc($id);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}