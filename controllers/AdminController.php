<?php

namespace controllers;

use models\LichHoc;
use models\NguoiDung;

require_once('../../models/NguoiDung.php');
require_once('../../models/LichHoc.php');

class AdminController
{
    private NguoiDung $nguoiDung;
    private LichHoc $lichHoc;

    public function __construct()
    {
    }

    // Check email đã tồn tại hay chưa? (True if exist, false if not exist)
    public function checkEmail($id, $email) : bool {
        $this->nguoiDung = new NguoiDung();
        return $this->nguoiDung->checkEmail($id, $email);
    }

    // Thêm người dùng
    public function addUser($username, $email, $phoneNumber, $role) : void {
        $this->nguoiDung = new NguoiDung();
        $this->nguoiDung->setTen($username);
        $this->nguoiDung->setEmail($email);
        $this->nguoiDung->setSoDienThoai($phoneNumber);
        $this->nguoiDung->setIdQuyen($role);
        // True if success, false if fail
        $isAdd = $this->nguoiDung->add($this->nguoiDung);

        if($isAdd) {
            setcookie('message', 'Thêm người dùng thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
        } else {
            setcookie('message', 'Thêm người dùng thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=error");
        }
    }

    // Sửa người dùng
    public function updateUser($id, $username, $email, $phoneNumber, $role) :void {
        $this->nguoiDung = new NguoiDung();
        $this->nguoiDung->setId($id);
        $this->nguoiDung->setTen($username);
        $this->nguoiDung->setEmail($email);
        $this->nguoiDung->setSoDienThoai($phoneNumber);
        $this->nguoiDung->setIdQuyen($role);
        // True if success, false if fail
        $isUpdate = $this->nguoiDung->update($this->nguoiDung);

        if($isUpdate) {
            setcookie('message', 'Sửa người dùng thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
        } else {
            setcookie('message', 'Sửa người dùng thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
        }
    }

    // Xóa người dùng
    public function removeUser($id) : void {
        $this->nguoiDung = new NguoiDung();
        $isRemove = $this->nguoiDung->delete($id);
        if($isRemove) {
            setcookie('message', 'Xóa người dùng thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
        } else {
            setcookie('message', 'Xóa người dùng thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qlnguoidung");
        }
    }

    // Thêm lịch học
    public function addLichHoc($courseId, $ngayBatDau, $infoPhongHoc) : void {
        // Set default value for infoPhongHoc
        $infoPhongHoc = $infoPhongHoc ?? "Chưa có thông tin phòng học";

        // True if success, false if fail
        $this->lichHoc = new LichHoc(0, $infoPhongHoc, $ngayBatDau, $courseId);
        if($this->lichHoc->add($this->lichHoc)) {
            setcookie('message', 'Thêm lịch học thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        } else {
            setcookie('message', 'Thêm lịch học thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        }
    }

    // Sửa lịch học
    public function updateLichHoc($id, $courseId, $ngayBatDau, $infoPhongHoc) : void {
        // Set default value for infoPhongHoc
        $infoPhongHoc = $infoPhongHoc ?? "Chưa có thông tin phòng học";

        // True if success, false if fail
        $this->lichHoc = new LichHoc($id, $infoPhongHoc, $ngayBatDau, $courseId);
        if($this->lichHoc->update($this->lichHoc)) {
            setcookie('message', 'Cập nhật lịch học thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        } else {
            setcookie('message', 'Cập nhật lịch học thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        }
    }

    // Xóa lịch học
    public function removeLichHoc($id) : void {
        $this->lichHoc = new LichHoc();
        $isRemove = $this->lichHoc->delete($id);
        if($isRemove) {
            setcookie('message', 'Xóa lịch học thành công', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        } else {
            setcookie('message', 'Xóa lịch học thất bại', time() + 1, '/');
            header("Location: /btl/index.php?controller=Pages&action=qllichhoc");
        }
    }
}