<?php

namespace models;

class GiangVien extends NguoiDung
{
    public function __construct(
        int $id = 0,
        string $ten = "",
        string $email = "",
        string $matKhau = "",
        string $soDienThoai = "",
        string $ngayTao = "",
        int $idQuyen = 3
    )
    {
        parent::__construct($id, $ten, $email, $matKhau, $soDienThoai, $ngayTao, $idQuyen);
    }

    // Get all giang vien
    public function getAll(): array
    {
        $sql = "SELECT * FROM nguoiDung WHERE id_quyen = 2";
        $result = parent::$conn->query($sql);
        $giangViens = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $giangVien = new GiangVien(
                    $row['id'],
                    $row['hoten'],
                    $row['email'],
                    $row['matkhau'],
                    $row['sodienthoai'],
                    $row['ngaytao'],
                    $row['quyenId']
                );
                array_push($giangViens, $giangVien);
            }
        }
        return $giangViens;
    }
}