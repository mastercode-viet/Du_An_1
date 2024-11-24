<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Vé - Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Reset cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #121212;
    color: #ffffff;
    line-height: 1.6;
}

/* Phần đặt vé */
.booking-section {
    padding: 60px 20px;
    background-color: #1c1c1c;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #2c2c2c;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.section-title {
    text-align: center;
    font-size: 28px;
    color: #f4c10f;
    margin-bottom: 30px;
    text-transform: uppercase;
}

.booking-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    font-size: 16px;
    color: #f4c10f;
    margin-bottom: 5px;
}

select,
input {
    font-size: 16px;
    padding: 10px;
    border: 1px solid #3e3e3e;
    border-radius: 5px;
    background-color: #1c1c1c;
    color: #ffffff;
}

select:focus,
input:focus {
    outline: none;
    border-color: #f4c10f;
}

.btn-submit {
    padding: 10px 15px;
    font-size: 16px;
    color: #121212;
    background-color: #f4c10f;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #e0ac0b;
}

</style>
<body>
    <section class="booking-section">
        <div class="container">
            <h2 class="section-title">Đặt Vé Xem Phim</h2>
            <form class="booking-form">
                <!-- Chọn phim -->
                <div class="form-group">
                    <label for="movie">Chọn Phim</label>
                    <select id="movie" name="movie" required>
                        <option value="" disabled selected>Chọn phim...</option>
                        <option value="avengers">Avengers: Endgame</option>
                        <option value="batman">The Batman</option>
                        <option value="frozen">Frozen 2</option>
                    </select>
                </div>

                <!-- Chọn rạp -->
                <div class="form-group">
                    <label for="cinema">Chọn Rạp</label>
                    <select id="cinema" name="cinema" required>
                        <option value="" disabled selected>Chọn rạp...</option>
                        <option value="cinema1">Rạp 1 - Quận 1</option>
                        <option value="cinema2">Rạp 2 - Quận 3</option>
                        <option value="cinema3">Rạp 3 - Quận 7</option>
                    </select>
                </div>

                <!-- Chọn suất chiếu -->
                <div class="form-group">
                    <label for="showtime">Chọn Suất Chiếu</label>
                    <select id="showtime" name="showtime" required>
                        <option value="" disabled selected>Chọn suất chiếu...</option>
                        <option value="10am">10:00 AM</option>
                        <option value="1pm">1:00 PM</option>
                        <option value="6pm">6:00 PM</option>
                        <option value="9pm">9:00 PM</option>
                    </select>
                </div>

                <!-- Số lượng vé -->
                <div class="form-group">
                    <label for="tickets">Số Lượng Vé</label>
                    <input type="number" id="tickets" name="tickets" min="1" max="10" value="1" required>
                </div>

                <!-- Nút đặt vé -->
                <button type="submit" class="btn-submit">Đặt Vé Ngay</button>
            </form>
        </div>
    </section>
</body>
</html>
