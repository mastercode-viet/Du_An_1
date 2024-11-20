<?php
include 'db.php';

$name = $status = "";
$name_err = $status_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["ten"]))) {
        $name_err = "Vui lòng nhập tên thể loại.";
    } else {
        $name = trim($_POST["ten"]);
    }

    if (empty(trim($_POST["status"]))) {
        $status_err = "Vui lòng nhập trạng thái.";
    } else {
        $status = trim($_POST["status"]);
    }

    if (empty($name_err) && empty($status_err)) {
        // Prepare SQL statement
        $sql = "INSERT INTO rap (ten, status) VALUES (:ten,dia chi, soluong)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":ten", $name, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);

            // Attempt to execute the statement
            if ($stmt->execute()) {
                // Redirect to the main page
                header("Location: index.php");
                exit();
            } else {
                echo "Có lỗi xảy ra. Vui lòng thử lại.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm rap mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2>Thêm rap mới</h2>
        <p>Vui lòng điền thông tin rap mới.</p>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Tên rap</label>
                <input type="text" name="ten" class="form-control <?= !empty($name_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($name); ?>">
                <span class="invalid-feedback"><?= $name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Trạng Thái</label>
                <input type="text" name="status" class="form-control <?= !empty($status_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($status); ?>">
                <span class="invalid-feedback"><?= $status_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Lưu">
                <a href="index.php" class="btn btn-secondary ml-2">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>
