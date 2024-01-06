<?php

$title = $title ?? 'Quản lý giảng viên';
$teacherCountTable = 0;    // Số bản ghi hiển thị thực tế trên bảng
$recordsPerPage = $recordsPerPage ?? 10;     // Số bản ghi hiển thị trên 1 trang
$total_records = $total_records ?? 0;     // Tổng số bản ghi
$pagination = $pagination ?? 1;     // Số trang hiện tại

$number_of_pages = ceil($total_records / $recordsPerPage);     // Tổng số trang

$html = "
    <div class='content-body'>
        <div class='header-content d-flex align-items-baseline justify-content-between'>
            <p class='header-title'>$title</p>
        </div>
        <div class='body-content table-responsive pt-4'>
            <table class='table table-light table-striped table-content'>
                <thead>
                    <tr>
                        <th scope='col'>STT</th>
                        <th scope='col'>Mã giảng viên</th>
                        <th scope='col'>Tên giảng viên</th>
                        <th scope='col'>Thông tin khóa học</th>
                        <th scope='col'>Thông tin liên hệ</th>
                        <th scope='col'>Ngày tham gia</th>
                    </tr>
                </thead>
                <tbody class='table-group-divider'> ";

if(isset($listTeacher)) {
    // Gán start = pagination (giá trị bắt đầu của STT)
    $start = $pagination * 10 - 9;

    foreach ($listTeacher as $item) {
        $html .= "
            <tr>
                <th scope='row'>$start</th>
                <th>{$item["id"]}</th>
                <td>{$item["ten"]}</td>
                <td>
                    <button type='button' class='btn btn-primary fs-5' style='width: 65%;' data-bs-toggle='modal' data-bs-target='#modalCoure{$item["id"]}'>
                        Xem chi tiết
                    </button>
                    <div class='modal fade' id='modalCoure{$item["id"]}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-scrollable' style='max-width: 800px;'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thông tin các khóa học đang giảng dạy</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'> ";

        // Hiển thị danh sách khóa học
        if(!count($item["courses"]) > 0) {      // Nếu không có khóa học nào
            $html .= "              <div class='empty pb-3'>
                                        <span>Giảng viên chưa tham gia khóa học nào</span>
                                    </div>
                                 <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Thoát</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class='d-block mb-2'>Số điện thoại: {$item["soDienThoai"]}</span>
                    <span class='d-block mb-2'>Email: {$item["email"]}</span>
                </td>
                <td>{$item["ngayTao"]}</td>
            </tr> 
            ";
        }
        else {
            $html .= "               <div class='block-course'>
                                        <div class='list-course'> ";
            foreach ($item["courses"] as $course) {
                // Format date
                $dateCoure = date('m-d-Y', strtotime($course["ngayTao"]));
                $html .= "                  <div class='item-content'>
                                                <div class='item-content-top'>
                                                    <div class='block d-flex align-items-baseline'>
                                                        <h3 class='item-content-top-title fw-bold'>Tên khóa học: {$course["tenKhoaHoc"]}</h3>
                                                        <p class='item-content-top-date'>$dateCoure</p>
                                                    </div>
                                                    <button class='btn btn-primary btn-show-schedule'>Xem lịch học</button>
                                                </div>
                                                <div class='block-schedule'>
                                                    <div class='item-content-bottom'>
                                                        <p class='item-content-bottom-desc'>
                                                            Mô tả: {$course["moTa"]}
                                                        </p>
                                                    </div> 
                                                    <!-- Modal lịch học -->
                                                    <div class='modal-schedule d-none'>
                                                        <div class='modal-schedule-content'>
                                                            <div class='modal-schedule-content-header d-flex align-items-center justify-content-between mb-3'>
                                                                <h3 class='modal-schedule-content-header-title'>Lịch học</h3>
                                                                <button class='btn-close'></button>
                                                            </div>
                                                            <div class='modal-schedule-content-body'>
                                                                <div class='modal-schedule-content-body-item'>
                                                                    <div class='modal-schedule-content-body-item-title'> ";

                // Hiển thị lịch học
                if(isset($course["schedule"])) {
                    // Format date
                    $course["schedule"]->setThoiGianBatDau(date('m-d-Y', strtotime($course["schedule"]->getThoiGianBatDau())));

                    $html .= "    <span class='pb-2 d-block'>{$course["schedule"]->getPhongHoc()}</span>
                                  <span class='pb-2 d-block'>Ngày bắt đầu: {$course["schedule"]->getThoiGianBatDau()}</span>
                                  <span class='pb-2 d-block'>Giảng viên: {$item["ten"]}</span> ";

                }

                $html .= "                                           </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> ";
            }
            $html .= "                   </div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Thoát</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class='d-block mb-2'>Số điện thoại: {$item["soDienThoai"]}</span>
                    <span class='d-block mb-2'>Email: {$item["email"]}</span>
                </td>
                <td>{$item["ngayTao"]}</td>
            </tr>
            ";
        }
        $start++;
        $teacherCountTable++;
    }
    $html .= " </tbody>
          </table> ";
}

$htmlBottom  = "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>$teacherCountTable trong tổng $total_records</p>
                <nav aria-label='Page navigation'>
                    <ul class='pagination pe-5'> ";

// Hiển thị các trang
for($page = 1; $page <= $number_of_pages; $page++) {
    $htmlBottom .= $page == $pagination
        ? "<li class='page-item active'><a class='page-link' href='#'>{$page}</a></li>"
        : "<li class='page-item'><a class='page-link' href='index.php?controller=Pages&action=qlnguoidung&pag={$page}'>{$page}</a></li>";
}

$htmlBottom .= "    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src='../../assets/js/modalQlGiangVien.js'></script>
";

print_r($html . $htmlBottom);