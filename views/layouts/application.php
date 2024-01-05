<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?? 'Quản lý đăng ký khóa học online'; ?></title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                        <span class="number-thongbao">0</span>
                    </i>
                    <i class="bi bi-person"></i>
                    <div class="ms-2">
                        <p class="name-user"><?php echo isset($userInfo) ? $userInfo->getTen() : 'Error'; ?></p>
                        <p class="role-user"><?php echo $role ?? 'Error'; ?></p>
                    </div>
                </div>
            </div>
        </form>
    </header>

    <main class="d-flex">
        <!-- Navbar -->
        <nav class="navbar-content">
            <div class="navbar-member d-flex flex-column">
                <a href="/btl/index.php?controler=Pages&action=home" class="active"><i class="bi bi-houses"></i> Trang chủ</a>
                <a href="/btl/index.php?controler=Pages&action=qlnguoidung"><i class="bi bi-universal-access"></i> Người dùng</a>
                <a href=""><i class="bi bi-book"></i> Khóa học</a>
                <a href=""><i class="bi bi-calendar-date"></i> Lịch Học</a>
                <a href=""><i class="bi bi-person-fill-gear"></i> Tài khoản</a>
                <a href=""><i class="bi bi-reception-4"></i> Thống kê</a>
                <a href=""><i class="bi bi-megaphone"></i> Thông báo hệ thống</a>
                <a href="" class="mt-5"><i class="bi bi-arrow-return-left"></i> Thoát</a>
            </div>
        </nav>
        <!-- Content -->
        <div class="main-content">
            <?php echo $content ?? 'Không có nội dung'; ?>
        </div>
    </main>

    <?php
        // Print toast nếu có lỗi
        if(isset($_COOKIE['message'])) {
            $htmlToast = "
                <div class='toast-main toast-container end-0 p-3' style='top: 64px;'>
                    <div class='toast d-block fs-6 bg-white' role='alert' aria-live='assertive' aria-atomic='true'>
                        <div class='toast-header'>
                          <img src='../../assets/images/cocon..png' class='rounded me-2' style='width: 20px; height: 20px;' alt='...'>
                          <strong class='me-auto fw-bold'>Thông báo</strong>
                          <small class='text-body-secondary'>just now</small>
                          <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                        </div>
                        <div class='toast-body'>
                            {$_COOKIE['message']}
                        </div>
                    </div>
                </div>
                <script src='../../assets/js/handleToast.js'></script>
            ";
            echo $htmlToast;
        }
    ?>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>