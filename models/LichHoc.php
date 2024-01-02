<?php

namespace models;

class LichHoc
{
    private int $id;
    private string $phongHoc;
    private \DateTime $thoiGianBatDau;
    private int $khoaHocId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPhongHoc(): string
    {
        return $this->phongHoc;
    }

    public function setPhongHoc(string $phongHoc): void
    {
        $this->phongHoc = $phongHoc;
    }

    public function getThoiGianBatDau(): \DateTime
    {
        return $this->thoiGianBatDau;
    }

    public function setThoiGianBatDau(\DateTime $thoiGianBatDau): void
    {
        $this->thoiGianBatDau = $thoiGianBatDau;
    }

    public function getKhoaHocId(): int
    {
        return $this->khoaHocId;
    }

    public function setKhoaHocId(int $khoaHocId): void
    {
        $this->khoaHocId = $khoaHocId;
    }

    public function __construct(int $id, string $phongHoc, \DateTime $thoiGianBatDau, int $khoaHocId)
    {
        $this->id = $id;
        $this->phongHoc = $phongHoc;
        $this->thoiGianBatDau = $thoiGianBatDau;
        $this->khoaHocId = $khoaHocId;
    }
}