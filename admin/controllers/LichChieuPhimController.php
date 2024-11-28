<?php
// controllers/LichChieuPhimController.php
require_once('models/Model_LichChieuPhim.php');
require_once('models/Model_Phim.php'); // Đảm bảo đã có model Phim
require_once('models/Model_PhongChieu.php'); // Đảm bảo đã có model PhongChieu

class LichChieuPhimController {
    private $lichChieuPhimModel;
    private $phimModel;
    private $phongChieuModel;

    public function __construct($db) {
        // Khởi tạo các model và truyền kết nối cơ sở dữ liệu vào model
        $this->lichChieuPhimModel = new LichChieuPhim($db);
        $this->phimModel = new PhimModel($db);
        $this->phongChieuModel = new PhongchieuModel($db);
    }

    // Hiển thị danh sách lịch chiếu phim
    public function index() {
        $lichChieuPhimList = $this->lichChieuPhimModel->read();  // Lấy tất cả lịch chiếu phim
        include('views/quanlylichchieuphim/index.php'); // Truyền dữ liệu đến view
    }

    // Tạo lịch chiếu phim mới
    public function create() {
        $phimList = $this->phimModel->read(); // Lấy danh sách phim
        $phongChieuList = $this->phongChieuModel->read(); // Lấy danh sách phòng chiếu

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form và gán vào model
            $this->lichChieuPhimModel->id_phim = $_POST['id_phim'];
            $this->lichChieuPhimModel->id_phongchieu = $_POST['id_phongchieu'];
            $this->lichChieuPhimModel->status = $_POST['status'];
            $this->lichChieuPhimModel->thoigianbatdau = $_POST['thoigianbatdau'];
            $this->lichChieuPhimModel->thoigianketthuc = $_POST['thoigianketthuc'];

            if ($this->lichChieuPhimModel->create()) {
                $_SESSION['success'] = 'Thêm lịch chiếu phim thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi khi thêm lịch chiếu phim!';
            }

            header("Location: ?view=LichChieuPhim");
            exit();
        }

        include('views/quanlylichchieuphim/create.php'); // Hiển thị form tạo lịch chiếu
    }

    // Sửa lịch chiếu phim
    public function edit() {
        if (isset($_GET['id'])) {
            $id_lichchieu = $_GET['id'];
        $lichChieu = $this->lichChieuPhimModel->readById($id_lichchieu); // Lấy thông tin lịch chiếu theo ID
        $phimList = $this->phimModel->read(); // Lấy danh sách phim
        $phongChieuList = $this->phongChieuModel->read(); // Lấy danh sách phòng chiếu

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Cập nhật thông tin lịch chiếu
            $this->lichChieuPhimModel->id_phim = $_POST['id_phim'];
            $this->lichChieuPhimModel->id_phongchieu = $_POST['id_phongchieu'];
            $this->lichChieuPhimModel->status = $_POST['status'];
            $this->lichChieuPhimModel->thoigianbatdau = $_POST['thoigianbatdau'];
            $this->lichChieuPhimModel->thoigianketthuc = $_POST['thoigianketthuc'];
            $this->lichChieuPhimModel->id_lichchieu = $id_lichchieu; // Thêm ID để xác định bản ghi cần sửa

            if ($this->lichChieuPhimModel->update()) {
                $_SESSION['success'] = 'Cập nhật lịch chiếu phim thành công!';
            } else {
                $_SESSION['error'] = 'Có lỗi khi cập nhật lịch chiếu phim!';
            }

            header("Location: ?view=LichChieuPhim");
            exit();
        }

        include('views/quanlylichchieuphim/edit.php'); // Hiển thị form sửa lịch chiếu
    }
}

    // Xóa lịch chiếu phim
    public function delete() {
        if (isset($_GET['id'])) {
            $id_lichchieu = $_GET['id'];
        if ($this->lichChieuPhimModel->delete($id_lichchieu)) {
            $_SESSION['success'] = 'Xóa lịch chiếu phim thành công!';
        } else {
            $_SESSION['error'] = 'Có lỗi khi xóa lịch chiếu phim!';
        }

        header("Location: ?view=LichChieuPhim");
        exit();
    }
}
}
?>
