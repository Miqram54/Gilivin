<?php
// Ambil data JSON yang dikirim melalui fetch POST
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah data berhasil diambil
if (!$data) {
    echo json_encode(["success" => false, "message" => "Data tidak ditemukan"]);
    exit;
}

// Koneksi ke database (ganti dengan detail koneksi database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_register"; // Sesuaikan nama database

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
var_dump($_POST);
// Pastikan data form terkirim dengan baik
if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['zip'], $_POST['country'], $_POST['payment'], $_POST['shipping'])) {
    die('Please fill all required fields.');
}

// Ambil data yang dikirim
$nama = $data['nama'];
$email = $data['email'];
$phone = $data['phone'];
$address = $data['address'];
$city = $data['city'];
$zip = $data['zip'];
$country = $data['country'];
$total = $data['total'];
$items = $data['items'];

// Simpan data ke tabel checkout_orders
$sql_order = "INSERT INTO checkout_orders (nama, email, phone, address, city, zip, country, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("sssssssd", $nama, $email, $phone, $address, $city, $zip, $country, $total);

if ($stmt_order->execute()) {
    // Dapatkan ID pesanan yang baru saja disimpan
    $order_id = $stmt_order->insert_id;

    // Simpan setiap item ke tabel order_items
    foreach ($items as $item) {
        $nama_produk = $item['nama_produk'];
        $harga_produk = $item['harga_produk'];
        $quantity = $item['quantity'];
        
        $sql_item = "INSERT INTO order_items (order_id, nama_produk, harga_produk, quantity) VALUES (?, ?, ?, ?)";
        $stmt_item = $conn->prepare($sql_item);
        $stmt_item->bind_param("isdi", $order_id, $nama_produk, $harga_produk, $quantity);
        
        if (!$stmt_item->execute()) {
            echo json_encode(["success" => false, "message" => "Gagal menyimpan item pesanan"]);
            exit;
        }
    }

    // Berhasil menyimpan pesanan dan item
    echo json_encode(["success" => true, "message" => "Pesanan berhasil disimpan"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal menyimpan pesanan"]);
}

// Tutup koneksi
$conn->close();
?>
