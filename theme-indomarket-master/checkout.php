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

// Ambil data user dengan ID tertentu
$userId = $_SESSION["user_id"];
$barangId = $_POST["id_produk"]; // Ganti dengan ID pengguna yang sesuai
$sqlUser = $conn->prepare("SELECT nama_lengkap, email, phone, alamat, negara, kota, kode_pos FROM users WHERE id = ?");
$sqlUser->bind_param("i", $userId);
$sqlUser->execute();
$resultUser = $sqlUser->get_result();

if ($resultUser->num_rows > 0) {
    $user = $resultUser->fetch_assoc();
} else {
    echo "No user found";
    exit();
}

// Ambil data keranjang
$sqlCart = $conn->prepare("SELECT nama_produk, harga_produk FROM keranjang WHERE id = ?");
$sqlCart->bind_param("i", $barangId);
$sqlCart->execute();
$resultCart = $sqlCart->get_result();

$cartData = [];
if ($resultCart->num_rows > 0) {
    while ($row = $resultCart->fetch_assoc()) {
        $cartData[] = $row;
    }
} else {
    echo "No products in cart";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Gaya untuk keseluruhan halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #eafaf1; /* Warna hijau terang untuk latar belakang */
            margin: 0;
            padding: 0;
        }

        /* Gaya untuk kotak checkout */
        .checkout-container {
            max-width: 700px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 128, 0, 0.2); /* Bayangan hijau */
            border: 2px solid #a8d5ba; /* Border hijau */
        }

        h2, h3 {
            color: #006400; /* Warna hijau tua untuk judul */
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #006400;
        }

        /* Gaya untuk input teks dan email */
        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #a8d5ba;
            border-radius: 5px;
            background-color: #f0fff4; /* Latar belakang hijau pucat */
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        /* Gaya untuk tombol */
        button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        /* Gaya untuk ringkasan pesanan */
        .order-summary {
            border-top: 1px solid #a8d5ba;
            padding-top: 20px;
            background-color: #f0fff4; /* Latar belakang hijau pucat */
            border-radius: 5px;
            padding: 15px;
        }

        .order-summary p {
            margin: 10px 0;
            color: #2e8b57; /* Warna hijau lebih tua untuk teks ringkasan pesanan */
        }

        .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #2e8b57;
        }

        /* Gaya untuk metode pembayaran dan pengiriman */
        .payment-method, .shipping-method {
            margin-top: 20px;
            background-color: #f7fff9; /* Latar belakang hijau sangat terang */
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #a8d5ba;
        }

        .payment-method h3, .shipping-method h3 {
            color: #006400;
        }

        .payment-method label, .shipping-method label {
            color: #006400;
        }

        /* Pesan konfirmasi */
        #confirmationMessage {
            display: none;
            padding: 20px;
            background-color: #e6ffed;
            color: green;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-ADFh5ZkK3eszHjqC"></script>
</head>
<body>

<div class="checkout-container">
    <h2>Checkout</h2>
    <form id="checkoutForm" method="POST" action="proses_checkout.php">
        <section>
            <h3>Informasi Pemesan</h3>
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

            <label for="address">Alamat</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['alamat']); ?>" required>

            <label for="city">Kota</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user['kota']); ?>" required>

            <label for="zip">Kode Pos</label>
            <input type="text" id="zip" name="zip" value="<?php echo htmlspecialchars($user['kode_pos']); ?>" required>

            <label for="country">Negara</label>
            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user['negara']); ?>" required>
        </section>

        <section class="order-summary">
            <h3>Ringkasan Pesanan</h3>
            <?php
                $total = 0;
                $items = []; // Array PHP untuk menampung data item
                foreach ($cartData as $item) {
                    echo "<p>" . htmlspecialchars($item['nama_produk']) . ": <span>Rp " . number_format($item['harga_produk'], 0, ',', '.') . "</span></p>";
                    $items[] = [
                        'name' => $item['nama_produk'],
                        'price' => $item['harga_produk'],
                        'quantity' => 1  
                    ];
                    $total += $item['harga_produk'];
                }
            ?>
            <input type="hidden"  id="total-price" value="<?php echo $total ?>"/>
            <p>Total Harga: <span class="total-price">Rp <?php echo number_format($total, 0, ',', '.'); ?></span></p>
        </section>

        <section class="payment-method">
            <h3>Metode Pembayaran</h3>
            <label><input type="radio" name="payment" value="Cash On Delivery" required> Cash On Delivery (Bayar di Tempat)</label><br>
            <label><input type="radio" name="payment" value="Virtual Account Bank" required> Virtual Account Bank</label><br>
            <label><input type="radio" name="payment" value="QRIS EWALLET" required> QRIS EWALLET</label><br>
        </section>

        <section class="shipping-method">
            <h3>Jasa Pengiriman</h3>
            <label><input type="radio" name="shipping" value="gilivin_kurir" checked> Gilivin Kurir</label>
        </section>

        <button type="button" id="pay-button">Bayar Sekarang</button>
    </form>

    <div id="confirmationMessage">
        Terima kasih atas pesanan Anda! Kami akan menghubungi Anda untuk konfirmasi pengiriman.
    </div>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ADFh5ZkK3eszHjqC"></script>
<script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', async function () {
      var items = <?php echo json_encode($items); ?>;

      const data = {
          nama: document.getElementById('name').value,
          email: document.getElementById('email').value,
          phone: document.getElementById('phone').value,
          address: document.getElementById('address').value,
          city: document.getElementById('city').value,
          zip: document.getElementById('zip').value,
          country: document.getElementById('country').value,
          total: document.getElementById('total-price').value,
          items: items
      };

      try {
          const response = await fetch('pembayaran.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify(data),
          });

          const token = await response.text();
          window.snap.pay(token, {
              onSuccess: function(result) { document.getElementById("checkoutForm").submit(); },
              onPending: function(result) { alert("Payment pending. Please complete your payment."); },
              onError: function(result) { alert("Payment failed. Please try again."); }
          });

      } catch (err) { console.log(err.message); }
  });
</script>

</body>
</html>