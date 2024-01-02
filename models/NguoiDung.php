<?php

namespace models;

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

    public function getNgayTao(): \DateTime
    {
        return $this->ngayTao;
    }

    public function setNgayTao(\DateTime $ngayTao): void
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
        int $idQuyen = 0
    ) {
        $this->id = $id;
        $this->ten = $ten;
        $this->email = $email;
        $this->matKhau = $matKhau;
        $this->soDienThoai = $soDienThoai;
        $this->ngayTao = date('d-m-y h:i:s');
        $this->idQuyen = $idQuyen;
        self::$conn = \connection::getConnection();
    }

    public function dangnhap($email, $matKhau)
    {
        $sql = "SELECT * FROM nguoiDung WHERE email = '$email' AND matKhau = '$matKhau'";
        $row = self::$conn->query($sql)->fetch_assoc();
        if($row != null){
            return array(
                'id' => $row['id'],
                'ten' => $row['ten'],
                'email' => $row['email'],
                'matKhau' => $row['matkhau'],
                'soDienThoai' => $row['sodienthoai'],
                'ngayTao' => $row['ngaytao'],
                'idQuyen' => $row['quyenId']
            );
        }

        return null;
    }
}