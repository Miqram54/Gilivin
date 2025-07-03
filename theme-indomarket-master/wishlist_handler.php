<?php
session_start();
include 'db_connection.php'; // Pastikan untuk memasukkan koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $user_id = $_POST['user_id'];
    $created_at = date('Y-m-d H:i:s');

    // Query untuk menyimpan ke tabel wishlist
    $query = "INSERT INTO wishlist2 (user_id, product_id, product_name, product_price, created_at) 
              VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$created_at')";

    if (mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
