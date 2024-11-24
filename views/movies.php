<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="index.css">
</head>


<body>
    <script>
        // Lấy tất cả các phần tử button với class là 'myButton'
        const buttons = document.querySelectorAll('.myButton');

        // Lặp qua tất cả các button và thêm sự kiện click
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Toggle class btn-selected khi nhấn vào button
                button.classList.toggle('btn-selected');
            });
        });
    </script>
    <style>
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Căn giữa theo chiều ngang */
            justify-content: center;
            /* Căn giữa theo chiều dọc */
            /* border: 2px solid #ccc; */
            /* Viền cho container */
            padding: 20px;
            /* Khoảng cách bên trong container */
            border-radius: 10px;
            /* Bo góc cho viền */
            background-color: #111827;
            /* Màu nền nhạt */
            max-width: 800px;
            /* Độ rộng tối đa */
            margin: 0 auto;
            /* Căn giữa container trong trang */
        }
        /* Màn hình (mô tả phòng chiếu) */
        
        .screen {
            text-align: center;
            margin-bottom: 20px;
            background-color: #ddd;
            padding: 10px;
            width: 100%;
            font-weight: bold;
            font-size: 18px;
            border-radius: 5px;
        }
        /* Ghế ngồi */
        
        .seats {
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Khoảng cách giữa các hàng */
        }
        
        .row {
            display: flex;
            justify-content: center;
            /* Căn giữa các ghế trong hàng */
            gap: 5px;
            /* Khoảng cách giữa các ghế */
        }
        
        .seat {
            width: 40px;
            height: 40px;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
        }
        
        .seat:hover {
            background-color: #5a6268;
        }
        
        .seat.selected {
            background-color: #28a745;
        }
        
        .seat.booked {
            background-color: #dc3545;
            cursor: not-allowed;
        }
        
        section {
            background-color: #111827;
        }
        
        .movies-schedule {
            /* display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem; */
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Chia thành 3 cột */
            gap: 20px;
            /* Khoảng cách giữa các phần tử */
            margin: 20px;
        }
        
        .movies {
            display: flex;
            gap: 20px;
            align-items: center;
            background-color: #1F2125;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* border: 1px solid #fff; */
            height: 253px;
            align-items: center;
        }
        
        .movies img {
            width: 250px;
            height: 278px;
            /* Chiều rộng tối đa của ảnh */
            border-radius: 8px;
            margin: 1px 19px 0px -14px;
        }
        
        .btn-selected {
            background-color: #4caf50;
            /* Màu xanh lá khi chọn */
            color: white;
        }
        
        .booked {
            background-color: gray;
            /* Màu xám cho ghế đã đặt */
            cursor: not-allowed;
        }
    </style>
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
        <div class="movies"><img src="/views//image//ảnh 1.webp">
            <div class="infos">
                <h2>NGÀY XƯA CÓ 1 CHUYỆN TÌNH </h2>
                <p>Tâm lý, tình cảm
                    <br>Viet Nam 135 phút
                    <br> Đạo diễn: Lê Công Minh Thảo
                    <br>Khởi chiếu: 28/10/2024</p>
                <p>Ngày Xưa Có Một Chuyện Tình xoay quanh câu chuyện tình bạn
                    <br> tình yêu giữa hai chàng trai và một cô gái từ thuở ấu thơ cho đến khi trưởng thành
                    <br> phải đối mặt với những thử thách của số phận. <br>Trải dài trong 4 giai đoạn từ năm 1987 - 2000
                    <br> ba người bạn cùng tuổi - Vinh, Miền, Phúc đã cùng yêu, cùng bỡ ngỡ bước vào đời, va vấp và vượt qua.</p>
            </div>
        </div>

        <div class="step">
            <div class="screen">Phòng chiếu số 18</div>
            <div class="seats">
                <div class="row">
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat booked">D6</button>
                    <button class="seat">D7</button>
                </div>
                <div class="row">
                    <button class="seat">K1</button>
                    <button class="seat">K2</button>
                    <button class="seat booked">K3</button>
                    <button class="seat">K4</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat booked">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
                </div>
                <div class="row">
                    <button class="seat">T1</button>
                    <button class="seat">T2</button>
                    <button class="seat">T3</button>
                    <button class="seat">T4</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat booked">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat">D6</button>
                    <button class="seat">D7</button>
                    <button class="seat">D4</button>
                    <button class="seat">D5</button>
                    <button class="seat ">D6</button>
                    <button class="seat">D7</button>
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
``