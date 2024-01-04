<?php

namespace models;

class LichHoc
{
    protected static $conn = NULL;
    private int $id;
    private string $phongHoc;
    private string $thoiGianBatDau;
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
        self::$conn = \models\connection::getConnection();
    }

    // Lấy danh sách lịch học theo khóa học
    public function getByKhoaHocId(int $khoaHocId): array
    {
        $sql = "SELECT * FROM lichhoc WHERE khoahocId = $khoaHocId";
        $result = self::$conn->query($sql);
        $lichHocList = array();
        while ($row = $result->fetch_assoc()) {
            $lichHoc = new LichHoc(
                $row['id'],
                $row['phonghoc'],
                $row['ngayhoc'],
                $row['khoahocId']
            );
            array_push($lichHocList, $lichHoc);
        }
        return $lichHocList;
    }

    // Lấy tất cả lịch học
    public function getAll(): array
    {
        $sql = "SELECT * FROM lichhoc";
        $result = self::$conn->query($sql);
        $lichHocList = array();
        while ($row = $result->fetch_assoc()) {
            $lichHoc = new LichHoc(
                $row['id'],
                $row['phonghoc'],
                $row['ngayhoc'],
                $row['khoahocId']
            );
            array_push($lichHocList, $lichHoc);
        }
        return $lichHocList;
    }

    // Thêm lịch học
    public function add(LichHoc $lichHoc): bool
    {
        $sql = "INSERT INTO lichhoc (ngayhoc, phonghoc, khoahocId) VALUES (?, ?, ?)";
        $stmt = self::$conn->prepare($sql);
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
        $stmt = self::$conn->prepare($sql);
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
        return self::$conn->query($sql);
    }
}