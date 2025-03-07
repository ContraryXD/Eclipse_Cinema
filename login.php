<?php
session_start();
ob_start();

if (isset($_SESSION['user'])) {
    header('Location: account.php');
    exit();
}

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM Users WHERE UserName = '$username' AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['UserName'];
        $_SESSION['id'] = $row['UserID'];
        echo "<script type='text/javascript'>
                alert('Đăng nhập thành công!');
                window.location.href = 'account.php';
              </script>";
        exit();
    } else {
        $error_message = 'Tên đăng nhập hoặc mật khẩu không đúng!';
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
            <p class="lead fs-2">Đăng nhập</p>
        </div>
    </div>
    <div class="login-container mt-5">
        <h2 class="text-center">Đăng nhập</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
        <?php } ?>
        <form class="login" method="post" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>