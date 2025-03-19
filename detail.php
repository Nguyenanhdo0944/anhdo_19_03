<?php
include 'config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên!";
        exit;
    }
} else {
    echo "Không có ID sinh viên!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">🔍 Chi tiết sinh viên</h2>
    <div class="card mx-auto" style="width: 30rem;">
        <img src="<?= $row["Hinh"] ?>" class="card-img-top" alt="Ảnh sinh viên">
        <div class="card-body">
            <h5 class="card-title"><?= $row["HoTen"] ?></h5>
            <p class="card-text"><strong>Mã SV:</strong> <?= $row["MaSV"] ?></p>
            <p class="card-text"><strong>Giới Tính:</strong> <?= $row["GioiTinh"] ?></p>
            <p class="card-text"><strong>Ngày Sinh:</strong> <?= $row["NgaySinh"] ?></p>
            <p class="card-text"><strong>Ngành Học:</strong> <?= $row["MaNganh"] ?></p>
            <a href="index.php" class="btn btn-secondary">↩️ Quay lại</a>
        </div>
    </div>
</body>
</html>
