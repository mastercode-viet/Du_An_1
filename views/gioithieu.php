<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="index.css">
</head>
<style>
    /* Reset cơ bản */


/* Phần giới thiệu */
.about-section {
    padding: 60px 20px;
    background-color: #1c1c1c;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: center;
}

.about-content {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 30px;
    align-items: center;
}

.about-text {
    flex: 1;
    min-width: 300px;
}

.section-title {
    font-size: 32px;
    color: #f4c10f;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.about-description {
    font-size: 16px;
    color: #bfbfbf;
    margin-bottom: 20px;
}

.about-list {
    list-style: none;
    margin-bottom: 20px;
}

.about-list li {
    position: relative;
    margin-bottom: 10px;
    padding-left: 20px;
    color: #ffffff;
}

.about-list li::before {
    content: "✔";
    color: #f4c10f;
    position: absolute;
    left: 0;
    font-size: 14px;
}

.learn-more-btn {
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    color: #1c1c1c;
    background-color: #f4c10f;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.learn-more-btn:hover {
    background-color: #e0ac0b;
}

.about-image {
    flex: 1;
    min-width: 300px;
}

.about-image img {
    width: 45%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* margin-right: 50px; */
}

</style>
<body>
<div id="main">
        <div id="header">
            <div class="top-header">
                <ul>
                    <li>
                        <a href="trangchu.php">Trang chủ</a>
                    </li>
                    <li>
                        <a href="lichchieu.php">Lịch chiếu</a>
                    </li>
                    <li>
                        <a href="tintuc.php">Tin tức</a>
                    </li>
                    <li>
                        <a href="khuyenmai.php">Khuyến mại</a>
                    </li>
                    <li>
                        <a href="giave.php">Giá vé</a>
                    </li>
                    <li>
                        <a href="gioithieu.php">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="Register.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="login.php">Đăng nhập</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
<section>
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">Về Chúng Tôi</h2>
                    <p class="about-description">
                        Chào mừng bạn đến với <strong>Akame gakill</strong> - nền tảng đặt vé xem phim trực tuyến hàng đầu tại Việt Nam! 
                        Chúng tôi mang đến trải nghiệm đặt vé nhanh chóng, tiện lợi cùng những thông tin đầy đủ về các bộ phim mới nhất. 
                    </p>
                    <p class="about-description">
                        Với sứ mệnh kết nối mọi người thông qua điện ảnh, Akame gakill không chỉ cung cấp vé xem phim mà còn đem lại các chương trình ưu đãi hấp dẫn,
                        dịch vụ khách hàng tận tâm và những giờ phút giải trí đáng nhớ tại rạp.
                    </p>
                    <ul class="about-list">
                        <li>Đặt vé chỉ với vài cú click chuột.</li>
                        <li>Cập nhật thông tin phim mới và khuyến mãi hàng ngày.</li>
                        <li>Thanh toán an toàn và bảo mật.</li>
                        <li>Hỗ trợ khách hàng 24/7.</li>
                    </ul>
                </div>
                <div class="about-image">
                    <img src="/views//gioithieu//lecongminhthao.jpg"  alt="Rạp chiếu phim" />
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p>Cơ quan chủ quản: BỘ VĂN HÓA, THỂ THAO VÀ DU LỊCH Bản quyền thuộc Trung tâm Chiếu phim Quốc gia.
            <br> Giấy phép số: 224/GP- TTĐT ngày 31/8/2010 - Chịu trách nhiệm: Lê Công Minh Thảo giám đốc
            <br> Địa chỉ: 87 Láng Hạ, Quận Ba Đình, Tp. Hà Nội - Điện thoại: 0778340768 Copyright 2023. NCC All Rights Reservered. Dev by Anvui.vn</p>
    </footer>
</body>
</html>
