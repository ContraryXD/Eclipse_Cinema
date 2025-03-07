<?php
session_start();
include 'connection.php';

// lấy từ form
$showtime_id = isset($_POST['showtime_id']) ? intval($_POST['showtime_id']) : 0;
$seats = isset($_POST['seats']) ? intval($_POST['seats']) : 0;
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;


// ktra dlieu
if ($showtime_id > 0 && $seats > 0 && $user_id > 0) {
    // Insert
    $sql = "INSERT INTO Bookings (UserID, ShowtimeID, Seats, BookingDateTime) VALUES ($user_id, $showtime_id, $seats, NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-center'>Đặt vé thành công!</p>";
        header("Location: account.php");
    } else {
        echo "<p class='text-center'>Lỗi: " . $conn->error . "</p>";
    }
} else {
    echo "<p class='text-center'>Dữ liệu không hợp lệ.</p>";
}

$conn->close();
?>
<a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>