<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/fonts/font.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <div class="login-view">
        <div class="login-view-content">
            <h1>ĐĂNG NHẬP</h1>
            <div class="user-name">
                <i class="bi bi-person-circle"></i>
                <input type="text" placeholder="Tên đăng nhập">
            </div>
            <div class="password">
                <i class="bi bi-shield-lock"></i>
                <input type="password" placeholder="Mật khẩu">
            </div>
            <div class="remember-fogot-pass d-flex justify-content-between">
                <div class="remember-password">
                    <input id="remember-pass" type="checkbox">
                    <label for="remember-pass">Remember me</label>
                </div>
                <div class="fogot-register">
                    <a href="fogot-pass-view.php">Quên mật khẩu</a>/<a href="register-view.php">Đăng kí</a>
                </div>
            </div>
            <div class="btn-login">
                <button class="btn-login-action" type="button">Đăng nhập</button>
            </div>
            <span>Trang này được bảo vệ bởi reCAPTCHA và áp dụng<a href=""> Điều khoản sử dụng</a>.</span>
        </div>
    </div>
</body>
</html>