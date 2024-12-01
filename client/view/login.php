<!-- views/khachhang/login.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="/admin/views/css/index.css">
</head>
<body>
    
    <!-- Hiển thị lỗi nếu có -->
    <?php if (isset($error)): ?>
        <p style="color:red"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST">
    <h2>Đăng Nhập</h2>

        <div>
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" placeholder="Mời bạn nhập tên đăng nhập" required>
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Mời bạn nhập mật khẩu" required>
        </div>
        <button type="submit">Đăng Nhập</button>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
        <p><a href="#">Quên mật khẩu</a></p>
    </form>
</body>
</html>
