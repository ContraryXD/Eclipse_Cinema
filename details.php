<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'MovieDB');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get movie_id from query parameter
        $movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;

        // Fetch movie details
        $sql = "SELECT * FROM Movies WHERE MovieID = $movie_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of the movie
            $row = $result->fetch_assoc();
            echo '<div class="row">';
            echo '    <div class="col-md-4">';
            echo '        <img src="public/assets/movies/' . $row["Image"] . '" class="img-fluid" alt="' . $row["Title"] . '">';
            echo '    </div>';
            echo '    <div class="col-md-8">';
            echo '        <h2>' . $row["Title"] . '</h2>';
            echo '        <p><strong>Genre:</strong> ' . $row["Genre"] . '</p>';
            echo '        <p><strong>Cast:</strong> ' . $row["Cast"] . '</p>';
            echo '        <p><strong>Release Date:</strong> ' . $row["ReleaseDate"] . '</p>';
            echo '        <p><strong>Vietnamese Description:</strong> ' . $row["Description"] . '</p>';
            echo '        <a href="booking.php?movie_id=' . $row["MovieID"] . '" class="btn btn-primary">Book Now</a>';
            echo '        <div class="mt-4">';
            echo '            <h4>Trailer</h4>';
            echo '            <iframe width="560" height="315" src="https://www.youtube.com/embed/' . $row["TrailerURL"] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        } else {
            echo "<p>Movie not found.</p>";
        }


        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>