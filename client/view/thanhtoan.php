<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
.payment-container {
    display: flex; /* Tạo hai cột */
    justify-content: space-between; /* Cách đều hai phần */
    align-items: flex-start; /* Canh trên cho hai phần */
    width: 30%; /* Chiều rộng toàn bộ container */
    margin: 50px auto;
    padding: 20px;
    background: blanchedalmond;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    float: left;
}

.left-section,
.right-section {
    width: 40%; /* Chiều rộng mỗi phần */
    border: 1px solid red;
}

.payment-method {
    margin-top: 0;
}

.payment-method label {
    display: block;
    margin: 10px 0;
}

.confirm-btn {
    margin-top: 20px;
    width: 30%;
    padding: 10px;
    background: #e50914;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.confirm-btn:hover {
    background: #d40812;
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
                    <a href="logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </div>
            <div class="payment-container">
    <div class="left-section">
        <div class="movie-info">
            <h2>Thông Tin Phim</h2>
            <p><strong>Tên phim:</strong> Avatar 2</p>
            <p><strong>Thời gian:</strong> 19:00, Ngày 01/12/2024</p>
            <p><strong>Phòng chiếu:</strong> Phòng 3</p>
        </div>

        <div class="ticket-info">
            <h2>Thông Tin Vé</h2>
            <p><strong>Số lượng vé:</strong> 2</p>
            <p><strong>Loại vé:</strong> Vé người lớn</p>
            <p><strong>Giá vé:</strong> 200,000 VNĐ</p>
        </div>

        <div class="payment-summary">
            <h2>Tổng Thanh Toán</h2>
            <p><strong>Tổng cộng:</strong> 400,000 VNĐ</p>
        </div>

        <button class="confirm-btn">Xác Nhận Thanh Toán</button>
    </div>

    <div class="right-section">
        <div class="payment-method">
            <h2>Phương Thức Thanh Toán</h2>
            <label><input type="radio" name="payment" value="momo"> MoMo</label>
            <label><input type="radio" name="payment" value="zalo"> ZaloPay</label>
            <label><input type="radio" name="payment" value="credit"> Thẻ Tín Dụng</label>
        </div>
    </div>
</div>

</div>

</body>
</html>
