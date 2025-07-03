<?php
// wishlist_handler.php
include 'db_connection.php'; // koneksi ke database

// Query untuk mengambil data dari tabel wishlist2
$query = "SELECT id, product_name, product_price, created_at FROM wishlist2";
$result = mysqli_query($conn, $query);

$wishlist = array();
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $wishlist[] = $row;
    }
    // Mengembalikan data dalam format JSON
    echo json_encode($wishlist);
} else {
    echo json_encode(array('message' => 'Error loading wishlist data.'));
}

mysqli_close($conn);
?>
