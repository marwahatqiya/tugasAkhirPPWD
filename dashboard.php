<?php
session_start();
require "koneksi.php";

$user_id = $_SESSION['id'];

$queryTabungan = mysqli_query($konek, "SELECT SUM(nominal) AS total FROM tabungan WHERE user_id = '$user_id'");

$dataTabungan = mysqli_fetch_assoc($queryTabungan);

$totalTabungan = $dataTabungan['total'];

$dataWishlist = mysqli_query($konek, "SELECT * FROM wishlist WHERE user_id = '$user_id' AND status = 'belum'");

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WishFund</title>

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

        .menu a:hover {
            background: white;
            color: #427AB5;
        }

        .main {
            margin-left: 250px;
            transition: 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            padding-bottom: 120px;
            flex: 1;
        }

        .wishlist-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .wishlist-card {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 12px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .wishlist-info h4 {
            margin: 0;
            font-size: 22px;
        }

        .wishlist-info h5 {
            margin-top: 8px;
            color: #427AB5;
        }

        .cart-icon {
            font-size: 24px;
            color: #427AB5;
            cursor: pointer;
            transition: 0.2s;
        }

        .cart-icon:hover {
            transform: scale(1.05);
            color: #356291;
        }

        .custom-alert {
            position: fixed;

            top: 20px;
            left: 270px;
            right: 20px;

            z-index: 2000;

            transition: 0.3s;
        }

        .custom-alert.full {
            left: 20px;
        }

        .delete-icon {
            font-size: 22px;
            color: gray;
            transition: 0.2s;
        }

        .delete-icon:hover {
            color: #dc3545;
            transform: scale(1.05);
        }

        /* Footer Style for Total Tabungan */
        .footer-savings {
            position: fixed;
            bottom: 0;
            right: 0;
            left: 250px;
            width: calc(100% - 250px);

            background: white;
            padding: 20px 30px;
            border-top: 2px solid #ddd;

            display: flex;
            justify-content: space-between;
            align-items: center;

            font-size: 22px;
            font-weight: bold;

            z-index: 999;
            transition: 0.3s;
        }

        .footer-savings.full {
            left: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['hapus'])) { ?>

        <div class="custom-alert" id="customAlert">

            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                Wishlist berhasil dihapus!

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>

        </div>

        <?php unset($_SESSION['hapus']); ?>
    <?php } ?>

    <div class="sidebar" id="sidebar">

        <div class="logo">
            WishFund
        </div>

        <div class="menu">
    <a href="dashboard.php"><i class="bi bi-house-door"></i> Home</a>
    <a href="tambahWhislist.php"><i class="bi bi-plus-circle"></i> Tambah Wishlist</a>
    <a href="tambahTabungan.php"><i class="bi bi-wallet2"></i> Tambah Tabungan</a>
    <a href="riwayatCheckout.php"><i class="bi bi-cart-check"></i> Riwayat Checkout</a>
</div>

    </div>

    <div class="main" id="main">

        <div class="topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="user-area">
                <h5><i class="bi bi-person-circle"></i> <?= $user; ?></h5>

                <a href="logout.php">
                    <button class="logout-btn">
                        Logout
                    </button>
                </a>
            </div>
        </div>

        <div class="content">
            <div class="wishlist-container">

                <?php while ($data = mysqli_fetch_assoc($dataWishlist)) { ?>

                    <div class="card-box wishlist-card">
                        <div class="wishlist-info">
                            <h4>
                                <?= $data['nama_barang']; ?>
                            </h4>
                            <h5>
                                Rp <?= number_format($data['harga']); ?>
                            </h5>
                            </div>
                            <div style="display:flex; gap:15px; align-items:center;">

                            <a href="Checkout.php?id=<?= $data['id']; ?>" class="cart-icon">
                               <i class="bi bi-cart-plus"></i>
                            </a>

                            <a href="konfirmasiHapus.php?id=<?= $data['id']; ?>" class="delete-icon">

                                <i class="bi bi-trash3-fill"></i>
                            </a>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="footer-savings" id="footerSavings">
        <h3>Total Tabungan</h3>

        <h1>Rp <?= number_format($totalTabungan); ?></h1>
    </div>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("hide");
            document.getElementById("main").classList.toggle("full");
            document.getElementById("footerSavings").classList.toggle("full");

            document.getElementById("customAlert")?.classList.toggle("full");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
