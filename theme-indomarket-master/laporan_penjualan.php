<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "username"; // Ganti dengan username Anda
$password = "password"; // Ganti dengan password Anda
$dbname = "user_register"; // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data laporan_penjualan
$sql = "SELECT nama_produk, nama_lengkap, harga, tanggal_pemesanan FROM laporan_penjualan";
if (!empty($_POST['month'])) {
    $selected_month = $_POST['month'];
    $sql .= " WHERE MONTH(tanggal_pemesanan) = $selected_month";
}
$result = $conn->query($sql);

// Inisialisasi variabel
$data_penjualan = [];
$total_penjualan = 0;
$total_pembeli = 0;
$produk_count = [];
$latest_order_date = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_penjualan[] = $row;
        $total_penjualan += $row['harga'];
        $total_pembeli++; // Menghitung jumlah pembeli
        
        // Menghitung produk terlaris
        if (isset($produk_count[$row['nama_produk']])) {
            $produk_count[$row['nama_produk']]++;
        } else {
            $produk_count[$row['nama_produk']] = 1;
        }

        // Menentukan tanggal pemesanan terakhir
        if ($latest_order_date === '' || $row['tanggal_pemesanan'] > $latest_order_date) {
            $latest_order_date = $row['tanggal_pemesanan'];
        }
    }
} else {
    echo "Tidak ada data.";
}

// Menentukan produk terlaris
$produk_terlaris = '';
$jumlah_terlaris = 0;
foreach ($produk_count as $produk => $jumlah) {
    if ($jumlah > $jumlah_terlaris) {
        $jumlah_terlaris = $jumlah;
        $produk_terlaris = $produk;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        h1, h4 {
            text-align: center;
            color: #4CAF50;
        }
        select, button {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid ;
           
            color: green;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #4CAF50;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d1e7dd;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        @keyframes fadeIn {
            from {opacity: 0;} 
            to {opacity: 1;}
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Laporan Penjualan</h1>
    

    <h4>Ringkasan Penjualan</h4>
    <ul>
        <li>Total Penjualan: Rp. <?php echo number_format($total_penjualan, 0, ',', '.'); ?></li>
        <li>Jumlah Pembeli: <?php echo $total_pembeli; ?></li>
        <li>Produk Terlaris: <?php echo $produk_terlaris; ?> (<?php echo $jumlah_terlaris; ?> penjualan)</li>
        <li>Tanggal Pemesanan Terakhir: <?php echo $latest_order_date; ?></li>
    </ul>
<form method="POST" action="">
        <label for="month">Cari berdasarkan Bulan:</label>
        <select name="month" id="month">
            <option value="">Semua Bulan</option>
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?php echo $m; ?>" <?php if (isset($_POST['month']) && $_POST['month'] == $m) echo 'selected'; ?>>
                    <?php echo date("F", mktime(0, 0, 0, $m, 1)); ?>
                </option>
            <?php endfor; ?>
        </select>
        <button type="submit">Tampilkan</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pemesanan</th>
                <th>Nama Produk</th>
                <th>Nama Pembeli</th>
                <th>Harga</th>
                <th>Lihat Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_penjualan as $index => $penjualan): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $penjualan['tanggal_pemesanan']; ?></td>
                <td><?php echo $penjualan['nama_produk']; ?></td>
                <td><?php echo $penjualan['nama_lengkap']; ?></td>
                <td>Rp. <?php echo number_format($penjualan['harga'], 0, ',', '.'); ?></td>
                <td>
                    <button onclick="viewDetails('<?php echo $penjualan['nama_produk']; ?>', '<?php echo $penjualan['tanggal_pemesanan']; ?>', '<?php echo $penjualan['nama_lengkap']; ?>', '<?php echo number_format($penjualan['harga'], 0, ',', '.'); ?>')">👁️</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Detail Produk</h2>
        <div id="modal-body"></div>
    </div>
</div>

<script>
    function viewDetails(produk, tanggal, pembeli, harga) {
        document.getElementById("modal-body").innerHTML = `<p>Produk: ${produk}</p><p>Tanggal: ${tanggal}</p><p>Nama Pembeli: ${pembeli}</p><p>Total Harga: Rp. ${harga}</p>`;
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>
</body>
</html>
