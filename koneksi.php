<?php
$server   = "localhost";      // Server database
$username = "root";           // Username MySQL
$password = "";               // Password MySQL (kosong jika pakai XAMPP)
$database = "supermarket";    // Nama database

// Membuat koneksi
$konek = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$konek) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
