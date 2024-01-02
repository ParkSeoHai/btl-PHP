<?php

namespace models;

class HocVien
{
    private int $idKhoaHoc;
    private int $idNguoiDung;
    private \DateTime $ngayDangKy;

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

    public function getNgayDangKy(): \DateTime
    {
        return $this->ngayDangKy;
    }

    public function setNgayDangKy(\DateTime $ngayDangKy): void
    {
        $this->ngayDangKy = $ngayDangKy;
    }

    public function __construct(int $idKhoaHoc, int $idNguoiDung, \DateTime $ngayDangKy)
    {
        $this->idKhoaHoc = $idKhoaHoc;
        $this->idNguoiDung = $idNguoiDung;
        $this->ngayDangKy = $ngayDangKy;
    }
}