<?php
session_start();
include 'connection.php';

// Get the form data
$movie_id = isset($_POST['movie_id']) ? intval($_POST['movie_id']) : 0;
$cinema_id = isset($_POST['cinema']) ? intval($_POST['cinema']) : 0;
$seats = isset($_POST['seats']) ? intval($_POST['seats']) : 0;
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

// Check if the form data is valid
if ($movie_id > 0 && $cinema_id > 0 && $seats > 0 && $user_id > 0) {
    // Insert the booking into the database
    $sql = "INSERT INTO Bookings (UserID, ShowtimeID, Seats, BookingDateTime) VALUES ($user_id, $movie_id, $seats, NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-center'>Đặt vé thành công!</p>";
    } else {
        echo "<p class='text-center'>Lỗi: " . $conn->error . "</p>";
    }
} else {
    echo "<p class='text-center'>Dữ liệu không hợp lệ.</p>";
}

$conn->close();
?>
<a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>