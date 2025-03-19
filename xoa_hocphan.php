<?php
session_start();
include 'config.php';

// Kiểm tra nếu chưa đăng nhập, chuyển hướng về login
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$maSV = $_SESSION["user"];
$maHocPhan = $_GET["id"] ?? ""; // Lấy mã học phần từ URL

if ($maHocPhan) {
    // Xóa học phần đã đăng ký
    $delete_sql = "DELETE FROM DangKy WHERE MaSV = '$maSV' AND MaHocPhan = '$maHocPhan'";
    if ($conn->query($delete_sql) === TRUE) {
        // Giảm số lượng sinh viên dự kiến trong bảng HocPhan
        $update_sql = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHocPhan = '$maHocPhan'";
        $conn->query($update_sql);
    }
}

header("Location: giohang.php");
exit;
?>
