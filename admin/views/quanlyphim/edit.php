<form action="/admin/index.php?view=Phim&action=update&id=<?= htmlspecialchars($phim['id']) ?>" method="POST">
    <div class="form-group">
        <label for="ten">Tên Phim</label>
        <input type="text" class="form-control" id="ten" name="ten" value="<?= htmlspecialchars($phim['ten']) ?>" required>
    </div>
    <div class="form-group">
        <label for="ngayramat">Ngày Ra Mắt</label>
        <input type="date" class="form-control" id="ngayramat" name="ngayramat" value="<?= htmlspecialchars($phim['ngayramat']) ?>" required>
    </div>
    <div class="form-group">
        <label for="ngaychieu">Ngày Chiếu</label>
        <input type="date" class="form-control" id="ngaychieu" name="ngaychieu" value="<?= htmlspecialchars($phim['ngaychieu']) ?>" required>
    </div>
    <div class="form-group">
        <label for="thoiluong">Thời Lượng (phút)</label>
        <input type="number" class="form-control" id="thoiluong" name="thoiluong" value="<?= htmlspecialchars($phim['thoiluong']) ?>" required>
    </div>
    <div class="form-group">
        <label for="noidung">Nội Dung</label>
        <textarea class="form-control" id="noidung" name="noidung" rows="4" required><?= htmlspecialchars($phim['noidung']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="gioithieu">Giới Thiệu</label>
        <textarea class="form-control" id="gioithieu" name="gioithieu" rows="4" required><?= htmlspecialchars($phim['gioithieu']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="daodien">Đạo Diễn</label>
        <input type="text" class="form-control" id="daodien" name="daodien" value="<?= htmlspecialchars($phim['daodien']) ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="1" <?= $phim['status'] == 1 ? 'selected' : '' ?>>Đang chiếu</option>
            <option value="2" <?= $phim['status'] == 2 ? 'selected' : '' ?>>Ngừng chiếu</option>
        </select>
    </div>
    <!-- Thêm trường giatien -->
    <div class="form-group">
        <label for="giatien">Giá Tiền</label>
        <input type="number" class="form-control" id="giatien" name="giatien" step="0.01" value="<?= htmlspecialchars($phim['giatien']) ?>" required>
    </div>
    <!-- Thể loại -->
    <div class="form-group">
        <label for="theloai">Chọn Thể Loại</label><br>
        <select class="form-control" id="theloai" name="theloai[]" multiple size="10" required>
            <?php foreach ($theloaiList as $theloai): ?>
                <option value="<?= $theloai['id_theloai'] ?>" 
                    <?= in_array($theloai['id_theloai'], $currentTheLoaiIds) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($theloai['ten']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <small class="form-text text-muted">Giữ Ctrl (hoặc Command trên Mac) để chọn nhiều thể loại.</small>
    </div>
    <button type="submit" class="btn btn-primary">Cập Nhật Phim</button>
</form>
