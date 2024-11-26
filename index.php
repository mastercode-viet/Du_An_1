<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "views/header.php";

// include "models/connectdb.php";
require_once "models/user.php";

// require_once 'controllers/HomeController.php';

// $home = new HomeController();
//

if (isset($_GET['act'])) {
    $act = $_GET['act'];

    // die($act);

    switch ($act) {
        case 'trangchu':
            include "views/trangchu.php";
            break;
        case 'lichchieu':
            include "views/lichchieu.php";
            break;
        case 'tintuc':
            include "views/tintuc.php";
            break;
        case 'khuyenmai':
            include "views/khuyenmai.php";
            break;
        case 'giave':
            include "views/giave.php";
            break;
        case 'gioithieu':
            include "views/gioithieu.php";
            break;
        case 'dangky':
            include "views/Register.php";
            break;
        case 'logout':
            unset($_SESSION['role']);
            unset($_SESSION['iduser']);
            unset($_SESSION['username']);
            header("Location: index.php");
            break;
        case 'login':
            if (isset($_POST['login'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                // Gọi hàm lấy thông tin người dùng
                $kq = getuserinfor($user, $pass);

                // Kiểm tra kết quả trả về
                if (!$kq) {
                    echo "Sai tên đăng nhập hoặc mật khẩu.";
                    include "views/login.php";
                    exit();
                }

                // Gán thông tin người dùng vào session
                $_SESSION['username'] = $kq['username'];
                $_SESSION['role'] = $kq['role'];
                $_SESSION['iduser'] = $kq['id_khachhang'];

                // Kiểm tra vai trò (role) và điều hướng
                if ($kq['role'] == 1) {
                    header("Location: /admin/index.php");
                    exit();

                } else {
                    header("Location: index.php");
                    exit();
                }
            }

            include "views/login.php";
            break;

        default:
            include "views/home.php";
            break;
    }
} else {
    include_once "views/home.php";

}
include "views/footer.php";
