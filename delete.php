<?php
include 'config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Lấy đường dẫn hình ảnh để xóa
    $sql = "SELECT Hinh FROM SinhVien WHERE MaSV = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        $imagePath = $row["Hinh"];
        
        // Xóa sinh viên trong database
        $sqlDelete = "DELETE FROM SinhVien WHERE MaSV = '$id'";
        if ($conn->query($sqlDelete) === TRUE) {
            
            // Kiểm tra nếu có ảnh thì xóa
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa ảnh
            }

            echo "Xóa thành công!";
            header("Location: index.php");
        } else {
            echo "Lỗi khi xóa: " . $conn->error;
        }
    } else {
        echo "Không tìm thấy sinh viên!";
    }
} else {
    echo "Thiếu ID sinh viên!";
}
?>
