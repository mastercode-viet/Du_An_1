<div class="container">
    <h1>Sửa dãy ghế</h1>
    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Hiển thị thông báo thành công nếu có -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <form action="index.php?view=dayghe&action=edit&id=<?php echo $currentDayGhe['id']; ?>" method="POST">
        <div class="form-group">
            <label for="ten">Tên dãy ghế:</label>
            <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $currentDayGhe['ten']; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Cập nhật</button>
    </form>
</div>
