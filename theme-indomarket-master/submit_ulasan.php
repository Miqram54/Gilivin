<?php
// Periksa apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'username', 'password', 'user_register');

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $id_produk = $_POST['id_produk'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $ulasan = $_POST['ulasan'];
    $tanggal = date("Y-m-d H:i:s");

    // Query untuk menyimpan data ke tabel ulasan_produk
    $sql = "INSERT INTO ulasan_produk (id_produk, nama_pengguna, ulasan, tanggal) VALUES (?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $id_produk, $nama_pengguna, $ulasan, $tanggal);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo 'success'; // Beri respon success ke JavaScript
    } else {
        echo 'error';
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
