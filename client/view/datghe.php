<?php
session_start();

// Kiểm tra nếu khách hàng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['client_logged_in']) || $_SESSION['client_logged_in'] !== true) {
    header("Location: /client/login.php");
    exit();
}
$phim_id = isset($_GET['phim_id']) ? $_GET['phim_id'] : null;
$showtime_id = isset($_GET['showtime_id']) ? $_GET['showtime_id'] : null;
$id_phongchieu = isset($_GET['id_phongchieu']) ? $_GET['id_phongchieu'] : null;

if (!$phim_id || !$showtime_id || !$id_phongchieu) {
    echo "Thông tin không đầy đủ.";
    exit();
}
// Kết nối database và gọi controller
require_once '../controllers/ClientController.php';  
$pdo = new PDO("mysql:host=localhost;dbname=da1", "root", "");
$clientController = new ClientController($pdo);

// Lấy thông tin phòng chiếu từ URL
$id_phongchieu = isset($_GET['id_phongchieu']) ? $_GET['id_phongchieu'] : null;

if ($id_phongchieu) {
    // Lấy danh sách ghế theo phòng chiếu
    $seats = $clientController->getSeatsByShowtime($id_phongchieu);
} else {
    echo "Không tìm thấy phòng chiếu.";
    exit();
}

if (empty($seats)) {
    echo "Không tìm thấy ghế cho phòng chiếu này.";
    exit();
}
$showtimeDetails = $clientController->getShowtimeDetails($phim_id, $showtime_id);
try {
    // Bắt đầu giao dịch để đảm bảo tính toàn vẹn dữ liệu
    $pdo->beginTransaction();

    // Lưu thông tin vé vào bảng vé (ví dụ: ve_phim)
    $stmt = $pdo->prepare("INSERT INTO ve_phim (user_id, created_at) VALUES (?, NOW())");
    $stmt->execute([$_SESSION['id_khachhang']]);

    // Lấy ID vé vừa được tạo
    $ticket_id = $pdo->lastInsertId(); 

    // Lưu thông tin ghế đã chọn vào bảng ghế (day_ghes)
    $stmt = $pdo->prepare("INSERT INTO day_ghes (ticket_id, seat_name, status) VALUES (?, ?, 'booked')");
    foreach ($seats as $seat) {
        $stmt->execute([$ticket_id, $seat]);
    }

    // Cam kết giao dịch
    $pdo->commit();
    echo "Đặt ghế thành công!";
} catch (Exception $e) {
    // Nếu có lỗi, rollback giao dịch
    $pdo->rollBack();

}
?>

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
 document.addEventListener("DOMContentLoaded", function() {
    const seats = document.querySelectorAll('.seat');
    let selectedSeats = [];  // Mảng lưu trữ ghế đã chọn

    // Xử lý khi nhấn vào ghế
    seats.forEach(function(seat) {
        seat.addEventListener('click', function() {
            if (!seat.classList.contains('booked')) {
                seat.classList.toggle('selected'); // Toggle chọn ghế
                let seatName = seat.innerText;
                
                // Thêm hoặc xóa ghế khỏi danh sách selectedSeats
                if (selectedSeats.includes(seatName)) {
                    selectedSeats = selectedSeats.filter(s => s !== seatName);
                    console.log("Ghế đã bỏ chọn: " + seatName);
                } else {
                    selectedSeats.push(seatName);
                    console.log("Ghế đã chọn: " + seatName);
                }

                // Console log toàn bộ danh sách ghế đã chọn sau khi thay đổi
                console.log("Danh sách ghế đã chọn: ", selectedSeats);
            }
        });
    });

    // Xử lý khi nhấn nút Đặt ghế
    document.getElementById('bookSeatsBtn').addEventListener('click', function() {
        if (selectedSeats.length > 0) {
            // Gửi thông tin ghế đã chọn qua URL (GET request)
            console.log("Đang đặt ghế: ", selectedSeats);
            window.location.href = "datghe.php?seats=" + encodeURIComponent(selectedSeats.join(','));  // Gửi danh sách ghế đã chọn
        } else {
            alert("Vui lòng chọn ghế.");
        }
    });
});
</script>

<style>
/* Toàn bộ body căn giữa theo chiều ngang, phần dưới có khoảng cách */
/* Toàn bộ body căn giữa theo chiều ngang, phần dưới có khoảng cách */
body {
    font-family: 'Roboto', sans-serif;
    background-color: black;
    color: white; /* Đặt màu chữ toàn bộ trang thành trắng */
    line-height: 1.6;
    padding: 20px;
}

/* Trung tâm nội dung chính của trang */
section {
    max-width: 1200px;
    margin: 0 auto;
    background-color: rgb(2, 8, 23);
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 50px;
}

/* Header của section (Thông tin phim) */
header h1 {
    text-align: center;
    font-size: 32px;
    font-weight: bold;
    color: white; /* Đặt màu chữ thành trắng */
    margin-bottom: 30px;
}

