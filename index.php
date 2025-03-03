<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclipse Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #F2F6D0;
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

    .hero {
        position: relative;
        background: url('./public/assets/poster_2.jpg') no-repeat center center;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #D98324;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
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
        transition: background-color 0.5s ease;
        background-color: rgba(68, 54, 39, 0.3);
        /* Translucent */
    }

    .navbar.scrolled {
        background-color: rgba(41, 32, 23, 0.9) !important;
        /* Solid */
    }

    .navbar-light .navbar-nav .nav-link {
        color: #FFFFFF;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #D98324;
    }

    .navbar-light .navbar-brand {
        color: #D98324;
    }

    .btn-outline-success {
        color: #D98324;
        border-color: #D98324;
    }

    .btn-outline-success:hover {
        background-color: #D98324;
        border-color: #D98324;
    }

    .btn-primary {
        background-color: #D98324;
        border-color: #D98324;
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
        color: #D98324;
    }

    p,
    .card-text {
        color: #FFFFFF;
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
        color: #FFFFFF;
    }

    .btn-circle.btn-lg:hover i {
        color: #D98324;
    }

    .form-control {
        height: 40px;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
    }

    .form-control::placeholder {
        color: #FFFFFF;
        opacity: 1;
    }

    .form-control:focus {
        color: #000000;
    }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="content">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fs-2 fw-bold" href="#">Eclipse Cinema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Movies
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Now Showing</a></li>
                                <li><a class="dropdown-item" href="#">Coming Soon</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                    <form class="d-flex ms-3">
                        <input class="form-control me-2 border-0" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-circle btn-lg" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i> Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="hero">
            <div class="text-center">
                <h1>Eclipse Cinema</h1>
                <p class="lead">Đặt vé nhanh và dễ dàng.</p>
                <a href="booking.php" class="btn btn-primary btn-lg">Đặt ngay</a>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text-center mb-4">Now Showing</h2>
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
                        echo '        <img src="public/assets/' . $row["Image"] . '" class="card-img-top" alt="' . $row["Title"] . '">';
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    </script>
</body>

</html>