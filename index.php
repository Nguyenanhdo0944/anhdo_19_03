<?php
include 'config.php';

// Lấy danh sách sinh viên
$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            height: 100vh;
            padding: 15px;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 260px;
            width: 100%;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center">Test1</h4>
    <a href="index.php">📋 Sinh Viên</a>
    <a href="hocphan.php">📚 Học Phần</a>
    <a href="cart.php">🛒 Đăng Ký</a>
    <a href="login.php">🔐 Đăng Nhập</a>
</div>

<!-- Nội dung chính -->
<div class="content">
    <h2 class="text-center mb-4">📋 Danh sách sinh viên</h2>
    <a href="create.php" class="btn btn-success mb-3">➕ Thêm Sinh Viên</a>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Ngành</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["MaSV"] ?></td>
                <td><?= $row["HoTen"] ?></td>
                <td><?= $row["GioiTinh"] ?></td>
                <td><?= $row["NgaySinh"] ?></td>
                <td><?= $row["MaNganh"] ?></td>
                <td><img src="<?= $row['Hinh'] ?>" width="50"></td>
                <td>
                    <a href="detail.php?id=<?= $row['MaSV'] ?>" class="btn btn-info btn-sm">👁️ Xem</a>
                    <a href="edit.php?id=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                    <a href="delete.php?id=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">🗑️ Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
