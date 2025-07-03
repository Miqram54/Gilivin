<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_register";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan hanya nama_lengkap dari users
$sql = "SELECT nama_lengkap FROM users";
$result = $conn->query($sql);

// Membuat tabel HTML untuk data users
$nomor = 1; // Inisialisasi nomor urut
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $nomor . "</td>"; // Menampilkan nomor
        echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
        echo "</tr>";
        $nomor++; // Increment nomor urut
    }
} else {
    echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
}

// Menutup koneksi database
$conn->close();
?>
