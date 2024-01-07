<?php

$title = $title ?? 'Trang chủ';
$totalGiangVien = $totalGiangVien ?? 0;
$listKhoaHoc = $listKhoaHoc ?? array();
$totalKhoaHoc = count($listKhoaHoc);
$totalHocVien = $totalHocVien ?? 0;


$listUser = $listUser ?? array();
$totalUser = count($listUser);

$html = "
<div class='content-body'>
    <div class='header-content d-flex align-items-baseline justify-content-between'>
        <p class='header-title'>$title</p>
    </div>
    <div class='box-total-list'>
        <div class='box-total-item'>
            <div class='box-total-item-content'>
                <p class='box-total-item-title'>Số học viên</p>
                <div class='box-total-item-icon'>
                    <i class='bi bi-person-fill'></i>
                    <p class='box-total-item-number'>$totalHocVien</p>
                </div>
            </div>
        </div>
        <div class='box-total-item'>
            <div class='box-total-item-content'>
                <p class='box-total-item-title'>Số giảng viên</p>
                <div class='box-total-item-icon'>
                    <i class='bi bi-person-workspace'></i>
                    <p class='box-total-item-number'>$totalGiangVien</p>
                </div>
            </div>
        </div>
        <div class='box-total-item'>
            <div class='box-total-item-content'>
                <p class='box-total-item-title'>Số khóa học</p>
                <div class='box-total-item-icon'>
                    <i class='bi bi-book'></i>
                    <p class='box-total-item-number'>$totalKhoaHoc</p>
                </div>
            </div>
        </div>
        <div class='box-total-item'>
            <div class='box-total-item-content'>
                <p class='box-total-item-title'>Số tài khoản</p>
                <div class='box-total-item-icon'>
                    <i class='bi bi-person-circle'></i>
                    <p class='box-total-item-number'>$totalUser</p>
                </div>
            </div>
        </div>
    </div>
    <div class='table-content-list d-flex justify-content-between pt-5 px-4'> 
";

// Print list nguoi dung
if(isset($listUser)) {
    $stt = 1;
    $html .= "
        <div class='table-responsive'>
            <div class='table-tile'>
                <p>Người dùng mới</p>
            </div>
            <table class='table table-light table-striped table-content'>
                <thead>
                    <tr>
                        <th scope='col'>STT</th>
                        <th scope='col'>Họ tên</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Số điện thoại</th>
                        <th scope='col'>Quyền</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'> ";
    foreach($listUser as $user) {
        $html .= "
                    <tr>
                        <th scope='row'>$stt</th>
                        <td>{$user['hoten']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['sodienthoai']}</td>
                        <td>{$user['quyen']}</td>
                    </tr>
        ";
        $stt++;
        if($stt > 5) break;
    }
    $html .= "
                </tbody>
            </table>
        </div> ";
}

// Print list khoa hoc
if(isset($listKhoaHoc)) {
    $html .= "
        <div class='table-responsive'>
            <div class='table-tile'>
                <p>Khóa học mới</p>
            </div>
            <table class='table table-light table-striped table-content'>
                <thead>
                    <tr>
                        <th scope='col'>STT</th>
                        <th scope='col'>Tên khóa học</th>
                        <th scope='col'>Ngày tạo</th>
                        <th scope='col'>Ngày cập nhật</th>
                        <th scope='col'>Người dạy</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'> 
    ";
    $stt = 1;
    foreach($listKhoaHoc as $khoaHoc) {
        $khoaHoc['ngaytao'] = date('d/m/Y', strtotime($khoaHoc['ngaytao']));
        $khoaHoc['ngaycapnhat'] = date('d/m/Y', strtotime($khoaHoc['ngaycapnhat']));
        $html .= "
                    <tr>
                        <th scope='row'>$stt</th>
                        <td style='max-width: 190px;'>{$khoaHoc['tenkhoahoc']}</td>
                        <td>{$khoaHoc['ngaytao']}</td>
                        <td>{$khoaHoc['ngaycapnhat']}</td>
                        <td>{$khoaHoc['nguoiday']}</td>
                    </tr>
        ";
        $stt++;
        if($stt > 6) break;
    }
    $html .= "
                </tbody>
            </table>
        </div> ";
}

print_r($html);