<?php

namespace models;

class ThongBao
{
    protected static $conn = null;
    private int $id;
    private string $tieuDe;
    private string $noiDung;
    private string $ngayTao;
    private string $ngayCapNhat;
    private int $idNguoiTao;

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
        self::$conn = \connection::getConnection();
    }

    // Lấy danh sách thông báo
    public function getAll()
    {
        $sql = "SELECT * FROM thongbao";
        $result = self::$conn->query($sql);
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

    // Thêm thông báo
    public function add(ThongBao $thongBao) : bool
    {
        $sql = "INSERT INTO thongbao (tieude, noidung, ngaytao, ngaycapnhat, nguoidungId) VALUES (?, ?, ?, ?, ?)";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("ssssi", $thongBao->tieuDe, $thongBao->noiDung, $thongBao->ngayTao, $thongBao->ngayCapNhat, $thongBao->idNguoiTao);
        return $stmt->execute();
    }

    // Sửa thông báo
    public function edit(ThongBao $thongBao) : bool
    {
        $sql = "UPDATE thongbao SET tieude = ?, noidung = ?, ngaycapnhat = ? WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("sssi", $thongBao->tieuDe, $thongBao->noiDung, $thongBao->ngayCapNhat, $thongBao->id);
        return $stmt->execute();
    }

    // Xóa thông báo
    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM thongbao WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}