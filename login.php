<?php
session_start();
require "koneksi.php";

$error = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($konek, "SELECT * FROM users WHERE name='$username'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        if (password_verify($password, $data['password'])) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['user'] = $data['name'];
            
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            /*body setinggi halaman */
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/pic1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .title {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--text-color);
            gap: 8px;
            padding: 16px;
        }

        .title h1 {
            font-size: var(--h1-size);
            font-weight: bold;
            margin: 0;
        }

        .title h2 {
            font-size: var(--h2-size);
            margin: 0;
        }

        .form-container {
            background-color: var(--primary-color);
            padding: 32px 64px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.669);
        }

        .form-control {
            width: 100%;
            margin: 0;
            padding: 0;
            padding: 8px 16px;
            background-color: var(--link-color);
            border: var(--highligh-color) solid 1.5px;
            color: var(--text-color) !important;
        }

        .form-floating label {
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: var(--link-color);
            outline: none;
            border-color: var(--highligh-color);
            box-shadow: 0 0 0 0.25rem rgba(251, 144, 185, 0.395);
        }

        .btn-primary {
            margin: 32px 0 0 0;
            width: 100%;
            background-color: var(--secondary-color);
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            color: var(--text-color);
        }

        .btn-primary:hover {
            background-color: var(--highligh-color);
        }

        .remember-container {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-color);
        }

        .remember-container #rememberMe {
            margin: 0;
        }

        .remember-container a {
            text-decoration: none;
            color: var(--highligh-color);
            font-size: var(--h5-size);
            margin: 4px 0 0 0;
        }

        .remember-container a:hover {
            color: var(--highligh-color);
        }

        .remember-me {
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            gap: 4px;
            font-size: var(--h5-size);
        }

        .divider {
            margin: 16px 0;
            border: none;
            border: 1px solid var(--highligh-color);
            display: flex;
            justify-content: center;
        }

        .btn-outline-primary {
            margin-top: 16px;
            width: 100%;
            display: flex;
            justify-content: center;
            border-color: var(--highligh-color);
            color: var(--text-color);
        }

        .bi-google {
            margin-right: 8px;
        }

        .btn-outline-primary:hover {
            border: none;
            background-color: var(--highligh-color);
        }

        .register p {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            gap: 8px;
            padding: 8px;
            font-size: var(--h4-size);
        }

        .register a {
            text-decoration: none;
            color: var(--highligh-color);
        }

        .register a:hover {
            color: var(--highligh-color);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="title">
            <h1>Login</h1>
            <p>Enter your email and password to continue</p>
        </div>
        <form action="login.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username">
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php } ?>
            <button type="submit" name="login" class="btn btn-primary"><b>Sign In</b></button>
        </form>

        <div class="remember-container">
            <label class="remember-me">
                <input type="checkbox" id="rememberMe">
                <label for="rememberMe">Remember me</label>
            </label>

            <a href="#">Need Help?</a>
        </div>

        <hr class="divider">

        <button type="button" class="btn btn-outline-primary ">
            <i class="bi bi-google"></i> Login with Google
        </button>

        <div class="register">
            <p>New in Movix? <a href="register.php">Register</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>