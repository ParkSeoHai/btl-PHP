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
        if($nguoiDung != null) {
            $_SESSION['user'] = $nguoiDung;
            header('Location: /btl/index.php?controller=Pages&action=home');
        } else {
            header('Location: /btl/index.php?controller=Pages&action=login');
        }
    }
}