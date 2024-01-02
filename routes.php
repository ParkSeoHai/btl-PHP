<?php

global $controller, $action;

$controllers = array(
    'Pages' => ['home', 'login', 'error'],
);  // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'Pages';
    $action = 'error';
}

// Include the controller file
$controllerClass = $controller . 'Controller';
$controllerFile = 'controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    // Nếu file controller tồn tại thì gọi nó ra để sử dụng
    include_once($controllerFile);

    // Instantiate the controller and call the action
    try {
        $controllerClass = '\controllers\\' . $controllerClass;
        $obj = new $controllerClass();
        $obj->$action();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    // Handle the case where the controller file is missing
    die('Controller file not found');
}