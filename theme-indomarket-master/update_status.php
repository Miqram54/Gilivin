<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'username', 'password', 'user_register');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data JSON yang dikirim
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$status = $data['status'];
// Query untuk memperbarui status pesanan
$sql = "UPDATE checkout_orders SET id_status = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $status, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'username', 'password', 'user_register');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan data `id_produk` dan `id_status` dikirim melalui POST
if (isset($_POST['user_id']) && isset($_POST['user_id'])) {
    $userid = $_POST['user_id']; // Ambil ID produk dari POST
    $idStatus = $_POST['id_status']; // Ambil ID status dari POST

    // Update status di tabel checkout_orders
    $sql = "UPDATE checkout_orders SET id_status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $idStatus, $idProduk); // Mengikat parameter

    if ($stmt->execute()) {
        echo "Status berhasil diperbarui"; // Jika berhasil
    } else {
        echo "Gagal memperbarui status"; // Jika gagal
    }

    $stmt->close(); // Menutup statement
}

// Tutup koneksi
$conn->close(); // Menutup koneksi
?>

