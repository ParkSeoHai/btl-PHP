<?php

namespace models;

class KhoaHoc
{
    protected static $conn = NULL;
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
        self::$conn = \models\connection::getConnection();
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
        $sql = "SELECT id, tenkhoahoc, mota, ngaytao, ngaycapnhat, nguoidayId FROM khoahoc";
        $result = $this->conn->query($sql);
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
        $result = $this->conn->query($sql);
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
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }

    // Cập nhật khóa học
    public function update($khoaHoc) : bool {
        $sql = "UPDATE khoahoc SET tenkhoahoc = '$khoaHoc->tenKhoaHoc', mota = '$khoaHoc->moTa', ngaycapnhat = '$khoaHoc->ngayCapNhat' WHERE id = '$khoaHoc->id'";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }

    // Xóa khóa học và các bảng liên quan (nếu có)
    public function delete($id) : bool {
        $sql = "DELETE FROM khoahoc, lichhoc, hocvien FROM khoahoc
                LEFT JOIN lichhoc ON khoahoc.id = lichhoc.khoahocId
                LEFT JOIN hocvien ON khoahoc.id = hocvien.khoahocId
                WHERE khoahoc.id = '$id'";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }
}