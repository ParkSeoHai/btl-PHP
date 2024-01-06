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
                <a href="/btl/index.php?controler=Pages&action=qllichhoc"><i class="bi bi-calendar-date"></i> Lịch Học</a>
                <a href="/btl/index.php?controler=Pages&action=qlgiangvien"><i class="bi bi-person-fill-gear"></i> Giảng viên</a>
                <a href=""><i class="bi bi-reception-4"></i> Thống kê</a>
                <a href="/btl/index.php?controler=Pages&action=thongbao"><i class="bi bi-megaphone"></i> Thông báo hệ thống</a>
                <a href="/btl/assets/php/logout.php" class="mt-5"><i class="bi bi-arrow-return-left"></i> Thoát</a>
            </div>
        </nav>
        <!-- Content -->
        <div class="main-content">
            <!-- Test view
            <div class='content-body'>
                <div class='header-content d-flex align-items-baseline justify-content-between'>
                    <p class='header-title'>Thông báo hệ thống</p>
                    <div class='header-action'>
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAdd'>
                            Thêm mới
                        </button>
                        <div class='modal fade' id='modalAdd' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thêm thông báo</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form action='../../assets/php/addThongBao.php' class='form-add' method='post'>
                                        <div class='mb-3'>
                                            <input type='text' name='username' class='form-control' placeholder='Tiêu đề'>
                                        </div>
                                        <div class='mb-3'>
                                            <textarea name="noidung" rows="10" class='form-control textarea' placeholder="Nội dung"></textarea>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                            <button type='submit' class='btn btn-primary btn-submit btn-submit-add'>Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='body-content table-responsive pt-4'>
                    <table class='table table-light table-striped table-content'>
                        <thead>
                            <tr>
                                <th scope='col'>STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope='col'>Nội dung</th>
                                <th scope='col'>Người tạo</th>
                                <th scope='col'>Ngày tạo</th>
                                <th scope='col'>Ngày cập nhật</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class='table-group-divider'>
                            <tr>
                                <th scope='row'>1</th>
                                <th>Khóa học PHP mới</th>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut expedita iste laboriosam, laborum minima nisi possimus quidem rem sed tempore.</td>
                                <th>Park Seo Hai</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <td>
                                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#thongbaoId'>
                                        <i class='bi bi-pen-fill'></i>
                                    </button>
                                    <div class='modal fade' id='thongbaoId' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-scrollable'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa thông báo</h1>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form action='../../assets/php/addThongBao.php' class='form-add' method='post'>
                                                    <div class='mb-3'>
                                                        <input type='text' name='username' class='form-control' placeholder='Tiêu đề'>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <textarea name="noidung" rows="10" class='form-control textarea' placeholder="Nội dung"></textarea>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                                        <button type='submit' class='btn btn-primary btn-submit btn-submit-add'>Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href='/btl/assets/php/removeUser.php?id={$user->getId()}' title='Xóa' class='btn btn-danger'>
                                        <i class='bi bi-x-circle-fill'></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class='bottom-content'>
                        <div class='d-flex align-items-baseline justify-content-between'>
                            <p class='fs-5'>$userCountTable trong tổng $total_records</p>
                            <nav aria-label='Page navigation'>
                                <ul class='pagination pe-5'>
                                    <li class='page-item active'><a class='page-link' href='#'>{$page}</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <script src="../../assets/js/validateFormAdd.js"></script>
            -->

            <?php echo $content ?? 'Không có nội dung'; ?>
        </div>
    </main>

    <!-- Toast (Thông báo) -->
    <?php
        // Print toast nếu có cookie message (Thông báo)
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