<div class="container">
    <h1>Thêm dãy ghế mới</h1>
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
    <form action="index.php?view=dayghe&action=create" method="POST">
        <div class="form-group">
            <label for="ten">Tên dãy ghế:</label>
            <input type="text" class="form-control" id="ten" name="ten" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
