<?php
// Bao gồm file model
require_once('models/Model_phim.php');

class PhimController {
    private $conn;
    private $phimModel;

    public function __construct($conn) {
        $this->conn = $conn;
        // Khởi tạo model
        $this->phimModel = new PhimModel($conn);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $filmsPerPage = 3; // Số phim hiển thị trên mỗi trang
        $offset = ($page - 1) * $filmsPerPage;

        // Lấy dữ liệu phim từ model
        $films = $this->phimModel->getAllPhim($filmsPerPage, $offset);

        // Tính tổng số phim và tổng số trang
        $totalFilms = $this->phimModel->getTotalPhim();
        $totalPages = ceil($totalFilms / $filmsPerPage);
        // Bao gồm view tương ứng
        include($_SERVER['DOCUMENT_ROOT'] . '/admin/views/quanlyphim/index.php'); // Hoặc đường dẫn đúng
    }
    

    public function create() {
        // Lấy tất cả thể loại
        $theloaiList = $this->phimModel->getAllTheLoai();

        // Kiểm tra nếu form được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form
            $tenPhim = $_POST['ten'];
            $ngayRaMat = $_POST['ngayramat'];
            $ngayChieu = $_POST['ngaychieu'];
            $thoiLuong = $_POST['thoiluong'];
            $noiDung = $_POST['noidung'];
            $gioiThieu = $_POST['gioithieu'];
            $daoDien = $_POST['daodien'];
            $status = $_POST['status'];
            $theLoaiIds = $_POST['theloai']; // Mảng các ID thể loại đã chọn

            $imagePath = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Thư mục lưu trữ ảnh
                $uploadDir = '/admin/images/';
                $tmpName = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $targetFilePath = $uploadDir . $fileName;

                $rootPath = $_SERVER['DOCUMENT_ROOT'];
                $target_path = $rootPath . $uploadDir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($tmpName, $target_path)) {
                    $imagePath = $targetFilePath; // Đường dẫn ảnh
                } else {
                    echo "Lỗi: Không thể tải ảnh lên.";
                    exit;
                }
            }

            // Thêm phim vào cơ sở dữ liệu
            $phimId = $this->phimModel->addPhim($tenPhim, $ngayRaMat, $ngayChieu, $thoiLuong, $noiDung, $gioiThieu, $daoDien, $status, $imagePath);
            
            // Thêm thể loại cho phim
            $this->phimModel->addTheLoaiPhim($phimId, $theLoaiIds);

            // Chuyển hướng về trang danh sách phim với thông báo thành công
            header("Location: /admin/index.php?view=Phim&status=success");
            exit;
        }

        // Bao gồm view để hiển thị form thêm phim
         // Bao gồm view tương ứng
         include($_SERVER['DOCUMENT_ROOT'] . '/admin/views/quanlyphim/create.php');
    }
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Xóa phim từ model
            $result = $this->phimModel->deletePhim($id);

            if ($result) {
                header("Location: index.php?view=Phim");  // Điều hướng về trang danh sách phim sau khi xóa thành công
            } else {
                echo "Lỗi khi xóa phim.";
            }
        } else {
            echo "Không có ID phim để xóa.";
        }
    }
    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  //
        $phim = $this->phimModel->getPhimById($id);
        if (!$phim) {
            $_SESSION['error'] = "Phim không tồn tại!";
            header("Location: index.php?view=quanlyphim");
            exit();
        }

        // Lấy tất cả thể loại và thể loại của phim
        $theloaiList = $this->phimModel->getAllTheLoai();
        $currentTheLoaiIds = $this->phimModel->getTheLoaiByPhimId($id);

        // Truyền dữ liệu vào view
      
        include($_SERVER['DOCUMENT_ROOT'] . '/admin/views/quanlyphim/edit.php');
    }
}

    

    // Phương thức cập nhật phim
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $ten = $_POST['ten'];
            $ngayramat = $_POST['ngayramat'];
            $ngaychieu = $_POST['ngaychieu'];
            $thoiluong = $_POST['thoiluong'];
            $noidung = $_POST['noidung'];
            $gioithieu = $_POST['gioithieu'];
            $daodien = $_POST['daodien'];
            $status = $_POST['status'];
            $theloaiIds = $_POST['theloai'];

            // Cập nhật thông tin phim
            $this->phimModel->updatePhim($id, $ten, $ngayramat, $ngaychieu, $thoiluong, $noidung, $gioithieu, $daodien, $status);

            // Cập nhật thể loại cho phim
            $this->phimModel->updateTheLoaiForPhim($id, $theloaiIds);

            $_SESSION['success'] = 'Cập nhật phim thành công!';
            header('Location: ' . SITE_URL . '/admin/index.php?view=Phim');
            exit;
        }

        // Lấy thông tin phim và thể loại
        $id = $_GET['id'];
        $phim = $this->phimModel->getPhimById($id);
        $theloaiList = $this->phimModel->getAllTheLoai();
        $currentTheLoaiIds = $this->phimModel->getTheLoaiByPhim($id);

        // Gửi dữ liệu sang View để hiển thị
     
        include($_SERVER['DOCUMENT_ROOT'] . '/admin/views/quanlyphim/edit.php');
    }

}
?>
