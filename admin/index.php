<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-3">
                <a href="orders.php" class="btn btn-primary w-100 mb-3">Orders</a>
            </div>
            <div class="col-md-3">
                <a href="movies.php" class="btn btn-primary w-100 mb-3">Movies</a>
            </div>
            <div class="col-md-3">
                <a href="users.php" class="btn btn-primary w-100 mb-3">Users</a>
            </div>
            <div class="col-md-3">
                <a href="logout.php" class="btn btn-danger w-100 mb-3">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>