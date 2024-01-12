<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <form method="post" action="../../assets/php/login.php" id="form-login">
        <div class="login-view">
            <div class="login-view-content">
                <h1>ĐĂNG NHẬP</h1>
                <?php
                    if(isset($_COOKIE['errorLogin'])) {
                        echo "<span class='mb-4 text-start' style='color: #d50101'>{$_COOKIE['errorLogin']}</span>";
                    }
                ?>
                <div class="user-name">
                    <div class="d-flex align-items-center w-100">
                        <label for="email"><i class="bi bi-person-circle"></i></label>
                        <input class="" type="email" name="email" id="email" placeholder="Email đăng nhập">
                    </div>
                    <span class="message d-block mt-3 text-start fs-4 text-danger" style="margin-left: 65px;"></span>
                </div>
                <div class="password">
                    <div class="d-flex align-items-center w-100">
                        <label for="password"><i class="bi bi-shield-lock"></i></label>
                        <input class="" type="password" id="password" name="password" placeholder="Mật khẩu">
                    </div>
                    <span class="message d-block mt-3 text-start fs-4 text-danger" style="margin-left: 65px;"></span>
                </div>
                <div class="remember-fogot-pass d-flex justify-content-between">
                    <div class="remember-password">
                        <input id="remember-pass" type="checkbox" name="remember">
                        <label for="remember-pass">Remember me</label>
                    </div>
                    <div class="fogot-register">
                        <a href="forgot-pass.php">Quên mật khẩu</a> / <a href="register.php">Đăng ký</a>
                    </div>
                </div>
                <div class="btn-login">
                    <button class="btn-login-action" type="submit">Đăng nhập</button>
                </div>
                <span>Trang này được bảo vệ bởi reCAPTCHA và áp dụng<a href="#"> Điều khoản sử dụng</a>.</span>
            </div>
        </div>
    </form>
    <script src="../../assets/js/validateFormLogin.js"></script>
</body>
</html>