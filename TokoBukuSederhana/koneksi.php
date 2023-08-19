<?php
$host = 'localhost';
$user = 'root';
$password = '';
$databse = 'store_db';

$koneksi = mysqli_connect($host, $user, $password, $databse);

if (!$koneksi) {
    die("Could not connect to database : " . mysqli_connect_error());
}
?>
