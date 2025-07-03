<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_register';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_produk = $_POST['id_produk'];
$nama_lengkap = $_POST['nama_lengkap'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$tanggal_pemesanan = $_POST['tanggal_pemesanan'];

$sql = "INSERT INTO laporan_penjualan (id_produk, nama_produk, nama_lengkap, harga, tanggal_pemesanan) 
        VALUES ('$id_produk', '$nama_produk', '$nama_lengkap', '$harga', '$tanggal_pemesanan')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


