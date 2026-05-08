<?php
session_start();
require "koneksi.php";

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    $query = mysqli_query($konek, "INSERT INTO wishlist(user_id, nama_barang, harga, status) VALUES('$user_id', '$nama_barang', '$harga', 'belum')");

    if ($query) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Gagal tambah wishlist!";
    }
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wishlist - WishFund</title>

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

        /* Sidebar Style - Konsisten dengan Dashboard */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #427AB5;
            padding: 20px;
            transition: 0.3s;
            z-index: 100;
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
            min min-height: calc(100vh - 70px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Card Style */
        .card-box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
        }

        .card-box h3 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #427AB5;
            box-shadow: 0 0 0 0.25 margin-left;
            rgba(66, 122, 181, 0.25);
        }

        .btn-custom {
            background: #427AB5;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            width: 100%;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #356291;
            transform: translateY(-2px);
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
                <i class="bi bi-house-door"></i>
                Home
            </a>

            <a href="tambahWhislist.php">
                <i class="bi bi-plus-circle"></i>
                Tambah Wishlist
            </a>

            <a href="tambahTabungan.php">
                <i class="bi bi-wallet2"></i>
                Tambah Tabungan
            </a>

            <a href="checkout.php">
                <i class="bi bi-cart-check"></i>
                Checkout
            </a>
        </div>

    </div>

    <div class="main" id="main">
        <div class="topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="user-area">
                <h5><?= $user; ?></h5>
                <a href="logout.php">
                    <button class="logout-btn">Logout</button>
                </a>
            </div>
        </div>

        <div class="content">
            <div class="card-box">
                <h3>Tambah Wishlist</h3>

                <form action="" method="POST">
                    <div class="mb-1">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control"
                            placeholder="Masukkan nama barang impianmu" required>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Harga</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="border-radius: 10px 0 0 10px;">Rp</span>
                            <input type="number" name="harga" class="form-control" min="0" placeholder="Contoh: 50000"
                                style="margin-bottom:0; border-radius: 0 10px 10px 0;" required>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-custom">
                        <i class="bi bi-plus-circle me-2"></i> Add
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