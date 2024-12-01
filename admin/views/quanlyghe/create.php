
<?php
// Kiểm tra nếu có thông báo lỗi từ session
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']); // Sau khi hiển thị thì xóa thông báo lỗi
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']); // Sau khi hiển thị thì xóa thông báo thành công
}
?>
<form action="?view=Ghe&action=create" method="POST">
    <div class="form-group">
        <label for="id_phongchieu">Chọn Phòng Chiếu:</label>
        <select class="form-control" id="id_phongchieu" name="id_phongchieu" required>
            <option value="">Chọn phòng chiếu</option>
            <?php
            foreach ($phongchieuList as $phongchieu) {
                echo "<option value='" . $phongchieu['id_phongchieu'] . "'>" . $phongchieu['ten'] . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
    <label for="id_dayghe">Chọn Dãy Ghế:</label>
    <select class="form-control" id="id_dayghe" name="id_dayghe" required>
        <option value="">Chọn dãy ghế</option>
        <?php
        // Lặp qua danh sách dãy ghế và hiển thị từng dãy ghế
        foreach ($daygheList as $dayghe) {
            echo "<option value='" . $dayghe['id'] . "'>" . $dayghe['ten'] . "</option>";
        }
        ?>
    </select>
</div>


    <div class="form-group">
        <label for="ten">Tên Ghế:</label>
        <input type="text" class="form-control" id="ten" name="ten" required>
    </div>

    <div class="form-group">
        <label for="status">Trạng Thái:</label>
        <select class="form-control" id="status" name="status">
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
</form>
