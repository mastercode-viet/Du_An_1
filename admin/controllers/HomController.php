<?php
// controllers/HomeController.php

class HomeController {
    public function home() {
        // Logic cho trang chủ
        // Đây là ví dụ, bạn có thể hiển thị các thông tin như danh sách các bộ phim, lịch chiếu, v.v.
        
        // Bạn có thể yêu cầu Model lấy dữ liệu từ cơ sở dữ liệu nếu cần
        require_once 'views/Khachhang/home.php'; // Hiển thị view cho trang chủ
    }
}
?>
