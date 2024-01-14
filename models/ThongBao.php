<?php

namespace models;

require_once('connection.php');

class ThongBao
{
    private int $id;
    private string $tieuDe;
    private string $noiDung;
    private string $ngayTao;
    private string $ngayCapNhat;
    private int $idNguoiTao;
    private string $tenNguoiTao;

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

    public function getIdNguoiTao(): int
    {
        return $this->idNguoiTao;
    }

    public function setIdNguoiTao(int $idNguoiTao): void
    {
        $this->idNguoiTao = $idNguoiTao;
    }

    public function getTenNguoiTao(): string
    {
        return $this->tenNguoiTao;
    }

    public function setTenNguoiTao(string $tenNguoiTao): void
    {
        $this->tenNguoiTao = $tenNguoiTao;
    }

    public function __construct(
        $id = 0,
        $tieuDe = "",
        $noiDung = "",
        $ngayTao = "",
        $ngayCapNhat = "",
        $idNguoiTao = 0
    )
    {
        $this->id = $id;
        $this->tieuDe = $tieuDe;
        $this->noiDung = $noiDung;
        $this->ngayTao = $ngayTao;
        $this->ngayCapNhat = $ngayCapNhat;
        $this->idNguoiTao = $idNguoiTao;
    }

    // Lấy danh sách thông báo
    public function getAll()
    {
        $sql = "SELECT * FROM thongbao";
        $result = connection::getConnection()->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thongBao = array(
                    "id" => $row["id"],
                    "tieude" => $row["tieude"],
                    "noidung" => $row["noidung"],
                    "ngaytao" => $row["ngaytao"],
                    "ngaycapnhat" => $row["ngaycapnhat"],
                    "nguoidungId" => $row["nguoidungId"],
                    "tenNguoiTao" => $this->getInfoNguoiTao($row["nguoidungId"])["hoten"]
                );
                array_push($list, $thongBao);
            }
        }
        return $list;
    }

    // Lấy danh sách thông báo theo pagination
    public function getAllByPagination($page_first_result, $results_per_page) : array
    {
        $sql = "SELECT * FROM thongBao LIMIT $page_first_result, $results_per_page";
        $result = connection::getConnection()->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thongBao = array(
                    "id" => $row["id"],
                    "tieude" => $row["tieude"],
                    "noidung" => $row["noidung"],
                    "ngaytao" => $row["ngaytao"],
                    "ngaycapnhat" => $row["ngaycapnhat"],
                    "nguoidungId" => $row["nguoidungId"],
                    "tenNguoiTao" => $this->getInfoNguoiTao($row["nguoidungId"])["hoten"]
                );
                array_push($list, $thongBao);
            }
        }
        return $list;
    }

    // Lấy tất cả thông báo theo id người dùng
    public function getAllByIdNguoiTao(int $idNguoiDung) : array
    {
        $sql = "SELECT * FROM thongbao WHERE nguoidungId = $idNguoiDung";
        $result = connection::getConnection()->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $thongBao = new ThongBao(
                    $row["id"],
                    $row["tieude"],
                    $row["noidung"],
                    $row["ngaytao"],
                    $row["ngaycapnhat"],
                    $row["nguoidungId"]
                );
                array_push($list, $thongBao);
            }
        }
        return $list;
    }

    // Lấy thông tin người tạo
    public function getInfoNguoiTao(int $idNguoiDung) : array
    {
        $sql = "SELECT * FROM nguoidung WHERE id = $idNguoiDung";
        $result = connection::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        $nguoiDung = array(
            "id" => $row["id"],
            "hoten" => $row["hoten"],
            "email" => $row["email"],
            "sodienthoai" => $row["sodienthoai"],
            "ngaytao" => $row["ngaytao"],
            "quyenId" => $row["quyenId"]
        );
        return $nguoiDung;
    }

    // Thêm thông báo
    public function add(ThongBao $thongBao) : bool
    {
        $sql = "INSERT INTO thongbao (tieude, noidung, ngaytao, ngaycapnhat, nguoidungId) VALUES (?, ?, ?, ?, ?)";
        $stmt = connection::getConnection()->prepare($sql);
        $stmt->bind_param("ssssi", $thongBao->tieuDe, $thongBao->noiDung, $thongBao->ngayTao, $thongBao->ngayCapNhat, $thongBao->idNguoiTao);
        return $stmt->execute();
    }

    // Sửa thông báo
    public function update(ThongBao $thongBao) : bool
    {
        $sql = "UPDATE thongbao SET tieude = ?, noidung = ?, ngaycapnhat = ? WHERE id = ?";
        $stmt = connection::getConnection()->prepare($sql);
        $stmt->bind_param("sssi", $thongBao->tieuDe, $thongBao->noiDung, $thongBao->ngayCapNhat, $thongBao->id);
        return $stmt->execute();
    }

    // Xóa thông báo
    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM thongbao WHERE id = ?";
        $stmt = connection::getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}