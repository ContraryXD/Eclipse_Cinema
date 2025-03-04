<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">
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
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include './template/nav.php'; ?>
    <!-- hero -->
    <div class="hero">
        <div class="text-center">
            <h1>Eclipse Cinema</h1>
            <p class="lead">Đặt vé nhanh và dễ dàng.</p>
            <a href="booking.php" class="btn btn-primary btn-lg">Đặt ngay</a>
        </div>
    </div>
    <!-- content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đang chiếu</h2>
        <div class="row">
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'MovieDB');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch 3 random movies
            $sql = "SELECT * FROM Movies ORDER BY RAND() LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '    <div class="card">';
                    echo '        <img class="card-img-top" src="public/assets/movies/' . $row["Image"] . '" class="card-img-top" alt="' . $row["Title"] . '">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . $row["Title"] . '</h5>';
                    echo '            <p class="card-text">' . $row["Genre"] . '</p>';
                    echo '            <a href="details.php?movie_id=' . $row["MovieID"] . '" class="btn btn-primary">View Details</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Eclipse Cinema is your go-to destination for the latest movies and a great cinematic experience.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@eclipsecinema.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="mt-3">
                <p>&copy; 2025 Eclipse Cinema. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>