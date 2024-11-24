<?php
include_once 'models/Model_theloai.php';

class TheLoaiController {
    private $theLoaiModel;

    public function __construct($dbConnection) {
        $this->theLoaiModel = new TheLoaiModel($dbConnection);
    }

    // Hiển thị danh sách thể loại
    public function index() {
        $itemsPerPage = 3;  // Số lượng thể loại hiển thị trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Lấy trang hiện tại từ URL, mặc định là 1

        // Lấy danh sách thể loại cho trang hiện tại
        $theloai = $this->theLoaiModel->getTheLoaiByPage($page, $itemsPerPage);

        // Lấy tổng số thể loại để tính số trang
        $totalTheLoai = $this->theLoaiModel->getTotalTheLoaiCount();
        $totalPages = ceil($totalTheLoai / $itemsPerPage);  // Tính số trang

        include_once 'views/quanlitheloai/index.php';
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten'];
            $status = $_POST['status'];

            // Thêm thể loại vào cơ sở dữ liệu
            if ($this->theLoaiModel->createTheLoai($ten, $status)) {
                $_SESSION['success'] = 'Thêm thể loại thành công!';
                header('Location: ?view=TheLoai');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi thêm thể loại!';
            }
        }

        include_once 'views/quanlitheloai/create.php';
    }

    // Chỉnh sửa thể loại
    public function edit() {
        $id = $_GET['id'];
        $theloai = $this->theLoaiModel->getTheLoaiById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = $_POST['ten'];
            $status = $_POST['status'];

            // Cập nhật thông tin thể loại
            if ($this->theLoaiModel->updateTheLoai($id, $ten, $status)) {
                $_SESSION['success'] = 'Cập nhật thể loại thành công!';
                header('Location: ?view=TheLoai');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật thể loại!';
            }
        }

        include_once 'views/quanlitheloai/edit.php';
    }

    public function delete() {
        $id = $_GET['id'];  // Lấy id thể loại từ URL

        // Kiểm tra xem thể loại có đang được sử dụng hay không
        if ($this->theLoaiModel->isTheLoaiUsed($id)) {
            $_SESSION['error'] = 'Không thể xóa thể loại vì nó đang được sử dụng trong các phim!';
            header('Location: ?view=TheLoai');
            exit;
        }

        // Nếu không sử dụng, thực hiện xóa
        if ($this->theLoaiModel->deleteTheLoai($id)) {
            $_SESSION['success'] = 'Xóa thể loại thành công!';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra khi xóa thể loại!';
        }

        header('Location: ?view=TheLoai');
        exit;
    }


    // Xử lý thêm, sửa, xóa thể loại (nếu có)
}
?>
