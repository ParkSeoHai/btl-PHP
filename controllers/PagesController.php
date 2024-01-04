<?php

namespace controllers;

use models\NguoiDung;
use models\Quyen;

require_once('BaseController.php');
require('./models/NguoiDung.php');
require('./models/Quyen.php');

class PagesController extends BaseController
{
    private NguoiDung $nguoiDung;
    private Quyen $quyen;

    public function __construct()
    {
        $this->folder = 'pages';
        $this->nguoiDung = new NguoiDung();
        $this->quyen = new Quyen();
    }

    public function index()
    {
        $this->render('index', array(),false);
    }

    public function home()
    {
        $user = $this->nguoiDung->getById($_SESSION['userId']);

        $data = array(
            'title' => 'Trang chủ',
            'user' => $user,
            'role' => $user->getRole($user->getIdQuyen())
        );

        $this->render('home', $data);
    }

    // Trang quản lý người dùng
    public function qlnguoidung()
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($_SESSION['userId']);

        // Lấy danh sách người dùng
        $listUser = $this->nguoiDung->getAll();

        // Lấy danh sách quyền
        $listRole = $this->quyen->getAll();

        $data = array(
            'title' => 'Quản lý người dùng',
            'user' => $user,
            'role' => $user->getRole($user->getIdQuyen()),
            'listUser' => $listUser,
            'listRole' => $listRole
        );
        $this->render('qlnguoidung', $data);
    }

    public function error()
    {
        $this->render('error', array(), false);
    }
}