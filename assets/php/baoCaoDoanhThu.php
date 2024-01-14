<?php
require_once ('../../models/NguoiDung.php');
require_once ('../../models/ThongKe.php');

$year = $_GET['year'] ?? date("Y");

$fileName = 'DoanhThu_' . $year . '.xls';

// Column names
$fields = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November','December');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Get records from the database
$thongkeModel = new \models\ThongKe();
$data = $thongkeModel->getDataPricePoints($year);

if(count($data) > 0) {
    $rowData = array();
    // Output each row of the data, format line as csv and write to file pointer
    foreach ($data as $item) {
        $rowItem = $item['y'];
        array_push($rowData, $rowItem);
    }
    $excelData .= implode("\t", array_values($rowData)) . "\n";
} else {
    $excelData .= 'No records found...'. "\n";
}

// Headers for download
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");

// Render excel data
echo $excelData;

exit();