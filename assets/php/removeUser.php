<?php
if(isset($_GET['id'])) {
    require_once '../../controllers/AdminController.php';

    $id = $_GET['id'];
    $adminController = new \controllers\AdminController();
    $adminController->removeUser($id);
}