<?php

namespace models;

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

    // Xóa học viên theo id khóa học
    public function deleteByKhoaHocId(int $idKhoaHoc,): bool
    {
        $sql = "DELETE FROM hocVien WHERE khoahocId = $idKhoaHoc";
        return connection::getConnection()->query($sql);
    }
}