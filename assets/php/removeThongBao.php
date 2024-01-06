<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Tao doi tuong AdminController
    require_once '../../controllers/AdminController.php';

    $adminController = new \controllers\AdminController();
    $adminController->removeThongBao($id);
}