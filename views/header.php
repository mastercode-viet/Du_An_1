<?php
// Kiểm tra và khởi động session nếu chưa khởi động
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="views/index.css"> <!-- Liên kết đến file CSS của bạn -->
    <script>
        var arr_hinh = [
            "/views/banner/2.webp",
            "/views/banner/3.webp",
            "/views/banner/4.webp",
            "/views/banner/5.webp"
        ];
        var index = 0;

        function prev() {
            index--;
            if (index < 0) index = arr_hinh.length - 1;
            document.getElementById("hinh").src = arr_hinh[index];
        }

        function next() {
            index++;
            if (index == arr_hinh.length) index = 0;
            document.getElementById("hinh").src = arr_hinh[index];
        }
        setInterval(next, 2000); // Chuyển hình mỗi 2 giây
    </script>
</head>

<body>
    <div id="main">
        <div id="header">
            <div class="top-header">
                <ul>
                    <li><a href="trangchu.php">Trang chủ</a></li>
                    <li><a href="index.php?act=lichchieu">Lịch chiếu</a></li>
                    <li><a href="index.php?act=tintuc">Tin tức</a></li>
                    <li><a href="index.php?act=khuyenmai">Khuyến mại</a></li>
                    <li><a href="index.php?act=giave">Giá vé</a></li>
                    <li><a href="index.php?act=gioithieu">Giới thiệu</a></li>

                    <?php
                    // Kiểm tra xem người dùng đã đăng nhập hay chưa
                    if (isset($_SESSION['username'])) {
                        // Nếu người dùng đã đăng nhập, hiển thị nút "Đăng xuất"
                        echo '<li>  <a href="index.php?act=userinfor">' . htmlspecialchars($_SESSION['username']) . '!</a></li>';
                        echo '<li>  <a href="index.php?act=logout">Đăng Xuất</a></li>';
                       
                    } else {
                       ?>
                        <li><a href="index.php?act=dangky">Đăng ký </a></li>
                        <li><a href="index.php?act=login">Đăng nhập </a></li>
                    
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <section>
        <!-- slideshow -->
        <div class="items">
            <img src="/views/banner/1.webp" width="100%" id="hinh">
            <i class="fa fa-chevron-circle-left" onclick="prev()"></i>
            <i class="fa fa-chevron-circle-right" onclick="next()"></i>
        </div>
    </section>
</body>

</html>
