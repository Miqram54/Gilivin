<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_register";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ulasan dan nama produk dari database
$sql = "SELECT p.nama_produk, u.nama_pengguna, u.ulasan 
        FROM ulasan_produk u 
        JOIN produk p ON u.id_produk = p.id 
        ORDER BY u.tanggal DESC";

$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h3 class="text-center mb-4">Daftar Ulasan Produk</h3>
    
    <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Nama Produk</th>
                <th>Nama Pengguna</th>
                <th>Ulasan</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
                <td><?= htmlspecialchars($row['ulasan']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p class="text-center">Belum ada ulasan untuk produk apapun.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>

<style>
    /* Background utama bertema hijau dan pertanian */
    body {
        background-color: #e9f5e9; /* Warna hijau lembut seperti daun */
        font-family: 'Arial', sans-serif;
        color: #444;
    }

    /* Container */
    .container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #f4fff4; /* Warna hijau muda yang lembut */
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 128, 0, 0.2); /* Bayangan hijau lembut */
    }

    /* Header */
    h3 {
        font-family: 'Verdana', sans-serif;
        font-weight: bold;
        color: #2e7d32; /* Hijau gelap untuk kesan alam */
        border-bottom: 2px solid #8bc34a; /* Garis hijau pertanian */
        padding-bottom: 10px;
    }

    /* Tabel */
    .table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
    }

    .table thead {
        background-color: #8bc34a; /* Warna hijau cerah pertanian */
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #dcedc8; /* Hijau lembut untuk hover */
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #c5e1a5; /* Warna hijau muda */
        padding: 10px;
        text-align: left;
    }

    .table-bordered th {
        font-weight: bold;
        font-size: 16px;
    }

    .table-bordered td {
        font-size: 14px;
    }

    /* Pusatkan teks pada tabel */
    th, td {
        text-align: center;
    }

    /* Styling tambahan */
    p {
        color: #555;
        font-size: 16px;
    }
</style>
