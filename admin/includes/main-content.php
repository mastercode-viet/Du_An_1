<div class="main-content">
    <?php
    // Kiểm tra nếu tham số 'view' có tồn tại
    if (isset($_GET['view']) && !isset($_GET['action'])) {
        $view = $_GET['view'];
        $viewPath = 'admin/views/' . $view . '/index.php'; // Chèn trang index của chức năng

        // Kiểm tra nếu trang index của chức năng tồn tại
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $viewPath)) {
            include($_SERVER['DOCUMENT_ROOT'] . '/' . $viewPath);
        } else {
            echo "Trang không tồn tại!";
        }
    } else if (isset($_GET['view']) && isset($_GET['action'])) {
        $view = $_GET['view'];
        $viewPath = 'admin/views/' . $view . '/index.php'; // Chèn trang index của chức năng
        // Kiểm tra action (create, update) để chèn trang create hoặc update
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $actionPath = 'admin/views/' . $view . '/' . $action . '.php'; // Tạo đường dẫn cho các action như 'create', 'update'
            // Kiểm tra nếu file action tồn tại
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $actionPath)) {
                include($_SERVER['DOCUMENT_ROOT'] . '/' . $actionPath);
                exit;
            } else {
                echo "Trang action không tồn tại!";
            }
        }
    } else {
        echo "<p>Chọn chức năng từ menu bên trái.</p>";
    }
    ?>
</div>