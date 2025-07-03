<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan Konsumen - Kurir Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #43cea2, #185a9d);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 1100px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        header h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 1.8em;
        }

        header h1 i {
            color: #27ae60;
            margin-right: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #27ae60;
            color: white;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            font-weight: bold;
            text-transform: uppercase;
        }

        table tr:hover {
            background-color: #f0f9f4;
            transition: background 0.3s ease;
        }

        .order-status {
            padding: 8px;
            border: none;
            border-radius: 5px;
            font-size: 0.9em;
            width: 100%;
        }

        .icon-status {
            display: inline-block;
            padding: 5px 10px;
            background: #ecf0f1;
            color: #2c3e50;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .icon-status:hover {
            background: #bdc3c7;
            transform: scale(1.05);
        }

        .selesai-btn {
            background-color: #2ecc71;
            color: white;
            font-weight: bold;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .selesai-btn:hover {
            background-color: #27ae60;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            table th, table td {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <header style="display: flex; align-items: center; justify-content: center; position: relative;">
    <h1 style="color: #32CD32; margin: 0;">
        <i class="fas fa-truck"></i> Data Pemesanan Konsumen
    </h1>
    <a href="pesanan_selesai.php" class="icon-container" title="Pesanan Selesai" 
       style="position: absolute; top: 0; right: 0; color: #32CD32; font-size: 1.5em;">
        <i class="bi bi-clipboard2-check-fill"></i>
    </a>
</header>
<br>
<br> 
        <section>
            <table id="ordersTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Konsumen</th>
                        <th>Barang Pesanan</th>
                        <th>Total Pembayaran</th>
                        <th>Alamat Pengiriman</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th>Status</th>
                        <th>Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $conn = new mysqli('localhost', 'username', 'password', 'user_register');
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        $statusKonfirmasi = [
                            1 => 'Menunggu Konfirmasi',
                            2 => 'Pesanan Siap Dikirim',
                            3 => 'Pending Pesanan',
                            4 => 'Pesanan Dibatalkan',
                            5 => 'Pesanan Selesai'
                        ];

                        $sql = "SELECT co.id, co.nama_lengkap, co.user_id, co.id_produk, co.alamat, co.metode_pembayaran, p.nama_produk, p.harga, co.id_status, co.id_konfirmasi 
                                FROM checkout_orders AS co 
                                JOIN produk AS p ON co.id_produk = p.id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $namaKonfirmasi = $statusKonfirmasi[$row['id_konfirmasi']] ?? 'Menunggu Konfirmasi';
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['nama_lengkap']}</td>
                                    <td>{$row['nama_produk']}</td>
                                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                    <td>{$row['alamat']}</td>
                                    <td>{$row['metode_pembayaran']}</td>
                                    <td>
                                        <select class='order-status' data-id='{$row['user_id']}'>
                                            <option value='1' " . ($row['id_status'] == '1' ? 'selected' : '') . ">Pending</option>
                                            <option value='2' " . ($row['id_status'] == '2' ? 'selected' : '') . ">Pesanan Diproses</option>
                                            <option value='3' " . ($row['id_status'] == '3' ? 'selected' : '') . ">Dalam Pengiriman</option>
                                            <option value='4' " . ($row['id_status'] == '4' ? 'selected' : '') . ">Selesai</option>
                                            <option value='5' " . ($row['id_status'] == '5' ? 'selected' : '') . ">Dibatalkan</option>
                                        </select>
                                    </td>
                                    <td><span class='icon-status' onclick='alert(\"Status: {$namaKonfirmasi}\")'>{$namaKonfirmasi}</span></td>
                                    <td><button class='selesai-btn' onclick='markAsCompleted({$row['id']})'>Selesai</button></td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>Tidak ada data pemesanan</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.order-status').forEach(select => {
            select.addEventListener('change', function() {
                const orderId = this.dataset.id;
                const newStatus = this.value;
                fetch('update_status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: orderId, status: newStatus })
                })
                .then(response => response.json())
                .then(data => alert('Status berhasil diubah!'))
                .catch(error => console.error('Error:', error));
            });
        });

        function markAsCompleted(orderId) {
            fetch('mark_as_completed.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: orderId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pesanan ditandai sebagai selesai!');
                    location.reload(); // Muat ulang halaman untuk memperbarui status
                } else {
                    alert('Gagal memperbarui status');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>


