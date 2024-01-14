<?php

$title = $title ?? 'Thống kê';
$year = $year ?? date('Y');

// Chart left
if(isset($dataThongKe) && isset($dataPointsAdmin) && isset($dataPointsTeacher) && isset($dataPointsStudent)) {
    $totalUsers = $dataThongKe['totalUsers'];
    $newUsersDataPoints = array(
        $dataThongKe['admin'],
        $dataThongKe['teacher'],
        $dataThongKe['student']
    );

    $newAdminDataPoints = $dataPointsAdmin;
    $newTeacherDataPoints = $dataPointsTeacher;
    $newStudentDataPoints = $dataPointsStudent;
}

// Chart right
if(isset($dataPointsPrice)) {
    $dataPoints = $dataPointsPrice;
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?? 'Quản lý đăng ký khóa học online'; ?></title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <style>
        #backButton {
            border-radius: 4px;
            padding: 8px;
            border: none;
            font-size: 16px;
            background-color: #2eacd1;
            color: white;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .invisible {
            display: none;
        }
        .canvasjs-chart-credit {
            display: none;
        }
    </style>
</head>
<body>

<header>
    <form action="" class="header">
        <div class="header-content d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="logo-thuong-hieu">
                    <img src="../../assets/images/cocon..png" alt="">
                </div>
                <div class="header-search ">
                    <input type="text" placeholder="Tìm kiếm...">
                    <i class="bi bi-search"></i>
                </div>
            </div>
            <div class="header-left">
                <i class="bi bi-bell">
                    <span class="number-thongbao">0</span>
                </i>
                <i class="bi bi-person"></i>
                <div class="ms-2">
                    <p class="name-user"><?php echo isset($userInfo) ? $userInfo->getTen() : 'Error'; ?></p>
                    <p class="role-user"><?php echo $role ?? 'Error'; ?></p>
                </div>
            </div>
        </div>
    </form>
</header>

<main class="d-flex">
    <!-- Navbar -->
    <nav class="navbar-content">
        <div class="navbar-member d-flex flex-column">
            <a href="/btl/index.php?controler=Pages&action=home" id="home"><i class="bi bi-houses"></i> Trang chủ</a>
            <a href="/btl/index.php?controler=Pages&action=qlnguoidung" id="qlnguoidung"><i class="bi bi-universal-access"></i> Người dùng</a>
            <a href="/btl/index.php?controler=Pages&action=qlkhoahoc" id="qlkhoahoc"><i class="bi bi-book"></i> Khóa học</a>
            <a href="/btl/index.php?controler=Pages&action=qllichhoc" id="qllichhoc"><i class="bi bi-calendar-date"></i> Lịch Học</a>
            <a href="/btl/index.php?controler=Pages&action=qlgiangvien" id="qlgiangvien"><i class="bi bi-person-fill-gear"></i> Giảng viên</a>
            <a href="/btl/index.php?controler=Pages&action=thongke" id="thongke"><i class="bi bi-reception-4"></i> Thống kê</a>
            <a href="/btl/index.php?controler=Pages&action=thongbao" id="thongbao"><i class="bi bi-megaphone"></i> Thông báo hệ thống</a>
            <a href="/btl/assets/php/logout.php" class="mt-5"><i class="bi bi-arrow-return-left"></i> Thoát</a>
        </div>
    </nav>
    <!-- Content -->
    <div class="main-content">
        <div class='content-body' style="overflow-y: auto">
            <div class='header-content d-flex justify-content-between align-items-baseline'>
                <div class="d-flex align-items-center">
                    <p class='header-title'><?= $title ?></p>
                    <div class="d-flex align-items-baseline ps-4">
                        <select class="form-select form-select-lg" id="year" aria-label="Small select example">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                </div>
                <a href="../../assets/php/baoCaoDoanhThu.php?year=<?= $year ?>" class="btn btn-success fs-4">Export</a>
            </div>
            <div class="row pt-3">
                <script>
                    window.onload = function () {

                        var totalVisitors = <?php echo $totalUsers ?>;
                        var visitorsData = {
                            "Users": [{
                                click: visitorsChartDrilldownHandler,
                                cursor: "pointer",
                                explodeOnClick: false,
                                innerRadius: "75%",
                                legendMarkerType: "square",
                                name: "Users",
                                radius: "100%",
                                showInLegend: true,
                                startAngle: 90,
                                type: "doughnut",
                                dataPoints: <?php echo json_encode($newUsersDataPoints, JSON_NUMERIC_CHECK); ?>
                            }],
                            "Admin": [{
                                color: "#E7823A",
                                name: "Admin",
                                type: "column",
                                xValueType: "dateTime",
                                dataPoints: <?php echo json_encode($newAdminDataPoints, JSON_NUMERIC_CHECK); ?>
                            }],
                            "Teacher": [{
                                color: "#546BC1",
                                name: "Teacher",
                                type: "column",
                                xValueType: "dateTime",
                                dataPoints: <?php echo json_encode($newTeacherDataPoints, JSON_NUMERIC_CHECK); ?>
                            }],
                            "Student": [{
                                color: "#6D78AD",
                                name: "Student",
                                type: "column",
                                xValueType: "dateTime",
                                dataPoints: <?php echo json_encode($newStudentDataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        };

                        var newVSReturningVisitorsOptions = {
                            animationEnabled: true,
                            theme: "light2",
                            title: {
                                text: "Users - <?= $year ?>",
                                fontSize: 24
                            },
                            subtitles: [{
                                text: "Nhấp vào phân đoạn để xem chi tiết.",
                                backgroundColor: "#0e3742",
                                fontSize: 14,
                                fontColor: "white",
                                padding: 5
                            }],
                            legend: {
                                fontFamily: "calibri",
                                fontSize: 14,
                                itemTextFormatter: function (e) {
                                    return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";
                                }
                            },
                            data: []
                        };

                        var visitorsDrilldownedChartOptions = {
                            animationEnabled: true,
                            theme: "light2",
                            axisX: {
                                labelFontColor: "#717171",
                                lineColor: "#a2a2a2",
                                tickColor: "#a2a2a2"
                            },
                            axisY: {
                                gridThickness: 0,
                                includeZero: false,
                                labelFontColor: "#717171",
                                lineColor: "#a2a2a2",
                                tickColor: "#a2a2a2",
                                lineThickness: 1
                            },
                            data: []
                        };

                        var chart = new CanvasJS.Chart("chartContainer-users", newVSReturningVisitorsOptions);
                        chart.options.data = visitorsData["Users"];
                        chart.render();

                        function visitorsChartDrilldownHandler(e) {
                            chart = new CanvasJS.Chart("chartContainer-users", visitorsDrilldownedChartOptions);
                            chart.options.data = visitorsData[e.dataPoint.name];
                            chart.options.title = { text: e.dataPoint.name }
                            chart.render();
                            $("#backButton").toggleClass("invisible");
                        }

                        $("#backButton").click(function() {
                            $(this).toggleClass("invisible");
                            chart = new CanvasJS.Chart("chartContainer-users", newVSReturningVisitorsOptions);
                            chart.options.data = visitorsData["Users"];
                            chart.render();
                        });

                        <!-- Right -->
                        var chart = new CanvasJS.Chart("chartContainer-right", {
                            animationEnabled: true,
                            theme: 'light2', // "light1", "light2", "dark1", "dark2"
                            title: {
                                text: "Doanh thu năm - <?= $year ?>",
                                fontSize: 18
                            },
                            axisY: {
                                title: "VNĐ"
                            },
                            data: [{
                                type: "column",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();
                    }
                </script>
                <!-- Right -->
                <div class="text-body col-7">
                    <div id="chartContainer-right" style="height: 370px; width: 100%;"></div>
                </div>
                <!-- Left -->
                <div class="chart-body col-5">
                    <div class="fw-bold text-primary-emphasis">Total: <?= $totalUsers ?></div>

                    <div id="chartContainer-users" style="height: auto; width: 100%;"></div>
                    <button class="btn invisible" style="top: 60px" id="backButton">&lt; Back</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Active navbar -->
    <?php
    $navActive = $_GET['action'] ?? 'home';
    echo "
            <script>
                const navActive = document.getElementById('$navActive');
                if(navActive) {
                    navActive.classList.add('active');
                }
            </script>
        ";
    ?>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        const year = document.getElementById('year');
        year.value = <?= $year ?>;

        const options = year.querySelectorAll('option');
        options.forEach(option => {
            if(option.value === <?= $year ?>) {
                option.selected = true;
            }
        })

        year.addEventListener('change', () => {
            window.location.href = `/btl/index.php?controler=Pages&action=thongke&year=${year.value}`;
        })
    </script>
</body>
</html>