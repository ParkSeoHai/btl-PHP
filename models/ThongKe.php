<?php

namespace models;

class ThongKe
{
    private NguoiDung $nguoiDung;

    public function __construct()
    {
        $this->nguoiDung = new NguoiDung();
    }

    // Get total users
    public function getTotalUsers($year) : int
    {
        $sql = "SELECT * FROM nguoidung WHERE ngaytao BETWEEN '$year-1-1 00:00:00' AND '$year-12-31 23:59:59'";
        $result = connection::getConnection()->query($sql);
        if($result->num_rows <= 0) {
            return 0;
        }

        return $result->num_rows;
    }

    // Get count of users by role
    public function getCountByRole($roleId, $year) : int
    {
        $sql = "SELECT * FROM nguoidung WHERE nguoidung.quyenId = $roleId AND ngaytao BETWEEN '$year-1-1 00:00:00' AND '$year-12-31 23:59:59'";
        $result = connection::getConnection()->query($sql);
        if($result->num_rows <= 0) {
            return 0;
        }

        return $result->num_rows;
    }

    // Get data for chart users
    public function getData($year) : array
    {
        $data = array(
            'totalUsers' => $this->getTotalUsers($year),
            'admin' => array("y"=> $this->getCountByRole(1, $year), "name"=> "Admin", "color"=> "#E7823A"),
            'teacher' => array("y"=> $this->getCountByRole(2, $year), "name"=> "Teacher", "color"=> "#546BC1"),
            'student' => array("y" => $this->getCountByRole(3, $year), "name" => "Student" , "color" => "#6D78AD")
        );
        return $data;
    }

    // Get data for chart users
    public function getDataPoint($roleId, $month, $year) : array {
        $sql = "SELECT * FROM nguoidung WHERE nguoidung.quyenId = $roleId AND ngaytao BETWEEN '$year-$month-1 00:00:00' AND '$year-$month-31 23:59:59'";
        $result = connection::getConnection()->query($sql);
        // Convert month to string
        $month = date("F", mktime(0, 0, 0, $month, 10));
        $data = array(
            'label' => "$month",
            'y'=> $result->num_rows
        );

        return $data;
    }

    // Get data for chart users
    public function getDataPoints($roleId, $year) : array
    {
        $dataPoints = array();
        $month = 1;

        while($month <= 12) {
            $dataPoint = $this->getDataPoint($roleId, $month, $year);
            array_push($dataPoints, $dataPoint);
            $month++;
        }

        return $dataPoints;
    }

    // Get data for chart prices
    public function getDataPrice($month, $year) : array {
        $sql = "SELECT SUM(subquery.total_students * k.gia) AS total_cost
                FROM khoahoc AS k
                JOIN (
                    SELECT h.khoahocId, COUNT(*) AS total_students
                    FROM hocvien AS h
                    JOIN khoahoc AS k ON h.khoahocId = k.id
                    WHERE h.ngaydangky BETWEEN '$year-$month-01 00:00:00' AND '$year-$month-31 23:59:59'
                    GROUP BY h.khoahocId
                ) AS subquery ON k.id = subquery.khoahocId;";
        $result = connection::getConnection()->query($sql);
        $row = $result->fetch_assoc();
        // Convert month to string
        $month = date("F", mktime(0, 0, 0, $month, 10));
        $data = array(
            'label' => "$month",
            'y'=> max($row['total_cost'], 0)
        );
        return $data;
    }

    // Get data for chart prices
    public function getDataPricePoints($year) : array {
        $dataPoints = array();
        $month = 1;
        while ($month <= 12) {
            $dataPoint = $this->getDataPrice($month, $year);
            array_push($dataPoints, $dataPoint);
            $month++;
        }
        return $dataPoints;
    }
}