<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">

</head>
<script>
    var arr_hinh = [
        // "banner/1.webp",
        "/views//banner//2.webp",
        "/views//banner//3.webp",
        "/views//banner//4.webp",
        "/views//banner//5.webp",
    ]
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
                        <a href="/views/login.php">Đăng nhập</a>
                    </li>
                </ul>
            </div>
          
        </div>
    </div>
    <div class="items">
        <img src="/views//banner//1.webp" width="100%" style="filter: blur(5px);" id="hinh">
        <i class="fa fa-chevron-circle-left" onclick="prev()"></i>
        <i class="fa fa-chevron-circle-right" onclick="next()"></i>
    </div>
    <div class="test">
    <div class="login">
        <span class="icon-close">
            <ion-icon name="close-circle-outline">x</ion-icon>
        </span>
        <form action="index.php?act=login" method ="post">
            <h2>Đăng Nhập</h2>
            <!-- Email -->
            <div class="taikhoan">
                <p>Tên đăng nhập:</p>
                <input type="text" placeholder="Mời bạn nhập tên đăng nhập" id="email"  name ="user"required>
            </div>

            <!-- Password -->
            <div class="taikhoan">
                <p>Password:</p>
                <input type="password" placeholder="Mời bạn nhập mật khẩu" id="password" name ="pass"required>
            </div>

           
            <div class="nhotk">
                <label><input type="checkbox">Nhớ tài khoản</label>
                <a href="#">Quên mật khẩu</a>
            </div>

        
            <input type="submit"name="login" class="btn" value="Đăng Nhập"></input>

            <div class="dangky">
                <p>Bạn chưa có tài khoản? <a href="Register.php">Đăng ký</a></p>
            </div>
        </form>
    </div>
</div>

        </div>
    </div>
    <!-- <footer>
        <p>Cơ quan chủ quản: BỘ VĂN HÓA, THỂ THAO VÀ DU LỊCH Bản quyền thuộc Trung tâm Chiếu phim Quốc gia.
            <br> Giấy phép số: 224/GP- TTĐT ngày 31/8/2010 - Chịu trách nhiệm: Lê Công Minh Thảo giám đốc
            <br> Địa chỉ: 87 Láng Hạ, Quận Ba Đình, Tp. Hà Nội - Điện thoại: 0778340768 Copyright 2023. NCC All Rights Reservered. Dev by Anvui.vn</p>
    </footer> -->