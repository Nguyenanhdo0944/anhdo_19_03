<?php
session_start();
include 'config.php';

// Lấy danh sách học phần
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);

// Xử lý thêm vào giỏ hàng (session)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["MaHP"])) {
    $maHP = $_POST["MaHP"];
    
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    if (!in_array($maHP, $_SESSION["cart"])) {
        $_SESSION["cart"][] = $maHP;
    }

    header("Location: hocphan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký học phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="text-center mb-4">📚 Danh sách học phần</h2>
    <a href="giohang.php" class="btn btn-primary mb-3">🛒 Xem giỏ hàng (<?= count($_SESSION["cart"] ?? []) ?>)</a>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Mã HP</th>
                <th>Tên học phần</th>
                <th>Số tín chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row["MaHP"] ?></td>
                <td><?= $row["TenHP"] ?></td>
                <td><?= $row["SoTinChi"] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                        <button type="submit" class="btn btn-success btn-sm">✅ Đăng ký</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
