<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- <link href="./public/css/style.css" rel="stylesheet"> -->
    <style>
        .hero {
            position: relative;
            background: url("./public/assets/poster_2.jpg") no-repeat center center;
            background-size: cover;
            height: 100vh;
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

        .card-img-top {
            height: 800px;
            object-fit: cover;
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar {
            transition: background-color 0.5s ease, border 0.5s ease;
            background-color: rgba(68, 54, 39, 0.3);
            border: 2px solid transparent;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);

            /* Translucent */
        }

        .navbar.scrolled {
            background-color: rgba(41, 32, 23) !important;
            /* Solid with white outline */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #d98324;
        }

        .navbar-light .navbar-brand {
            color: #d98324;
        }

        .btn-outline-success {
            color: #d98324;
            border-color: #d98324;
        }

        .btn-outline-success:hover {
            background-color: #d98324;
            border-color: #d98324;
        }

        .btn-primary {
            background-color: #d98324;
            border-color: #d98324;
        }

        .btn-primary:hover {
            background-color: #443627;
            border-color: #443627;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #d98324;
        }

        p,
        .card-text {
            color: #ffffff;
        }

        .btn-circle.btn-lg {
            width: 40px;
            height: 40px;
            padding: 0;
            font-size: 18px;
            line-height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: none;
            color: #ffffff;
        }

        .btn-circle.btn-lg:hover i {
            color: #d98324;
        }

        .form-control {
            height: 40px;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #ffffff;
            opacity: 1;
        }

        .form-control:focus {
            color: #000000;
        }

        .footer {
            background-color: #443627;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: #d98324;
        }
    </style>
</head>

<body>
    <!-- Thanh điều hướng -->
    <?php include './template/nav.php'; ?>
    <!-- hero -->
    <div class="hero">
        <div class="text-center">
            <h1>Eclipse Cinema</h1>
            <p class="lead">Đặt vé nhanh và dễ dàng.</p>
            <a href="booking.php" class="btn btn-primary btn-lg">Đặt ngay</a>
        </div>
    </div>
    <!-- nội dung -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đang chiếu</h2>
        <div class="row">
            <?php
            // Kết nối cơ sở dữ liệu
            $conn = new mysqli('localhost', 'root', '', 'MovieDB');

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Lấy 3 phim ngẫu nhiên
            $sql = "SELECT * FROM Movies ORDER BY RAND() LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Xuất dữ liệu của từng hàng
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '    <div class="card">';
                    echo '        <img class="card-img-top" src="public/assets/movies/' . $row["Image"] . '" class="card-img-top" alt="' . $row["Title"] . '">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . $row["Title"] . '</h5>';
                    echo '            <p class="card-text">' . $row["Genre"] . '</p>';
                    echo '            <a href="details.php?movie_id=' . $row["MovieID"] . '" class="btn btn-primary">Xem chi tiết</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "Không có kết quả";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <!-- chân trang -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>Eclipse Cinema là hệ thống đặt vé cho những bộ phim mới nhất và trải nghiệm điện ảnh tuyệt vời.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: huynhhuuloc81206@gmail.com</p>
                    <p>Điện thoại: 0901 020 761</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="mt-3">
                <p>&copy; 2025 Eclipse Cinema</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>