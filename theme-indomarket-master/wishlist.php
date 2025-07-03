<?php
// Koneksi ke database
$servername = "localhost";  // Ganti dengan nama host database
$username = "root";         // Ganti dengan username database kamu
$password = "";             // Ganti dengan password database kamu
$dbname = "user_register";  // Ganti dengan nama database kamu

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data JSON dari request
$data = json_decode(file_get_contents('php://input'), true);

// Pastikan data ada
if (isset($data['productName']) && isset($data['productPrice'])) {
    $productName = $data['productName'];
    $productPrice = $data['productPrice'];

    // SQL untuk menyimpan data
    $sql = "INSERT INTO wishlist (product_name, product_price) VALUES ('$productName', '$productPrice')";

    if ($conn->query($sql) === TRUE) {
        // Kirim respon sukses
        echo json_encode(["success" => true]);
    } else {
        // Kirim respon gagal
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid input"]);
}

// Tutup koneksi
$conn->close();
?>

