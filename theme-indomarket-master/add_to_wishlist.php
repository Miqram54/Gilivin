<?php
// Hubungkan ke database
include 'db_connection.php';  // Pastikan file koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $user_id = $_POST['user_id'];
    $created_at = date('Y-m-d H:i:s');  // Waktu saat ini

    // Query untuk memasukkan data ke tabel wishlist
    $sql = "INSERT INTO wishlist (user_id, product_name, product_price, created_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isss', $user_id, $product_name, $product_price, $created_at);

    if ($stmt->execute()) {
        echo 'Data berhasil disimpan ke wishlist';
    } else {
        echo 'Gagal menyimpan data: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
