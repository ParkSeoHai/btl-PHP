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

    public function dangNhap($email, $password, $isRemember = false)
    {
        $this->nguoiDung = new NguoiDung();
        $user = $this->nguoiDung->dangNhap($email, $password);
        if($user) {
            if($user['idQuyen'] == 3){
                setcookie('errorLogin', 'Bạn không có quyền truy cập vào trang này', time() + 1, '/');
                header('location: /btl/views/pages/login.php');
            } else {
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

    public function dangKy($user)
    {
        if($user) {
            $this->nguoiDung = new NguoiDung();
            // Kiểm tra xem email đã tồn tại hay chưa?
            if($this->nguoiDung->checkEmail($user->getEmail())) {
                setcookie('errorRegister', 'Lỗi: Email đã tồn tại', time() + 1, '/');
                header('location: /btl/views/pages/register.php');
            }
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

    public function dangXuat()
    {
        $this->nguoiDung = new NguoiDung();
        $this->nguoiDung->dangXuat();
    }
}