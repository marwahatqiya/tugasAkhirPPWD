<?php
session_start();
require "koneksi.php";

$id = $_GET['id'];

mysqli_query($konek, "DELETE FROM wishlist WHERE id='$id'");

$_SESSION['hapus'] = true;

header("Location: dashboard.php");
exit;
?>