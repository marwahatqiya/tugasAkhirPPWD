<?php
session_start();
require "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($konek,
    "UPDATE wishlist SET status='dihapus' WHERE id='$id'"
);

$_SESSION['hapus'] = true;

header("Location: dashboard.php");
exit;
?>