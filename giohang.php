<?php
include 'config.php'; // Kết nối MySQL
session_start();

// Giả sử người dùng đã đăng nhập và có mã sinh viên (MaSV)
$maSV = $_SESSION['MaSV'] ?? ''; // Nếu chưa đăng nhập, MaSV sẽ là rỗng

// if ($maSV == '') {
//     die("Vui lòng đăng nhập trước khi xem giỏ hàng.");
// }

// Lấy danh sách học phần đã đăng ký của sinh viên
$sql = "SELECT hp.MaHocPhan, hp.TenHocPhan, hp.SoTinChi 
        FROM DangKy dk 
        JOIN HocPhan hp ON dk.MaHocPhan = hp.MaHocPhan
        WHERE dk.MaSV = '$maSV'";

$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">📋 Danh Sách Học Phần Đã Đăng Ký</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>❌ Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['MaHocPhan']; ?></td>
                        <td><?php echo $row['TenHocPhan']; ?></td>
                        <td><?php echo $row['SoTinChi']; ?></td>
                        <td>
                            <a href="xoa_hocphan.php?MaHocPhan=<?php echo $row['MaHocPhan']; ?>" class="btn btn-danger btn-sm">
                                ❌ Xóa
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Xóa tất cả học phần -->
        <a href="xoa_giohang.php" class="btn btn-warning">🗑 Xóa Tất Cả</a>
        <a href="hocphan.php" class="btn btn-secondary">🔙 Quay lại</a>
    </div>
</body>
</html>
