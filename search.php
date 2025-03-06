<?php
session_start();
include 'connection.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if ($query) {
    $search_query = "SELECT * FROM Movies WHERE Title LIKE '%$query%' OR Genre LIKE '%$query%' OR Description LIKE '%$query%'";
    $search_result = mysqli_query($conn, $search_query);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
    </style>
</head>

<body>
    <?php include 'template/nav.php'; ?>
    <div class="hero">
        <div class="overlay"></div>
        <div class="content text-center">
            <h1>Eclipse Cinema</h1>
            <h2 class="text-center mb-4">Kết quả tìm kiếm: "<?php echo htmlspecialchars($query); ?>"</h2>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php
            if ($query && $search_result && mysqli_num_rows($search_result) > 0) {
                while ($row = mysqli_fetch_assoc($search_result)) {
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
                echo '<div class="col-12">';
                echo '    <div class="alert alert-warning" role="alert">No results found for "' . htmlspecialchars($query) . '"</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>