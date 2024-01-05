<?php
require_once '../../controllers/AdminController.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Tao doi tuong AdminController
    $adminController = new \controllers\AdminController();
    $adminController->removeLichHoc($id);
} else {
    echo "Lỗi: Không đủ dữ liệu";
}