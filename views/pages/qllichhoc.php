<?php
$title = $title ?? 'Quản lý lịch học';
$userCountTable = 0;    // Số bản ghi hiển thị trên bảng
$total_records = $total_records ?? 0;     // Tổng số bản ghi
$pagination = $pagination ?? 1;     // Số trang hiện tại

$number_of_pages = ceil($total_records / 10);     // Tổng số trang

$htmlModalAdd = "";
$htmlTable = "";
$htmlBottom = "";

$html = "
    <div class='content-body'>
        <div class='header-content d-flex align-items-baseline justify-content-between'>
            <p class='header-title'>{$title}</p>
            <div class='header-action'>
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAdd'>
                    Thêm mới
                </button>
    ";

$htmlModalAdd .= "
                <!-- Modal -->
                <div class='modal fade' id='modalAdd' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thêm lịch học</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <form action='../../assets/php/addLichHoc.php' class='form-add' method='post'>
                                <div class='mb-3'>
                                    <select class='form-select' name='courseId'>
                                        <option value='0' selected>Chọn khóa học</option> ";

// Hiển thị danh sách khóa học
if(isset($listKhoaHoc)) {
    foreach($listKhoaHoc as $item) {
        $htmlModalAdd .= "<option value='{$item->getId()}'>{$item->getTenKhoaHoc()}</option>";
    }
}

$htmlModalAdd .= "                  </select>
                                </div>
                                <div class='mb-3'>
                                    <input type='date' name='ngayBatDau' class='form-control' placeholder='Ngày học'>
                                </div>
                                <div class='mb-3'>
                                    <textarea class='form-control' name='infoPhongHoc' placeholder='Thông tin phòng học'></textarea>
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
";

$htmlTable = "
        <div class='body-content table-responsive pt-4'>
            <table class='table table-light table-striped table-content'>
                <thead>
                <tr>
                    <th scope='col'>STT</th>
                    <th scope='col'>Tên khóa học</th>
                    <th scope='col'>Tên giảng viên</th>
                    <th scope='col'>Ngày bắt đầu học</th>
                    <th scope='col'>Thông tin phòng học</th>
                    <th scope='col'>Hành động</th>
                </tr>
                </thead>
                <tbody class='table-group-divider'>
    ";

// Print table
if (isset($listLichHoc)) {
    // Gán start = pagination (giá trị bắt đầu của STT)
    $start = $pagination * 10 - 9;

    // Hiển thị từng bản ghi
    foreach ($listLichHoc as $item) {
        // Format date
        $item->setThoiGianBatDau(date('Y-m-d', strtotime($item->getThoiGianBatDau())));

        $htmlTable .= "
                    <tr>
                        <th scope='row'>$start</th>
                        <td>{$item->getTenKhoaHoc()}</td>
                        <td>{$item->getTenGiangVien()}</td>
                        <td>{$item->getThoiGianBatDau()}</td>
                        <td>
                        ";

        // Tách chuỗi phòng học thành mảng
        if($item->getPhongHoc() !== '') {
            $phongHocArr = explode(',', $item->getPhongHoc());
            $htmlPhongHoc = "";
            foreach($phongHocArr as $phongHoc) {
                $phongHoc = trim($phongHoc);
                $htmlPhongHoc .= "<span class='d-block mt-2'>$phongHoc</span>";
            }
            $htmlTable .= $htmlPhongHoc;
        } else {
            $htmlTable .= "<span class='d-block'>Chưa có thông tin phòng học</span>";
        }

        $htmlTable .= "
                        </td>
                        <td class='actions'>
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateId{$item->getId()}'>
                                <i class='bi bi-pen-fill'></i>
                            </button>
                            <!-- Modal -->
                            <div class='modal fade' id='updateId{$item->getId()}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-scrollable'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa lịch học</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <form action='../../assets/php/updateLichHoc.php' class='form-update' method='post'>
                                            <div class='mb-3'>
                                                <select class='form-select' name='courseId'>
                                                    <option value='0' selected>Chọn khóa học</option> ";
        // Hiển thị danh sách khóa học
        if(isset($listKhoaHoc)) {
            foreach($listKhoaHoc as $khoaHoc) {
                $htmlTable .= $item->getKhoaHocId() == $khoaHoc->getId()
                    ? "<option value='{$khoaHoc->getId()}' selected>{$khoaHoc->getTenKhoaHoc()}</option>"
                    : "<option value='{$khoaHoc->getId()}'>{$khoaHoc->getTenKhoaHoc()}</option>";
            }
        }

        $htmlTable .= "                         </select>
                                            </div>
                                            <div class='mb-3'>
                                                <input type='text' name='id' value='{$item->getId()}' hidden=''  class='form-control'>
                                            </div>
                                            <div class='mb-3'>
                                                <input type='date' name='ngayBatDau' value='{$item->getThoiGianBatDau()}' class='form-control'>
                                            </div>
                                            <div class='mb-3'>
                                                <textarea class='form-control' name='infoPhongHoc' placeholder='Thông tin phòng học'>{$item->getPhongHoc()}</textarea>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                                <button type='submit' class='btn btn-primary btn-submit btn-submit-update'>Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href='/btl/assets/php/removeLichHoc.php?id={$item->getId()}' title='Xóa' class='btn btn-danger'>
                                <i class='bi bi-x-circle-fill'></i>
                            </a>
                        </td>
                    </tr>    
        ";
        $start++;
        $userCountTable++;
    }

    $htmlTable .= "
            </tbody>
        </table>
    ";
}

$htmlBottom .= "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>$userCountTable trong tổng $total_records</p>
                <nav aria-label='Page navigation'>
                    <ul class='pagination pe-5'> ";

// Hiển thị các trang
for ($page = 1; $page <= $number_of_pages; $page++) {
    $htmlBottom .= $page == $pagination
        ? "<li class='page-item active'><a class='page-link' href='#'>{$page}</a></li>"
        : "<li class='page-item'><a class='page-link' href='index.php?controller=Pages&action=qlnguoidung&pag={$page}'>{$page}</a></li>";
}

$htmlBottom .= "    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src='../../assets/js/validateFormAdd.js'></script>
    <script src='../../assets/js/validateFormUpdate.js'></script>
    ";

$html .= $htmlModalAdd . $htmlTable . $htmlBottom;

print_r($html);