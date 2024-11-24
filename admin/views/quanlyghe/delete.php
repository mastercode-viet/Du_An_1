<?php
include 'db.php'; // Include database connection

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = trim($_GET['id']);

    // Prepare a delete statement
    $sql = "DELETE FROM rap WHERE id = :id";
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Attempt to execute the statement
        if ($stmt->execute()) {
            // Redirect to the main page after successful deletion
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
?>
