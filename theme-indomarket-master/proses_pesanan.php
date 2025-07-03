<?php
// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "user_register");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel checkout_orders dan produk
$sql = "SELECT co.id_produk, co.user_id, co.nama_lengkap, co.email, co.phone, co.alamat, co.kota, co.kode_pos, co.negara, co.total_harga, co.metode_pembayaran, co.jasa_pengiriman, co.tanggal_pemesanan, p.nama_produk, co.id_konfirmasi, co.id_status 
        FROM checkout_orders co 
        JOIN produk p ON co.id_produk = p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Style umum */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 80%; margin: 20px auto; padding: 20px; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .view-btn, .finish-btn { padding: 10px 15px; border: none; cursor: pointer; }
        .view-btn { background-color: #007BFF; color: white; border-radius: 5px; }
        .finish-btn { background-color: #28a745; color: white; border-radius: 5px; }
        .popup { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; }
        .popup-content { background-color: #fff; margin: 10% auto; padding: 20px; width: 70%; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); position: relative; }
        .popup-header { font-size: 1.5em; margin-bottom: 15px; }
        .close { position: absolute; top: 10px; right: 15px; font-size: 24px; cursor: pointer; color: #333; }
        .popup-body p { margin: 8px 0; }
        select { padding: 5px; border-radius: 5px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Nama Produk</th>
                    <th>Detail Pesanan</th>
                    <th>Konfirmasi Pesanan</th>
                    <th>Status Pengiriman</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
            <?php
// Array untuk memetakan id_konfirmasi dengan nama konfirmasi
$statusKonfirmasi = [
    1 => 'Pending ',
    2 => 'Pesanan Diproses',
    3 => 'Dalam Pengiriman',
    4 => 'Selesai',
    5 => 'Dibatalkan'
];
?>

<?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['nama_lengkap']; ?></td>
            <td><?php echo $row['nama_produk']; ?></td>
            <td>
                <button class="view-btn" onclick="showPopup('<?php echo addslashes($row['nama_lengkap']); ?>', '<?php echo addslashes($row['email']); ?>', '<?php echo addslashes($row['phone']); ?>', '<?php echo addslashes($row['alamat']); ?>', '<?php echo addslashes($row['kota']); ?>', '<?php echo addslashes($row['kode_pos']); ?>', '<?php echo addslashes($row['negara']); ?>', '<?php echo $row['total_harga']; ?>', '<?php echo addslashes($row['metode_pembayaran']); ?>', '<?php echo addslashes($row['jasa_pengiriman']); ?>', '<?php echo $row['tanggal_pemesanan']; ?>')">Lihat</button>
            </td>
            <td>
                <select name="konfirmasi_pesanan<?php echo $row['user_id']; ?>" onchange="updateKonfirmasi(<?php echo $row['user_id']; ?>, this.value)">
                    <option value='1' <?php echo ($row['id_konfirmasi'] == 1) ? 'selected' : ''; ?>>Menunggu Konfirmasi</option>
                    <option value='2' <?php echo ($row['id_konfirmasi'] == 2) ? 'selected' : ''; ?>>Pesanan Siap Dikirim</option>
                    <option value='3' <?php echo ($row['id_konfirmasi'] == 3) ? 'selected' : ''; ?>>Pending Pesanan</option>
                    <option value='4' <?php echo ($row['id_konfirmasi'] == 4) ? 'selected' : ''; ?>>Pesanan Dibatalkan</option>
                    <option value='5' <?php echo ($row['id_konfirmasi'] == 5) ? 'selected' : ''; ?>>Pesanan Selesai</option>
                </select>
            </td>
            <td><?php echo $statusKonfirmasi[$row['id_status']] ?? 'Belum Dikonfirmasi'; ?></td> <!-- Tampilkan nama konfirmasi -->
            <td>
            <button class="finish-btn" onclick="finishOrder(
        <?php echo $row['id_produk']; ?>, 
        '<?php echo addslashes($row['nama_lengkap']); ?>', 
        '<?php echo addslashes($row['nama_produk']); ?>', 
        '<?php echo addslashes($row['total_harga']); ?>', 
        '<?php echo $row['tanggal_pemesanan']; ?>'
    )">Selesai</button>

<script>
function finishOrder(id_produk, nama_lengkap, nama_produk, total_harga, tanggal_pemesanan) {
    fetch('save_laporan_penjualan.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id_produk: id_produk,
            nama_lengkap: nama_lengkap,
            nama_produk: nama_produk,
            total_harga: total_harga,
            tanggal_pemesanan: tanggal_pemesanan
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Pesanan telah disimpan ke laporan penjualan dan dihapus dari proses pesanan.");
            location.reload(); // Memperbarui halaman untuk merefleksikan perubahan
        } else {
            alert("Terjadi kesalahan: " + data.message); // Tampilkan pesan error dari server
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="6">Tidak ada data pesanan.</td>
    </tr>
<?php endif; ?>

    <!-- Pop-up -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="hidePopup()">&times;</span>
            <div class="popup-header">Detail Pesanan</div>
            <div class="popup-body">
                <p><strong>Nama:</strong> <span id="popup-nama"></span></p>
                <p><strong>Email:</strong> <span id="popup-email"></span></p>
                <p><strong>Phone:</strong> <span id="popup-phone"></span></p>
                <p><strong>Alamat:</strong> <span id="popup-alamat"></span></p>
                <p><strong>Kota:</strong> <span id="popup-kota"></span></p>
                <p><strong>Kode Pos:</strong> <span id="popup-kodepos"></span></p>
                <p><strong>Negara:</strong> <span id="popup-negara"></span></p>
                <p><strong>Total Harga:</strong> <span id="popup-harga"></span></p>
                <p><strong>Metode Pembayaran:</strong> <span id="popup-metode"></span></p>
                <p><strong>Jasa Pengiriman:</strong> <span id="popup-jasa"></span></p>
                <p><strong>Tanggal Pemesanan:</strong> <span id="popup-tanggal"></span></p>
            </div>
        </div>
    </div>

    <script>
        // Menampilkan pop-up
        function showPopup(nama, email, phone, alamat, kota, kodepos, negara, harga, metode, jasa, tanggal) {
            document.getElementById("popup-nama").innerText = nama;
            document.getElementById("popup-email").innerText = email;
            document.getElementById("popup-phone").innerText = phone;
            document.getElementById("popup-alamat").innerText = alamat;
            document.getElementById("popup-kota").innerText = kota;
            document.getElementById("popup-kodepos").innerText = kodepos;
            document.getElementById("popup-negara").innerText = negara;
            document.getElementById("popup-harga").innerText = harga;
            document.getElementById("popup-metode").innerText = metode;
            document.getElementById("popup-jasa").innerText = jasa;
            document.getElementById("popup-tanggal").innerText = tanggal;
            document.getElementById("popup").style.display = "block";
        }

        // Menyembunyikan pop-up
        function hidePopup() {
            document.getElementById("popup").style.display = "none";
        }

        // Memperbarui konfirmasi pesanan
        function updateKonfirmasi(user_id, konfirmasi) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_status2.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Status pesanan berhasil diperbarui.");
                }
            };
            xhr.send("user_id=" + user_id + "&konfirmasi=" + konfirmasi);
        }

        // Menyelesaikan pesanan
        function finishOrder(id_produk, nama_lengkap, nama_produk, total_harga, tanggal) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_laporan_penjualan.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Pesanan selesai dan disimpan.");
                    location.reload(); // Refresh halaman setelah menyelesaikan pesanan
                }
            };
            xhr.send("id_produk=" + id_produk + "&nama_lengkap=" + nama_lengkap + "&nama_produk=" + nama_produk + "&harga=" + total_harga + "&tanggal_pemesanan=" + tanggal);
        }
        
    </script>
</body>
</html>

<?php
$conn->close();
?>
