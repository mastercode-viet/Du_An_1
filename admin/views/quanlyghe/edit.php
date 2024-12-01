<div class="container">
    <h1>Sửa Ghế</h1>
    <form action="?view=Ghe&action=edit&id_ghe=<?php echo $currentGhe['id_ghe']; ?>" method="POST">
        <!-- Chọn Phòng Chiếu -->
        <div class="form-group">
            <label for="id_phongchieu">Chọn Phòng Chiếu:</label>
            <select class="form-control" id="id_phongchieu" name="id_phongchieu" required>
                <option value="">Chọn phòng chiếu</option>
                <?php
                // Lặp qua danh sách phòng chiếu và hiển thị tên phòng chiếu
                foreach ($phongchieuList as $phongchieu) {
                    echo "<option value='" . $phongchieu['id_phongchieu'] . "' " . ($currentGhe['id_phongchieu'] == $phongchieu['id_phongchieu'] ? 'selected' : '') . ">" . $phongchieu['ten'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Chọn Dãy Ghế -->
        <div class="form-group">
            <label for="id_dayghe">Chọn Dãy Ghế:</label>
            <select class="form-control" id="id_dayghe" name="id_dayghe" required>
                <option value="">Chọn dãy ghế</option>
                <?php
                // Lặp qua danh sách dãy ghế và hiển thị tên dãy ghế
                foreach ($daygheList as $dayghe) {
                    echo "<option value='" . $dayghe['id'] . "' " . ($currentGhe['id_dayghe'] == $dayghe['id'] ? 'selected' : '') . ">" . $dayghe['ten'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Tên Ghế -->
        <div class="form-group">
            <label for="ten">Tên Ghế:</label>
            <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $currentGhe['ten']; ?>" required>
        </div>

        <!-- Trạng Thái -->
        <div class="form-group">
            <label for="status">Trạng Thái:</label>
            <select class="form-control" id="status" name="status">
                <option value="1" <?php echo $currentGhe['status'] == 1 ? 'selected' : ''; ?>>Hoạt động</option>
                <option value="0" <?php echo $currentGhe['status'] == 0 ? 'selected' : ''; ?>>Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
