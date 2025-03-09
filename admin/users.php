<?php
session_start();

// Kiểm tra xem admin đã đăng nhập chưa
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include '../connection.php';

// Xử lý form thêm mới người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Thêm mới người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO Users (UserName, Email, Password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý người dùng
        header('Location: users.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý form chỉnh sửa người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cập nhật người dùng trong cơ sở dữ liệu
    $sql = "UPDATE Users SET UserName = ?, Email = ?, Password = ? WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $password, $user_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý người dùng
        header('Location: users.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Xử lý xóa người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // Xóa người dùng khỏi cơ sở dữ liệu
    $sql = "DELETE FROM Users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Chuyển hướng đến trang quản lý người dùng
        header('Location: users.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Lấy danh sách người dùng từ cơ sở dữ liệu
$sql = "SELECT UserID, UserName, Email FROM Users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'top.html'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'side.html'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="text-center">Quản lý người dùng</h1>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newUserModal">
                        <i class="bi bi-plus-circle"></i> Thêm người dùng mới
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Mã người dùng</th>
                            <th scope="col">Tên người dùng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['UserID'] . "</td>";
                                echo "<td>" . $row['UserName'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editUserModal' data-user-id='" . $row['UserID'] . "' data-username='" . $row['UserName'] . "' data-email='" . $row['Email'] . "'><i class='bi bi-pencil'></i> Sửa</button>";
                                echo "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUserModal' data-user-id='" . $row['UserID'] . "'><i class='bi bi-trash'></i> Xóa</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Không tìm thấy người dùng nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal thêm người dùng mới -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Thêm người dùng mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="users.php" method="POST">
                        <input type="hidden" name="add_user" value="1">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye-slash"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu người dùng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa người dùng -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="users.php" method="POST">
                        <input type="hidden" name="edit_user" value="1">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="edit_password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleEditPassword"><i class="bi bi-eye-slash"></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xóa người dùng -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Xóa người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa người dùng này không?</p>
                    <form action="users.php" method="POST">
                        <input type="hidden" name="delete_user" value="1">
                        <input type="hidden" id="delete_user_id" name="user_id">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Điền dữ liệu vào modal chỉnh sửa người dùng
        var editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-user-id');
            var username = button.getAttribute('data-username');
            var email = button.getAttribute('data-email');

            var modalTitle = editUserModal.querySelector('.modal-title');
            var editUserIdInput = editUserModal.querySelector('#edit_user_id');
            var editUsernameInput = editUserModal.querySelector('#edit_username');
            var editEmailInput = editUserModal.querySelector('#edit_email');

            modalTitle.textContent = 'Chỉnh sửa người dùng ' + userId;
            editUserIdInput.value = userId;
            editUsernameInput.value = username;
            editEmailInput.value = email;
        });

        // Điền dữ liệu vào modal xóa người dùng
        var deleteUserModal = document.getElementById('deleteUserModal');
        deleteUserModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-user-id');

            var deleteUserIdInput = deleteUserModal.querySelector('#delete_user_id');
            deleteUserIdInput.value = userId;
        });

        // Toggle password visibility
        var togglePassword = document.getElementById('togglePassword');
        var password = document.getElementById('password');
        togglePassword.addEventListener('click', function() {
            if (password.type === 'password') {
                password.type = 'text';
                togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                password.type = 'password';
                togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        });

        var toggleEditPassword = document.getElementById('toggleEditPassword');
        var editPassword = document.getElementById('edit_password');
        toggleEditPassword.addEventListener('click', function() {
            if (editPassword.type === 'password') {
                editPassword.type = 'text';
                toggleEditPassword.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                editPassword.type = 'password';
                toggleEditPassword.innerHTML = '<i class="bi bi-eye-slash"> </i>';
            }
        });
    </script>
</body>

</html>