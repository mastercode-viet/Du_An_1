<!-- views/lichchieuphim/edit.php -->

<div class="container">
    <h1>Sửa Lịch Chiếu Phim</h1>

    <form action="?view=LichChieuPhim&action=edit&id=<?php echo $lichChieu['id']; ?>" method="POST">
        <!-- Chọn Phim -->
        <div class="form-group">
            <label for="id_phim">Chọn Phim:</label>
            <select class="form-control" id="id_phim" name="id_phim" required>
                <?php foreach ($phimList as $phim): ?>
                    <option value="<?php echo $phim['id']; ?>" <?php echo ($lichChieu['id_phim'] == $phim['id']) ? 'selected' : ''; ?>>
                        <?php echo $phim['ten']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Chọn Phòng Chiếu -->
        <div class="form-group">
            <label for="id_phongchieu">Chọn Phòng Chiếu:</label>
            <select class="form-control" id="id_phongchieu" name="id_phongchieu" required>
                <?php foreach ($phongChieuList as $phongChieu): ?>
                    <option value="<?php echo $phongChieu['id_phongchieu']; ?>" <?php echo ($lichChieu['id_phongchieu'] == $phongChieu['id_phongchieu']) ? 'selected' : ''; ?>>
                        <?php echo $phongChieu['ten']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Thời Gian Bắt Đầu -->
        <div class="form-group">
            <label for="thoigianbatdau">Thời Gian Bắt Đầu:</label>
            <input type="datetime-local" class="form-control" id="thoigianbatdau" name="thoigianbatdau" value="<?php echo date('Y-m-d\TH:i', strtotime($lichChieu['thoigianbatdau'])); ?>" required>
        </div>

        <!-- Thời Gian Kết Thúc -->
        <div class="form-group">
            <label for="thoigianketthuc">Thời Gian Kết Thúc:</label>
            <input type="datetime-local" class="form-control" id="thoigianketthuc" name="thoigianketthuc" value="<?php echo date('Y-m-d\TH:i', strtotime($lichChieu['thoigianketthuc'])); ?>" required>
        </div>

        <!-- Trạng Thái -->
        <div class="form-group">
            <label for="status">Trạng Thái:</label>
            <select class="form-control" id="status" name="status">
                <option value="0" <?php echo ($lichChieu['status'] == 0) ? 'selected' : ''; ?>>Chưa Chiếu</option>
                <option value="1" <?php echo ($lichChieu['status'] == 1) ? 'selected' : ''; ?>>Đang Chiếu</option>
                <option value="2" <?php echo ($lichChieu['status'] == 2) ? 'selected' : ''; ?>>Đã Chiếu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
    </form>
</div>
