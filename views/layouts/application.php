<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($title) ? $title : 'Quản lý đăng ký khóa học online'; ?></title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <header>
        <h1 style="text-align: center; background-color: olive">Header</h1>
    </header>

    <main class="d-flex">
        <!-- Navbar -->
        <nav style="width: 200px; height: 200px; background-color: #ff5757"></nav>
        <!-- Content -->
        <div class="main-content">
            <?php echo isset($content) ? $content : 'Không có nội dung'; ?>
        </div>
    </main>
</body>
</html>