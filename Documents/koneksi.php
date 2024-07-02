<?php

$host = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$db = "penjualan";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}else{
    // echo "Koneksi berhasil";
}
