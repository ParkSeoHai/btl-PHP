<?php

namespace models;

class ThongBao
{
    private int $id;
    private string $tieuDe;
    private string $noiDung;
    private \DateTime $ngayTao;
    private \DateTime $ngayCapNhat;
    private int $idNguoiTao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTieuDe(): string
    {
        return $this->tieuDe;
    }

    public function setTieuDe(string $tieuDe): void
    {
        $this->tieuDe = $tieuDe;
    }

    public function getNoiDung(): string
    {
        return $this->noiDung;
    }

    public function setNoiDung(string $noiDung): void
    {
        $this->noiDung = $noiDung;
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

    public function getIdNguoiTao(): int
    {
        return $this->idNguoiTao;
    }

    public function setIdNguoiTao(int $idNguoiTao): void
    {
        $this->idNguoiTao = $idNguoiTao;
    }

    public function __construct($id, $tieuDe, $noiDung, $ngayTao, $ngayCapNhat, $idNguoiTao)
    {
        $this->id = $id;
        $this->tieuDe = $tieuDe;
        $this->noiDung = $noiDung;
        $this->ngayTao = $ngayTao;
        $this->ngayCapNhat = $ngayCapNhat;
        $this->idNguoiTao = $idNguoiTao;
    }
}