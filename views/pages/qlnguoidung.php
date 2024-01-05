<?php

$title = $title ?? 'Quản lý người dùng';
$userCountTable = 0;    // Số người dùng hiển thị trên bảng
$total_records = $total_records ?? 0;     // Tổng số người dùng
$pagination = $pagination ?? 1;     // Số trang hiện tại

$number_of_pages = ceil($total_records / 10);     // Tổng số trang

$htmlModalAdd = "";
$htmlTable = "";

$html = "
    <div class='content-body'>
        <div class='header-content d-flex align-items-baseline justify-content-between'>
            <p class='header-title'>{$title}</p>
            <div class='header-action'>
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                    Thêm mới
                </button>
                <!-- Modal -->
    ";

// Print modal add user
if(isset($listRole)) {
    $htmlModalAdd .= "
                <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Thêm người dùng</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <form action='../../assets/php/addUser.php' class='form-add' method='post'>
                                <div class='mb-3'>
                                    <input type='text' name='username' class='form-control' placeholder='Họ và tên'>
                                </div>
                                <div class='mb-3'>
                                    <input type='email' name='email' class='form-control' placeholder='Email'>
                                </div>
                                <div class='mb-3'>
                                    <input type='text' name='phoneNumber' id='phone-number' class='form-control' placeholder='Số điện thoại'>
                                </div>
                                <div class='mb-3'>
                                    <select class='form-select' name='role' aria-label='Default select example'>
                                        <option value='0' selected>Quyền</option>
                                        ";

    for($i = 0; $i < count($listRole); ++$i) {
        $htmlModalAdd .= "<option value='{$listRole[$i]->getId()}'>{$listRole[$i]->getTenQuyen()}</option>";
    }

    $htmlModalAdd .= "               </select>
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
    ";
}

$htmlTable = "
    <table class='table table-light table-striped table-content'>
        <thead>
            <tr>
                <th scope='col'>STT</th>
                <th scope='col'>Họ tên</th>
                <th scope='col'>Email</th>
                <th scope='col'>Số điện thoại</th>
                <th scope='col'>Ngày tạo</th>
                <th scope='col'>Quyền</th>
                <th scope='col'>Hành động</th>
            </tr>
        </thead>
        <tbody class='table-group-divider'>
    ";

// Print table user
if(isset($listUserPage)) {
    // Gán start = pagination (giá trị bắt đầu của STT)
    $start = $pagination * 10 - 9;

    foreach($listUserPage as $user) {
        $htmlTable .= "
            <tr>
                <th scope='row'>$start</th>
                <td>{$user->getTen()}</td>
                <td>{$user->getEmail()}</td>
                <td>{$user->getSoDienThoai()}</td>
                <td>{$user->getNgayTao()}</td>
                <td>{$user->getRole($user->getIdQuyen())}</td>
                <td class='actions'>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#userId{$user->getId()}'>
                        <i class='bi bi-pen-fill'></i>
                    </button>
                    <div class='modal fade' id='userId{$user->getId()}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-scrollable'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-4 fw-bold' id='exampleModalLabel'>Sửa người dùng</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form action='../../assets/php/updateUser.php' class='form-update' method='post'>
                                    <div class='mb-3'>
                                        <input type='text' name='id' value='{$user->getId()}' class='form-control d-none'>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='text' name='username' value='{$user->getTen()}' class='form-control' placeholder='Họ và tên'>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='email' name='email' value='{$user->getEmail()}' class='form-control' placeholder='Email'>
                                    </div>
                                    <div class='mb-3'>
                                        <input type='text' name='phoneNumber' value='{$user->getSoDienThoai()}' id='phone-number' class='form-control' placeholder='Số điện thoại'>
                                    </div>
                                    <div class='mb-3'>
                                        <select class='form-select' name='role' aria-label='Default select example'>
                                            <option value='0'>Quyền</option> ";
        // Print list role
        if(isset($listRole)) {
            for($i = 0; $i < count($listRole); ++$i) {
                $htmlTable .= $listRole[$i]->getId() == $user->getIdQuyen()
                    ? "<option value='{$listRole[$i]->getId()}' selected>{$listRole[$i]->getTenQuyen()}</option>"
                    : "<option value='{$listRole[$i]->getId()}'>{$listRole[$i]->getTenQuyen()}</option>";
            }
        }

        $htmlTable .= "                 </select>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Hủy</button>
                                        <button type='submit' class='btn btn-primary btn-submit btn-submit-update'>Lưu</button>
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
        ";
        $start++;
        $userCountTable++;
    }

    $htmlTable .= "
            </tbody>
        </table>
    ";
}

$htmlBottom  = "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>$userCountTable trong tổng $total_records</p>
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
    <script src='../../assets/js/validateFormAdd.js'></script>
    <script src='../../assets/js/validateFormUpdate.js'></script>
    ";

$html .= $htmlModalAdd . $htmlTable . $htmlBottom;

print_r($html);