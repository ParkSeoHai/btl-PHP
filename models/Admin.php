<?php

namespace models;

class Admin extends NguoiDung
{
    public function __construct(
        int $id = 0,
        string $ten = "",
        string $email = "",
        string $matKhau = "",
        string $soDienThoai = "",
        string $ngayTao = "",
        int $idQuyen = 0
    )
    {
        parent::__construct($id, $ten, $email, $matKhau, $soDienThoai, $ngayTao, $idQuyen);
    }

    // Get all user admin
    public function getAll(): array
    {
        $sql = "SELECT * FROM nguoiDung WHERE quyenId = 1";
        $result = parent::$conn->query($sql);
        $listUser = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new Admin(
                    $row['id'],
                    $row['hoten'],
                    $row['email'],
                    $row['matkhau'],
                    $row['sodienthoai'],
                    $row['ngaytao'],
                    $row['quyenId']
                );
                array_push($listUser, $user);
            }
        }
        return $listUser;
    }
}