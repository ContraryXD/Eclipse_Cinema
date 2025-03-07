<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id']; // Get user ID from session
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
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

        .content {
            position: relative;
            z-index: 2;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }

        .login-container h2 {
            color: #d98324;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #d98324;
            border-color: #d98324;
        }

        .btn-primary:hover {
            background-color: #443627;
            border-color: #443627;
        }

        .login input {
            color: black;
        }

        .table-container {
            margin-top: 30px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .details p {
            color: black;
            font-size: 19px;
        }
    </style>

</head>

<body>
    <?php include 'template/nav.php'; ?>
    <?php
    // csdl
    include 'connection.php';

    // thong tin user
    $user_query = "SELECT * FROM Users WHERE UserID = $user_id";
    $user_result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_result);

    // thong tin ve
    $booking_query = "
    SELECT 
        Bookings.BookingID, 
        Movies.Title AS MovieTitle, 
        Movies.Genre AS MovieGenre, 
        Movies.ReleaseDate AS MovieReleaseDate, 
        Theaters.Name AS TheaterName, 
        Theaters.Location AS TheaterLocation, 
        Showtimes.ShowDateTime,
        Bookings.Seats
    FROM Bookings 
    JOIN Showtimes ON Bookings.ShowtimeID = Showtimes.ShowtimeID 
    JOIN Movies ON Showtimes.MovieID = Movies.MovieID 
    JOIN Theaters ON Showtimes.TheaterID = Theaters.TheaterID 
    WHERE Bookings.UserID = $user_id";
    $booking_result = mysqli_query($conn, $booking_query);
    $bookings = mysqli_fetch_all($booking_result, MYSQLI_ASSOC);
    ?>
    <div class="hero">
        <div class="overlay"></div>
        <div class="content text-center">
            <h1>Eclipse Cinema</h1>
            <p class="fs-2">Xin chào <?php echo $user['UserName']  ?></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 details d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-5">Chi tiết người dùng</h1>
                    <p><strong>Username:</strong> <?php echo $user['UserName']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
                </div>
                <div>
                    <a href="logout.php" class="btn btn-danger" onclick="confirmLogout(event)"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        </div>
        <div class="row table-container">
            <div class="col-12">
                <h2>Vé đã đặt</h2>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Phim</th>
                            <th>Thể loại</th>
                            <th>Ngày ra mắt</th>
                            <th>Rạp</th>
                            <th>Địa điểm</th>
                            <th>Thời gian</th>
                            <th>Ghế ngồi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($bookings); $i++) { ?>
                            <tr>
                                <td><?php echo $bookings[$i]['BookingID']; ?></td>
                                <td><?php echo $bookings[$i]['MovieTitle']; ?></td>
                                <td><?php echo $bookings[$i]['MovieGenre']; ?></td>
                                <td><?php echo $bookings[$i]['MovieReleaseDate']; ?></td>
                                <td><?php echo $bookings[$i]['TheaterName']; ?></td>
                                <td><?php echo $bookings[$i]['TheaterLocation']; ?></td>
                                <td><?php echo $bookings[$i]['ShowDateTime']; ?></td>
                                <td><?php echo $bookings[$i]['Seats']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</body>

</html>