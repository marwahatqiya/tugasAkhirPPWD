<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'WishFund';

$konek = new mysqli($hostname, $username, $password, $database);
if ($konek->connect_error){
    die('YAhaha, gagal: ' . $konek->connect_error);
}
?>