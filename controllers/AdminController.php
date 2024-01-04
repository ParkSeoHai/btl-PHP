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

    // Thêm người dùng
    public function addUser() {
        $this->nguoiDung = new NguoiDung();

    }
}