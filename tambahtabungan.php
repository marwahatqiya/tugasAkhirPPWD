<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['id'];
    $nominal = $_POST['nominal'];

    // Menambah data ke tabel tabungan
    $query = mysqli_query($konek, "INSERT INTO tabungan(user_id, nominal) VALUES('$user_id', '$nominal')");

    if ($query) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Gagal menambah tabungan!";
    }
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tabungan - WishFund</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #427AB5;
            padding: 20px;
            transition: 0.3s;
            z-index: 1000;
        }

        .sidebar.hide {
            left: -250px;
        }

        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: white;
            color: #427AB5;
        }

        .main {
            margin-left: 250px;
            transition: 0.3s;
            min-height: 100vh;
        }

        .main.full {
            margin-left: 0;
        }

        .topbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .toggle-btn {
            border: none;
            background: none;
            font-size: 24px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: #427AB5;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .content {
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
        }

        .card-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .btn-custom {
            background: #427AB5;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #356291;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">

        <div class="logo">
            WishFund
        </div>

        <div class="menu">
            <a href="dashboard.php">
                <i class="bi bi-house-door"></i> Home
            </a>

            <a href="tambahWhislist.php">
                <i class="bi bi-plus-circle"></i> Tambah Wishlist
            </a>

            <a href="tambahTabungan.php" class="active">
                <i class="bi bi-wallet2"></i> Tambah Tabungan
            </a>

            <a href="riwayatCheckout.php">
                <i class="bi bi-cart-check"></i> Riwayat Checkout
            </a>
        </div>

    </div>

    <div class="main" id="main">

        <div class="topbar">

            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="user-area">
                <h5>
                    <i class="bi bi-person-circle"></i> <?= $user; ?>
                </h5>

                <a href="logout.php">
                    <button class="logout-btn">
                        Logout
                    </button>
                </a>
            </div>

        </div>

        <div class="content">

            <div class="card-box">
                <h3 class="text-center mb-4">Tambah Tabungan</h3>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <?= $error; ?>
                    </div>
                <?php } ?>

                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Nominal Menabung</label>

                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            <input type="number" name="nominal" class="form-control" placeholder="Contoh: 10000"
                                required>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-custom">
                        <i class="bi bi-plus-circle me-2"></i>
                        Simpan Tabungan
                    </button>

                </form>
            </div>

        </div>
    </div>
    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("hide");
            document.getElementById("main").classList.toggle("full");
        }
    </script>
</body>

</html>