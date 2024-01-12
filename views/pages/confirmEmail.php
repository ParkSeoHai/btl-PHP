<?php session_start();
    if(isset($_SESSION['code']) && isset($_SESSION['userRegister'])) {
        $code = $_SESSION['code'];
        $user = $_SESSION['userRegister'];
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận Email</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <form class="register-view form-register" method="post" action="confirmEmail.php">
        <div class="register-view-content">
            <h1 class="pb-3 mb-0">XÁC NHẬN EMAIL ĐĂNG KÝ</h1>
            <div class="error-register text-start text-danger mb-4 fw-bold">
                <?php
                    if(isset($_COOKIE['errorConfirmEmail'])) {
                        echo $_COOKIE['errorConfirmEmail'];
                    }
                ?>
            </div>
            <div class="user-name">
                <p>Vui lòng kiểm tra email của bạn và nhập mã code dài 6 chữ số.</p>
                <div class="d-flex justify-content-center align-items-baseline w-100 pt-4 pb-2">
                    <input class="ms-0 w-50 text-center fs-3 fw-bold" type="text" name="code" autofocus autocomplete="false" required placeholder="Enter code">
                </div>
            </div>
            <button class="btn-register" name="confirm" type="submit">Xác nhận</button>
            <a href="register.php" class="float-start mt-5 btn btn-outline-dark w-50 fs-5 text-decoration-none">Quay lại</a>
        </div>
    </form>

    <?php
        if(isset($_POST['confirm'])) {
            if($_POST['code'] == $code) {
                // Xóa session
                unset($_SESSION['code']);

                require_once('../../models/NguoiDung.php');
                require_once('../../controllers/NguoiDungController.php');
                // Tạo đối tượng người dùng
                $userController = new \controllers\NguoiDungController();
                $userModel = new \models\NguoiDung();
                $userModel->setTen($user['username']);
                $userModel->setSoDienThoai($user['phoneNumber']);
                $userModel->setEmail($user['email']);
                $userModel->setMatKhau($user['password']);
                // Thêm người dùng vào database
                $userController->dangKy($userModel);
            } else {
                setcookie('errorConfirmEmail', 'Lỗi: Mã code không đúng', time() + 1, '/');
                header('location: /btl/views/pages/confirmEmail.php');
            }
        }
    ?>
</body>
</html>