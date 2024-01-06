<?php

namespace models;

require_once('connection.php');
require_once('HocVien.php');

class KhoaHoc
{
    private int $id;
    private string $tenKhoaHoc;
    private string $moTa;
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

    public function __construct(
        int $id = 0,
        string $tenKhoaHoc = "",
        string $moTa = "",
        string $ngayTao = "",
        string $ngayCapNhat = "",
        int $idNguoiDay = 0
    ) {
        $this->id = $id;
        $this->tenKhoaHoc = $tenKhoaHoc;
        $this->moTa = $moTa;
        $this->ngayTao = $ngayTao;
        $this->ngayCapNhat = $ngayCapNhat;
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
                    $row['ngaytao'],
                    $row['ngaycapnhat'],
                    $row['nguoidayId']
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
                    $row['ngaytao'],
                    $row['ngaycapnhat'],
                    $row['nguoidayId']
                );
                array_push($lstKhoaHoc, $khoaHoc);
            }
        }
        return $lstKhoaHoc;
    }

    // Lấy khóa học theo id
    public function getById($id) : KhoaHoc|null
    {
        $sql = "SELECT id, tenkhoahoc, mota, ngaytao, ngaycapnhat, nguoidayId FROM khoahoc WHERE id = '$id'";
        $result = connection::getConnection()->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $khoaHoc = new KhoaHoc(
                $row['id'],
                $row['tenkhoahoc'],
                $row['mota'],
                $row['ngaytao'],
                $row['ngaycapnhat'],
                $row['nguoidayId']
            );
            return $khoaHoc;
        }
        return null;
    }

    // Thêm khóa học
    public function add($khoaHoc) : bool {
        $sql = "INSERT INTO khoahoc(tenkhoahoc, mota, ngaytao, ngaycapnhat, nguoidayId) VALUES 
                ('$khoaHoc->tenKhoaHoc', '$khoaHoc->moTa', '$khoaHoc->ngayTao', '$khoaHoc->ngayCapNhat', '$khoaHoc->idNguoiDay')";
        return connection::getConnection()->query($sql);
    }

    // Cập nhật khóa học
    public function update($khoaHoc) : bool {
        $sql = "UPDATE khoahoc SET tenkhoahoc = '$khoaHoc->tenKhoaHoc', mota = '$khoaHoc->moTa', ngaycapnhat = '$khoaHoc->ngayCapNhat' WHERE id = '$khoaHoc->id'";
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