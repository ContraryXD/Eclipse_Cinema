<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt vé</title>
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

        .rounded-color-div {
            background-color: #d98324;
            border-radius: 15px;
            padding: 20px;
            color: white;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include 'template/nav.php'; ?>
    <div class="hero">
        <div class="overlay"></div>
        <div class="content text-center">
            <h1>Eclipse Cinema</h1>
            <p class="fs-2">Đặt vé phim</p>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đặt vé</h2>
        <?php
        // ket noi csdl
        include 'connection.php';

        // lay id phim tu url
        $movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

        // SELECT phim
        $sql = "SELECT * FROM Movies WHERE MovieID = $movie_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="row">';
            echo '    <div class="col-md-4">';
            echo '        <img src="public/assets/movies/' . $row["Image"] . '" class="img-fluid" alt="' . $row["Title"] . '">';
            echo '    </div>';
            echo '    <div class="col-md-8">';
            echo '        <h2>' . $row["Title"] . '</h2>';
            echo '        <p><strong>Thể loại:</strong> ' . $row["Genre"] . '</p>';
            echo '        <p><strong>Giá vé:</strong> ' . number_format($row["Price"], 0, ',', '.') . ' VND</p>';
            echo '        <form action="process_booking.php" method="POST">';
            echo '            <input type="hidden" name="movie_id" value="' . $row["MovieID"] . '">';
            echo '            <div class="mb-3">';
            echo '                <label for="cinema" class="form-label">Chọn rạp</label>';
            echo '                <select class="form-control" id="cinema" name="cinema" required>';
            echo '                    <option value="">Chọn rạp</option>';

            // Fetch cinemas
            $cinema_sql = "SELECT * FROM Theaters";
            $cinema_result = $conn->query($cinema_sql);
            if ($cinema_result->num_rows > 0) {
                while ($cinema_row = $cinema_result->fetch_assoc()) {
                    echo '<option value="' . $cinema_row["TheaterID"] . '">' . $cinema_row["Name"] . ' - ' . $cinema_row["Location"] . '</option>';
                }
            }

            echo '                </select>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="seats" class="form-label">Số lượng vé</label>';
            echo '                <input type="number" class="form-control" id="seats" name="seats" min="1" max="10" required>';
            echo '            </div>';
            echo '            <button type="submit" class="btn btn-primary">Đặt vé ngay</button>';
            echo '        </form>';
            echo '    </div>';
            echo '</div>';
        } else {
            echo "<p class='text-center'>Không tìm thấy phim.</p>";
        }

        $conn->close();
        ?>
        <div class="rounded-color-div">
            <p>Enjoy your movie experience at Eclipse Cinema!</p>
        </div>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>