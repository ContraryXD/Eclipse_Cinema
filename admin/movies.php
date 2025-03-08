<?php
session_start();

// Kiểm tra xem admin đã đăng nhập chưa
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../connection.php';

// Xử lý form thêm mới phim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_movie'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $duration = $_POST['duration'];
    $rating = $_POST['rating'];

    // Thêm mới phim vào cơ sở dữ liệu
    $sql = "INSERT INTO Movies (Title, Genre, ReleaseDate, Duration, Rating) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $title, $genre, $release_date, $duration, $rating);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý phim
        header('Location: movies.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý form chỉnh sửa phim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_movie'])) {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $duration = $_POST['duration'];
    $rating = $_POST['rating'];

    // Cập nhật phim trong cơ sở dữ liệu
    $sql = "UPDATE Movies SET Title = ?, Genre = ?, ReleaseDate = ?, Duration = ?, Rating = ? WHERE MovieID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $title, $genre, $release_date, $duration, $rating, $movie_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý phim
        header('Location: movies.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý xóa phim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_movie'])) {
    $movie_id = $_POST['movie_id'];

    // Xóa phim khỏi cơ sở dữ liệu
    $sql = "DELETE FROM Movies WHERE MovieID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movie_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý phim
        header('Location: movies.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Lấy danh sách phim từ cơ sở dữ liệu
$sql = "SELECT * FROM Movies";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim</title>
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
                <h1 class="text-center">Quản lý phim</h1>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newMovieModal">
                        <i class="bi bi-plus-circle"></i> Thêm phim mới
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Mã phim</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Ngày phát hành</th>
                            <th scope="col">Thời lượng</th>
                            <th scope="col">Đánh giá</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['MovieID'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['Genre'] . "</td>";
                                echo "<td>" . $row['ReleaseDate'] . "</td>";
                                echo "<td>" . $row['Duration'] . "</td>";
                                echo "<td>" . $row['Rating'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editMovieModal' data-movie-id='" . $row['MovieID'] . "' data-title='" . $row['Title'] . "' data-genre='" . $row['Genre'] . "' data-release-date='" . $row['ReleaseDate'] . "' data-duration='" . $row['Duration'] . "' data-rating='" . $row['Rating'] . "'><i class='bi bi-pencil'></i> Sửa</button>";
                                echo "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteMovieModal' data-movie-id='" . $row['MovieID'] . "'><i class='bi bi-trash'></i> Xóa</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Không tìm thấy phim nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- New Movie Modal -->
    <div class="modal fade" id="newMovieModal" tabindex="-1" aria-labelledby="newMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMovieModalLabel">Thêm phim mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="movies.php" method="POST">
                        <input type="hidden" name="add_movie" value="1">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Thể loại</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Ngày phát hành</label>
                            <input type="date" class="form-control" id="release_date" name="release_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Thời lượng (phút)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Đánh giá</label>
                            <input type="number" step="0.1" class="form-control" id="rating" name="rating" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu phim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Movie Modal -->
    <div class="modal fade" id="editMovieModal" tabindex="-1" aria-labelledby="editMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMovieModalLabel">Chỉnh sửa phim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="movies.php" method="POST">
                        <input type="hidden" name="edit_movie" value="1">
                        <input type="hidden" id="edit_movie_id" name="movie_id">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_genre" class="form-label">Thể loại</label>
                            <input type="text" class="form-control" id="edit_genre" name="genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_release_date" class="form-label">Ngày phát hành</label>
                            <input type="date" class="form-control" id="edit_release_date" name="release_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_duration" class="form-label">Thời lượng (phút)</label>
                            <input type="number" class="form-control" id="edit_duration" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_rating" class="form-label">Đánh giá</label>
                            <input type="number" step="0.1" class="form-control" id="edit_rating" name="rating" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Movie Modal -->
    <div class="modal fade" id="deleteMovieModal" tabindex="-1" aria-labelledby="deleteMovieModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMovieModalLabel">Xóa phim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa phim này không?</p>
                    <form action="movies.php" method="POST">
                        <input type="hidden" name="delete_movie" value="1">
                        <input type="hidden" id="delete_movie_id" name="movie_id">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Điền dữ liệu vào modal chỉnh sửa phim
        var editMovieModal = document.getElementById('editMovieModal');
        editMovieModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var movieId = button.getAttribute('data-movie-id');
            var title = button.getAttribute('data-title');
            var genre = button.getAttribute('data-genre');
            var releaseDate = button.getAttribute('data-release-date');
            var duration = button.getAttribute('data-duration');
            var rating = button.getAttribute('data-rating');

            var modalTitle = editMovieModal.querySelector('.modal-title');
            var editMovieIdInput = editMovieModal.querySelector('#edit_movie_id');
            var editTitleInput = editMovieModal.querySelector('#edit_title');
            var editGenreInput = editMovieModal.querySelector('#edit_genre');
            var editReleaseDateInput = editMovieModal.querySelector('#edit_release_date');
            var editDurationInput = editMovieModal.querySelector('#edit_duration');
            var editRatingInput = editMovieModal.querySelector('#edit_rating');

            modalTitle.textContent = 'Chỉnh sửa phim ' + title;
            editMovieIdInput.value = movieId;
            editTitleInput.value = title;
            editGenreInput.value = genre;
            editReleaseDateInput.value = releaseDate;
            editDurationInput.value = duration;
            editRatingInput.value = rating;
        });

        // Điền dữ liệu vào modal xóa phim
        var deleteMovieModal = document.getElementById('deleteMovieModal');
        deleteMovieModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var movieId = button.getAttribute('data-movie-id');

            var deleteMovieIdInput = deleteMovieModal.querySelector('#delete_movie_id');
            deleteMovieIdInput.value = movieId;
        });
    </script>
</body>

</html>