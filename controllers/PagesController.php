<?php

namespace controllers;

use models\GiangVien;
use models\HocVien;
use models\KhoaHoc;
use models\LichHoc;
use models\NguoiDung;
use models\Quyen;
use models\ThongBao;
use models\ThongKe;

require_once('BaseController.php');
require('./models/NguoiDung.php');
require('./models/Quyen.php');
require('./models/LichHoc.php');
require('./models/KhoaHoc.php');
require('./models/GiangVien.php');
require('./models/ThongBao.php');
require('./models/HocVien.php');
require('./models/ThongKe.php');

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

    // Trang chủ
    public function home()
    {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy danh sách người dùng
        $listUser = $this->nguoiDung->getAllByDesc();

        // Lấy tổng số giảng viên
        $totalGiangVien = count($this->nguoiDung->getAllByRole(2));

        // Lấy tổng số học viên
        $hocvienModel = new HocVien();
        $totalHocVien = $hocvienModel->getTotal();

        // Lấy danh sách khóa học
        $this->khoaHoc = new KhoaHoc();
        $listKhoaHoc = $this->khoaHoc->getAllByDesc();

        $data = array(
            'title' => 'Trang chủ',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listKhoaHoc' => $listKhoaHoc,
            'totalGiangVien' => $totalGiangVien,
            'listUser' => $listUser,
            'totalHocVien' => $totalHocVien
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

    // Trang quản lý khóa học
    public function qlkhoahoc()
    {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy pagination từ URL nếu có
        $pagination = $_GET['pag'] ?? 1;

        // Số lượng người dùng trên 1 trang
        $result_per_page = 10;

        // Lấy danh sách khóa học theo pagination
        $this->khoaHoc = new KhoaHoc();
        $listCourse = $this->khoaHoc->getAllByPagination(($pagination - 1) * $result_per_page, $result_per_page);

        // Lấy danh sách giảng viên
        $listTeacher = $this->nguoiDung->getAllByRole(2);

        // Lấy tổng số khóa học
        $total_records = count($this->khoaHoc->getAll());

        $data = array(
            'title' => 'Quản lý người dùng',
            'pagination' => $pagination,
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'listTeacher' => $listTeacher,
            'listCourse' => $listCourse,
            'total_records' => $total_records,
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

    // Trang thống kê báo cáo
    public function thongke() {
        $this->nguoiDung = new NguoiDung();
        // Lấy thông tin người dùng đang đăng nhập
        $user = $this->nguoiDung->getById($this->userId);

        // Lấy year từ URL nếu có
        $year = $_GET['year'] ?? date("Y");

        // Lấy thông tin thống kê users
        $thongKe = new ThongKe();
        $dataThongKe = $thongKe->getData($year);

        // Lấy data points cho chart price
        $dataPointsPrice = $thongKe->getDataPricePoints($year);

        $data = array(
            'title' => 'Thống kê báo cáo',
            'userInfo' => $user,
            'role' => $this->nguoiDung->getRole($user->getIdQuyen()),
            'year' => $year,
            'dataThongKe' => $dataThongKe,
            'dataPointsAdmin' => $thongKe->getDataPoints(1, $year),
            'dataPointsTeacher' => $thongKe->getDataPoints(2, $year),
            'dataPointsStudent' => $thongKe->getDataPoints(3, $year),
            'dataPointsPrice' => $dataPointsPrice,
        );
        $this->render('thongkebaocao', $data, false);
    }

    // Trang báo lỗi
    public function error()
    {
        $this->render('error', array(), false);
    }
}