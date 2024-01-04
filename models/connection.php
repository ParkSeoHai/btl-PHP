<?php

namespace models;
class connection
{
    private static $conn = NULL;

    public static function getConnection()
    {
        try {
            self::$conn = new \mysqli("localhost", "root", "", "btl_php");
        } catch (\Exception $e) {
            echo "Lỗi kết nối CSDL, chi tiết lỗi: " . $e->getMessage();
            exit();
        }
        return self::$conn;
    }
}