<?php
session_start();
require "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($konek, "SELECT * FROM wishlist WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Wishlist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: 'Segoe UI', sans-serif;
        }

        .hapus-card {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);

            text-align: center;
        }

        .hapus-card h3 {
            margin-bottom: 15px;
        }

        .hapus-card p {
            color: gray;
            margin-bottom: 25px;
        }

        .btn-hapus {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-batal {
            background: #427AB5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
    </style>
</head>

<body>

    <div class="hapus-card">

        <h3>Hapus Wishlist?</h3>

        <p>
            Yakin mau hapus
            <b><?= $data['nama_barang']; ?></b> ?
        </p>

        <div class="button-group">

            <a href="dashboard.php" class="btn-batal">
                Batal
            </a>

            <a href="hapusWishlist.php?id=<?= $data['id']; ?>" class="btn-hapus">
                Hapus
            </a>

        </div>

    </div>

</body>

</html>