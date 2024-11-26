<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khuyến Mãi</title>
     <link rel="stylesheet" href="index.css"> 
</head>
<style>
.news-section {
    padding: 30px 15px;
    background-color: #111827;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    font-size: 2rem;
    color: yellow;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.news-card {
    background-color: #111827;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.news-card:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.news-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.news-content {
    padding: 15px;
    text-align: center;
}

.news-title {
    font-size: 1.5rem;
    color: #34495e;
    margin-bottom: 10px;
}

.news-description {
    font-size: 1rem;
    color: #7f8c8d;
    margin-bottom: 15px;
    line-height: 1.5;
}

.read-more {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1rem;
    color: #ffffff;
    background-color: #3498db;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.read-more:hover {
    background-color: #2980b9;
}

</style>
<body>
<div id="main">
       
    <section class="news-section">
        <div class="container">
            <h2 class="section-title">KHUYẾN MÃI</h2>
            <div class="news-grid">
                <!-- Tin 1 -->
                <div class="news-card">
                    <img src="/views//gioithieu//1.webp" alt="Poster phim">
                    <div class="news-content">
                        <h3 class="news-title">Ra mắt siêu phẩm hành động tháng 12</h3>
                        <p class="news-description">Bom tấn hành động "Chiến Binh Cuối Cùng" sẽ chính thức khởi chiếu ngày 20/12. Đặt vé ngay để nhận quà tặng độc quyền!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
                <!-- Tin 2 -->
                <div class="news-card">
                    <img src="/views//gioithieu//2.webp" alt="Khuyến mãi phim">
                    <div class="news-content">
                        <h3 class="news-title">Mua 2 vé tặng 1 bắp rang</h3>
                        <p class="news-description">Ưu đãi cực hot! Khi mua 2 vé xem phim, bạn sẽ nhận ngay một phần bắp rang miễn phí. Áp dụng từ 15/11 đến 30/11.</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
                <!-- Tin 3 -->
                <div class="news-card">
                    <img src="/views//gioithieu//3.webp" alt="Phim gia đình">
                    <div class="news-content">
                        <h3 class="news-title">Phim hoạt hình dành cho gia đình</h3>
                        <p class="news-description">Cùng gia đình thưởng thức "Cuộc Phiêu Lưu Kỳ Thú" - bộ phim hoạt hình hài hước và cảm động, khởi chiếu từ 25/11.</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="/views//gioithieu//4.webp" alt="Phim gia đình">
                    <div class="news-content">
                        <h3 class="news-title">Xuất chiếu đặc biệt</h3>
                        <p class="news-description">Với vô vàn phần quà BÍ MẬT - chỉ giới hạn dành tặng cho 100 khán giả duy nhất nhanh tay săn vé mỗi tuần..</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="gioithieu/5.png" alt="Phim gia đình">
                    <div class="news-content">
                        <h3 class="news-title">Ưu đãi học sinh - sinh viên khi xem phim</h3>
                        <p class="news-description">THẺ U22 ƯU ĐÃI GIÁ VÉ CHO HỌC SINH, SINH VIÊN 55.000Đ/VÉ 2D</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="gioithieu/6.png" alt="Phim gia đình">
                    <div class="news-content">
                        <h3 class="news-title">Đồng giá vé</h3>
                        <p class="news-description">SPECIAL MONDAY - ĐỒNG GIÁ 50.000Đ/VÉ 2D THỨ 2 CUỐI THÁNG</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
