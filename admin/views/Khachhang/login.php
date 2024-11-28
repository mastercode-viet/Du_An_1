<?php

// Kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'da1';
$username_db = 'root';
$password_db = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Kiểm tra nếu người dùng đã đăng nhập thì chuyển hướng về trang quản trị
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
    header("Location: /admin/index.php"); // Chuyển hướng đến trang quản trị sau khi đăng nhập
    exit;
}

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra tên đăng nhập trong bảng 'khach_hang'
    $sql = "SELECT * FROM khach_hang WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Kiểm tra nếu có người dùng với tên đăng nhập này
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // So sánh trực tiếp mật khẩu
    if ($user && $password == $user['password']) {
        // Kiểm tra vai trò của người dùng (role)
        if ($user['role'] == 1) { // Kiểm tra nếu là admin
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $user['username']; // Lưu tên đăng nhập vào session
            header("Location:/admin/index.php"); // Chuyển hướng đến trang quản trị
            exit;
        } else {
            $error = "Bạn không có quyền truy cập vào trang quản trị.";
        }
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="/admin/views//css//index.css">
</head>

<body>
    <!-- <h2>Đăng Nhập</h2> -->
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red"><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="POST">
        <div>
        <h2>Đăng Nhập</h2>
            <label>Tên đăng nhập (Username):</label>
            <input type="text" name="username" placeholder="Mời bạn đăng nhập" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" placeholder="Mời bạn nhập mật khẩu"  required>
        </div>
        <button type="submit">Đăng Nhập</button>
        <p>Chưa có tài khoản? <a href="views/khachhang/register.php">Đăng ký</a></p>
        <a href="">Quên mật khật</a>    
</form>
    <!-- <p>Chưa có tài khoản? <a href="index.php?act=register">Đăng ký</a></p> -->
</body>
</html>
