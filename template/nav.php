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
                    <a class="nav-link active" aria-current="page" href="./">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"> Movies </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="movies.php">All Movies</a></li>
                        <?php
                        // Include the database connection file
                        include 'connection.php';

                        // Fetch distinct genres from the Movies table
                        $sql = "SELECT DISTINCT Genre FROM Movies";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // các thể loại phim
                            while ($row = $result->fetch_assoc()) {
                                echo '<li><a class="dropdown-item" href="movies.php?genre=' . urlencode($row["Genre"]) . '">' . $row["Genre"] . '</a></li>';
                            }
                        } else {
                            echo '<li><a class="dropdown-item" href="#">No genres available</a></li>';
                        }

                        $conn->close();
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
            <form class="d-flex ms-3" method="GET" action="search.php">
                <input class="form-control me-2 border-0" type="search" name="query" placeholder="Search"
                    aria-label="Search" required />
                <button class="btn btn-circle btn-lg" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-user"></i>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
                        } else {
                            echo 'Login';
                        }
                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>