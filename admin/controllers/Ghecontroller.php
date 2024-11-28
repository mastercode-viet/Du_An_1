<?php
require_once('models/model_ghe.php');
require_once('models/model_dayghe.php');
require_once('models/Model_PhongChieu.php');

class GheController {
    private $gheModel;
    private $PhongchieuModel;
    private $daygheModel; 
    public function __construct($db) {
        $this->gheModel = new Ghe($db);  // Khởi tạo mô hình Ghe
        $this->PhongchieuModel = new PhongchieuModel($db);
        $this->daygheModel = new DayGhe($db);  // Khởi tạo mô hình PhongChieu
    }

    // Hiển thị danh sách ghế
    public function index() {
        $result = $this->gheModel->read();
        include('views/quanlyghe/index.php');
    }

    // Thêm ghế mới
    public function create() {
        // Lấy danh sách phòng chiếu và dãy ghế từ model
        $phongchieuList = $this->PhongchieuModel->read();  // Lấy tất cả phòng chiếu
        $daygheList = $this->daygheModel->read();  // Lấy tất cả dãy ghế
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $this->gheModel->id_phongchieu = $_POST['id_phongchieu'];
            $this->gheModel->id_dayghe = $_POST['id_dayghe'];  // Lấy id dãy ghế
            $this->gheModel->ten = $_POST['ten'];
            $this->gheModel->status = $_POST['status'];
    
            // Kiểm tra dữ liệu trước khi thêm
            if (empty($this->gheModel->ten)) {
                $_SESSION['error'] = 'Tên ghế không được để trống!';
                header("Location: ?view=Ghe&action=create");
                exit();
            }
    
            // Thêm ghế vào cơ sở dữ liệu
            if ($this->gheModel->create()) {
                $_SESSION['success'] = 'Thêm ghế thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm ghế!';
            }
    
            header("Location: ?view=Ghe");
            exit();
        }
    
        // Gửi dữ liệu phòng chiếu và dãy ghế vào view
        include('views/quanlyghe/create.php');
    }
    

    // Sửa ghế
    public function edit() {
        $phongchieuList = $this->PhongchieuModel->read();  // Lấy tất cả phòng chiếu
        $daygheList = $this->daygheModel->read();
        if (isset($_GET['id_ghe'])) {
            $this->gheModel->id_ghe = $_GET['id_ghe'];
            $result = $this->gheModel->read();
            $currentGhe = null;

            // Tìm ghế hiện tại
            foreach ($result as $row) {
                if ($row['id_ghe'] == $this->gheModel->id_ghe) {
                    $currentGhe = $row;
                    break;
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->gheModel->id_phongchieu = $_POST['id_phongchieu'];
                $this->gheModel->id_dayghe = $_POST['id_dayghe'];
                $this->gheModel->ten = $_POST['ten'];
                $this->gheModel->status = $_POST['status'];

                // Cập nhật ghế
                if ($this->gheModel->update()) {
                    $_SESSION['success'] = 'Cập nhật ghế thành công!';
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật ghế!';
                }

                header("Location: ?view=Ghe");
                exit();
            }

            include('views/quanlyghe/edit.php');
        }
    }

    // Xóa ghế
    public function delete() {
        if (isset($_GET['id_ghe'])) {
            $id_ghe = $_GET['id_ghe'];

            if ($this->gheModel->delete($id_ghe)) {
                $_SESSION['success'] = 'Xóa ghế thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi xóa ghế!';
            }

            header('Location: ?view=Ghe');
            exit();
        } else {
            $_SESSION['error'] = 'Không tìm thấy ghế để xóa';
            header('Location: ?view=Ghe');
            exit();
        }
    }
}
?>
