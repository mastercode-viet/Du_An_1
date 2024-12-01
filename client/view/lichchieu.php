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
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Lấy danh sách phim từ Controller
$movies = $clientController->showMovies($date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Chiếu Phim</title>
    <link rel="stylesheet" href="/client/view/index.css">
</head>

<body>
    <div id="main">
        <div id="header">
            <div class="top-header">
                <ul>
                    <li><a href="/client/view/Home.php">Home</a></li>
                    <li><a href="/client/view/lichchieu.php">Lịch Chiếu</a></li>
                    <li><a href="tintuc.php">Tin tức</a></li>
                    <li><a href="khuyenmai.php">Khuyến mại</a></li>
                    <li><a href="giave.php">Giá vé</a></li>
                    <li><a href="gioithieu.php">Giới thiệu</a></li>
                    <li><a href="Register.php">Đăng ký</a></li>
                    <li><a href="login.php">Đăng nhập</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section>
        <header>
            <h1>Lịch Chiếu Phim</h1>
            <!-- Chọn ngày -->
            <form method="get" action="lichchieu.php">
    <label for="custom-date">Chọn ngày:</label>
    <input type="date" id="custom-date" name="date" value="<?php echo htmlspecialchars($date); ?>">
    <button type="submit">Lọc</button>
</form>
        </header>

        <main>
        <div class="movie-schedule">
    <?php if (!empty($movies)): ?>
        <?php foreach ($movies as $movie): ?>
            <div class="movie">
                <img src="<?php echo htmlspecialchars($movie['image']); ?>" alt="Movie Image">
                <div class="info">
                    <h2>
                        <a href="movies.php?id=<?php echo htmlspecialchars($movie['phim_id']); ?>">
                            <?php echo htmlspecialchars($movie['ten']); ?>
                        </a>
                    </h2>
                    <p>Khởi chiếu: <?php echo htmlspecialchars($movie['ngaychieu']); ?></p>
                    <p>Lịch chiếu:</p>
                    <div class="showtimes">
    <?php if (!empty($movie['showtimes'])): ?>
        <?php foreach ($movie['showtimes'] as $showtime): ?>
            <button class="showtime-btn" 
                    onclick="window.location.href='datghe.php?phim_id=<?php echo $movie['phim_id']; ?>&showtime_id=<?php echo $showtime['showtime_id']; ?>&id_phongchieu=<?php echo $showtime['id_phongchieu']; ?>'">
                <?php echo htmlspecialchars($showtime['start']); ?> - <?php echo htmlspecialchars($showtime['end']); ?>
            </button>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có lịch chiếu</p>
    <?php endif; ?>
</div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có phim nào cho ngày được chọn.</p>
    <?php endif; ?>
</div>

</main>
    </section>

    <footer>
        <p>Cơ quan chủ quản: BỘ VĂN HÓA, THỂ THAO VÀ DU LỊCH Bản quyền thuộc Trung tâm Chiếu phim Quốc gia. <br>Giấy phép số: 224/GP- TTĐT ngày 31/8/2010 - Chịu trách nhiệm: Lê Công Minh Thảo giám đốc <br>Địa chỉ: 87 Láng Hạ, Quận Ba Đình, Tp. Hà Nội - Điện thoại: 0778340768 Copyright 2023. NCC All Rights Reservered. Dev by Anvui.vn</p>
    </footer>
</body>
</html>
