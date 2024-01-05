<?php

namespace models;

require_once('connection.php');

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
        $row = connection::getConnection()->query($sql)->fetch_assoc();

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
        if(connection::getConnection()->query($sql)) {
            return true;
        }
        return false;
    }

    // Phương thức kiểm tra xem email đã tồn tại hay chưa? (true: đã tồn tại, false: chưa tồn tại)
    public function checkEmail($id, $email) : bool
    {
        // Nếu id > 0 thì là cập nhật người dùng, không kiểm tra email
        $sql = "SELECT email FROM nguoiDung WHERE id = '$id'";
        $result = connection::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        if($row['email'] == $email) {
            return false;
        } else {
            $sql = "SELECT * FROM nguoiDung WHERE email = '$email'";
            $result = connection::getConnection()->query($sql);
            return $result->num_rows > 0;
        }
    }

    // Lấy danh sách người dùng
    public function getAll() : array
    {
        $sql = "SELECT * FROM nguoiDung";
        $result = connection::getConnection()->query($sql);
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

    // Lấy danh sách người dùng theo pagination
    public function getAllByPagination($page_first_result, $results_per_page) : array
    {
        $sql = "SELECT * FROM nguoiDung LIMIT $page_first_result, $results_per_page";
        $result = connection::getConnection()->query($sql);
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
        $row = connection::getConnection()->query($sql)->fetch_assoc();
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

    // Lấy quyền của người dùng
    public function getRole($idQuyen) : string
    {
        $sql = "SELECT * FROM quyen WHERE id = '$idQuyen'";
        $row = connection::getConnection()->query($sql)->fetch_assoc();
        return $row['tenquyen'];
    }

    // Thêm người dùng
    public function add(NguoiDung $user) : bool
    {
        // Mặc định mật khẩu là 123456
        $user->matKhau = password_hash('123456', PASSWORD_DEFAULT);
        // Ngày tạo là ngày hiện tại
        $user->ngayTao = $this->getDateTimeNow();

        // Query thêm người dùng
        $sql = "INSERT INTO nguoiDung(hoten, email, matkhau, sodienthoai, ngaytao, quyenId) VALUES 
                ('$user->ten', '$user->email', '$user->matKhau', '$user->soDienThoai', '$user->ngayTao', '$user->idQuyen')";

        return connection::getConnection()->query($sql);
    }

    // Cập nhật người dùng
    public function update($user) : bool
    {
        $sql = "UPDATE nguoiDung SET hoten = '$user->ten', email = '$user->email', sodienthoai = '$user->soDienThoai', 
                quyenId = '$user->idQuyen' WHERE id = '$user->id'";

        return connection::getConnection()->query($sql);
    }

    // Xóa người dùng
    public function delete($id) : bool
    {
        $sql = "DELETE nguoiDung, khoaHoc, hocVien, thongBao FROM nguoiDung 
                LEFT JOIN khoaHoc ON khoaHoc.nguoidayId = nguoiDung.id 
                LEFT JOIN hocVien ON hocVien.nguoiDungId = nguoiDung.id 
                LEFT JOIN thongBao ON thongBao.nguoiDungId = nguoiDung.id 
                WHERE nguoiDung.id = '$id'";

        return connection::getConnection()->query($sql);
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