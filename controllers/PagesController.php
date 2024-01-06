<?php

namespace controllers;

use models\GiangVien;
use models\KhoaHoc;
use models\LichHoc;
use models\NguoiDung;
use models\Quyen;
use models\ThongBao;

require_once('BaseController.php');
require('./models/NguoiDung.php');
require('./models/Quyen.php');
require('./models/LichHoc.php');
require('./models/KhoaHoc.php');
require('./models/GiangVien.php');
require('./models/ThongBao.php');

class PagesController extends BaseController
{
    private NguoiDung $nguoiDung;
    private Quyen $quyen;
    private LichHoc $lichHoc;
    private KhoaHoc $khoaHoc;
    private GiangVien $giangVien;
    private ThongBao $thongBao;
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

    public function qlkhoahoc(){
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng khóa học trên 1 trang
        $result_per_page = 10;

        $data = array(
            'title' => 'Quản lý người dùng',
            'pagination' => $pagination,
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
        );
        $this->render('qlkhoahoc', $data);
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

        // Lấy danh sách lịch học theo pagination
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

    // Trang quản lý giảng viên
    public function qlgiangvien() {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng bản ghi trên 1 trang
        $result_per_page = 10;

        // Lấy danh sách giảng viên theo pagination
        $this->giangVien = new GiangVien();
        $listTeacher = $this->giangVien->getAllByPagination(($pagination - 1) * $result_per_page, $result_per_page);

        // Lấy tổng số giảng viên
        $total_records = count($this->giangVien->getAll());

        $data = array(
            'title' => 'Quản lý giảng viên',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listTeacher' => $listTeacher,
            'recordsPerPage' => $result_per_page,
            'total_records' => $total_records,
        );
        $this->render('qlgiangvien', $data);
    }

    // Trang thông báo
    public function thongbao() {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng bản ghi trên 1 trang
        $result_per_page = 10;

        // Lấy danh sách thông báo theo pagination
        $this->thongBao = new ThongBao();
        $listThongBao = $this->thongBao->getAllByPagination(($pagination - 1) * $result_per_page, $result_per_page);

        // Lấy tổng số người dùng
        $total_records = count($this->thongBao->getAll());

        $data = array(
            'title' => 'Thông báo',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listThongBao' => $listThongBao,
            'total_records' => $total_records,
        );
        $this->render('thongbaohethong', $data);
    }

    public function error()
    {
        $this->render('error', array(), false);
    }
}