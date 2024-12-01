<?php
session_start();

// Kiểm tra nếu khách hàng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['client_logged_in']) || $_SESSION['client_logged_in'] !== true) {
    header("Location: /client/login.php");
    exit();
}

require_once '../controllers/ClientController.php'; 

// Lấy thông tin họ và tên người dùng từ session
$first_name = $_SESSION['first_name']; // Giả sử bạn lưu họ trong session
$last_name = $_SESSION['last_name'];   // Giả sử bạn lưu tên trong session

// Ghép họ và tên
$full_name = $first_name . ' ' . $last_name;

// Khởi tạo Controller
$pdo = new PDO("mysql:host=localhost;dbname=da1", "root", "");
$clientController = new ClientController($pdo);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$result = $clientController->getPhimList($page);
$phimList = $result['phimList'];
$totalPages = $result['totalPages'];
$currentPage = $result['currentPage'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/client/view/index.css">

</head>
<style>#header ul li span {
    font-weight: bold;
    color: white; /* Màu xanh lá */
    margin-left: 20px;
}</style>
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
                    <a href="/client/view/Home.php">Home</a>
                    </li>
                    <li>
                    <a href="/client/view/lichchieu.php">Lịch Chiếu</a>
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
                    <a href="Home.php">Đăng xuất</a>
                    </li>
                    <li><span>Chào, <?php echo htmlspecialchars($full_name); ?></span></li>
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
                <h2>Danh sách phim</h2>
                <div id="products">
                <div class="content">
        <?php foreach ($phimList as $phim): ?>
            <div class="items1">
    <img src="<?php echo htmlspecialchars($phim['image']); ?>" width="100px" height="180px">
    <a href="#">
        <h3><?php echo htmlspecialchars($phim['ten']); ?></h3>
    </a>
    <p><?php echo htmlspecialchars($phim['theloai']); ?> - <?php echo htmlspecialchars($phim['ngayramat']); ?></p>
    <br> <!-- Cách dòng sau thông tin của phim -->
    <p><strong>Thời lượng:</strong> <?php echo htmlspecialchars($phim['thoiluong']); ?> phút</p>
    <br> <!-- Cách dòng -->
    <p><strong>Ngày chiếu:</strong> <?php echo htmlspecialchars($phim['ngaychieu']); ?></p>
</div>

        <?php endforeach; ?>
    </div>
</div>

                <!-- Phân trang -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Prev</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <hr>
        <h2>Phim sắp chiếu</h2>
        <div class="content">
            <!-- Bạn có thể tạo thêm một phần phim sắp chiếu tương tự như trên -->
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