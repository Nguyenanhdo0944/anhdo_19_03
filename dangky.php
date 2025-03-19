<?php
include 'config.php';
session_start();

$maSV = $_SESSION['MaSV'] ?? ''; // Lấy mã sinh viên từ session
$maHocPhan = $_GET['MaHocPhan'] ?? ''; // Lấy mã học phần từ URL

if ($maSV == '' || $maHocPhan == '') {
    die("Dữ liệu không hợp lệ. Vui lòng đăng nhập hoặc chọn học phần.");
}

// Kiểm tra xem sinh viên đã đăng ký học phần này chưa
$sql_check = "SELECT * FROM DangKy WHERE MaSV='$maSV' AND MaHocPhan='$maHocPhan'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "<script>alert('Bạn đã đăng ký học phần này rồi!'); window.location='hocphan.php';</script>";
} else {
    // Thêm vào bảng DangKy
    $sql_insert = "INSERT INTO DangKy (MaSV, MaHocPhan) VALUES ('$maSV', '$maHocPhan')";

    if ($conn->query($sql_insert)) {
        echo "<script>alert('Đăng ký thành công!'); window.location='hocphan.php';</script>";
    } else {
        die("Lỗi khi đăng ký: " . $conn->error);
    }
}
?>
