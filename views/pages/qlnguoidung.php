<?php

$title = $title ?? 'Quản lý người dùng';
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
                                    <button type='submit' class='btn btn-primary btn-submit'>Lưu</button>
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

// Print table user
if(isset($listUser)) {
    $count = 1;
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

    foreach ($listUser as $user) {
        $htmlTable .= "
            <tr>
                <th scope='row'>$count</th>
                <td>{$user->getTen()}</td>
                <td>{$user->getEmail()}</td>
                <td>{$user->getSoDienThoai()}</td>
                <td>{$user->getNgayTao()}</td>
                <td>{$user->getRole($user->getIdQuyen())}</td>
                <td class='actions'>
                    <a href='' title='Sửa' class='btn btn-primary'>
                        <i class='bi bi-pen-fill'></i>
                    </a>
                    <a href='' title='Xóa' class='btn btn-danger'>
                        <i class='bi bi-x-circle-fill'></i>
                    </a>
                </td>
            </tr>
        ";
        $count++;
    }

    $htmlTable .="
        </tbody>
            </table>
        </div>";
}

$htmlBottom  = "
        <div class='bottom-content'>
            <div class='d-flex align-items-baseline justify-content-between'>
                <p class='fs-5'>10 trong tổng 130</p>
                <nav aria-label='Page navigation'>
                    <ul class='pagination'>
                        <li class='page-item'>
                            <a class='page-link' href='#' aria-label='Previous'>
                                <span aria-hidden='true'>&laquo;</span>
                            </a>
                        </li>
                        <li class='page-item'><a class='page-link active' href='#'>1</a></li>
                        <li class='page-item'><a class='page-link' href='#'>2</a></li>
                        <li class='page-item'><a class='page-link' href='#'>3</a></li>
                        <li class='page-item'>
                            <a class='page-link' href='#' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src='../../assets/js/validateFormAddUser.js'></script>
    ";

$html .= $htmlModalAdd . $htmlTable . $htmlBottom;

print_r($html);