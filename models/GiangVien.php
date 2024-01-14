<?php

namespace models;

require_once('connection.php');
require_once('KhoaHoc.php');
require_once('LichHoc.php');

class GiangVien extends NguoiDung
{
    public function __construct(
        int $id = 0,
        string $ten = "",
        string $email = "",
        string $matKhau = "",
        string $soDienThoai = "",
        string $ngayTao = "",
        int $idQuyen = 3
    )
    {
        parent::__construct($id, $ten, $email, $matKhau, $soDienThoai, $ngayTao, $idQuyen);
    }

    // Get all giang vien
    public function getAll(): array
    {
        $sql = "SELECT * FROM nguoiDung WHERE quyenId = 2";
        $result = connection::getConnection()->query($sql);
        $giangViens = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $giangVien = new GiangVien(
                    $row['id'],
                    $row['hoten'],
                    $row['email'],
                    $row['matkhau'],
                    $row['sodienthoai'],
                    $row['ngaytao'],
                    $row['quyenId']
                );
                array_push($giangViens, $giangVien);
            }
        }
        return $giangViens;
    }

    // Lấy danh sách giảng viên theo pagination
    // Đầu ra dạng
    /* $item = array(
        [
            'id' => 1,
            'name' => 'Nguyễn Văn A',
            'courses' => [
                'course1' => [
                    'id' => 1,
                    'name' => 'Lập trình web',
                    'description' => 'Học lập trình web',
                    'start_date' => '2021-10-10',
                    'end_date' => '2021-12-10',
                    'schedule' => [
                        'schedule1' => [
                            'id' => 1,
                            'date' => '2021-10-10',
                            'time' => '08:00',
                            'duration' => '2h',
                            'content' => 'Học HTML',
                        ],
                        'schedule2' => [
                            'id' => 2,
                            'date' => '2021-10-11',
                            'time' => '08:00',
                            'duration' => '2h',
                            'content' => 'Học CSS',
                        ],
                    ]
                ],
                'course2' => [
                    'id' => 2,
                    'name' => 'Lập trình web',
                    'description' => 'Học lập trình web',
                    'start_date' => '2021-10-10',
                    'end_date' => '2021-12-10',
                ],
            ]
        ],
        [
            'id' => 1,
            'name' => 'Nguyễn Văn A',
            'courses' => [
                'course1' => [
                    'id' => 1,
                    'name' => 'Lập trình web',
                    'description' => 'Học lập trình web',
                    'start_date' => '2021-10-10',
                    'end_date' => '2021-12-10',
                    'schedule' => [
                        'schedule1' => [
                            'id' => 1,
                            'date' => '2021-10-10',
                            'time' => '08:00',
                            'duration' => '2h',
                            'content' => 'Học HTML',
                        ],
                        'schedule2' => [
                            'id' => 2,
                            'date' => '2021-10-11',
                            'time' => '08:00',
                            'duration' => '2h',
                            'content' => 'Học CSS',
                        ],
                    ]
                ],
                'course2' => [
                    'id' => 2,
                    'name' => 'Lập trình web',
                    'description' => 'Học lập trình web',
                    'start_date' => '2021-10-10',
                    'end_date' => '2021-12-10',
                ],
            ]
        ]
    );*/
    public function getAllByPagination($page_first_result, $results_per_page) : array
    {
        // Lấy danh sách giảng viên
        $sql = "SELECT * FROM nguoiDung WHERE quyenId = 2 LIMIT $page_first_result, $results_per_page";
        $result = connection::getConnection()->query($sql);
        $listTeacher = array();
        if($result->num_rows > 0) {
            // Lặp danh sách giảng viên
            while($row = $result->fetch_assoc()) {
                // Lấy danh sách khóa học của giảng viên
                $khoaHocModel = new KhoaHoc();
                $listCourse = $khoaHocModel->getAllByIdNguoiDay($row['id']);
                $courses = array();
                if(count($listCourse) > 0) {
                    foreach($listCourse as $course) {
                        // Lấy lịch học của khóa học theo id
                        $lichHocModel = new LichHoc();
                        $schedule = $lichHocModel->getByKhoaHocId($course->getId());
                        // Khóa học
                        $course = array(
                            'id' => $course->getId(),
                            'tenKhoaHoc' => $course->getTenKhoaHoc(),
                            'moTa' => $course->getMoTa(),
                            'ngayTao' => $course->getNgayTao(),
                            'ngayCapNhat' => $course->getNgayCapNhat(),
                            'idNguoiDay' => $course->getIdNguoiDay(),
                            'schedule' => $schedule
                        );
                        array_push($courses, $course);
                    }
                }

                // Giảng viên
                $teacher = array(
                    'id' => $row['id'],
                    'ten' => $row['hoten'],
                    'email' => $row['email'],
                    'soDienThoai' => $row['sodienthoai'],
                    'ngayTao' => $row['ngaytao'],
                    'idQuyen' => $row['quyenId'],
                    'courses' => $courses
                );
                array_push($listTeacher, $teacher);
            }
        }
        return $listTeacher;
    }
}