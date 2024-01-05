<?php

namespace controllers;

use models\NguoiDung;

require_once('../../models/NguoiDung.php');
class AdminController
{
    private NguoiDung $nguoiDung;

    public function __construct()
    {
    }

    // Check email đã tồn tại hay chưa? (True if exist, false if not exist)
    public function checkEmail($id, $email) : bool {
        $this->nguoiDung = new NguoiDung();
        return $this->nguoiDung->checkEmail($id, $email);
    }

    // Thêm người dùng
    public function addUser($username, $email, $phoneNumber, $role) {
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
    public function updateUser($id, $username, $email, $phoneNumber, $role) {
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
    public function removeUser($id) {
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
}