<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_register';
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $conn->connect_error]));
}

// Ambil data dari permintaan POST
$orderId = $_POST['user_id'];
$newStatus = $_POST['konfirmasi'];
// Update status di database
$sql = "UPDATE checkout_orders SET id_konfirmasi = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $newStatus, $orderId); // Mengikat parameter (id_konfirmasi, id_produk)

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Status berhasil diperbarui.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status: ' . $stmt->error]);
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
