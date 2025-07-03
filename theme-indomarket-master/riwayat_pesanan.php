<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Riwayat Pesanan</title>
    <style>
        /* Mengatur warna latar belakang dengan tema pertanian */
        body {
            background-color: #e8f5e9; /* Warna hijau lembut */
            font-family: 'Arial', sans-serif;
        }

        /* Memberikan margin pada kontainer */
        .container {
            margin-top: 50px;
            background-color: white; /* Latar belakang putih di dalam kontainer */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Mengatur gaya untuk judul */
        h2 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #388e3c; /* Warna hijau untuk tema pertanian */
        }

        /* Menambahkan ikon terkait pertanian di samping judul */
        h2:before {
            content: "\1F33F"; /* Emoji daun untuk menekankan tema pertanian */
            font-size: 1.5em;
            margin-right: 10px;
        }

        /* Gaya untuk tabel */
        .table thead th {
            background-color: #388e3c; /* Hijau tua yang terkait dengan pertanian */
            color: white;
        }

        .table tbody tr:hover {
            background-color: #c8e6c9; /* Warna hijau muda saat hover */
        }

        .table tbody td {
            vertical-align: middle;
        }

        /* Mengatur tombol agar lebih menarik dan sesuai dengan tema */
        .btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
        }

        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        /* Menambahkan ikon terkait pertanian di header */
        .header-icon {
            font-size: 1.5em;
            color: #388e3c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Riwayat Pesanan</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>ID Produk</th>
                <th>Alamat</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start(); // Memulai sesi

            // Pastikan user sudah login
            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php"); // Redirect ke halaman login jika belum login
                exit();
            }

            // Ambil user_id dari sesi
            $user_id = $_SESSION['user_id'];

            // Koneksi ke database
            $conn = new mysqli("localhost", "username", "password", "user_register");

            // Cek koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query untuk mengambil data pesanan yang sesuai dengan user yang login
            $sql = "
                SELECT co.nama_lengkap, co.id_produk, co.alamat, p.nama_produk, p.harga, co.id_status
                FROM checkout_orders co
                JOIN produk p ON co.id_produk = p.id
                WHERE co.user_id = ?
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Cek apakah ada data
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    // Mengkonversi id_status menjadi deskripsi status
                    $statusPesanan = '';
                    switch($row['id_status']) {
                        case '1':
                            $statusPesanan = 'Pending';
                            break;
                        case '2':
                            $statusPesanan = 'Pesanan Diproses';
                            break;
                        case '3':
                            $statusPesanan = 'Dalam Pengiriman';
                            break;
                        case '4':
                            $statusPesanan = 'Selesai';
                            break;
                        case '5':
                            $statusPesanan = 'Dibatalkan';
                            break;
                        default:
                            $statusPesanan = 'Belum Diproses';
                            break;
                    }

                    // Menampilkan data ke dalam tabel
                    echo "<tr>
                            <td>{$row['nama_lengkap']}</td>
                            <td>{$row['id_produk']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['nama_produk']}</td>
                            <td>Rp. " . number_format($row['harga'], 2) . "</td>
                            <td>{$statusPesanan}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada riwayat pesanan</td></tr>";
            }

            // Tutup koneksi dan statement
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
