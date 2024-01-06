<?php

namespace models;

class LichHoc
{
    private int $id;
    private string $tenKhoaHoc;
    private string $tenGiangVien;
    private string $thoiGianBatDau;
    private string $phongHoc;
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

    public function getThoiGianBatDau(): string
    {
        return $this->thoiGianBatDau;
    }

    public function setThoiGianBatDau(string $thoiGianBatDau): void
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

    public function getTenKhoaHoc(): string
    {
        return $this->tenKhoaHoc;
    }

    public function setTenKhoaHoc(string $tenKhoaHoc): void
    {
        $this->tenKhoaHoc = $tenKhoaHoc;
    }

    public function getTenGiangVien(): string
    {
        return $this->tenGiangVien;
    }

    public function setTenGiangVien(string $tenGiangVien): void
    {
        $this->tenGiangVien = $tenGiangVien;
    }

    public function __construct(
        int $id = 0,
        string $phongHoc = "",
        string $thoiGianBatDau = "",
        int $khoaHocId = 0
    )
    {
        $this->id = $id;
        $this->phongHoc = $phongHoc;
        $this->thoiGianBatDau = $thoiGianBatDau;
        $this->khoaHocId = $khoaHocId;
    }

    // Lấy lịch học theo khóa học
    public function getByKhoaHocId(int $khoaHocId): LichHoc
    {
        $sql = "SELECT * FROM lichhoc WHERE khoahocId = $khoaHocId";
        $result = connection::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        $lichHoc = new LichHoc(
            $row['id'],
            $row['phonghoc'],
            $row['ngayhoc'],
            $row['khoahocId']
        );
        return $lichHoc;
    }

    // Lấy tất cả lịch học
    public function getAll(): array
    {
        $sql = "SELECT l.id, k.tenkhoahoc, n.hoten, l.phonghoc, l.ngayhoc, l.khoahocId FROM khoahoc k, lichhoc l, nguoidung n
                    WHERE k.id = l.khoahocId AND k.nguoidayId = n.id";
        $result = connection::getConnection()->query($sql);
        $lichHocList = array();
        while ($row = $result->fetch_assoc()) {
            $lichHoc = new LichHoc(
                $row['id'],
                $row['phonghoc'],
                $row['ngayhoc'],
                $row['khoahocId']
            );
            $lichHoc->setTenKhoaHoc($row['tenkhoahoc']);
            $lichHoc->setTenGiangVien($row['hoten']);
            array_push($lichHocList, $lichHoc);
        }
        return $lichHocList;
    }

    // Lấy lịch học theo pagination
    public function getAllByPagination($page_first_result, $results_per_page) : array {
        $sql = "SELECT l.id, k.tenkhoahoc, n.hoten, l.phonghoc, l.ngayhoc, l.khoahocId FROM khoahoc k, lichhoc l, nguoidung n
                    WHERE k.id = l.khoahocId AND k.nguoidayId = n.id LIMIT $page_first_result, $results_per_page";
        $result = connection::getConnection()->query($sql);
        $listLichHoc = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lichHoc = new LichHoc(
                    $row['id'],
                    $row['phonghoc'],
                    $row['ngayhoc'],
                    $row['khoahocId']
                );
                $lichHoc->setTenKhoaHoc($row['tenkhoahoc']);
                $lichHoc->setTenGiangVien($row['hoten']);
                array_push($listLichHoc, $lichHoc);
            }
        }
        return $listLichHoc;
    }

    // Thêm lịch học
    public function add(LichHoc $lichHoc): bool
    {
        $sql = "INSERT INTO lichhoc (ngayhoc, phonghoc, khoahocId) VALUES (?, ?, ?)";
        $stmt = connection::getConnection()->prepare($sql);
        $ngayHoc = $lichHoc->getThoiGianBatDau();
        $phongHoc = $lichHoc->getPhongHoc();
        $khoaHocId = $lichHoc->getKhoaHocId();
        $stmt->bind_param('ssi', $ngayHoc, $phongHoc, $khoaHocId);
        return $stmt->execute();
    }

    // Cập nhật lịch học
    public function update(LichHoc $lichHoc): bool
    {
        $sql = "UPDATE lichhoc SET ngayhoc = ?, phonghoc = ?, khoahocId = ? WHERE id = ?";
        $stmt = connection::getConnection()->prepare($sql);
        $ngayHoc = $lichHoc->getThoiGianBatDau();
        $phongHoc = $lichHoc->getPhongHoc();
        $khoaHocId = $lichHoc->getKhoaHocId();
        $id = $lichHoc->getId();
        $stmt->bind_param('ssii', $ngayHoc, $phongHoc, $khoaHocId, $id);
        return $stmt->execute();
    }

    // Xóa lịch học
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM lichhoc WHERE id = $id";
        return connection::getConnection()->query($sql);
    }
}