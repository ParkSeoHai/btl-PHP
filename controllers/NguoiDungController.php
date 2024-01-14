<?php

namespace controllers;

use models\NguoiDung;

require_once('../../models/NguoiDung.php');

class NguoiDungController
{
    private NguoiDung $nguoiDung;

    public function __construct()
    {
    }

    public function dangNhap($email, $password, $isRemember = false) : void
    {
        $this->nguoiDung = new NguoiDung();
        $user = $this->nguoiDung->dangNhap($email, $password);
        if($user) {
            if($user['idQuyen'] == 2 || $user['idQuyen'] == 3){
                setcookie('errorLogin', 'Bạn không có quyền truy cập vào trang này', time() + 1, '/');
                header('location: /btl/views/pages/login.php');
            } else {
                // Lưu cookie thông báo
                setcookie('message', 'Đăng nhập thành công', time() + 1, '/');
                // Set session
                session_start();
                if($isRemember) {
                    // Lưu cookie trong 1 ngày
                    setcookie('userId', $user['id'], time() + 86400, '/');
                    header('location: /btl/index.php?controller=Pages&action=home');
                }
                $_SESSION['userId'] = $user['id'];
                header('location: /btl/index.php?controller=Pages&action=home');
            }
        } else {
            setcookie('errorLogin', 'Email hoặc mật khẩu không đúng', time() + 1, '/');
            header('location: /btl/views/pages/login.php');
        }
    }

    public function checkEmail($email) : bool {
        $this->nguoiDung = new NguoiDung();
        // Kiểm tra xem email đã tồn tại hay chưa?
        if($this->nguoiDung->checkEmail(0, $email)) {
            setcookie('errorRegister', 'Lỗi: Email đã tồn tại', time() + 1, '/');
            header('location: /btl/views/pages/register.php');
            return true;
        }
        return false;
    }

    public function dangKy($user) : void
    {
        if($user) {
            $this->nguoiDung = new NguoiDung();
            // Đăng ký người dùng
            if($this->nguoiDung->dangKy($user)) {
                header('location: /btl/views/pages/login.php');
            } else {
                setcookie('errorRegister', 'Lỗi: Đăng ký không thành công', time() + 1, '/');
                header('location: /btl/views/pages/register.php');
            }
        } else {
            setcookie('errorRegister', 'Lỗi: Chưa nhận được thông tin người dùng', time() + 1, '/');
            header('location: /btl/views/pages/register.php');
        }
    }

    public function resetPassword($email, $newPassword) : void
    {
        $this->nguoiDung = new NguoiDung();
        if($this->nguoiDung->resetPassword($email, $newPassword)) {
            setcookie('success', 'Đổi mật khẩu thành công', time() + 1, '/');
            header('location: /btl/views/pages/forgot-pass.php');
        } else {
            setcookie('error', 'Lỗi: Đổi mật khẩu không thành công', time() + 1, '/');
            header('location: /btl/views/pages/forgot-pass.php');
        }
    }

    public function dangXuat()
    {
        $this->nguoiDung = new NguoiDung();
        $this->nguoiDung->dangXuat();
    }
}