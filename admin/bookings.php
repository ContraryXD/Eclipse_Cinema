<?php
session_start();

// Kiểm tra xem admin đã đăng nhập chưa
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../connection.php';

// Xử lý form thêm mới đặt vé
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_booking'])) {
    $user_id = $_POST['user_id'];
    $showtime_id = $_POST['showtime_id'];
    $seats = $_POST['seats'];
    $booking_date_time = date('Y-m-d H:i:s');

    // Thêm mới đặt vé vào cơ sở dữ liệu
    $sql = "INSERT INTO Bookings (UserID, ShowtimeID, Seats, BookingDateTime) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $user_id, $showtime_id, $seats, $booking_date_time);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý đặt vé
        header('Location: bookings.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý form chỉnh sửa đặt vé
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_booking'])) {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $showtime_id = $_POST['showtime_id'];
    $seats = $_POST['seats'];

    // Cập nhật đặt vé trong cơ sở dữ liệu
    $sql = "UPDATE Bookings SET UserID = ?, ShowtimeID = ?, Seats = ? WHERE BookingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $showtime_id, $seats, $booking_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý đặt vé
        header('Location: bookings.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý xóa đặt vé
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_booking'])) {
    $booking_id = $_POST['booking_id'];

    // Xóa đặt vé khỏi cơ sở dữ liệu
    $sql = "DELETE FROM Bookings WHERE BookingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý đặt vé
        header('Location: bookings.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Lấy danh sách đặt vé từ cơ sở dữ liệu
$sql = "SELECT Bookings.BookingID, Users.UserID, Users.UserName, Showtimes.ShowtimeID, Showtimes.ShowDateTime, Bookings.Seats, Movies.Title 
        FROM Bookings 
        JOIN Users ON Bookings.UserID = Users.UserID 
        JOIN Showtimes ON Bookings.ShowtimeID = Showtimes.ShowtimeID 
        JOIN Movies ON Showtimes.MovieID = Movies.MovieID";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đặt vé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'top.html'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'side.html'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="text-center">Quản lý đặt vé</h1>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newBookingModal">
                        <i class="bi bi-plus-circle"></i> Thêm đặt vé mới
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Mã đặt vé</th>
                            <th scope="col">Tên người dùng</th>
                            <th scope="col">Suất chiếu</th>
                            <th scope="col">Số ghế</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['BookingID'] . "</td>";
                                echo "<td>" . $row['UserName'] . "</td>";
                                echo "<td>" . $row['ShowDateTime'] . "</td>";
                                echo "<td>" . $row['Seats'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editBookingModal' data-booking-id='" . $row['BookingID'] . "' data-user-id='" . $row['UserID'] . "' data-showtime-id='" . $row['ShowtimeID'] . "' data-seats='" . $row['Seats'] . "'><i class='bi bi-pencil'></i> Sửa</button>";
                                echo "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteBookingModal' data-booking-id='" . $row['BookingID'] . "'><i class='bi bi-trash'></i> Xóa</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Không tìm thấy đặt vé nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal thêm đặt vé mới -->
    <div class="modal fade" id="newBookingModal" tabindex="-1" aria-labelledby="newBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBookingModalLabel">Thêm đặt vé mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="bookings.php" method="POST">
                        <input type="hidden" name="add_booking" value="1">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Người dùng</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <?php
                                // Lấy danh sách người dùng từ cơ sở dữ liệu
                                $user_sql = "SELECT UserID, UserName FROM Users";
                                $user_result = $conn->query($user_sql);
                                if ($user_result->num_rows > 0) {
                                    while ($user_row = $user_result->fetch_assoc()) {
                                        echo "<option value='" . $user_row['UserID'] . "'>" . $user_row['UserName'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="showtime_id" class="form-label">Suất chiếu</label>
                            <select class="form-select" id="showtime_id" name="showtime_id" required>
                                <?php
                                // Lấy danh sách suất chiếu từ cơ sở dữ liệu
                                $showtime_sql = "SELECT ShowtimeID, ShowDateTime FROM Showtimes";
                                $showtime_result = $conn->query($showtime_sql);
                                if ($showtime_result->num_rows > 0) {
                                    while ($showtime_row = $showtime_result->fetch_assoc()) {
                                        echo "<option value='" . $showtime_row['ShowtimeID'] . "'>" . $showtime_row['ShowDateTime'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="seats" class="form-label">Số ghế</label>
                            <input type="number" class="form-control" id="seats" name="seats" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu đặt vé</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa đặt vé -->
    <div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookingModalLabel">Chỉnh sửa đặt vé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="bookings.php" method="POST">
                        <input type="hidden" name="edit_booking" value="1">
                        <input type="hidden" id="edit_booking_id" name="booking_id">
                        <div class="mb-3">
                            <label for="edit_user_id" class="form-label">Người dùng</label>
                            <select class="form-select" id="edit_user_id" name="user_id" required>
                                <?php
                                // Lấy danh sách người dùng từ cơ sở dữ liệu
                                $user_sql = "SELECT UserID, UserName FROM Users";
                                $user_result = $conn->query($user_sql);
                                if ($user_result->num_rows > 0) {
                                    while ($user_row = $user_result->fetch_assoc()) {
                                        echo "<option value='" . $user_row['UserID'] . "'>" . $user_row['UserName'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_showtime_id" class="form-label">Suất chiếu</label>
                            <select class="form-select" id="edit_showtime_id" name="showtime_id" required>
                                <?php
                                // Lấy danh sách suất chiếu từ cơ sở dữ liệu
                                $showtime_sql = "SELECT ShowtimeID, ShowDateTime FROM Showtimes";
                                $showtime_result = $conn->query($showtime_sql);
                                if ($showtime_result->num_rows > 0) {
                                    while ($showtime_row = $showtime_result->fetch_assoc()) {
                                        echo "<option value='" . $showtime_row['ShowtimeID'] . "'>" . $showtime_row['ShowDateTime'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_seats" class="form-label">Số ghế</label>
                            <input type="number" class="form-control" id="edit_seats" name="seats" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xóa đặt vé -->
    <div class="modal fade" id="deleteBookingModal" tabindex="-1" aria-labelledby="deleteBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBookingModalLabel">Xóa đặt vé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa đặt vé này không?</p>
                    <form action="bookings.php" method="POST">
                        <input type="hidden" name="delete_booking" value="1">
                        <input type="hidden" id="delete_booking_id" name="booking_id">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Điền dữ liệu vào modal chỉnh sửa đặt vé
        var editBookingModal = document.getElementById('editBookingModal');
        editBookingModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var bookingId = button.getAttribute('data-booking-id');
            var userId = button.getAttribute('data-user-id');
            var showtimeId = button.getAttribute('data-showtime-id');
            var seats = button.getAttribute('data-seats');

            var modalTitle = editBookingModal.querySelector('.modal-title');
            var editBookingIdInput = editBookingModal.querySelector('#edit_booking_id');
            var editUserIdSelect = editBookingModal.querySelector('#edit_user_id');
            var editShowtimeIdSelect = editBookingModal.querySelector('#edit_showtime_id');
            var editSeatsInput = editBookingModal.querySelector('#edit_seats');

            modalTitle.textContent = 'Chỉnh sửa đặt vé ' + bookingId;
            editBookingIdInput.value = bookingId;
            editUserIdSelect.value = userId;
            editShowtimeIdSelect.value = showtimeId;
            editSeatsInput.value = seats;
        });

        // Điền dữ liệu vào modal xóa đặt vé
        var deleteBookingModal = document.getElementById('deleteBookingModal');
        deleteBookingModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var bookingId = button.getAttribute('data-booking-id');

            var deleteBookingIdInput = deleteBookingModal.querySelector('#delete_booking_id');
            deleteBookingIdInput.value = bookingId;
        });
    </script>
</body>

</html>