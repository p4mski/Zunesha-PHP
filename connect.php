<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "nama_database"; // Ganti dengan nama database yang kamu pakai

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
