<?php

namespace controllers;

class BaseController
{
    protected $folder; // Biến có giá trị là thư mục nào đó trong thư mục views, chứa các file view template của phần đang truy cập.

    // Hàm hiển thị kết quả ra cho người dùng.
    function render($file, $data = array(), $isTemplate = true)
    {
        // Kiểm tra file gọi đến có tồn tại hay không?
        $view_file = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($view_file)) {
            if($isTemplate) {
                // Nếu sử dụng template thì gọi ra file template chung của hệ thống
                // Nếu tồn tại file đó thì tạo ra các biến chứa giá trị truyền vào lúc gọi hàm
                extract($data);
                // Sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó vào 1 biến chứ chưa hiển thị luôn ra trình duyệt
                ob_start();
                require_once($view_file);
                $content = ob_get_clean();
                // Sau khi có kết quả đã được lưu vào biến $content, gọi ra template chung của hệ thống đế hiển thị ra cho người dùng
                require_once('views/layouts/application.php');
            } else {
                extract($data);
                // Sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó vào 1 biến chứ chưa hiển thị luôn ra trình duyệt
                ob_start();
                // Nếu không sử dụng template thì gọi ra file view template của phần đang truy cập.
                require_once($view_file);
            }
        } else {
            // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.
            header('Location: /btl/index.php?controller=Pages&action=error');
        }
    }
}