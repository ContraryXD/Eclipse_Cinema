<?php
session_start();
ob_start();

if (isset($_SESSION['user'])) {
    header('Location: account.php');
    exit();
}

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
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
            $login_error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
        }
    } elseif (isset($_POST['signup'])) {
        $username = trim($_POST['new_username']);
        $email = trim($_POST['new_email']);
        $password = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);

        // Check if username or email already exists
        $sql = "SELECT * FROM Users WHERE UserName = ? OR Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $signup_error = 'Tên đăng nhập hoặc email đã tồn tại!';
        } else {
            // Insert new user
            $sql = "INSERT INTO Users (UserName, Email, Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                $signup_success = 'Đăng ký thành công. Bạn có thể đăng nhập ngay bây giờ.';
            } else {
                $signup_error = 'Lỗi: ' . $stmt->error;
            }

            $stmt->close();
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập & Đăng ký</title>
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

    .auth-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        max-width: 800px;
        margin: auto;
    }

    .auth-form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 48%;
    }

    .auth-form h2 {
        color: #d98324;
        margin-bottom: 20px;
    }

    .auth-form .form-control {
        border-radius: 5px;
        color: black;
        /* Ensure text color is black */
    }

    .auth-form .btn {
        width: 100%;
        border-radius: 5px;
    }

    .auth-form .alert {
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #d98324;
        border-color: #d98324;
    }

    .btn-primary:hover {
        background-color: #443627;
        border-color: #443627;
    }
    </style>
</head>

<body>
    <?php include 'template/nav.php'; ?>
    <div class="hero">
        <div class="overlay"></div>
        <div class="content text-center">
            <h1>Eclipse Cinema</h1>
            <p class="lead fs-2">Đăng nhập & Đăng ký</p>
        </div>
    </div>
    <div class="auth-container mt-5">
        <div class="auth-form">
            <h2 class="text-center">Đăng nhập</h2>
            <?php if (isset($login_error)) { ?>
            <div class="alert alert-danger" role="alert"><?php echo $login_error; ?></div>
            <?php } ?>
            <form method="post" action="login.php">
                <input type="hidden" name="login" value="1">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
        <div class="auth-form">
            <h2 class="text-center">Đăng ký</h2>
            <?php if (isset($signup_error)) { ?>
            <div class="alert alert-danger" role="alert"><?php echo $signup_error; ?></div>
            <?php } elseif (isset($signup_success)) { ?>
            <div class="alert alert-success" role="alert"><?php echo $signup_success; ?></div>
            <?php } ?>
            <form method="post" action="login.php">
                <input type="hidden" name="signup" value="1">
                <div class="mb-3">
                    <label for="new_username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="new_username" name="new_username" required>
                </div>
                <div class="mb-3">
                    <label for="new_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="new_email" name="new_email" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="submit" class="btn btn-success">Đăng ký</button>
            </form>
        </div>
    </div>
    <?php include 'template/footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>