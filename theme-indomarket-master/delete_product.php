<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "user_register");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ID produk dikirim melalui POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Query untuk menghapus produk berdasarkan ID
    $sql = "DELETE FROM produk WHERE id = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    // Bind parameter (menghindari SQL Injection)
    $stmt->bind_param("i", $id);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "Produk berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "ID produk tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>


