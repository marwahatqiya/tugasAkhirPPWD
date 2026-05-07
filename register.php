<?php
require "koneksi.php";

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password != $confirm) {
        echo "Password tidak sama!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $cek = mysqli_query(
            $konek,
            "SELECT * FROM users WHERE email='$email'"
        );

        if (mysqli_num_rows($cek) > 0) {
            echo "Email sudah digunakan!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users(email, name, password)
              VALUES('$email', '$username', '$hash')";

            if (mysqli_query($konek, $query)) {
                header("Location: login.php");
                exit;
            } else {
                echo mysqli_error($konek);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #427AB5;
            --secondary-color: #406AAF;
            --link-color: #F7DD7D;
            --text-color: #FFE8BE;

            --h1-size: 32px;
            --h2-size: 24px;
            --h4-size: 16px;
            --h5-size: 14px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="title">
            <h1>Register</h1>
            <p>Enter your email and password to continue</p>
        </div>
        <form action="" method="POST">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username"
                    required>
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword"
                    placeholder="Confirm Password" required>
                <label for="floatingConfirmPassword">Confirm Password</label>
            </div>
            <button type="submit" name="register" class="btn btn-primary"><b>Sign Up</b></button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>