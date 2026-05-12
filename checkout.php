<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$wishlist_id = $_GET['id'];

$query_item = mysqli_query($konek, "SELECT * FROM wishlist WHERE id = '$wishlist_id' AND user_id = '$user_id'");
$item = mysqli_fetch_assoc($query_item);

if (!$item) {
    header("Location: dashboard.php");
    exit;
}

$harga_barang = $item['harga'];

$query_tabungan = mysqli_query($konek, "SELECT SUM(nominal) AS total FROM tabungan WHERE user_id = '$user_id'");
$data_tabungan = mysqli_fetch_assoc($query_tabungan);
$total_tabungan = $data_tabungan['total'];

if ($total_tabungan >= $harga_barang) {
    $pengurangan = -$harga_barang;
    mysqli_query($konek, "INSERT INTO tabungan(user_id, nominal) VALUES('$user_id', '$pengurangan')");
    
    mysqli_query($konek, "UPDATE wishlist SET status = 'terwujud' WHERE id = '$wishlist_id'");
    
    header("Location: checkoutBerhasil.php");
} else {
    header("Location: checkoutGagal.php");
}
exit;
?>
