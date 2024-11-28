<?php
require_once('models/model_dayghe.php');
class DayGheController {
    private $dayGheModel;

    public function __construct($db) {
        $this->dayGheModel = new DayGhe($db);
    }

    // Hiển thị danh sách dãy ghế
    public function index() {
        $result = $this->dayGheModel->read();
        include('views/quanlydayghe/index.php'); // Hiển thị danh sách dãy ghế
    }

    // Thêm dãy ghế
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->dayGheModel->ten = $_POST['ten'];
    
            // Kiểm tra dữ liệu trước khi thêm
            if (empty($this->dayGheModel->ten)) {
                $_SESSION['error'] = 'Tên dãy ghế không được để trống!';
                header("Location: ?view=DayGhe&action=create");
                exit();
            }
    
            // Kiểm tra xem tên dãy ghế đã tồn tại chưa
            if ($this->dayGheModel->isTenDayGheExists($this->dayGheModel->ten)) {
                $_SESSION['error'] = 'Tên dãy ghế này đã tồn tại! Vui lòng chọn tên khác.';
                header("Location: ?view=DayGhe&action=create");
                exit();
            }
    
            // Thêm dãy ghế
            if ($this->dayGheModel->create()) {
                $_SESSION['success'] = 'Thêm dãy ghế thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm dãy ghế!';
            }
    
            header("Location: ?view=DayGhe");
            exit();
        }
        include('views/quanlydayghe/create.php');
    }

    // Sửa dãy ghế
    public function edit() {
        if (isset($_GET['id'])) {
            $this->dayGheModel->id = $_GET['id'];
            $result = $this->dayGheModel->read();
            $currentDayGhe = null;
    
            // Tìm dãy ghế hiện tại
            foreach ($result as $row) {
                if ($row['id'] == $this->dayGheModel->id) {
                    $currentDayGhe = $row;
                    break;
                }
            }
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->dayGheModel->ten = $_POST['ten'];
    
                // Kiểm tra dữ liệu trước khi cập nhật
                if (empty($this->dayGheModel->ten)) {
                    $_SESSION['error'] = 'Tên dãy ghế không được để trống!';
                    header("Location: ?view=DayGhe&action=edit&id=" . $this->dayGheModel->id);
                    exit();
                }
    
                // Kiểm tra xem tên dãy ghế đã tồn tại chưa
                if ($this->dayGheModel->isTenDayGheExists($this->dayGheModel->ten, $this->dayGheModel->id)) {
                    $_SESSION['error'] = 'Tên dãy ghế này đã tồn tại! Vui lòng chọn tên khác.';
                    header("Location: ?view=DayGhe&action=edit&id=" . $this->dayGheModel->id);
                    exit();
                }
    
                // Cập nhật dãy ghế
                if ($this->dayGheModel->update()) {
                    $_SESSION['success'] = 'Cập nhật dãy ghế thành công!';
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật dãy ghế!';
                }
    
                header("Location: ?view=DayGhe");
                exit();
            }
    
            include('views/quanlydayghe/edit.php');
        }
    }

    // Xóa dãy ghế
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Kiểm tra xem dãy ghế có đang được sử dụng hay không

            // Xóa dãy ghế
            if ($this->dayGheModel->delete($id)) {
                $_SESSION['success'] = 'Xóa dãy ghế thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi xóa dãy ghế!';
            }

            header('Location: ?view=DayGhe');
            exit;
        } else {
            $_SESSION['error'] = 'Không tìm thấy dãy ghế để xóa';
            header('Location: ?view=DayGhe');
            exit;
        }
    }
}
?>