/* Thông tin chi tiết phim */
.movie-details {
    text-align: center;
    margin-bottom: 30px;
}

.movie-image img {
    max-width: 350px;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.movie-details h2,
.movie-details p,
.movie-details p strong {
    color: white; /* Đặt màu chữ cho thông tin phim thành trắng */
}

/* Phần chọn ghế */
.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

/* Màn hình chiếu */
.screen {
    background-color: #333;
    color: white; /* Màu chữ trắng cho màn hình chiếu */
    font-size: 20px;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 30px;
    border-radius: 5px;
    text-transform: uppercase;
}

/* Dãy ghế */
.row {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

/* Tên dãy ghế (A, B, C, D) */
.row-name {
    font-size: 18px;
    font-weight: bold;
    color: white; /* Màu chữ trắng cho tên dãy ghế */
    margin-right: 10px;
    text-transform: uppercase;
}

/* Ghế */
.seat {
    width: 45px;
    height: 45px;
    background-color: #6c757d;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 0 10px;
    font-size: 14px;
    font-weight: bold;
    color: white; /* Màu chữ trắng cho ghế */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.seat:hover {
    background-color: #495057;
    transform: scale(1.1);
}

.seat.selected {
    background-color: #e74c3c;
}

.seat.booked {
    background-color: #dc3545;
    cursor: not-allowed;
}

.seat:active {
    transform: scale(0.98);
}

/* Nút đặt ghế */
#bookSeatsBtn {
    display: block;
    width: 100%;
    padding: 15px;
    font-size: 18px;
    background-color: #e74c3c;
    color: white; /* Màu chữ trắng cho nút */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin-top: 40px;
}

#bookSeatsBtn:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

#bookSeatsBtn:disabled {
    background-color: #b0b0b0;
    cursor: not-allowed;
}


#bookSeatsBtn:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}

#bookSeatsBtn:disabled {
    background-color: #b0b0b0;
    cursor: not-allowed;
}
</style>

<section>
    <header>
        <h1>Thông Tin Lịch Chiếu</h1>
    </header>

    <main>
    <?php if ($showtimeDetails): ?>
        <div class="movie-details">
            <!-- Hiển thị hình ảnh của phim -->
            <div class="movie-image">
                <img src="<?php echo htmlspecialchars($showtimeDetails['image']); ?>" alt="Movie Image">
            </div>

            <h2>Tiêu đề phim: <?php echo htmlspecialchars($showtimeDetails['movie_title']); ?></h2>
            <p>Giới thiệu: <?php echo htmlspecialchars($showtimeDetails['movie_description']); ?></p>
            <p>Thời gian chiếu: <?php echo htmlspecialchars($showtimeDetails['showtime']); ?> - <?php echo htmlspecialchars($showtimeDetails['end_time']); ?></p>
            <p>Thời lượng: <?php echo htmlspecialchars($showtimeDetails['movie_duration']); ?> phút</p>
        </div>
    <?php else: ?>
        <p>Không tìm thấy lịch chiếu này.</p>
    <?php endif; ?>
    </main>
</section>

<section>
    <div class="step">
        <div class="screen">
            <?php
            $phong_chieu_name = isset($seats[0]['phong_chieu_name']) ? $seats[0]['phong_chieu_name'] : 'Thông tin phòng chiếu không có';
            echo htmlspecialchars($phong_chieu_name); // Hiển thị tên phòng chiếu
            ?>
        </div>
        <div class="seats">
            <?php
            // Tạo mảng để nhóm ghế theo từng dãy (A, B, C, D)
            $seatsByRow = [];

            // Nhóm ghế theo tên dãy (gd.ten)
            foreach ($seats as $seat) {
                // Giả sử gd.ten là A, B, C, D và seat_name là số ghế (1, 2, 3,...)
                $row = $seat['seat_name'][0]; // Giả sử rằng seat_name luôn bắt đầu bằng dãy ghế (A, B, C, D)
                if (!isset($seatsByRow[$row])) {
                    $seatsByRow[$row] = [];
                }
                $seatsByRow[$row][] = $seat;
            }

            // Sắp xếp các dãy ghế theo thứ tự A, B, C, D
            ksort($seatsByRow);

            // Hiển thị ghế theo từng dãy
            foreach ($seatsByRow as $row => $seatsInRow) {
                echo "<div class='row'>";
                echo "<div class='row-name'>" . htmlspecialchars($row) . "</div>"; // Tên dãy ghế (A, B, C, D)
                
                foreach ($seatsInRow as $seat) {
                    $class = 'available'; // Giả sử ghế luôn có thể chọn
                    if (isset($seat['status']) && $seat['status'] === 'booked') {
                        $class = 'booked'; // Ghế đã đặt
                    }
                    echo "<button class='seat $class'>" . htmlspecialchars($seat['seat_name']) . "</button>"; // Hiển thị số ghế
                }
                echo "</div>"; // Kết thúc dãy ghế
            }
            ?>
        </div>
        <button id="bookSeatsBtn" >Đặt Ghế</button>
    </div>
</section>

</body>
</html>
