<?php

namespace models;

class KhoaHoc
{
    private int $id;
    private string $tenKhoaHoc;
    private string $moTa;
    private string $hinhAnh;
    private \DateTime $ngayTao;
    private \DateTime $ngayCapNhat;
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

    public function getHinhAnh(): string
    {
        return $this->hinhAnh;
    }

    public function setHinhAnh(string $hinhAnh): void
    {
        $this->hinhAnh = $hinhAnh;
    }

    public function getNgayTao(): \DateTime
    {
        return $this->ngayTao;
    }

    public function setNgayTao(\DateTime $ngayTao): void
    {
        $this->ngayTao = $ngayTao;
    }

    public function getNgayCapNhat(): \DateTime
    {
        return $this->ngayCapNhat;
    }

    public function setNgayCapNhat(\DateTime $ngayCapNhat): void
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
        int $id,
        string $tenKhoaHoc,
        string $moTa,
        string $hinhAnh,
        \DateTime $ngayTao,
        \DateTime $ngayCapNhat,
        int $idNguoiDay
    ) {
        $this->id = $id;
        $this->tenKhoaHoc = $tenKhoaHoc;
        $this->moTa = $moTa;
        $this->hinhAnh = $hinhAnh;
        $this->ngayTao = $ngayTao;
        $this->ngayCapNhat = $ngayCapNhat;
        $this->idNguoiDay = $idNguoiDay;
    }
}