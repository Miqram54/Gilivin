<?php
$conn = new mysqli('localhost', 'username', 'password', 'user_register');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Koneksi database gagal']));
}

// Membaca data JSON yang diterima
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $query = "UPDATE checkout_orders SET id_status = 4, id_konfirmasi = 5 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID pesanan tidak ditemukan']);
}

$conn->close();
?>
