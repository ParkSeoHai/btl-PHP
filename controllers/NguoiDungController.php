<?php

namespace controllers;

use models\NguoiDung;

require_once('../../models/NguoiDung.php');
require_once('BaseController.php');
require_once('PagesController.php');

class NguoiDungController extends BaseController
{
    private NguoiDung $nguoiDung;

    public function __construct()
    {
        $this->nguoiDung = new NguoiDung();
        $this->folder = 'pages';
    }

    public function dangNhap($email, $password)
    {
        $nguoiDung = $this->nguoiDung->dangNhap($email, $password);
        if ($nguoiDung != null) {
            if($nguoiDung['idQuyen'] == 1){             // Quyền 1: Admin
                $_SESSION['userAdmin'] = $nguoiDung['id'];
                header('Location: /btl/index.php?controller=Pages&action=home');
            } else if($nguoiDung['idQuyen'] == 2){      // Quyền 2: Giáo viên
                $_SESSION['userTeacher'] = $nguoiDung['id'];
                header('Location: /btl/index.php?controller=Pages&action=home');
            } else if($nguoiDung['idQuyen'] == 3){      // Quyền 3: Sinh viên
                $_SESSION['userStudent'] = $nguoiDung['id'];
                header('Location: /btl/index.php?controller=Pages&action=error');
            }
        } else {
            header('Location: /btl/index.php?controller=Pages&action=error');
        }
    }
}