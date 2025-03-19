<?php
session_start();
include 'config.php';

$error = "";

// Kiểm tra đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST["MaSV"];

    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$maSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["user"] = $maSV; // Lưu user vào session
        header("Location: hocphan.php");
        exit;
    } else {
        $error = "❌ Mã Sinh Viên không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">🔐 Đăng Nhập</h2>
    <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
    <form method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="MaSV" class="form-label">Mã Sinh Viên:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">🔑 Đăng Nhập</button>
    </form>
</body>
</html>
