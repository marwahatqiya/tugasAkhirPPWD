<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$user = $_SESSION['user'];

// Mengambil data wishlist yang sudah dibeli
$queryHistory = mysqli_query($konek, "SELECT * FROM wishlist WHERE user_id = '$user_id' AND status = 'terwujud' ORDER BY id DESC");
if (!$queryHistory) {
    die("Query gagal: " . mysqli_error($konek));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Checkout - WishFund</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; }
        .sidebar { position: fixed; left: 0; top: 0; width: 250px; height: 100vh; background: #427AB5; padding: 20px; transition: 0.3s; z-index: 1000; }
        .logo { color: white; font-size: 28px; font-weight: bold; margin-bottom: 40px; }
        .menu a { display: flex; align-items: center; gap: 10px; text-decoration: none; color: white; padding: 14px; border-radius: 10px; margin-bottom: 10px; transition: 0.3s; }
        .menu a:hover { background: white; color: #427AB5; }
        .main { margin-left: 250px; padding: 30px; transition: 0.3s; min-height: 100vh; }
        .topbar { height: 70px; background: white; display: flex; align-items: center; justify-content: space-between; padding: 0 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .table-container { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .badge-success { background-color: #28a745; color: white; padding: 5px 10px; border-radius: 20px; font-size: 14px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">WishFund</div>
        <div class="menu">
            <a href="dashboard.php"><i class="bi bi-house-door"></i> Home</a>
            <a href="tambahWhislist.php"><i class="bi bi-plus-circle"></i> Tambah Wishlist</a>
            <a href="tambahTabungan.php"><i class="bi bi-wallet2"></i> Tambah Tabungan</a>
            <a href="riwayatCheckout.php" style="background: white; color: #427AB5;"><i class="bi bi-cart-check"></i> Riwayat Checkout</a>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <h5><i class="bi bi-clock-history"></i> Riwayat Checkout</h5>
            <div class="user-area">
                <span><i class="bi bi-person-circle"></i> <?= $user; ?></span>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (mysqli_num_rows($queryHistory) === 0) { ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada riwayat checkout.</td>
                        </tr>
                    <?php } else {
                        while ($data = mysqli_fetch_assoc($queryHistory)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($data['nama_barang']); ?></td>
                                <td>Rp <?= number_format($data['harga']); ?></td>
                                <td><span class="badge-success">Berhasil Dibeli</span></td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
