<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <form class="register-view form-register" method="post" action="../../assets/php/register.php">
        <div class="register-view-content">
            <h1>ĐĂNG KÝ</h1>
            <div class="error-register text-start text-danger mb-4 fw-bold">
                <?php
                    if(isset($_COOKIE['errorRegister'])) {
                        echo $_COOKIE['errorRegister'];
                    }
                ?>
            </div>
            <div class="user-name">
                <div class="d-flex align-items-center w-100">
                    <label for="username"><i class="bi bi-person-circle"></i></label>
                    <input type="text" id="username" name="username" placeholder="Tên người dùng">
                </div>
            </div>
            <div class="user-name">
                <div class="d-flex align-items-center w-100">
                    <label for="phone-number"><i class="bi bi-telephone"></i></label>
                    <input type="text" id="phone-number" name="phoneNumber" placeholder="Số điện thoại">
                </div>
            </div>
            <div class="input-email">
                <div class="d-flex align-items-center w-100">
                    <label for="email"><i class="bi bi-envelope"></i></label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="password">
                <div class="d-flex align-items-center w-100">
                    <label for="password"><i class="bi bi-shield-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Mật khẩu">
                </div>
            </div>
            <div class="password-lv2">
                <div class="d-flex align-items-center w-100">
                    <label for="password-confirm"><i class="bi bi-shield-lock-fill"></i></label>
                    <input type="password" id="password-confirm" name="password-confirm" placeholder="Xác nhận mật khẩu">
                </div>
            </div>
            <div class="checkbox-dksd">
                <input id="agree" name="agree" type="checkbox">
                <label for="agree">Tôi đồng ý với điều khoản sử dụng</label>
            </div>
            <button class="btn-register" type="submit">Đăng ký</button>
            <a href="login.php" class="text-dark d-block pt-3 float-start">Đăng nhập</a>
        </div>
    </form>
    <script src="../../assets/js/validateFormRegister.js"></script>
</body>
</html>
