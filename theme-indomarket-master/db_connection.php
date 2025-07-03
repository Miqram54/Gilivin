<?php
$servername = "localhost";
$username = "root";   // Ganti dengan username MySQL
$password = "";       // Ganti dengan password MySQL
$dbname = "user_register";  // Ganti dengan nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
