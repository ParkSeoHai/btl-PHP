<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "btl_php";

// Connect to MySQL
$conn = mysqli_connect($servername, $username, $password, $dbName);
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $tbquyen = "CREATE TABLE quyen (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tenquyen VARCHAR(30) NOT NULL)engine=innoDB";
    // Tao bang quyen
    mysqli_query($conn, $tbquyen);

    $tbNguoiDung = "CREATE TABLE nguoidung (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            hoten VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            matkhau VARCHAR(100) NOT NULL,
            sodienthoai VARCHAR(15) NOT NULL,
            ngaytao DATETIME NOT NULL,
            quyenId INT NOT NULL,
            FOREIGN KEY (quyenId) REFERENCES quyen(id))engine=innoDB";

    // Tao bang nguoi dung
    mysqli_query($conn, $tbNguoiDung);

    $tbKhoaHoc = "CREATE TABLE khoahoc (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tenkhoahoc VARCHAR(255) NOT NULL,
            mota VARCHAR(1000) NOT NULL,
            ngaytao DATETIME NOT NULL,
            ngaycapnhat DATETIME NOT NULL,
            nguoidayId INT NOT NULL,
            FOREIGN KEY (nguoidayId) REFERENCES nguoidung(id))engine=innoDB";

    // Tao bang khoa hoc
    mysqli_query($conn, $tbKhoaHoc);

    $tbHocVien = "CREATE TABLE hocvien (
            khoahocId INT NOT NULL,
            nguoidungId INT NOT NULL,
            ngaydangky DATETIME NOT NULL,
            FOREIGN KEY (khoahocId) REFERENCES khoahoc(id),
            FOREIGN KEY (nguoidungId) REFERENCES nguoidung(id),
            PRIMARY KEY (khoahocId, nguoidungId))engine=innoDB";

    // Tao bang hoc vien
    mysqli_query($conn, $tbHocVien);

    $tbLichHoc = "CREATE TABLE lichhoc (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            ngayhoc DATETIME NOT NULL,
            phonghoc VARCHAR(50) NOT NULL,
            khoahocId INT NOT NULL,
            FOREIGN KEY (khoahocId) REFERENCES khoahoc(id))engine=innoDB";

    // Tao bang lich hoc
    mysqli_query($conn, $tbLichHoc);

    $tbThongBao = "CREATE TABLE thongbao (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tieude VARCHAR(255) NOT NULL,
            noidung VARCHAR(1000) NOT NULL,
            ngaytao DATETIME NOT NULL,
            ngaycapnhat DATETIME NOT NULL,
            isRead INT NOT NULL,
            nguoidungId INT NOT NULL,
            FOREIGN KEY (nguoidungId) REFERENCES nguoidung(id))engine=innoDB";

    // Tao bang thong bao
    mysqli_query($conn, $tbThongBao);

    // Insert data
    $insertQuyen = "INSERT INTO quyen (tenquyen) VALUES ('Admin'), ('Teacher'), ('Student')";
    mysqli_query($conn, $insertQuyen);

    $password_hash = password_hash('123456', PASSWORD_DEFAULT);
    $insertAdmin = "INSERT INTO nguoidung (hoten, email, matkhau, sodienthoai, ngaytao, quyenId) VALUES 
        ('Nguyen Van A', 'admin@gmail.com', '$password_hash', '0123456789', '2024-01-01 00:00:00', 1),
        ('Park Seo Hai', 'parkseohai@gmail.com', '$password_hash', '0333301536', '2024-01-01 00:00:00', 3)";
    mysqli_query($conn, $insertAdmin);
}