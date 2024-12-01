<!-- views/Customer/register.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="/admin/views/css/index.css">
</head>
<body>    
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    
    <form action="indexkhachhang.php?act=register" method="POST">
        <h1>Đăng ký tài khoản mới</h1>

        <!-- Tài khoản -->
        <label for="username">Tài khoản (Username):</label>
        <input type="text" id="username" name="username" 
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
        <br>
        
        <!-- Tên người dùng -->
        <label for="fullName">Tên người dùng:</label>
        <input type="text" id="fullName" name="fullName" 
               value="<?php echo isset($_POST['fullName']) ? $_POST['fullName'] : ''; ?>" required>
        <br>
        
        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" 
               value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
        <br>
        
        <!-- Số điện thoại -->
        <label for="phone">Số điện thoại:</label>
        <input type="tel" id="phone" name="phone" 
               value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>
        <br>
        
        <!-- Mật khẩu -->
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <br>
        
        <!-- Xác nhận mật khẩu -->
        <label for="confirmPassword">Xác nhận mật khẩu:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        <br>
        <br>
        
        <button type="submit">Đăng ký</button>
        
        <p>Đã có tài khoản <a href="indexkhachhang.php?act=login">Đăng nhập</a></p>
    </form>
</body>
</html>
