<!-- views/lichchieuphim/create.php -->
<div class="container">
    <h1>Thêm Lịch Chiếu Phim</h1>

    <!-- Form tạo lịch chiếu -->
    <form action="?view=LichChieuPhim&action=create" method="POST">
        <div class="form-group">
            <label for="id_phim">Chọn Phim</label>
            <select class="form-control" id="id_phim" name="id_phim" required>
                <option value="">Chọn Phim</option>
                <?php foreach ($phimList as $phim): ?>
                    <option value="<?php echo $phim['id']; ?>"><?php echo $phim['ten']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_phongchieu">Chọn Phòng Chiếu</label>
            <select class="form-control" id="id_phongchieu" name="id_phongchieu" required>
                <option value="">Chọn Phòng Chiếu</option>
                <?php foreach ($phongChieuList as $phongchieu): ?>
                    <option value="<?php echo $phongchieu['id_phongchieu']; ?>"><?php echo $phongchieu['ten']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="thoigianbatdau">Thời Gian Bắt Đầu</label>
            <input type="datetime-local" class="form-control" id="thoigianbatdau" name="thoigianbatdau" required>
        </div>

        <div class="form-group">
            <label for="thoigianketthuc">Thời Gian Kết Thúc</label>
            <input type="datetime-local" class="form-control" id="thoigianketthuc" name="thoigianketthuc" required>
        </div>

        <div class="form-group">
            <label for="status">Trạng Thái</label>
            <select class="form-control" id="status" name="status" required>
                <option value="0">Chưa chiếu</option>
                <option value="1">Đang chiếu</option>
                <option value="2">Đã chiếu</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="?view=LichChieuPhim" class="btn btn-secondary">Hủy</a>
    </form>
</div>
