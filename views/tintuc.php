<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
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
       
    <section>
    <div class="container">
            <h2 class="section-title">Tin Tức Phim Ảnh</h2>
            <div class="news-grid">
                <!-- Bài viết 1 -->
                <div class="news-card">
                    <img src="/views//gioithieu//5.webp" alt="Tin tức phim 1">
                    <div class="news-content">
                        <h3 class="news-title">Top phim bom tấn tháng 12</h3>
                        <p class="news-description">Cùng điểm qua những bộ phim bom tấn đang khuấy đảo rạp chiếu tháng này. Đặt vé ngay để không bỏ lỡ!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
                <!-- Bài viết 2 -->
                <div class="news-card">
                    <img src="/views//gioithieu//6.webp" alt="Khuyến mãi vé xem phim">
                    <div class="news-content">
                        <h3 class="news-title">Khuyến mãi 50% khi đặt vé online</h3>
                        <p class="news-description">Nhanh tay đặt vé trực tuyến hôm nay để nhận ưu đãi giảm giá cực sốc, chỉ có tại CinemaX!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
                <!-- Bài viết 3 -->
                <div class="news-card">
                    <img src="/views//gioithieu//7.webp" alt="Sự kiện đặc biệt">
                    <div class="news-content">
                        <h3 class="news-title">Buổi giao lưu đặc biệt cùng đạo diễn nổi tiếng</h3>
                        <p class="news-description">Tham gia sự kiện giao lưu trực tiếp với đạo diễn của siêu phẩm điện ảnh "Hành Tinh Xanh". Đừng bỏ lỡ cơ hội này!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
                

                <div class="news-card">
                    <img src="/views//gioithieu//8.webp" alt="Sự kiện đặc biệt">
                    <div class="news-content">
                        <h3 class="news-title">Buổi giao lưu đặc biệt cùng đạo diễn nổi tiếng</h3>
                        <p class="news-description">Tham gia sự kiện giao lưu trực tiếp với đạo diễn của siêu phẩm điện ảnh "Hành Tinh Xanh". Đừng bỏ lỡ cơ hội này!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="/views//gioithieu//9.webp" alt="Sự kiện đặc biệt">
                    <div class="news-content">
                        <h3 class="news-title">Buổi giao lưu đặc biệt cùng đạo diễn nổi tiếng</h3>
                        <p class="news-description">Tham gia sự kiện giao lưu trực tiếp với đạo diễn của siêu phẩm điện ảnh "Hành Tinh Xanh". Đừng bỏ lỡ cơ hội này!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>

                <div class="news-card">
                    <img src="/views//gioithieu//10.webp" alt="Sự kiện đặc biệt">
                    <div class="news-content">
                        <h3 class="news-title">Buổi giao lưu đặc biệt cùng đạo diễn nổi tiếng</h3>
                        <p class="news-description">Tham gia sự kiện giao lưu trực tiếp với đạo diễn của siêu phẩm điện ảnh "Hành Tinh Xanh". Đừng bỏ lỡ cơ hội này!</p>
                        <a href="#" class="read-more">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
   
