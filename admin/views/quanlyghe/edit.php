<?php
include 'db.php'; // Include database connection

// Initialize variables for form fields
$name = $status = "";
$name_err = $status_err = "";

// Check if 'id' is present in URL and get the record data
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = trim($_GET['id']);

    // Fetch existing data
    $sql = "SELECT * FROM the_loai WHERE id_theloai = :id";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $name = $row['ten'];
            $status = $row['status'];
        } else {
            // Redirect if no matching record found
            header("Location: index.php");
            exit();
        }

        // Close statement
        unset($stmt);
    }
}

// Process form submission for updating the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["ten"]))) {
        $name_err = "Vui lòng nhập tên thể loại.";
    } else {
        $name = trim($_POST["ten"]);
    }

    // Validate status
    if (empty(trim($_POST["status"]))) {
        $status_err = "Vui lòng nhập trạng thái.";
    } else {
        $status = trim($_POST["status"]);
    }

    // Check for errors before updating in the database
    if (empty($name_err) && empty($status_err)) {
        // Prepare an update statement
        $sql = "UPDATE the_loai SET ten = :ten, status = :status WHERE id_theloai = :id";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bindParam(":ten", $name, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            // Attempt to execute the statement
            if ($stmt->execute()) {
                // Redirect to the main page after successful update
                header("Location: index.php");
                exit();
            } else {
                echo "Có lỗi xảy ra khi cập nhật. Vui lòng thử lại.";
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
    <title>Chỉnh sửa ghế</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Chỉnh sửa ghế</h2>
        <p>Chỉnh sửa thông tin ghế.</p>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . htmlspecialchars($id); ?>" method="post">
            <div class="form-group">
                <label>Tên ghế</label>
                <input type="text" name="ten" class="form-control <?= !empty($name_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($name); ?>">
                <span class="invalid-feedback"><?= $name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="diachi" class="form-control <?= !empty($name_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($name); ?>">
                <span class="invalid-feedback"><?= $name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" name="soluong" class="form-control <?= !empty($name_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($name); ?>">
                <span class="invalid-feedback"><?= $name_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Lưu">
                <a href="index.php" class="btn btn-secondary ml-2">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>
