<?php

namespace models;

require_once('connection.php');

class HocVien
{
    private int $idKhoaHoc;
    private int $idNguoiDung;
    private string $ngayDangKy;

    public function getIdKhoaHoc(): int
    {
        return $this->idKhoaHoc;
    }

    public function setIdKhoaHoc(int $idKhoaHoc): void
    {
        $this->idKhoaHoc = $idKhoaHoc;
    }

    public function getIdNguoiDung(): int
    {
        return $this->idNguoiDung;
    }

    public function setIdNguoiDung(int $idNguoiDung): void
    {
        $this->idNguoiDung = $idNguoiDung;
    }

    public function getNgayDangKy(): string
    {
        return $this->ngayDangKy;
    }

    public function setNgayDangKy(string $ngayDangKy): void
    {
        $this->ngayDangKy = $ngayDangKy;
    }

    public function __construct(int $idKhoaHoc = 0, int $idNguoiDung = 0, string $ngayDangKy = "")
    {
        $this->idKhoaHoc = $idKhoaHoc;
        $this->idNguoiDung = $idNguoiDung;
        $this->ngayDangKy = $ngayDangKy;
    }

    // Get tổng số học viên
    public function getTotal(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM hocVien";
        $result = connection::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Xóa học viên theo id khóa học
    public function deleteByKhoaHocId(int $idKhoaHoc,): bool
    {
        $sql = "DELETE FROM hocVien WHERE khoahocId = $idKhoaHoc";
        return connection::getConnection()->query($sql);
    }
}