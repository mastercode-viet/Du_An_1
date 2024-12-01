<?php
// Đảm bảo đây là file đúng chứa các lớp kết nối
require_once __DIR__ . '/../models/MovieModel.php';
class ClientController {
    private $pdo;
    private $phimModel;

    public function __construct($pdo) {
        // Lưu đối tượng PDO vào biến thành viên
        $this->pdo = $pdo;

        // Khởi tạo model phim
        $this->phimModel = new PhimModel($pdo);
    }
    public function getPhimList($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $phimModel = new PhimModel($this->pdo);
        
        // Lấy danh sách phim phân trang
        $phimList = $phimModel->getAllMovies($limit, $offset);
        
        // Lấy tổng số phim để tính tổng số trang
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM phim");
        $totalFilms = $stmt->fetchColumn();
        
        // Tính số trang
        $totalPages = ceil($totalFilms / $limit);
        
        return [
            'phimList' => $phimList, 
            'totalPages' => $totalPages, 
            'currentPage' => $page
        ];
    }

    // Xử lý đăng nhập cho khách hàng
    public function login() {
        // Kiểm tra nếu phương thức là POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Truy vấn kiểm tra tên đăng nhập trong bảng 'khach_hang'
            $sql = "SELECT * FROM khach_hang WHERE username = :username";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Kiểm tra nếu có người dùng với tên đăng nhập này
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // So sánh trực tiếp mật khẩu (không sử dụng password_verify)
            if ($user && $password == $user['password']) {
                // Kiểm tra vai trò của người dùng (role)
                if ($user['role'] == 2) {  // role = 2 cho khách hàng
                    // Lưu thông tin đăng nhập vào session
                    $_SESSION['client_logged_in'] = true;
                    $_SESSION['username'] = $user['username']; // Lưu tên đăng nhập vào session
                    $_SESSION['first_name'] = $user['ho']; // Lưu họ
                    $_SESSION['last_name'] = $user['ten']; $_SESSION['id_khachhang'] = $user['id_khachhang'];
                    // Chuyển hướng đến trang chủ
                    header("Location: /client/view/Home.php");
                    exit;
                } else {
                    $error = "Bạn không có quyền truy cập vào trang này.";
                }
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }

        // Trả về thông báo lỗi nếu có
        return isset($error) ? $error : null; 
    }
    public function showMovies($date = null) {
        // Khởi tạo đối tượng PhimModel
        $phimModel = new PhimModel($this->pdo);
    
        // Nếu không có ngày, sử dụng ngày hiện tại
        if (!$date) {
            $date = date('Y-m-d');
        }
    
        // Lấy danh sách phim từ Model và trả về kết quả
        $movies = $phimModel->getMoviesByDate($date); 
    
        // Debug: Kiểm tra dữ liệu trả về từ Model 
        return $movies;  // Đảm bảo trả về dữ liệu đúng
    }
    public function getSeatsByShowtime($id_phongchieu) {
        // Gọi phương thức trong model để lấy ghế
        return $this->phimModel->getSeatsByShowtime($id_phongchieu);
    }
     // Lấy thông tin chi tiết của phim và lịch chiếu
     public function getShowtimeDetails($phim_id, $showtime_id) {
        return $this->phimModel->getShowtimeDetails($phim_id, $showtime_id);
    }
    public function bookSeats($user_id, $showtime_id, $seats) {
        // Bắt đầu giao dịch
        $this->pdo->beginTransaction();

        try {
            // Tạo vé mới
            $ticket_id = $this->phimModel->createTicket($user_id, $showtime_id);

            // Lưu ghế đã chọn vào bảng dat_ghe
            $seat_ids = [];
            foreach ($seats as $seat_name) {
                $seat_id = $this->phimModel->getSeatIdByName($seat_name, $showtime_id); // Sử dụng showtime_id thay vì id_phongchieu
                if ($seat_id) {
                    $seat_ids[] = $seat_id;
                }
            }

            // Book các ghế đã chọn
            $this->phimModel->bookSeats($ticket_id, $seat_ids);

            // Cam kết giao dịch
            $this->pdo->commit();
            return ['success' => true, 'ticket_id' => $ticket_id];
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->pdo->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    
}
?>
