<?php
include_once 'models/Model_rap.php';
class RapController {
    private $rapModel;

    public function __construct($dbConnection) {
        $this->rapModel = new RapModel($dbConnection);
    }

    // Hiển thị danh sách rạp
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;

        $raps = $this->rapModel->getAllRaps($page, $limit);
        $totalRaps = $this->rapModel->getTotalRaps();
        $totalPages = ceil($totalRaps / $limit);

        include 'views/quanlyrap/index.php'; // View để hiển thị danh sách rạp
    }

    // Thêm rạp
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = $_POST['ten'];
            $dia_chi = $_POST['dia_chi'];
            $thoi_gian_mo = $_POST['thoi_gian_mo'];
            $thoi_gian_dong = $_POST['thoi_gian_dong'];
            $status = $_POST['status'];
            $dienthoai = $_POST['dienthoai'];
            $this->rapModel->addRap($ten, $dia_chi, $thoi_gian_mo, $thoi_gian_dong, $status, $dienthoai);
            $_SESSION['success'] = "Thêm rạp thành công!";
            header('Location: ?view=Rap');
            exit;
        }

        include 'views/quanlyrap/create.php'; // View để thêm rạp
    }

    // Chỉnh sửa rạp
    public function edit() {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = $_POST['ten'];
            $dia_chi = $_POST['diachi'];
            $thoi_gian_mo = $_POST['thoi_gian_mo'];
            $thoi_gian_dong = $_POST['thoi_gian_dong'];
            $status = $_POST['status'];
            $dienthoai = $_POST['dienthoai'];

            $this->rapModel->updateRap($id, $ten, $dia_chi, $thoi_gian_mo, $thoi_gian_dong, $status, $dienthoai);
            $_SESSION['success'] = "Cập nhật rạp thành công!";
            header('Location: ?view=Rap');
            exit;
        }

        $rap = $this->rapModel->getRapById($id);
        include 'views/quanlyrap/edit.php'; // View để chỉnh sửa rạp
    }

    // Xóa rạp
   // Controller: RapController.php
   public function delete() {
    $id = $_GET['id'];  // Lấy id của rạp từ URL

    // Kiểm tra xem rạp có đang được sử dụng trong phòng chiếu không
    if ($this->rapModel->isRapUsed($id)) {
        // Nếu rạp đang được sử dụng, thông báo lỗi
        $_SESSION['error'] = 'Không thể xóa rạp vì nó đang được sử dụng trong các phòng chiếu!';
        header('Location: ?view=Rap');
        exit;
    }

    // Nếu không có phòng chiếu nào sử dụng, thực hiện xóa rạp
    if ($this->rapModel->deleteRap($id)) {
        $_SESSION['success'] = 'Xóa rạp thành công!';
    } else {
        $_SESSION['error'] = 'Có lỗi xảy ra khi xóa rạp!';
    }

    header('Location: ?view=Rap');
    exit;
}

}

?>