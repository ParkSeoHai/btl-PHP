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
    private string $userId;

    public function __construct()
    {
        $this->folder = 'pages';
        $this->userId = $_SESSION['userId'];
    }

    public function index()
    {
        $this->render('index', array(),false);
    }

    public function home()
    {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        $data = array(
            'title' => 'Trang chủ',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen())
        );

        $this->render('home', $data);
    }

    // Trang quản lý người dùng
    public function qlnguoidung()
    {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng người dùng trên 1 trang
        $result_per_page = 10;

        // Lấy danh sách người dùng theo pagination
        $listUser = $this->nguoiDung->getAllByPagination(($pagination - 1) * $result_per_page, $result_per_page);

        // Lấy tổng số người dùng
        $total_records = count($this->nguoiDung->getAll());

        // Lấy danh sách quyền
        $this->quyen = new Quyen();
        $listRole = $this->quyen->getAll();

        $data = array(
            'title' => 'Quản lý người dùng',
            'pagination' => $pagination,
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listUserPage' => $listUser,
            'total_records' => $total_records,
            'listRole' => $listRole
        );
        $this->render('qlnguoidung', $data);
    }

    public function error()
    {
        $this->render('error', array(), false);
    }
}