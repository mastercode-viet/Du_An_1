<?php
class PhimModel {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getAllMovies($limit = 10, $offset = 0) {
        // Truy vấn lấy danh sách phim với phân trang và kết nối các bảng
        $sql = "SELECT p.id AS phim_id, p.ten, p.ngayramat,p.ngaychieu, p.noidung, p.image, p.thoiluong, 
                       GROUP_CONCAT(t.ten) AS theloai
                FROM phim p
                LEFT JOIN the_loai_phim tlp ON p.id = tlp.id_phim
                LEFT JOIN the_loai t ON tlp.id_theloai = t.id_theloai
                GROUP BY p.id
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $movies;
    }
    // Lấy danh sách phim từ cơ sở dữ liệu
    public function getMoviesByDate($date) {
        if (!$date) {
            $date = date('Y-m-d');
        }
    
        // Cập nhật truy vấn SQL để lấy cả id lịch chiếu và id phòng chiếu
        $sql = "SELECT p.id AS phim_id, p.ten, p.ngaychieu, p.noidung, p.image, 
                    p.thoiluong, l.id AS showtime_id, l.thoigianbatdau, l.thoigianketthuc, 
                    l.id_phongchieu
                FROM phim p
                JOIN lich_chieu_phim l ON p.id = l.id_phim
                WHERE DATE(l.thoigianbatdau) = :date";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    
        $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Nhóm kết quả theo phim
        $groupedMovies = [];
        foreach ($movies as $movie) {
            $movieId = $movie['phim_id'];
            if (!isset($groupedMovies[$movieId])) {
                $groupedMovies[$movieId] = $movie;
                $groupedMovies[$movieId]['showtimes'] = [];
            }
    
            // Kiểm tra nếu thời gian bắt đầu (thoigianbatdau) lớn hơn hoặc bằng ngày hiện tại
            $currentDateTime = date('Y-m-d H:i:s');
            if ($movie['thoigianbatdau'] >= $currentDateTime) {
                // Lấy thời gian bắt đầu và kết thúc, sau đó chuyển thành định dạng 'H:i'
                $start = date('H:i', strtotime($movie['thoigianbatdau']));
                $end = date('H:i', strtotime($movie['thoigianketthuc']));
                $groupedMovies[$movieId]['showtimes'][] = [
                    'start' => $start, 
                    'end' => $end, 
                    'showtime_id' => $movie['showtime_id'],  // Thêm id của lịch chiếu vào mảng showtimes
                    'id_phongchieu' => $movie['id_phongchieu'] // Thêm id_phong_chieu
                ];
            }
        }
    
        // Trả về mảng đã nhóm
        return array_values($groupedMovies);
    }
    

    public function getSeatsByShowtime($id_phongchieu) {
        // Truy vấn SQL để lấy ghế theo phòng chiếu
        $sql = "
        SELECT g.id_ghe AS seat_id, CONCAT(gd.ten, ' ', g.ten) AS seat_name, p.ten AS phong_chieu_name
        FROM ghe g
        LEFT JOIN dayghe gd ON gd.id = g.id_dayghe
        LEFT JOIN dat_ghe dg ON g.id_ghe = dg.id_ghe
        LEFT JOIN vé v ON dg.id_ve = v.id
        LEFT JOIN phongchieu p ON g.id_phongchieu = p.id_phongchieu
        WHERE g.id_phongchieu = :id_phongchieu
    ";

        // Chuẩn bị và thực hiện truy vấn SQL
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_phongchieu', $id_phongchieu, PDO::PARAM_INT); // BIND tham số id_phongchieu
        $stmt->execute();

        // Kiểm tra nếu có kết quả trả về
        if ($stmt->rowCount() > 0) {
            // Lấy kết quả trả về dưới dạng mảng
            $seats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $seats = []; // Không có ghế
        }

        // Trả về kết quả
        return $seats;
    }
    public function getShowtimeDetails($phim_id, $showtime_id) {
        $sql = "
        SELECT p.image as image, p.ten AS movie_title, p.gioithieu AS movie_description, s.thoigianbatdau AS showtime,s.thoigianketthuc AS end_time, p.thoiluong AS movie_duration
        FROM phim p
        JOIN lich_chieu_phim s ON p.id = s.id_phim
        WHERE p.id = :phim_id AND s.id = :showtime_id
        ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':phim_id', $phim_id, PDO::PARAM_INT);
        $stmt->bindParam(':showtime_id', $showtime_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Kiểm tra nếu có kết quả
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result; // Trả về dữ liệu
        } else {
            return null; // Không tìm thấy kết quả
        }
    }
    

    public function createTicket($user_id, $showtime_id) {
        $stmt = $this->pdo->prepare("INSERT INTO ve (id_khachhang, id_lichchieu, status) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $showtime_id, 'pending']);
        return $this->pdo->lastInsertId(); // Trả về ID của vé vừa tạo
    }

    // Lưu ghế đã đặt vào bảng dat_ghe
    public function bookSeats($ticket_id, $seats) {
        $stmt = $this->pdo->prepare("INSERT INTO dat_ghe (id_ghe, id_ve, status) VALUES (?, ?, ?)");
        foreach ($seats as $seat_id) {
            $stmt->execute([$seat_id, $ticket_id, 'booked']);
        }
    }

    // Hàm lấy ID ghế từ tên ghế
    public function getSeatIdByName($seat_name, $phongchieu_id) {
        $stmt = $this->pdo->prepare("SELECT id FROM ghe WHERE seat_name = ? AND id_phongchieu = ?");
        $stmt->execute([$seat_name, $phongchieu_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }
    // Hiển thị giao diện chọn 
  
}
    

?>
