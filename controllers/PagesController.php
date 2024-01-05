<?php

namespace controllers;

use models\KhoaHoc;
use models\LichHoc;
use models\NguoiDung;
use models\Quyen;

require_once('BaseController.php');
require('./models/NguoiDung.php');
require('./models/Quyen.php');
require('./models/LichHoc.php');
require('./models/KhoaHoc.php');

class PagesController extends BaseController
{
    private NguoiDung $nguoiDung;
    private Quyen $quyen;
    private LichHoc $lichHoc;
    private KhoaHoc $khoaHoc;
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

    // Trang quản lý lịch học
    public function qllichhoc() {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng bản ghi trên 1 trang
        $result_per_page = 10;

        // Lấy danh sách lịch học dùng theo pagination
        $this->lichHoc = new LichHoc();
        $listLichHoc = $this->lichHoc->getAllByPagination(($pagination - 1) * $result_per_page, $result_per_page);

        // Lấy tổng số người dùng
        $total_records = count($this->lichHoc->getAll());

        // Lấy danh sách khóa học
        $this->khoaHoc = new KhoaHoc();
        $listKhoaHoc = $this->khoaHoc->getAll();

        $data = array(
            'title' => 'Quản lý lịch học',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listLichHoc' => $listLichHoc,
            'listKhoaHoc' => $listKhoaHoc,
            'total_records' => $total_records,
        );
        $this->render('qllichhoc', $data);
    }

    public function error()
    {
        $this->render('error', array(), false);
    }
}