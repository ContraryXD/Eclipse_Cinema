<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">
    <style>
        .hero {
            position: relative;
            background-size: cover;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            width: 100%;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* Dark overlay */
        }

        .hero .text-center {
            position: relative;
            z-index: 1;
            /* Ensures text stays above overlay */
        }

        .movie-details {
            color: #333333;
        }

        .movie-details h2 {
            color: #000000;
        }

        .movie-details p {
            color: #555555;
        }

        .star-rating {
            position: relative;
            display: inline-block;
            color: #ffd700;
            width: 90px;
        }

        .star-rating .stars {
            position: relative;
            z-index: 1;
        }

        .star-rating .cover {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            background-color: #f2f6d0;
            z-index: 2;
        }
    </style>
</head>

<body>
    <?php include 'template/nav.php'; ?>
    <?php
    // kết nối
    include 'connection.php';

    // Lấy movie_id từ url
    $movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

    // select chi tiết phim
    $sql = "SELECT * FROM Movies WHERE MovieID = $movie_id";
    $result = $conn->query($sql);
    ?>
    <div class="hero"
        style="background: url('./public/assets/movies/movie_<?php echo $movie_id; ?>_1.jpg') no-repeat center center; background-size: cover;">
    </div>
    <div class="container mt-5 movie-details">
        <?php
        if ($result->num_rows > 0) {
            // Xuất dữ liệu của phim
            $row = $result->fetch_assoc();
            echo '<div class="row">';
            echo '    <div class="col-md-5">';
            echo '        <img src="public/assets/movies/' . $row["Image"] . '" class="img-fluid" alt="' . $row["Title"] . '">';
            echo '    </div>';
            echo '    <div class="col-md-5">';
            echo '        <h2>' . $row["Title"] . '</h2>';
            echo '        <p><strong>Thể loại:</strong> ' . $row["Genre"] . '</p>';
            echo '        <p><strong>Diễn viên:</strong> ' . $row["Cast"] . '</p>';
            echo '        <p><strong>Ngày phát hành:</strong> ' . $row["ReleaseDate"] . '</p>';
            echo '        <p><strong>Mô tả:</strong> ' . $row["Description"] . '</p>';
            echo '        <p><strong>Đánh giá:</strong>';
            echo '            <div class="star-rating">';
            echo '                <div class="stars">';
            for ($i = 0; $i < 5; $i++) {
                echo '<i class="fas fa-star"></i>';
            }
            echo '                </div>';
            $cover_width = (10 - $row["Rating"]) * 10;
            echo '                <div class="cover" style="width: ' . $cover_width . '%;"></div>';
            echo '            </div></p>';
            echo '        <p><strong>Giá vé:</strong> ' . number_format($row["Price"], 0, ',', '.') . ' VND</p>';
            echo '        <a href="booking.php?movie_id=' . $row["MovieID"] . '" class="btn btn-primary">Đặt vé ngay</a>';
            echo '        <div class="mt-4">';
            echo '            <h4>Trailer</h4>';
            echo '            <iframe width="684" height="385" src="https://www.youtube.com/embed/' . $row["TrailerURL"] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        } else {
            echo "<p class='text-center'>Không tìm thấy phim.</p>";
        }

        $conn->close();
        ?>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>