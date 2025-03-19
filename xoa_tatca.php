<?php
session_start();
include 'config.php';

// Kiểm tra nếu chưa đăng nhập, chuyển hướng về login
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$maSV = $_SESSION["user"];

// Lấy danh sách học phần đã đăng ký để cập nhật số lượng dự kiến
$sql = "SELECT MaHocPhan FROM DangKy WHERE MaSV = '$maSV'";
$result = $conn->query($sql);

// Cập nhật số lượng sinh viên dự kiến trong HocPhan
while ($row = $result->fetch_assoc()) {
    $update_sql = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHocPhan = '{$row['MaHocPhan']}'";
    $conn->query($update_sql);
}

// Xóa tất cả học phần đăng ký
$delete_sql = "DELETE FROM DangKy WHERE MaSV = '$maSV'";
$conn->query($delete_sql);

header("Location: giohang.php");
exit;
?>
