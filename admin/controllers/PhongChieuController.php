<?php
include_once 'models/Model_PhongChieu.php';
include_once 'models/Model_rap.php';
// controllers/PhongchieuController.php
class PhongchieuController {
    private $phongchieuModel;
    private $rapModel;  // Khai báo biến cho RapModel
    private $itemsPerPage = 10; // Số lượng phòng chiếu mỗi trang

    public function __construct($db) {
        // Khởi tạo model
        $this->phongchieuModel = new PhongChieuModel($db);
        $this->rapModel = new RapModel($db);  // Khởi tạo RapModel
    }

    public function index() {
        // Lấy số trang hiện tại từ URL (mặc định là 1 nếu không có)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $this->itemsPerPage;

        // Lấy danh sách phòng chiếu và các thông tin liên quan từ model
        $phongchieus = $this->phongchieuModel->getPhongChieuWithRap($this->itemsPerPage, $offset);

        // Lấy tổng số phòng chiếu để tính phân trang
        $totalItems = $this->phongchieuModel->getTotalPhongChieu();
        $totalPages = ceil($totalItems / $this->itemsPerPage);

        // Lấy danh sách các rạp để hiển thị trong dropdown khi tạo phòng chiếu
      // Gọi model RapModel để lấy tất cả rạp

        // Truyền dữ liệu vào view
        require_once 'views/quanlyphongchieu/index.php';  // Truyền tất cả các dữ liệu vào view
    }

    // Hiển thị form thêm phòng chiếu
    public function create() {
        $raps = $this->rapModel->getAllRaps();
    
        // Kiểm tra xem có phải là request POST không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_rap = $_POST['id_rap'];
            $ten= $_POST['ten'];
            $danhgia = $_POST['danhgia'];
            $status = $_POST['status'];
    
            // Gọi model để thêm phòng chiếu
            if ($this->phongchieuModel->addPhongChieu($id_rap, $ten,$danhgia, $status)) {
                $_SESSION['success'] = 'Thêm phòng chiếu thành công';
                header('Location: ?view=Phongchieu');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm phòng chiếu';
            }
        }
        require_once 'views/quanlyphongchieu/create.php';
    }

    // Hiển thị form sửa phòng chiếu
    public function edit() {
        $id = $_GET['id'];
        $phongchieu = $this->phongchieuModel->getPhongChieuById($id);

        // Lấy danh sách rạp để hiển thị trong dropdown
        $raps = $this->rapModel->getAllRaps();
    
        // Kiểm tra xem có phòng chiếu không
        if (!$phongchieu) {
            $_SESSION['error'] = "Không tìm thấy phòng chiếu.";
            header("Location: ?view=Phongchieu");
            exit;
        }

        require_once 'views/quanlyphongchieu/edit.php';
    }

  // Phương thức update trong controller
  public function update() {
    // Kiểm tra xem id có được truyền qua URL không
    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Lấy id từ URL
    } else {
        // Nếu không có id, chuyển hướng đến danh sách phòng chiếu hoặc thông báo lỗi
        $_SESSION['error'] = 'Không tìm thấy phòng chiếu';
        header('Location: ?view=Phongchieu');
        exit;
    }

    // Kiểm tra nếu phương thức là POST (khi form được submit)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ form
        $id_rap = $_POST['id_rap'];
        $ten= $_POST['ten'];
        $danhgia = $_POST['danhgia'];
        $status = $_POST['status'];

        // Cập nhật phòng chiếu trong database
        if ($this->phongchieuModel->updatePhongChieu($id, $id_rap,$ten, $danhgia, $status)) {
            $_SESSION['success'] = 'Cập nhật phòng chiếu thành công';
            header('Location: ?view=Phongchieu'); // Quay lại danh sách phòng chiếu
            exit;
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật phòng chiếu';
        }
    }

    // Nếu không phải POST, gọi phương thức edit để hiển thị form sửa
    // Truyền id vào edit để lấy thông tin phòng chiếu cần sửa
    $phongchieu = $this->phongchieuModel->getPhongChieuById($id);
    $raps = $this->rapModel->getAllRaps(); // Lấy danh sách rạp
    require_once 'views/quanlyphongchieu/edit.php'; // Hiển thị form sửa
}



public function delete() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Kiểm tra xem phòng chiếu có đang được sử dụng không
        if ($this->phongchieuModel->isPhongChieuUsed($id)) {
            $_SESSION['error'] = 'Phòng chiếu này đang được sử dụng và không thể xóa';
            header('Location: ?view=Phongchieu');
            exit;
        }

        // Thực hiện xóa phòng chiếu
        if ($this->phongchieuModel->deletePhongChieu($id)) {
            $_SESSION['success'] = 'Xóa phòng chiếu thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa phòng chiếu';
        }

        header('Location: ?view=Phongchieu');
        exit;
    } else {
        $_SESSION['error'] = 'Không tìm thấy phòng chiếu để xóa';
        header('Location: ?view=Phongchieu');
        exit;
    }
}
}
?>
