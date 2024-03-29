<?php session_start();

// Lấy cookie userId nếu có
if(isset($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa?
if(!isset($_SESSION['userId'])){      // Nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
    header('Location: /btl/views/pages/index.php');
} else {                            // Nếu đã đăng nhập thì chuyển hướng đến trang chủ
    // Lấy controller và action từ URL
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'Pages';
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    require_once('routes.php');
}