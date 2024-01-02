<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($title) ? $title : 'Quản lý đăng ký khóa học online'; ?></title>
</head>
<body>
    <header>
        <h1 style="text-align: center; background-color: olive">Header</h1>
    </header>

    <main>
        <?php echo isset($content) ? $content : 'Không có nội dung'; ?>
    </main>
</body>
</html>