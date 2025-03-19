<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST["MaSV"];
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $ngaySinh = $_POST["NgaySinh"];
    $maNganh = $_POST["MaNganh"];

    // Xử lý upload ảnh
    $targetDir = "uploads/";
    $fileName = basename($_FILES["Hinh"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    
    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                VALUES ('$maSV', '$hoTen', '$gioiTinh', '$ngaySinh', '$targetFilePath', '$maNganh')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Lỗi khi tải ảnh lên!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">Thêm sinh viên</h2>
    <form method="POST" enctype="multipart/form-data" class="border p-4 rounded bg-light">
        <div class="mb-3">
            <label class="form-label">Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-select">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngành Học:</label>
            <input type="text" name="MaNganh" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">✅ Thêm sinh viên</button>
        <a href="index.php" class="btn btn-secondary">↩️ Quay lại</a>
    </form>
</body>
</html>
