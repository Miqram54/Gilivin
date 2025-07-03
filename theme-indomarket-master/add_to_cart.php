<?php
// Koneksi database
session_start();

include 'db_connection.php';  // Pastikan untuk mengganti dengan path yang benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari permintaan AJAX
    if(isset($_POST['name']) && isset($_POST['price'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $price = (int)$_POST['price']; // Casting ke integer
        $product_id = (int)$_POST['product_id']; // Casting ke integer
        $user_id = (int)$_POST['user_id'];

        // Siapkan query untuk menyimpan produk ke keranjang
        $sql = "INSERT INTO keranjang (id_produk, id_user, nama_produk, harga_produk) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("iisi",$product_id,  $user_id, $name, $price);
            
            // Eksekusi query
            if ($stmt->execute()) {
                // Set response header
                header('Content-Type: application/json');
                echo json_encode(["message" => "Produk berhasil ditambahkan ke keranjang", "status" => "success"]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(["message" => "Gagal menambahkan produk ke keranjang: " . $stmt->error, "status" => "error"]);
            }
            // Tutup statement
            $stmt->close();
        } else {
            // Jika gagal membuat statement
            header('Content-Type: application/json');
            echo json_encode(["message" => "Query error: " . $conn->error, "status" => "error"]);
        }
    } else {
        // Jika data yang dikirim tidak lengkap
        header('Content-Type: application/json');
        echo json_encode(["message" => "Data tidak lengkap", "status" => "error"]);
    }

    // Tutup koneksi database
    $conn->close();
} else {
    // Jika metode request bukan POST
    header('Content-Type: application/json');
    echo json_encode(["message" => "Invalid request method", "status" => "error"]);
}
?>
