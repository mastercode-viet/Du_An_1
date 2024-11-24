<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<style>
    /* Đảm bảo container chính chiếm toàn bộ chiều cao màn hình và căn giữa nội dung */
</style>
<body>
<script>
    var arr_hinh = [
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
            <div class="top-header" style="filter: blur(5px);">
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
            <!-- <div class="items">
                <form action="">
                    <button>đăng ký</button>
                    <button>đăng nhập</button>
                </form>
            </div> -->
        </div>
    </div>
    <!--  "/views//banner//2.webp",
        "/views//banner//3.webp",
        "/views//banner//4.webp",
        "/views//banner//5.webp", -->
    <div class="items">
        <img src="/views//banner//1.webp" width="100%" style="filter: blur(5px);" id="hinh">
        <i class="fa fa-chevron-circle-left" onclick="prev()"></i>
        <i class="fa fa-chevron-circle-right" onclick="next()"></i>
    </div>
<div class="test">
    <div class="register">
        <span class="icon-close">
            <ion-icon name="close-circle-outline">x</ion-icon>
        </span>
        <form action="signup_handler.php" method="POST">
            <h2>Đăng Ký</h2>
            <div class="taikhoan">
                <p>Họ và Tên :</p>
                <input type="text" placeholder="Mời bạn nhập họ và tên" id="fullname" name="fullname" required>
            </div>
            <br>
            <div class="taikhoan">
                <p>Email của bạn :</p>
                <input type="email" placeholder="Mời bạn nhập email" id="email" name="email" required>
            </div>
            <br>
            <div class="taikhoan">
                <p>Mật khẩu của bạn:</p>
                <input type="password" placeholder="Mời bạn nhập mật khẩu" id="password" name="password" required>
            </div>
            <br>
            <div class="taikhoan">
                <p>Nhập lại mật khẩu:</p>
                <input type="password" placeholder="Xác nhận lại mật khẩu" id="confirm_password" name="confirm_password" required>
            </div>
            <br>
            <div class="nhotk">
                <label><input type="checkbox" name="agree_terms" required>Tôi đồng ý với <a href="#">điều khoản và chính sách</a></label>
            </div>
            <button type="submit" class="btn">Đăng Ký</button>
            <div class="dangnhap">
                <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>