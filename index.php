<?php
// Lấy controller và action từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Pages';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

require_once('routes.php');
