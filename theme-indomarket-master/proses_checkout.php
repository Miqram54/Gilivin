<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "user_register";

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pastikan data form terkirim dengan baik
if (!isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['zip'], $_POST['country'], $_POST['payment'], $_POST['shipping'])) {
    die('Please fill all required fields.');
}

// Ambil data user dari sesi
$userId = $_SESSION["user_id"];

// Ambil data dari form checkout
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$country = $_POST['country'];
$paymentMethod = $_POST['payment'];
$shippingMethod = $_POST['shipping'];

// Ambil data produk dari keranjang untuk user yang sedang login
$sqlCart = $conn->prepare ("SELECT nama_produk, id_produk, harga_produk FROM keranjang WHERE id_user = ?");
$sqlCart->bind_param("i", $userId);
$sqlCart->execute();
$resultCart = $sqlCart->get_result();

// Cek apakah keranjang tidak kosong
if ($resultCart->num_rows > 0) {
    $totalAmount = 0;
    $orderItems = [];
    $id_produk;
    
    while ($row = $resultCart->fetch_assoc()) {
        $totalAmount += $row['harga_produk'];
        $orderItems[] = $row['nama_produk'];
        $id_produk = $row['id_produk'];
    }

    // Gabungkan semua nama produk dalam satu string
    $orderDetails = implode(", ", $orderItems);

    // Simpan data ke tabel checkout_orders
    $sqlInsert = $conn->prepare("INSERT INTO checkout_orders (user_id, id_produk, nama_lengkap, email, phone, alamat, kota, kode_pos, negara, metode_pembayaran, jasa_pengiriman, total_harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sqlInsert->bind_param("iisssssssssi", $userId, $id_produk, $name, $email, $phone, $address, $city, $zip, $country, $paymentMethod, $shippingMethod, $totalAmount);

    if ($sqlInsert->execute()) {
        // Kosongkan keranjang setelah pesanan disimpan
        $sqlDeleteCart = $conn->prepare("DELETE FROM keranjang WHERE id_user = ?");
        $sqlDeleteCart->bind_param("i", $userId);
        $sqlDeleteCart->execute();

        // Menampilkan pesan sukses dengan tampilan yang lebih baik
        echo "
        
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pesanan Berhasil</title>
            <meta http-equiv='refresh' content='3;url=index.php'> <!-- Refresh otomatis ke index.php setelah 3 detik -->
            <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' rel='stylesheet'>
            <style>
                body {
                    background-image: url(../images/truk_kurir.jpeg); /* Ganti dengan URL gambar latar belakang pertanian yang diinginkan */
                    background-size: cover;
                    background-position: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    font-family: 'Roboto', sans-serif;
                }
                .message {
                    background-color: rgba(255, 255, 255, 0.8);
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                    text-align: center;
                    font-size: 24px;
                    color: #333;
                }
            </style>
        </head>
        <body>
            <div class='message'>
                Pesanan Anda telah berhasil disimpan!
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Terjadi kesalahan saat menyimpan pesanan: " . $conn->error;
    }
} else {
    echo "Keranjang belanja kosong.";
}

// Tutup koneksi
$conn->close();
?>
