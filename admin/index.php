<?php
session_start();
define('SITE_URL', 'http://localhost:3000');

// Kiểm tra đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /admin/loginadmin.php");
    exit;
}

include('db.php');
include('includes/header.php');
?>

<div class="container-fluid">
    <div class="row">
        <?php include('includes/sidebar.php'); ?>

        <div class="main-content">
            <?php
            if (isset($_GET['view'])) {
                $view = $_GET['view'];
                $controllerClass = ucfirst($view) . 'Controller';

                if (file_exists('controllers/' . $controllerClass . '.php')) {
                    include('controllers/' . $controllerClass . '.php');
                    $controller = new $controllerClass($conn);

                    // Xử lý các hành động như create, edit, delete
                    if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                        if ($action == 'create') {
                            $controller->create();  // Gọi hành động tạo mới
                        } elseif ($action == 'edit') {
                            $controller->edit();  // Gọi hành động chỉnh sửa
                        } elseif ($action == 'delete') {
                            $controller->delete();  // Gọi hành động xóa
                        }elseif ($action == 'update') {
                            $controller->update();  // Gọi hành động cập nhật
                        } else {
                            $controller->index();  // Hiển thị danh sách phim
                        }
                    } else {
                        $controller->index();  // Hiển thị danh sách phim nếu không có hành động
                    }
                } else {
                    echo "<p>Không tìm thấy controller tương ứng!</p>";
                }
            } else {
                echo "<p>Chọn chức năng từ menu bên trái.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php

?>
