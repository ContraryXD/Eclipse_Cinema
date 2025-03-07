<?php
session_start();

// Check da dang nhap chua
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
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
            background-color: #EFDCAB;
            border-radius: 15px;
            padding: 20px;
            color: white;
            text-align: center;
            margin-top: 20px;
        }

        .details p {
            color: black;
        }

        .payment input::placeholder {
            color: rgb(133, 133, 133);
        }

        .payment input {
            color: black;
        }

        .payment label {
            font-size: +2;
            font-weight: bold;
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
            $ticket_price = $row["Price"];
            echo '<div class="row">';
            echo '    <div class="col-md-4">';
            echo '        <img src="public/assets/movies/' . $row["Image"] . '" class="img-fluid" alt="' . $row["Title"] . '">';
            echo '    </div>';
            echo '    <div class="col-md-8 details">';
            echo '        <h2>' . $row["Title"] . '</h2>';
            echo '        <p><strong>Thể loại:</strong> ' . $row["Genre"] . '</p>';
            echo '        <p><strong>Giá vé:</strong> ' . number_format($ticket_price, 0, ',', '.') . ' VND</p>';
            echo '        <form action="process_booking.php" method="POST">';
            echo '            <input type="hidden" name="movie_id" value="' . $row["MovieID"] . '">';
            echo '            <div class="mb-3">';
            echo '                <label for="showtime_id" class="form-label fw-bold">Chọn suất chiếu</label>';
            echo '                <select class="form-control text-dark" id="showtime_id" name="showtime_id" required>';
            echo '                    <option value="">Chọn suất chiếu</option>';

            // xuất chiếu phim
            $showtime_sql = "SELECT Showtimes.ShowtimeID, Showtimes.ShowDateTime, Theaters.Name AS TheaterName FROM Showtimes JOIN Theaters ON Showtimes.TheaterID = Theaters.TheaterID WHERE Showtimes.MovieID = $movie_id";
            $showtime_result = $conn->query($showtime_sql);
            if ($showtime_result->num_rows > 0) {
                while ($showtime_row = $showtime_result->fetch_assoc()) {
                    echo '<option value="' . $showtime_row["ShowtimeID"] . '" data-theater="' . $showtime_row["TheaterName"] . '">' . $showtime_row["ShowDateTime"] . ' - ' . $showtime_row["TheaterName"] . '</option>';
                }
            }

            echo '                </select>';
            echo '            </div>';
            echo '            <div id="theater-info" class="mb-3"></div>';
            echo '            <div class="mb-3">';
            echo '                <label for="seats" class="form-label fw-bold">Số lượng vé</label>';
            echo '                <input type="number" class="form-control text-dark" id="seats" name="seats" min="1" max="10" style="width: 100px;" required>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="total_price" class="form-label fw-bold">Tổng tiền</label>';
            echo '                <input type="text" class="form-control text-dark" id="total_price" name="total_price" readonly>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="discount" class="form-label fw-bold">Giảm giá</label>';
            echo '                <input type="text" class="form-control text-dark" id="discount" name="discount" readonly>';
            echo '            </div>';
            echo '        <h3 class="mt-5">Thông tin thanh toán</h3>';
            echo '        <div class="payment">';
            echo '            <div class="mb-3">';
            echo '                <label for="card_number" class="form-label">Số thẻ</label>';
            echo '                <input type="text" class="form-control" id="card_number" name="card_number" required>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="card_name" class="form-label">Tên trên thẻ</label>';
            echo '                <input type="text" class="form-control" id="card_name" name="card_name" required>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="expiry_date" class="form-label">Ngày hết hạn</label>';
            echo '                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>';
            echo '            </div>';
            echo '            <div class="mb-3">';
            echo '                <label for="cvv" class="form-label">CVV</label>';
            echo '                <input type="text" class="form-control" id="cvv" name="cvv" required>';
            echo '            </div>';
            echo '            <button type="submit" class="btn btn-primary">Đặt vé ngay</button>';
            echo '      </div>';
            echo '        </form>';
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
    <script>
        document.getElementById('showtime_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var theaterInfo = selectedOption.getAttribute('data-theater');
            document.getElementById('theater-info').innerText = theaterInfo ? 'Rạp: ' + theaterInfo : '';
        });

        document.getElementById('seats').addEventListener('input', function() {
            var seats = parseInt(this.value);
            var ticketPrice = <?php echo $ticket_price; ?>;
            var discount = seats > 1 ? (seats - 1) * 0.02 : 0;
            var totalPrice = seats * ticketPrice * (1 - discount);
            document.getElementById('total_price').value = totalPrice.toLocaleString('vi-VN') + ' VND';
            document.getElementById('discount').value = (discount * 100).toFixed(2) + '%';
        });
    </script>
</body>

</html>