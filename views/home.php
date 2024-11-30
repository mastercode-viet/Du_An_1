<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">

</head>
<script>
    var arr_hinh = [
        // "banner/1.webp",
        "/views//banner//2.webp",
        "/views//banner//3.webp",
        "/views//banner//4.webp",
        "/views//banner//5.webp",
    ];
    var index = 0;

    function prev() {
        index--;
        if (index < -0) index = arr_hinh.length - 1;
        document.getElementById("hinh").src = arr_hinh[index];
    }

    function next() {
        index++;
        if (index == arr_hinh.length) index = 0;

        document.getElementById("hinh").src = arr_hinh[index];
    }
    setInterval("next()", 2000);
</script>

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
                        <a href="Signup.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="login.php">Đăng nhập</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <section>
        <!-- slideshow -->
        <div class="items">
            <img src="/views//banner//1.webp" width="100%" id="hinh">
            <i class="fa fa-chevron-circle-left" onclick="prev()"></i>
            <i class="fa fa-chevron-circle-right" onclick="next()"></i>
            <h2>Phim đang chiếu</h2>
        </div>
        <!-- ảnh hàng dọc -->
        </div>
        <div id="products">
            <div class="content">
                <div class="items">
                    <img src="/views//image//ảnh 1.webp" alt="">
                    <a href="#">
                        <h3>NGÀY XƯA CÓ MỘT CHUYỆN TÌNH - T16</h3>
                    </a>
                    <p>Tâm lí, tình cảm 01/11/2024</p>
                </div>

                <div class="items">
                    <img src="/views//image//ảnh 2.webp" alt="">
                    <a href="#">
                        <h3>VENOM: THE LAST DANCE -T13</h3>
                    </a>
                    <p>Khoa học, viễn tưởng 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 3.webp" alt="">
                <a href="#">
                        <h3> TRÒ CHƠI NHÂN TÍNH-T16</h3>
                    </a>
                    <p>Kinh dị 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 4.webp" alt="">
                <a href="#">
                        <h3> ÁC QUỶ TRUY HỒN-T18</h3>
                    </a>
                    <p>Kinh dị 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 5.webp" alt="">
                <a href="#">
                        <h3> BIỆT ĐỘI HOT GIRL-T16</h3>
                    </a>
                    <p>Hoạt hình 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 6.webp" alt="">
                <a href="#">
                        <h3>ELLI VÀ BÍ ẨN CHIẾC TÀU MA-K</h3>
                    </a>
                    <p>Hoạt hình 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 7.webp" alt="">
                <a href="#">
                        <h3>ELLI VÀ BÍ ẨN CHIẾC TÀU MA-K</h3>
                    </a>
                    <p>Hoạt hình 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 8.webp" alt="">
                <a href="#">
                        <h3>BÓNG ĐÁ NỮ VIỆT NAM</h3>
                    </a>
                    <p>18/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 9.webp" alt="">
                <a href="#">
                        <h3>BOCCHI THE ROCK! Recap Part 2-K</h3>
                    </a>
                    <p>18/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 10.webp" alt="">
                <a href="#">
                        <h3> CÔ DÂU HÀO MÔN- T18</h3>
                    </a>
                    <p>Tâm lý, tình cảm 18/10/2024 </p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 11.webp" alt="">
                <a href="#">
                        <h3>TÍN HIỆU CẦU CỨU-T18</h3>
                    </a>
                    <p>18/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 12.webp" alt="">
                <a href="#">
                        <h3> TEE YOD: QUỶ ĂN TẠNG PHẦN 2-T18</h3>
                    </a>
                    <p>kinh dị 18/10/2024</p>
                </div>
            </div>
            <hr>
            <!-- đoạn về phim sắp chiếu -->
            <!--  -->
            <h2>Phim sắp chiếu</h2>
            <div class="content">
                <div class="items">
                <img src="/views//image//ảnh 1.webp" alt="">
                <a href="#">
                        <h3>VENOM: THE LAST DANCE -T13</h3>
                    </a>
                    <p>Khoa học, viễn tưởng
                        <br>25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 2.webp" alt="">
                <a href="#">
                        <h3> TRÒ CHƠI NHÂN TÍNH-T16</h3>
                    </a>
                    <p>Kinh dị 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 3.webp" alt="">
                <a href="#">
                        <h3> ÁC QUỶ TRUY HỒN-T18</h3>
                    </a>
                    <p>Kinh dị 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 4.webp" alt="">
                <a href="#">
                        <h3> TEE YOD: QUỶ ĂN TẠNG PHẦN 2-T18</h3>
                    </a>
                    <p>Kinh dị 18/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 5.webp" alt="">
                <a href="#">
                        <h3>ELLI VÀ BÍ ẨN CHIẾC TÀU MA-K
                            <br> Lồng tiếng</h3>
                    </a>
                    <p>Hoạt hình 25/10/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 6.webp" alt="">
                <a href="#">
                        <h3>LÀM GIÀU VỚI MA-T16</h3>
                    </a>
                    <p>Hài, Tâm lý, tình cảm
                        <br>02/09/2024
                    </p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 7.webp" alt="">
                <a href="#">
                        <h3> CÁM-T18</h3>
                    </a>
                    <p>Kinh dị 20/09/2024</p>
                </div>

                <div class="items">
                <img src="/views//image//ảnh 8.webp" alt="">
                <a href="#">
                        <h3>JOKER: FOLIE À DEUX
                            <br>ĐIÊN CÓ ĐÔI-T18</h3>
                    </a>
                    <p>Kinh dị, Tâm lý, tình cảm, Nhạc kịch
                        <br>04/10/2024
                    </p>
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