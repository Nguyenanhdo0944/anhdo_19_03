<?php
include 'config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $ngaySinh = $_POST["NgaySinh"];
    $maNganh = $_POST["MaNganh"];

    // Nếu có ảnh mới, cập nhật
    if ($_FILES["Hinh"]["name"]) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["Hinh"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
            $hinh = $targetFilePath;
        } else {
            echo "Lỗi khi tải ảnh!";
            exit;
        }
    } else {
        $hinh = $row["Hinh"];
    }

    $sql = "UPDATE SinhVien SET HoTen='$hoTen', GioiTinh='$gioiTinh', NgaySinh='$ngaySinh', Hinh='$hinh', MaNganh='$maNganh' WHERE MaSV='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">✏️ Sửa thông tin sinh viên</h2>
    <form method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light">
        <div class="mb-3">
            <label class="form-label">Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" value="<?= $row['HoTen'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-select">
                <option value="Nam" <?= $row["GioiTinh"] == "Nam" ? "selected" : "" ?>>Nam</option>
                <option value="Nữ" <?= $row["GioiTinh"] == "Nữ" ? "selected" : "" ?>>Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" value="<?= $row['NgaySinh'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control">
            <p class="mt-2">Ảnh hiện tại:</p>
            <img src="<?= $row['Hinh'] ?>" width="100" class="rounded">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngành Học:</label>
            <input type="text" name="MaNganh" class="form-control" value="<?= $row['MaNganh'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
        <a href="index.php" class="btn btn-secondary">↩️ Quay lại</a>
    </form>
</body>
</html>
