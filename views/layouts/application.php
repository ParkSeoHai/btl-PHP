<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($title) ? $title : 'Quản lý đăng ký khóa học online'; ?></title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <header>
        <form action="" class="header">
            <div class="header-content d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="logo-thuong-hieu">
                        <img src="../../assets/images/cocon..png" alt="">
                    </div>
                    <div class="header-search ">
                        <input type="text" placeholder="Tìm kiếm...">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
                <div class="header-left">
                    <i class="bi bi-bell">
                        <p class="number-thongbao">
                            0
                        </p>
                    </i>
                    <i class="bi bi-person"></i>
                    <span>Xin chào, </span>
                </div>
            </div>
        </form>
    </header>

    <main class="d-flex main-content">
        <!-- Navbar -->
        <form action="" class="navbar-content">
            <div class="navbar-member d-flex flex-column">
                <a href=""><i class="bi bi-houses"></i> Trang chủ</a>
                <a href=""><i class="bi bi-universal-access"></i> Người dùng</a>
                <a href=""><i class="bi bi-book"></i> Khóa học</a>
                <a href=""><i class="bi bi-calendar-date"></i> Lịch Học</a>
                <a href=""><i class="bi bi-person-fill-gear"></i> Tài khoản</a>
                <a href=""><i class="bi bi-reception-4"></i> Thống kê</a>
                <a href=""><i class="bi bi-megaphone"></i> Thông báo hệ thống</a>
                <a href="" class="mt-5"><i class="bi bi-arrow-return-left"></i> Thoát</a>
            </div>
        </form>
        <nav style="width: 200px; height: 200px; background-color: #ff5757"></nav>
        <!-- Content -->
        <div class="main-content">
            <?php echo isset($content) ? $content : 'Không có nội dung'; ?>
        </div>
    </main>
</body>
</html>