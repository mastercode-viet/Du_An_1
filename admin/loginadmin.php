<?php
session_start();
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
            header("Location:../admin/views/index.php"); // Chuyển hướng đến web quản trị
            exit;
        } elseif ($user['role'] == 0) { // Kiểm tra nếu vai trò là user thông thường
            $_SESSION['user_logged_in'] = true;
            $_SESSION['username'] = $user['username']; // Lưu tên đăng nhập vào session
            header("Location: ../index.php"); // Chuyển hướng đến trang chủ
            exit;
        } else {
            $error = "Bạn không có quyền truy cập vào trang này.";
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
    <title>Đăng nhập quản trị viên</title>
    <style>
        /* Reset lại một số thuộc tính mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            margin-bottom: 15px;
            color: red;
            font-size: 14px;
            text-align: center;
        }

        footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Đăng nhập quản trị viên</h2>

        <?php if (isset($error)) {
            echo "<div class='error'>$error</div>";
        } ?>

        <form action="loginadmin.php" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>

</body>

</html>
