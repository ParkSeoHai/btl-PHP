<?php

namespace models;

require_once('connection.php');

class KhoaHoc
{
    private int $id;
    private string $tenKhoaHoc;
    private string $moTa;
    private float $giaBan;
    private string $hinhAnh;
    private string $ngayTao;
    private string $ngayCapNhat;
    private int $idNguoiDay;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTenKhoaHoc(): string
    {
        return $this->tenKhoaHoc;
    }

    public function setTenKhoaHoc(string $tenKhoaHoc): void
    {
        $this->tenKhoaHoc = $tenKhoaHoc;
    }

    public function getMoTa(): string
    {
        return $this->moTa;
    }

    public function setMoTa(string $moTa): void
    {
        $this->moTa = $moTa;
    }

    public function getNgayTao(): string
    {
        return $this->ngayTao;
    }

    public function setNgayTao(string $ngayTao): void
    {
        $this->ngayTao = $ngayTao;
    }

    public function getNgayCapNhat(): string
    {
        return $this->ngayCapNhat;
    }

    public function setNgayCapNhat(string $ngayCapNhat): void
    {
        $this->ngayCapNhat = $ngayCapNhat;
    }

    public function getIdNguoiDay(): int
    {
        return $this->idNguoiDay;
    }

    public function setIdNguoiDay(int $idNguoiDay): void
    {
        $this->idNguoiDay = $idNguoiDay;
    }

    public function getGiaBan(): float
    {
        return $this->giaBan;
    }

    public function setGiaBan(float $giaBan): void
    {
        $this->giaBan = $giaBan;
    }

    public function getHinhAnh(): string
    {
        return $this->hinhAnh;
    }

    public function setHinhAnh(string $hinhAnh): void
    {
        $this->hinhAnh = $hinhAnh;
    }

    public function __construct(
        int $id = 0,
        string $tenKhoaHoc = "",
        string $moTa = "",
        string $hinhAnh = "",
        string $ngayTao = "",
        string $ngayCapNhat = "",
        float $giaBan = 0,
        int $idNguoiDay = 0
    ) {
        $this->id = $id;
        $this->tenKhoaHoc = $tenKhoaHoc;
        $this->moTa = $moTa;
        $this->hinhAnh = $hinhAnh;
        $this->ngayTao = $this->getDateTimeNow();
        $this->ngayCapNhat = $this->getDateTimeNow();
        $this->giaBan = $giaBan;
        $this->idNguoiDay = $idNguoiDay;
    }

    // Get date time now
    public function getDateTimeNow() : string
    {
        $date = new \DateTime();
        return $date->format('Y-m-d H:i:s');
    }

    // Lấy danh sách khóa học
    public function getAll() : array
    {
        $sql = "SELECT * FROM khoahoc";
        $result = connection::getConnection()->query($sql);
        $lstKhoaHoc = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $khoaHoc = new KhoaHoc(
                    $row['id'],
                    $row['tenkhoahoc'],
                    $row['mota'],
                    $row['hinhAnh'],
                    $row['ngaytao'],
                    $row['ngaycapnhat'],
                    $row['gia'],
                    $row['nguoidayId']
                );
                array_push($lstKhoaHoc, $khoaHoc);
            }
        }
        return $lstKhoaHoc;
    }

    // Lấy danh sách khóa học theo pagination
    public function getAllByPagination($page_first_result, $results_per_page) : array {
        $sql = "SELECT * FROM khoaHoc LIMIT $page_first_result, $results_per_page";
        $result = connection::getConnection()->query($sql);
        $listCourse = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $course = new KhoaHoc(
                    $row['id'],
                    $row['tenkhoahoc'],
                    $row['mota'],
                    $row['hinhAnh'],
                    $row['ngaytao'],
                    $row['ngaycapnhat'],
                    $row['gia'],
                    $row['nguoidayId']
                );
                array_push($listCourse, $course);
            }
        }
        return $listCourse;
    }

    // Lấy danh sách khoa học theo id giảm dần
    public function getAllByDesc() : array
    {
        // Lấy danh sách khóa học
        $sql = "SELECT * FROM khoahoc ORDER BY id DESC";
        $result = connection::getConnection()->query($sql);
        $lstKhoaHoc = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Lấy người dạy
                $modelNguoiDung = new NguoiDung();
                $nguoiDay = $modelNguoiDung->getById($row['nguoidayId']);

                $khoaHoc = array(
                    'id' => $row['id'],
                    'tenkhoahoc' => $row['tenkhoahoc'],
                    'mota' => $row['mota'],
                    'hinhAnh' => $row['hinhAnh'],
                    'ngaytao' => $row['ngaytao'],
                    'ngaycapnhat' => $row['ngaycapnhat'],
                    'nguoidayId' => $row['nguoidayId'],
                    'gia' => $row['gia'],
                    'nguoiday' => $nguoiDay->getTen()
                );
                array_push($lstKhoaHoc, $khoaHoc);
            }
        }
        return $lstKhoaHoc;
    }

    // Lấy danh sách khóa học theo id người dạy
    public function getAllByIdNguoiDay($idNguoiDay) : array
    {
        $sql = "SELECT * FROM khoahoc WHERE nguoidayId = '$idNguoiDay'";
        $result = connection::getConnection()->query($sql);
        $lstKhoaHoc = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $khoaHoc = new KhoaHoc(
                    $row['id'],
                    $row['tenkhoahoc'],
                    $row['mota'],
                    $row['hinhAnh'],
                    $row['ngaytao'],
                    $row['ngaycapnhat'],
                    $row['gia'],
                    $row['nguoidayId']
                );
                array_push($lstKhoaHoc, $khoaHoc);
            }
        }
        return $lstKhoaHoc;
    }

    // Thêm khóa học
    public function add(KhoaHoc $khoaHoc) : bool {
        $sql = "INSERT INTO khoahoc(tenkhoahoc, mota, ngaytao, ngaycapnhat, nguoidayId, gia, hinhAnh) VALUES 
                ('$khoaHoc->tenKhoaHoc', '$khoaHoc->moTa', '$khoaHoc->ngayTao', '$khoaHoc->ngayCapNhat', '$khoaHoc->idNguoiDay',
                $khoaHoc->giaBan, '$khoaHoc->hinhAnh')";
        return connection::getConnection()->query($sql);
    }

    // Cập nhật khóa học
    public function update(KhoaHoc $khoaHoc) : bool {
        $sql = "UPDATE khoahoc SET tenkhoahoc = '$khoaHoc->tenKhoaHoc', mota = '$khoaHoc->moTa', ngaycapnhat = '$khoaHoc->ngayCapNhat',
                gia = $khoaHoc->giaBan, hinhAnh = '$khoaHoc->hinhAnh' WHERE id = '$khoaHoc->id'";
        return connection::getConnection()->query($sql);
    }

    // Xóa khóa học
    public function delete($id) : bool {
        // Xóa lịch học nếu có
        $lichHoc = new LichHoc();
        $lichHoc->deleteByKhoaHocId($id);

        // Xóa học viên nếu có
        $hocVien = new HocVien();
        $hocVien->deleteByKhoaHocId($id);

        // Xoá khóa học
        $sql = "DELETE FROM khoahoc WHERE id = $id";
        return connection::getConnection()->query($sql);
    }
}