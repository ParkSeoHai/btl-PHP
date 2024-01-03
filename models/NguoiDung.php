<?php

namespace models;

use Cassandra\Date;

require_once('../../connection.php');

class NguoiDung
{
    protected static $conn = NULL;

    private int $id;
    private string $ten;
    private string $email;
    private string $matKhau;
    private string $soDienThoai;
    private string $ngayTao;
    private int $idQuyen;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTen(): string
    {
        return $this->ten;
    }

    public function setTen(string $ten): void
    {
        $this->ten = $ten;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMatKhau(): string
    {
        return $this->matKhau;
    }

    public function setMatKhau(string $matKhau): void
    {
        $this->matKhau = $matKhau;
    }

    public function getSoDienThoai(): string
    {
        return $this->soDienThoai;
    }

    public function setSoDienThoai(string $soDienThoai): void
    {
        $this->soDienThoai = $soDienThoai;
    }

    public function getNgayTao(): string
    {
        return $this->ngayTao;
    }

    public function setNgayTao(string $ngayTao): void
    {
        $this->ngayTao = $ngayTao;
    }

    public function getIdQuyen(): int
    {
        return $this->idQuyen;
    }

    public function setIdQuyen(int $idQuyen): void
    {
        $this->idQuyen = $idQuyen;
    }

    public function __construct(
        int $id = 0,
        string $ten = "",
        string $email = "",
        string $matKhau = "",
        string $soDienThoai = "",
        string $ngayTao = "",
        int $idQuyen = 3       // Mặc định: 3 là quyền của người dùng
    ) {
        $this->id = $id;
        $this->ten = $ten;
        $this->email = $email;
        $this->matKhau = $matKhau;
        $this->soDienThoai = $soDienThoai;
        $this->ngayTao = $ngayTao;
        $this->idQuyen = $idQuyen;
        self::$conn = \connection::getConnection();
    }

    // Get date time now
    public function getDateTimeNow() : string
    {
        $date = new \DateTime();
        return $date->format('Y-m-d H:i:s');
    }

    // Phương thức đăng nhập
    public function dangnhap($email, $matKhau) : array|null
    {
        $sql = "SELECT * FROM nguoiDung WHERE email = '$email'";
        $row = self::$conn->query($sql)->fetch_assoc();

        if(password_verify($matKhau, $row['matkhau'])){
            return array(
                'id' => $row['id'],
                'ten' => $row['hoten'],
                'email' => $row['email'],
                'matKhau' => $row['matkhau'],
                'soDienThoai' => $row['sodienthoai'],
                'ngayTao' => $row['ngaytao'],
                'idQuyen' => $row['quyenId']
            );
        }
        return null;
    }

    // Phương thức đăng ký
    public function dangKy($user) : bool {
        $sql = "INSERT INTO nguoiDung(hoten, email, matkhau, sodienthoai, ngaytao, quyenId) VALUES 
                ('$user->ten', '$user->email', '$user->matKhau', '$user->soDienThoai', '$user->ngayTao', '$user->idQuyen')";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }

    // Phương thức kiểm tra xem email đã tồn tại hay chưa?
    public function checkEmail($email) : bool
    {
        $sql = "SELECT * FROM nguoiDung WHERE email = '$email'";
        $result = self::$conn->query($sql);
        if($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    // Lấy danh sách người dùng
    public function getAll() : array
    {
        $sql = "SELECT * FROM nguoiDung";
        $result = self::$conn->query($sql);
        $listUser = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new NguoiDung(
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

    // Lấy người dùng theo id
    public function getById($id) : NguoiDung
    {
        $sql = "SELECT * FROM nguoiDung WHERE id = '$id'";
        $row = self::$conn->query($sql)->fetch_assoc();
        $user = new NguoiDung(
            $row['id'],
            $row['hoten'],
            $row['email'],
            $row['matkhau'],
            $row['sodienthoai'],
            $row['ngaytao'],
            $row['quyenId']
        );
        return $user;
    }

    // Thêm người dùng
    public function add($user) : bool
    {
        // Mặc định mật khẩu là 123456
        $passwordDefault = password_hash('123456', PASSWORD_DEFAULT);
        $sql = "INSERT INTO nguoiDung(hoten, email, matkhau, sodienthoai, ngaytao, quyenId) VALUES 
                ('$user->ten', '$user->email', '$passwordDefault', '$user->soDienThoai', '$user->ngayTao', '$user->idQuyen')";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }

    // Cập nhật người dùng
    public function update($user) : bool
    {
        $sql = "UPDATE nguoiDung SET hoten = '$user->ten', email = '$user->email', sodienthoai = '$user->soDienThoai', 
                quyenId = '$user->idQuyen' WHERE id = '$user->id'";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }

    // Xóa người dùng
    public function delete($id) : bool
    {
        $sql = "DELETE nguoiDung, khoaHoc, hocVien, thongBao FROM nguoiDung 
                LEFT JOIN khoaHoc ON khoaHoc.nguoidayId = nguoiDung.id 
                LEFT JOIN hocVien ON hocVien.nguoiDungId = nguoiDung.id 
                LEFT JOIN thongBao ON thongBao.nguoiDungId = nguoiDung.id 
                WHERE nguoiDung.id = '$id'";
        if(self::$conn->query($sql)) {
            return true;
        }
        return false;
    }
    // Xóa các bảng có liên quan đến người dùng: khoahoc, hocvien, thongbao
//    public function deleteAll($id) : bool
//    {
//        $sql = "DELETE nguoiDung, khoaHoc, hocVien, thongBao FROM nguoiDung
//                LEFT JOIN khoaHoc ON khoaHoc.nguoidayId = nguoiDung.id
//                LEFT JOIN hocVien ON hocVien.nguoiDungId = nguoiDung.id
//                LEFT JOIN thongBao ON thongBao.nguoiDungId = nguoiDung.id
//                WHERE nguoiDung.id = '$id'";
//        if(self::$conn->query($sql)) {
//            return true;
//        }
//        return false;
//    }

}