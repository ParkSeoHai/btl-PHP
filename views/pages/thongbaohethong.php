<?php

$title = $title ?? 'Thông báo hệ thống';
$recordCountTable = 0;    // Số bản ghi hiển thị trên bảng
$total_records = $total_records ?? 1;     // Tổng số bản ghi
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
                            <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thêm thông báo</h1>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action='../../assets/php/addThongBao.php' class='form-add' method='post'>
                            <div class='mb-3'>
                                <input type='text' name='title' class='form-control' placeholder='Tiêu đề'>
                            </div>
                            <div class='mb-3'>
                                <textarea name='noidung' rows='10' class='form-control textarea' placeholder='Nội dung'></textarea>
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

// Print table
$htmlTable .=
"   <div class='body-content table-responsive pt-4'>
        <table class='table table-light table-striped table-content'>
            <thead>
                <tr>
                    <th scope='col'>STT</th>
                    <th scope='col'>Tiêu đề</th>
                    <th scope='col'>Nội dung</th>
                    <th scope='col'>Người tạo</th>
                    <th scope='col'>Ngày tạo</th>
                    <th scope='col'>Ngày cập nhật</th>
                    <th scope='col'>Hành động</th>
                </tr>
            </thead>
            <tbody class='table-group-divider'> ";

// Print table row
if(isset($listThongBao)) {
    // Gán start = pagination (giá trị bắt đầu của STT)
    $start = $pagination * 10 - 9;
    foreach ($listThongBao as $thongBao) {
        $htmlTable .= "
            <tr> 
                <th scope='row'>$start</th>
                <th>{$thongBao['tieude']}</th>
                <td style='width: 300px;'>{$thongBao['noidung']}</td>
                <th>{$thongBao['tenNguoiTao']}</th>
                <th>{$thongBao['ngaytao']}</th>
                <th>{$thongBao['ngaycapnhat']}</th>
                <td class='actions'>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#thongbao{$thongBao['id']}'>
                        <i class='bi bi-pen-fill'></i>
                    </button>
                    <div class='modal fade' id='thongbao{$thongBao['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa thông báo</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form action='../../assets/php/updateThongBao.php' class='form-update' method='post'>
                                    <div class='mb-3'>
                                        <input type='text' name='id' value='{$thongBao['id']}' hidden='hidden' class='form-control' placeholder='Tiêu đề'>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='text' name='title' value='{$thongBao['tieude']}' class='form-control' placeholder='Tiêu đề'>
                                    </div>
                                    <div class='mb-3'>
                                        <textarea name='noidung' rows='10' class='form-control' placeholder='Nội dung'>{$thongBao['noidung']}</textarea>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                        <button type='submit' class='btn btn-primary btn-submit btn-submit-update'>Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href='/btl/assets/php/removeThongBao.php?id={$thongBao['id']}' title='Xóa' class='btn btn-danger'>
                        <i class='bi bi-x-circle-fill'></i>
                    </a>
                </td>
            </tr>
        ";
        $start++;
        $recordCountTable++;
    }
}

$htmlTable .= "    
    </tbody>
        </table> ";

$htmlBottom  = "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>$recordCountTable trong tổng $total_records</p>
                <nav aria-label='Page navigation'>
                    <ul class='pagination pe-5'> ";

// Hiển thị các trang
for($page = 1; $page <= $number_of_pages; $page++) {
    $htmlBottom .= $page == $pagination
        ? "<li class='page-item active'><a class='page-link' href='#'>{$page}</a></li>"
        : "<li class='page-item'><a class='page-link' href='index.php?controller=Pages&action=thongbao&pag={$page}'>{$page}</a></li>";
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