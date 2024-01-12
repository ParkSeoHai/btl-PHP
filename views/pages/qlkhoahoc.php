<?php
$title = $title ?? 'Quản lý khóa học';
$courseCountTable = 0;    // Số khóa học hiển thị trên bảng
$total_records = $total_records ?? 0;     // Tổng số khóa học
$pagination = $pagination ?? 1;     // Số trang hiện tại

$number_of_pages = ceil($total_records / 10);     // Tổng số trang

$htmlTable = "";

$html = "
<div class='content-body'>
    <div class='header-content d-flex align-items-baseline justify-content-between'>
        <p class='header-title'>$title</p>
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
                                <textarea name='description' rows='5' class='form-control textarea' placeholder='Mô tả'></textarea>
                            </div>
                            <div class='mb-3'>
                                <select class='form-select' name='teacherId' aria-label='Default select example'>
                                    <option value='0' selected>Chọn giảng viên</option> ";

// Hiển thị danh sách giảng viên
if(isset($listTeacher) && count($listTeacher) > 0) {
    foreach($listTeacher as $teacher) {
        $html .= "<option value='{$teacher->getId()}'>{$teacher->getId()} - {$teacher->getTen()}</option>";
    }
}

$html .= "
                                </select>
                            </div>
                            <div class='mb-3'>
                                <input type='text' name='coursePrice' class='form-control' placeholder='Giá khóa học'>
                            </div>
                            <div class='mb-3'>
                                <label for='formFile' class='form-label fs-5'>Ảnh khóa học</label>
                                <input class='form-control' name='courseImage' type='file' id='formFile'>
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
    </div> ";

// Nếu có khóa học thì hiển thị bảng
$htmlTable .= "
    <div class='body-content table pt-4'>
        <table class='table table-light table-striped table-content'>
            <thead>
                <tr>
                    <th scope='col'>STT</th>
                    <th scope='col'>Hình ảnh</th>
                    <th scope='col'>Tên khóa học</th>
                    <th scope='col'>Giá bán</th>
                    <th scope='col'>Ngày tạo</th>
                    <th scope='col'>Hành động</th>
                </tr>
            </thead>
            <tbody class='table-group-divider'> ";

// Hiển thị danh sách khóa học
if(isset($listCourse) && count($listCourse) > 0) {
    // Gán start = pagination (giá trị bắt đầu của STT)
    $start = $pagination * 10 - 9;
    foreach ($listCourse as $course) {
        $htmlTable .= "
                <tr>
                    <th scope='row' class='text-center'><span style='position: relative; top: -20px'>$start</span></th>
                    <td style='width: 10%;'>
                        <div style='position: relative; top: 5px; min-height: 70px'>
                            <img src='{$course->getHinhAnh()}' style='width: 60px; height: 60px' alt='{$course->getTenKhoaHoc()}'>
                        </div>
                    </td>
                    <td style='width: 40%'>
                        <div class='d-flex align-items-baseline' style='position: relative; top: -10px; min-height: 40px;'>
                            <span>{$course->getTenKhoaHoc()}</span>
                        </div>
                    </td>
                    <td>
                        <span style='position:relative; top: -20px'>{$course->getGiaBan()}</span>
                    </td>
                    <td>
                        <span style='position:relative; top: -20px'>{$course->getNgayTao()}</span>
                    </td>
                    <td>
                        <div style='position: relative; top: -20px'>
                            <button type='button' class='btn btn-primary fs-4' data-bs-toggle='modal' data-bs-target='#khoaHoc{$course->getId()}'>
                                <i class='bi bi-pen-fill'></i>
                            </button>
                            <div class='modal fade' id='khoaHoc{$course->getId()}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-scrollable'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa thông tin khóa học</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <form action='../../assets/php/updateKhoaHoc.php' class='form-update' method='post'>
                                            <div class='mb-3'>
                                                <input type='text' name='courseId' value='{$course->getId()}' hidden='hidden' class='form-control'>
                                            </div>
                                            <div class='mb-3'>
                                                <input type='text' name='courseName' value='{$course->getTenKhoaHoc()}' class='form-control' placeholder='Tên khóa học'>
                                            </div>
                                            <div class='mb-3'>
                                                <textarea name='description' rows='5' class='form-control textarea' placeholder='Mô tả'>
                                                    {$course->getMota()}
                                                </textarea>
                                            </div>
                                            <div class='mb-3'>
                                                <select class='form-select' name='teacherId' aria-label='Default select example'>
                                                    <option value='0' selected>Chọn giảng viên</option> ";
        // Hiển thị danh sách giảng viên
        if(isset($listTeacher) && count($listTeacher) > 0) {
            foreach($listTeacher as $teacher) {
                $htmlTable .= $teacher->getId() == $course->getIdNguoiDay()
                    ? "<option value='{$teacher->getId()}' selected>{$teacher->getId()} - {$teacher->getTen()}</option>"
                    : "<option value='{$teacher->getId()}'>{$teacher->getId()} - {$teacher->getTen()}</option>";
            }
        }

        $htmlTable .= "
                                                </select>
                                            </div>
                                            <div class='mb-3'>
                                                <input type='text' name='coursePrice' value='{$course->getGiaBan()}' class='form-control' placeholder='Giá khóa học'>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='formFile' class='form-label fs-5'>Ảnh khóa học</label>
                                                <input class='form-control' name='courseImage' type='file' id='formFile'>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                                <button type='submit' class='btn btn-primary btn-submit btn-submit-update'>Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href='/btl/assets/php/removeKhoaHoc.php?id={$course->getId()}' title='Xóa' class='btn btn-danger fs-4'>
                                <i class='bi bi-x-circle-fill'></i>
                            </a>
                        </div>
                    </td>
                </tr>
            ";
        ++$start;
        $courseCountTable++;
    }

}
$htmlTable .= "</tbody>
        </table> ";

// Bottom
$htmlBottom  = "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>$courseCountTable trong tổng $total_records</p>
                <nav aria-label='Page navigation'>
                    <ul class='pagination pe-5'> ";

// Hiển thị các trang
for($page = 1; $page <= $number_of_pages; $page++) {
    $htmlBottom .= $page == $pagination
        ? "<li class='page-item active'><a class='page-link' href='#'>{$page}</a></li>"
        : "<li class='page-item'><a class='page-link' href='index.php?controller=Pages&action=qlkhoahoc&pag={$page}'>{$page}</a></li>";
}

$htmlBottom .= "    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src='../../assets/js/validateFormAdd.js'></script>
    <script src='../../assets/js/validateFormUpdate.js'></script>
    ";

print_r($html . $htmlTable . $htmlBottom);