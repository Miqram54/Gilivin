<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "user_register");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Dapatkan ID produk yang akan dihapus
$id = $_POST['id'];

// Query untuk menghapus produk dari database
$sql = "DELETE FROM produk WHERE id = ?";

// Persiapkan statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Produk berhasil dihapus.";
} else {
    echo "Gagal menghapus produk.";
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
