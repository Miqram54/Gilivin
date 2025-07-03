<?php
session_start();
$conn = new mysqli("localhost", "username", "password", "user_register");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $user_id = $_SESSION['user_id']; // Pastikan pengguna yang sama

    // Hapus item dari keranjang
    $delete_sql = "DELETE FROM keranjang WHERE id = ? AND id_user = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("ii", $id_produk, $user_id);

    if ($stmt->execute()) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();

// Redirect back to cart page
header("Location: cart_page.php"); // Ganti dengan nama halaman keranjang Anda
exit();
?>
