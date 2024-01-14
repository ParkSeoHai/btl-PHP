<?php
    session_start();
    if(isset($_SESSION['code']) && isset($_SESSION['email'])) {
        $code = $_SESSION['code'];
        $email = $_SESSION['email'];
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../assets/fonts/font.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
    <body>
        <div class="fogot-pass-view">
            <div class="fogot-pass-view-content">
                <h1>QUÊN MẬT KHẨU</h1>
                <?php
                    if(isset($_COOKIE['error'])) {
                        session_unset();
                        echo "<div class='alert alert-danger' role='alert'>
                                <strong>Lỗi!</strong> " . $_COOKIE['error'] . "
                            </div>";
                    } else if(isset($_COOKIE['success'])) {
                        session_unset();
                        echo "<div class='alert alert-success' role='alert'>
                                <strong>Thành công!</strong> " . $_COOKIE['success'] . "
                            </div>";
                    }
                ?>
                <form id="form" class="input-email" method="post" action="../../assets/php/forgotPassword.php">
                    <label for="email"><i class="bi bi-envelope"></i></label>
                    <?php
                        if(isset($email)) {
                            echo "<input type='email' name='email' id='email' class='ms-4' placeholder='Email' value='$email'>";
                        } else {
                            echo "<input type='email' name='email' id='email' class='ms-4' placeholder='Email'>";
                        }
                    ?>
                    <button type="submit" class="border-0 bg-white"><i class="send-code bi bi-arrow-right"></i></button>
                </form>
                <?php
                    if(isset($code) && isset($email)) {
                        echo "<div>
                                <span>Mã xác thực 6 số</span><br>
                                <input class='verification-codes mb-3' type='text' placeholder='Mã xác thực'>
                                <span class='message-error float-start text-danger d-none pe-4'>Mã xác thực không chính xác</span>
                            </div>";
                    }
                ?>
                <form action="../../assets/php/resetPassword.php" id="form-reset-password" method="post">
                    <div class="d-none reset-block">
                        <?php
                            if(isset($email)) {
                                echo "<input type='email' name='emailConfirm' class='ms-4' hidden='' placeholder='Email' value='$email'>";
                            }
                        ?>
                        <div class="mb-3">
                            <label class="float-start mb-2 fs-4">Nhập mật khẩu mới</label>
                            <input type="password" name="newPassword" class="w-100 border-2 ps-2 py-2 new-password" style="border-radius: 8px" required placeholder="Mật khẩu mới">
                        </div>
                        <div class="mb-4">
                            <label class="float-start mb-2 fs-4">Nhập lại mật khẩu mới</label>
                            <input type="password" class="w-100 border-2 ps-2 py-2 password-confirm" style="border-radius: 8px" required placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </div>
                    <div class="checkbox-dksd">
                        <a href="login.php" class="text-danger-emphasis d-block">Quay lại</a>
                    </div>
                    <button class="btn-fogot-pass btn-confirm" type="button">Xác nhận</button>
                </form>
            </div>
        </div>
    </body>

    <script>
        // Validate email
        const form = document.getElementById('form');
        const btn = form.querySelector('button');
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const email = form.querySelector('input[type="email"]').value;

            // Validate email
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if(email === '') {
                alert('Vui lòng nhập email');
            } else if(!regex.test(email)) {
                alert('Email không hợp lệ');
            } else {
                form.submit();
            }
        })

        // Validate code
        const formResetPassword = document.getElementById('form-reset-password');
        const btnConfirm = formResetPassword.querySelector('.btn-confirm');
        const codeElement = document.querySelector('.verification-codes');
        // Check code
        codeElement.addEventListener('input', (e) => {
            if(e.target.value.length >= 6) {
                e.target.value = e.target.value.slice(0, 6);
                if(e.target.value === '<?php echo $code; ?>') {
                    // Show reset block
                    const resetBlock = document.querySelector('.reset-block');
                    resetBlock.classList.remove('d-none');
                    // Hidden message error
                    const messageError = document.querySelector('.message-error');
                    messageError.classList.add('d-none');
                } else {
                    // Show message error
                    const messageError = document.querySelector('.message-error');
                    messageError.classList.remove('d-none');
                }
            } else {
                // Hidden reset block
                const resetBlock = document.querySelector('.reset-block');
                resetBlock.classList.add('d-none');
            }
        })
        // Click button confirm
        btnConfirm.addEventListener('click', (e) => {
            e.preventDefault();
            if(codeElement) {
                if(codeElement.value === '') {
                    alert('Vui lòng nhập mã xác thực');
                } else if(codeElement.value !== '<?php echo $code; ?>') {
                    alert('Mã xác thực không đúng');
                } else {
                    // Validate password and password confirm
                    const newPassword = document.querySelector('.new-password').value;
                    const passwordConfirm = document.querySelector('.password-confirm').value;
                    if(newPassword === '') {
                        alert('Vui lòng nhập mật khẩu mới');
                    } else if(passwordConfirm === '') {
                        alert('Vui lòng nhập lại mật khẩu mới');
                    } else if(newPassword !== passwordConfirm) {
                        alert('Mật khẩu không khớp');
                    } else {
                        formResetPassword.submit();
                    }
                }
            }
        })
    </script>
</html>