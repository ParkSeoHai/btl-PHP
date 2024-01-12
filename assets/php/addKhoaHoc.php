<?php
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

if(isset($_POST['courseName']) && isset($_POST['description']) && isset($_POST['teacherId'])
    && isset($_POST['coursePrice']) && isset($_POST['courseImage'])) {
    $courseName = $_POST['courseName'];
    $description = $_POST['description'];
    $teacherId = $_POST['teacherId'];
    $coursePrice = $_POST['coursePrice'];
    $courseImage = $_POST['courseImage'];

    // Upload image to cloudinary
    // Use Composer to manage your PHP library dependency
    require __DIR__ . '/../../vendor/autoload.php';

    // Initialize Cloudinary configuration
    // Hidden API key and secret key


    try {
        // Instantiate UploadApi
        $uploadApi = new UploadApi();

        // Specify the folder in which you want to upload the image on Cloudinary
        $cloudinaryFolder = "Btl-Php"; // Replace with your desired folder name on Cloudinary

        // Specify the URL of the image you want to upload
        $localImagePath = "D:\\IT3-EAUT\\Lập trình Web PHP\\btl\\assets\\images\\" . $courseImage;; // Replace with the actual URL

        // Upload the image to the specified folder
        $response = $uploadApi->upload($localImagePath, [
            "folder" => $cloudinaryFolder,
            // Additional upload options can be specified here
        ]);

        // You can then use $publicId and $url as needed

        // Print the result for demonstration purposes
        //print_r($response);

        $url = $response['secure_url'] ?? 'Lỗi upload ảnh';

        echo $courseName . ' ' . $description . ' ' . $teacherId . ' ' . $coursePrice . ' ' . $url;

        require_once '../../controllers/AdminController.php';
        $adminController = new \controllers\AdminController();
        $adminController->addCourse($courseName, $description, $url, $coursePrice, $teacherId);
    } catch (Exception $e) {
        setcookie('message', 'Lỗi upload image: ' . $e->getMessage(), time() + 1, '/');
        header('Location: /btl/index.php?controller=Pages&action=qlkhoahoc');
    }
} else
    echo 'Không đủ dữ liệu!';