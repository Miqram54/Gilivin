<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Pesanan Selesai</h1>
        <table>
            <tr>
                <th>Nomor</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Metode Pembayaran</th>
                <th>Total Harga</th>
                <th>Tanggal Pemesanan</th>
                <th>Nama Produk</th>
            </tr>
            <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "username", "password", "user_register");

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query untuk mengambil data pesanan selesai dari checkout_orders
                $sql = "SELECT 
                            ROW_NUMBER() OVER (ORDER BY co.tanggal_pemesanan) AS Nomor,
                            co.nama_lengkap,
                            co.alamat,
                            co.metode_pembayaran,
                            co.total_harga,
                            co.tanggal_pemesanan,
                            p.nama_produk
                        FROM 
                            checkout_orders AS co
                        JOIN 
                            produk AS p ON co.id_produk = p.id
                        WHERE 
                            co.id_konfirmasi = 5"; // Mengambil hanya pesanan dengan status "selesai"
                $result = $conn->query($sql);

                // Tampilkan data di tabel
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row["nama_lengkap"] . "</td>
                                <td>" . $row["alamat"] . "</td>
                                <td>" . $row["metode_pembayaran"] . "</td>
                                <td>Rp " . number_format($row["total_harga"], 0, ',', '.') . "</td>
                                <td>" . $row["tanggal_pemesanan"] . "</td>
                                <td>" . $row["nama_produk"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align: center;'>Tidak ada data pesanan selesai.</td></tr>";
                }

                // Tutup koneksi
                $conn->close();
            ?>
        </table>
    </div>
</body>
</html>


