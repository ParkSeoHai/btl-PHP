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
                <a href="/btl/index.php?controler=Pages&action=home" id="home"><i class="bi bi-houses"></i> Trang chủ</a>
                <a href="/btl/index.php?controler=Pages&action=qlnguoidung" id="qlnguoidung"><i class="bi bi-universal-access"></i> Người dùng</a>
                <a href="/btl/index.php?controler=Pages&action=qlkhoahoc" id="qlkhoahoc"><i class="bi bi-book"></i> Khóa học</a>
                <a href="/btl/index.php?controler=Pages&action=qllichhoc" id="qllichhoc"><i class="bi bi-calendar-date"></i> Lịch Học</a>
                <a href="/btl/index.php?controler=Pages&action=qlgiangvien" id="qlgiangvien"><i class="bi bi-person-fill-gear"></i> Giảng viên</a>
                <a href="/btl/index.php?controler=Pages&action=thongke" id="thongke"><i class="bi bi-reception-4"></i> Thống kê</a>
                <a href="/btl/index.php?controler=Pages&action=thongbao" id="thongbao"><i class="bi bi-megaphone"></i> Thông báo hệ thống</a>
                <a href="/btl/assets/php/logout.php" class="mt-5"><i class="bi bi-arrow-return-left"></i> Thoát</a>
            </div>
        </nav>
        <!-- Content -->
        <div class="main-content">
            <!-- Test view
            <div class='content-body'>
                <div class='header-content d-flex align-items-baseline justify-content-between'>
                    <p class='header-title'>Quản lý khóa học</p>
                    <div class='header-action'>
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAdd'>
                            Thêm mới
                        </button>
                        <div class='modal fade' id='modalAdd' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-scrollable'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thêm khóa học mới</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form action='../../assets/php/addKhoaHoc.php' class='form-add' method='post'>
                                        <div class='mb-3'>
                                            <input type='text' name='courseName' class='form-control' placeholder='Tên khóa học'>
                                        </div>
                                        <div class='mb-3'>
                                            <textarea name="Description" rows="5" class='form-control textarea' placeholder="Mô tả"></textarea>
                                        </div>
                                        <div class='mb-3'>
                                            <select class='form-select' name='teacherId' aria-label='Default select example'>
                                                <option value='0' selected>Chọn giảng viên</option>
                                                <option value='0'>ParkSeoHai2</option>
                                            </select>
                                        </div>
                                        <div class='mb-3'>
                                            <input type='text' name='coursePrice' class='form-control' placeholder='Giá khóa học'>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label fs-5">Ảnh khóa học</label>
                                            <input class="form-control" type="file" id="formFile">
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
                <div class='body-content table pt-4'>
                    <table class='table table-light table-striped table-content'>
                        <thead>
                            <tr>
                                <th scope='col'>STT</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên khóa học</th>
                                <th scope='col'>Giá bán</th>
                                <th scope='col'>Ngày tạo</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class='table-group-divider'>
                            <tr>
                                <th scope='row' class="text-center"><span style="position: relative; top: -20px">1</span></th>
                                <td style="width: 10%;">
                                    <span style="position: relative; top: 5px"><img src="../../assets/images/photo-book-index.jpg" style="width: 60px; height: 60px" alt=""></span>
                                </td>
                                <td style="width: 40%">
                                    <span style="position: relative; top: -30px">Lorete laboriosam, laborum minima nisi possimus quidem rem sed tempore.</span>
                                </td>
                                <td>
                                    <span style="position:relative; top: -20px">3000000</span>
                                </td>
                                <td>
                                    <span style="position:relative; top: -20px">11/1/2024</span>
                                </td>
                                <td>
                                    <div style="position: relative; top: -20px">
                                        <button type='button' class='btn btn-primary fs-4' data-bs-toggle='modal' data-bs-target='#thongbaoId'>
                                            <i class='bi bi-pen-fill'></i>
                                        </button>
                                        <div class='modal fade' id='thongbaoId' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog modal-dialog-scrollable'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa thông tin khóa học</h1>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <form action='../../assets/php/updateKhoaHoc.php' class='form-update' method='post'>
                                                        <div class='mb-3'>
                                                            <input type='text' name='courseName' class='form-control' placeholder='Tên khóa học'>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <textarea name="Description" rows="5" class='form-control textarea' placeholder="Mô tả"></textarea>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <select class='form-select' name='teacherId' aria-label='Default select example'>
                                                                <option value='0' selected>Chọn giảng viên</option>
                                                                <option value='0'>ParkSeoHai2</option>
                                                            </select>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <input type='text' name='coursePrice' class='form-control' placeholder='Giá khóa học'>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label fs-5">Ảnh khóa học</label>
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                                            <button type='submit' class='btn btn-primary btn-submit btn-submit-update'>Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href='/btl/assets/php/removeUser.php?id={$user->getId()}' title='Xóa' class='btn btn-danger fs-4'>
                                            <i class='bi bi-x-circle-fill'></i>
                                        </a>
                                    </div>
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
            <script src="../../assets/js/validateFormUpdate.js"></script>
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

    <!-- Active navbar -->
    <?php
    $navActive = $_GET['action'] ?? 'home';
    echo "
            <script>
                const navActive = document.getElementById('$navActive');
                if(navActive) {
                    navActive.classList.add('active');
                }
            </script>
        ";
    ?>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>