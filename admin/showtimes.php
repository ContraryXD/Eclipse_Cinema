<?php
session_start();

// Kiểm tra xem admin đã đăng nhập chưa
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../connection.php';

// Xử lý form thêm mới suất chiếu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_showtime'])) {
    $movie_id = $_POST['movie_id'];
    $show_date_time = $_POST['show_date_time'];

    // Thêm mới suất chiếu vào cơ sở dữ liệu
    $sql = "INSERT INTO Showtimes (MovieID, ShowDateTime) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $movie_id, $show_date_time);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý suất chiếu
        header('Location: showtimes.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý form chỉnh sửa suất chiếu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_showtime'])) {
    $showtime_id = $_POST['showtime_id'];
    $movie_id = $_POST['movie_id'];
    $show_date_time = $_POST['show_date_time'];

    // Cập nhật suất chiếu trong cơ sở dữ liệu
    $sql = "UPDATE Showtimes SET MovieID = ?, ShowDateTime = ? WHERE ShowtimeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $movie_id, $show_date_time, $showtime_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý suất chiếu
        header('Location: showtimes.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý xóa suất chiếu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_showtime'])) {
    $showtime_id = $_POST['showtime_id'];

    // Xóa suất chiếu khỏi cơ sở dữ liệu
    $sql = "DELETE FROM Showtimes WHERE ShowtimeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $showtime_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý suất chiếu
        header('Location: showtimes.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Lấy danh sách suất chiếu từ cơ sở dữ liệu
$sql = "SELECT Showtimes.ShowtimeID, Showtimes.MovieID, Movies.Title, Showtimes.ShowDateTime 
        FROM Showtimes 
        JOIN Movies ON Showtimes.MovieID = Movies.MovieID";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý suất chiếu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'top.html'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'side.html'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="text-center">Quản lý suất chiếu</h1>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#newShowtimeModal">
                        <i class="bi bi-plus-circle"></i> Thêm suất chiếu mới
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Mã suất chiếu</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Thời gian chiếu</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ShowtimeID'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['ShowDateTime'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editShowtimeModal' data-showtime-id='" . $row['ShowtimeID'] . "' data-movie-id='" . $row['MovieID'] . "' data-show-date-time='" . $row['ShowDateTime'] . "'><i class='bi bi-pencil'></i> Sửa</button>";
                                echo "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteShowtimeModal' data-showtime-id='" . $row['ShowtimeID'] . "'><i class='bi bi-trash'></i> Xóa</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Không tìm thấy suất chiếu nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal thêm suất chiếu mới -->
    <div class="modal fade" id="newShowtimeModal" tabindex="-1" aria-labelledby="newShowtimeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newShowtimeModalLabel">Thêm suất chiếu mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="showtimes.php" method="POST">
                        <input type="hidden" name="add_showtime" value="1">
                        <div class="mb-3">
                            <label for="movie_id" class="form-label">Phim</label>
                            <select class="form-select" id="movie_id" name="movie_id" required>
                                <?php
                                // Lấy danh sách phim từ cơ sở dữ liệu
                                $movie_sql = "SELECT MovieID, Title FROM Movies";
                                $movie_result = $conn->query($movie_sql);
                                if ($movie_result->num_rows > 0) {
                                    while ($movie_row = $movie_result->fetch_assoc()) {
                                        echo "<option value='" . $movie_row['MovieID'] . "'>" . $movie_row['Title'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="show_date_time" class="form-label">Thời gian chiếu</label>
                            <input type="datetime-local" class="form-control" id="show_date_time" name="show_date_time"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu suất chiếu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa suất chiếu -->
    <div class="modal fade" id="editShowtimeModal" tabindex="-1" aria-labelledby="editShowtimeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editShowtimeModalLabel">Chỉnh sửa suất chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="showtimes.php" method="POST">
                        <input type="hidden" name="edit_showtime" value="1">
                        <input type="hidden" id="edit_showtime_id" name="showtime_id">
                        <div class="mb-3">
                            <label for="edit_movie_id" class="form-label">Phim</label>
                            <select class="form-select" id="edit_movie_id" name="movie_id" required>
                                <?php
                                // Lấy danh sách phim từ cơ sở dữ liệu
                                $movie_sql = "SELECT MovieID, Title FROM Movies";
                                $movie_result = $conn->query($movie_sql);
                                if ($movie_result->num_rows > 0) {
                                    while ($movie_row = $movie_result->fetch_assoc()) {
                                        echo "<option value='" . $movie_row['MovieID'] . "'>" . $movie_row['Title'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_show_date_time" class="form-label">Thời gian chiếu</label>
                            <input type="datetime-local" class="form-control" id="edit_show_date_time"
                                name="show_date_time" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xóa suất chiếu -->
    <div class="modal fade" id="deleteShowtimeModal" tabindex="-1" aria-labelledby="deleteShowtimeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteShowtimeModalLabel">Xóa suất chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa suất chiếu này không?</p>
                    <form action="showtimes.php" method="POST">
                        <input type="hidden" name="delete_showtime" value="1">
                        <input type="hidden" id="delete_showtime_id" name="showtime_id">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Điền dữ liệu vào modal chỉnh sửa suất chiếu
        var editShowtimeModal = document.getElementById('editShowtimeModal');
        editShowtimeModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var showtimeId = button.getAttribute('data-showtime-id');
            var movieId = button.getAttribute('data-movie-id');
            var showDateTime = button.getAttribute('data-show-date-time');

            var modalTitle = editShowtimeModal.querySelector('.modal-title');
            var editShowtimeIdInput = editShowtimeModal.querySelector('#edit_showtime_id');
            var editMovieIdSelect = editShowtimeModal.querySelector('#edit_movie_id');
            var editShowDateTimeInput = editShowtimeModal.querySelector('#edit_show_date_time');

            modalTitle.textContent = 'Chỉnh sửa suất chiếu ' + showtimeId;
            editShowtimeIdInput.value = showtimeId;
            editMovieIdSelect.value = movieId;
            editShowDateTimeInput.value = showDateTime;
        });

        // Điền dữ liệu vào modal xóa suất chiếu
        var deleteShowtimeModal = document.getElementById('deleteShowtimeModal');
        deleteShowtimeModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var showtimeId = button.getAttribute('data-showtime-id');

            var deleteShowtimeIdInput = deleteShowtimeModal.querySelector('#delete_showtime_id');
            deleteShowtimeIdInput.value = showtimeId;
        });
    </script>
</body>

</html>