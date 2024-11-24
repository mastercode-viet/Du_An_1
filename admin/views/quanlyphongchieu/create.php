<form action="?view=Phongchieu&action=create" method="POST">
    <div class="form-group">
        <label for="id_rap">Chọn Rạp:</label>
        <select name="id_rap" id="id_rap" class="form-control" required>
            <?php foreach ($raps as $rap): ?>
                <option value="<?= htmlspecialchars($rap['id']) ?>"><?= htmlspecialchars($rap['ten']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="danhgia">Đánh giá:</label>
        <input type="text" name="danhgia" id="danhgia" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="status">Trạng thái:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="1">Hoạt động</option>
            <option value="0">Dừng hoạt động</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>
</form>
