<?php
session_start();
require "koneksi.php";

//mengecek tombol register jika ditekan
if (isset($_POST['register'])) {
    // mengirim data menggunakan metode post
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // mengecek pasword yang dimasukan
    if ($password != $confirm) {
        $_SESSION['error'] = "Password tidak sama!";
        header("Location: register.php");
        exit;
    } else {
        // mengecek email sudah dipakai atau belum
        $cek = mysqli_query(
            $konek,
            "SELECT * FROM users WHERE email='$email'"
        );
        // kalo email sudah digunakan
        if (mysqli_num_rows($cek) > 0) {
            $_SESSION['error'] = "Email sudah digunakan!";
            header("Location: register.php");
            exit;
        } else {
            // mengacak data pw sebelum disimpan
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // menyimpan data baru
            $query = "INSERT INTO users(email, name, password)
              VALUES('$email', '$username', '$hash')";

            // menjalankan query
            if (mysqli_query($konek, $query)) {
                $_SESSION['success'] = "Register berhasil! Silakan login.";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat registrasi!";
                header("Location: register.php");
                exit;
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
            --secondary-color: #356291;
            --link-color: #f5f5f5;
            --text-color: #FFE8BE;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--link-color);
        }

        .container-login {
            width: 100%;
            height: 100vh;
            display: flex;
        }

        /* LEFT SIDE */
        .left-side {
            width: 40%;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: white;
        }

        .form-container {
            width: 80%;
            max-width: 400px;
        }

        .title h1 {
            font-size: 42px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .title p {
            color: gray;
            margin-bottom: 30px;
        }

        .form-control {
            height: 55px;
            border-radius: 12px;
        }

        .btn-primary {
            height: 50px;
            border-radius: 12px;
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .register {
            margin-top: 20px;
            text-align: center;
        }

        /* RIGHT SIDE */
        .right-side {
            width: 60%;
            height: 100vh;

            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('img/pic1.png');
            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay {
            text-align: center;
            color: white;
        }

        .overlay h1 {
            font-size: 60px;
            font-weight: bold;
        }

        .overlay p {
            font-size: 20px;
        }
    </style>
</head>

<body>

    <!-- yang membungkus semua halaman register -->
    <div class="container-login">

        <!-- LEFT seluruh bagian kiri -->
        <div class="left-side">

            <!-- bungkus isi form -->
            <div class="form-container">

                <div class="title">
                    <!-- megecek apakah ada pesan eror dr session -->
                    <?php
                    if (isset($_SESSION['error'])) {
                        // menampilkan pesan error
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        // supaya pesan hilang setelah di refresh
                        unset($_SESSION['error']);
                    }

                    // untuk pesan berhasil
                    if (isset($_SESSION['success'])) {
                        // bootstrap alert warna ijo
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>
                    <!-- judul halaman -->
                    <h1>Register</h1>
                    <p>Create your WishFund account</p>
                </div>

                <!-- form register -->
                <form action="" method="POST">

                    <!-- ngebuat kotak email melayang -->
                    <div class="form-floating mb-3">

                        <!-- input email kalo ada required wajib isi sebelum submit-->
                        <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email"
                            required>
                        <label for="floatingEmail">
                            Email</label>

                    </div>

                    <div class="form-floating mb-3">

                        <input type="text" name="username" class="form-control" id="floatingUsername"
                            placeholder="Username" maxlength="20" required>
                        <label for="floatingUsername">
                            Username</label>

                    </div>

                    <div class="form-floating mb-3">

                        <input type="password" name="password" class="form-control" id="floatingPassword"
                            placeholder="Password" required>
                        <label for="floatingPassword">
                            Password</label>

                    </div>

                    <div class="form-floating mb-3">

                        <input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword"
                            placeholder="Confirm Password" required>
                        <label for="floatingConfirmPassword">
                            Confirm Password </label>

                    </div>

                    <!-- tombol register, tombol bts warna biru lebar tombol 100% -->
                    <button type="submit" name="register" class="btn btn-primary w-100">
                        <b>Sign Up</b>
                    </button>

                </form>

                <div class="register">

                    <!-- tombol login -->
                    <p>Already have an account?<a href="login.php">Login</a></p>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="right-side">

            <!-- lapisan transparan diatas background -->
            <div class="overlay">
                <h1>WishFund</h1>

                <p>Save your dreams one step at a time</p>

            </div>

        </div>

    </div>

</body>

</html>