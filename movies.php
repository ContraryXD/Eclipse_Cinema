<?php
session_start();
// lấy thể loại từ url
$genre = isset($_GET['genre']) ? htmlspecialchars($_GET['genre']) : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">

    <style>
        .hero {
            position: relative;
            background: url("./public/assets/poster_2.jpg") no-repeat center center;
            background-size: cover;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d98324;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        body {
            background-color: #f2f6d0;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .card {
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-img-top {
            height: 500px;
            object-fit: cover;
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
            background-color: white;
            z-index: 2;
        }

        .btn {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include 'template/nav.php'; ?>
    <div class="hero">
        <div class="overlay"></div>
        <div class="content text-center">
            <h1>Eclipse Cinema</h1>
            <p class="fs-2"><?php echo $genre ?></p>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">
            <?php
            echo $genre ? "Phim: $genre" : "Tất cả phim";
            ?>
        </h2>
        <div class="row">
            <?php
            // Kết nối csdl
            include 'connection.php';

            // select dữ liệu dựa vào thể loại đã lấy hoặc lấy hết luon
            $sql = $genre ? "SELECT * FROM Movies WHERE Genre = '$genre'" : "SELECT * FROM Movies";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '    <div class="card">';
                    echo '        <img src="public/assets/movies/' . $row["Image"] . '" class="card-img-top" alt="' . $row["Title"] . '">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . $row["Title"] . '</h5>';
                    echo '            <p class="card-text text-dark">' . $row["Genre"] . '</p>';
                    echo '            <p class="card-text text-dark">' . number_format($row["Price"], 0, ',', '.') . ' VND</p>';
                    echo '            <div class="star-rating">';
                    echo '                <div class="stars">';
                    for ($i = 0; $i < 5; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '                </div>';
                    $cover_width = (10 - $row["Rating"]) * 10;
                    echo '                <div class="cover" style="width: ' . $cover_width . '%;"></div>';
                    echo '            </div>';
                    echo '            <div class="row mt-2">';
                    echo '                <div class="col-6">';
                    echo '                    <a href="details.php?movie_id=' . $row["MovieID"] . '" class="btn btn-primary">View Details</a>';
                    echo '                </div>';
                    echo '                <div class="col-6">';
                    echo '                    <a href="booking.php?movie_id=' . $row["MovieID"] . '" class="btn btn-success">Book Now</a>';
                    echo '                </div>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "<p class='text-center'>Không tìm thấy phim.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>