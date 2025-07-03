<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lilita+One&family=Protest+Strike&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   <style>
        .thumbnail {
            margin-right: 20px;
        }
        .media {
            display: flex;
            align-items: center;
        }
        .media-object {
            border-radius: 5px;
            margin-right: 10px;
        }
        .btn-danger {
            margin-top: 25px;
        }
        .label {
            border-radius: 5px;
            padding: 5px 10px;
        }
        h5 {
            margin: 5px 0;
        }
        .table thead th {
            background-color: #f8f9fa;
            text-align: center;
        }
        body {
            background-color: #4c7b4d;
        }
        .table tbody tr:hover {
            background-color: #6A9C89;
        }
        .table tbody tr td {
            vertical-align: middle;
        }
        .total-row {
            font-weight: bold;
        }
        .total-row h5, .total-row h3 {
            margin: 0;
        }
        h2 {
        font-family: "Lilita One", sans-serif;
        font-weight: 400;
        font-style: normal;
        color: #E2F1E7;
        }
        h4 {
        font-family: "Fira Sans Condensed", sans-serif;
        font-weight: bold;
        font-size:large;
        font-style: normal;
        }
        span {
        font-family: "Fira Sans Condensed", sans-serif;
        font-weight: 200;
        font-style: normal;
        font-size:15px;
        color:#ffff;
        }
        h4.media-heading a {
        color: #bbb584; 
        text-decoration: none;
         }
        .btn-success{
            background-color:#3C3D37 ;
         }
    </style>

    <title>Keranjang</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Keranjang</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Total</th>
                <th class="text-center">Tanggal add</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody id="cart-items">
            <?php
            // Database connection
            $conn = new mysqli("localhost", "username", "password", "user_register");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Assuming user_id is stored in session
            session_start();
            $user_id = $_SESSION['user_id']; // Ensure user is logged in
var_dump($_SESSION);
exit;
            // Fetch user data from users table
            $user_sql = "SELECT nama_lengkap, email, phone, alamat, negara, kota, kode_pos FROM users WHERE id = $user_id";
            $user_result = $conn->query($user_sql);
            $user_data = $user_result->fetch_assoc();

            // Fetch data from the keranjang table and join with produk table to get product image
            $sql = "SELECT keranjang.*, produk.nama_produk, produk.harga, produk.gambar 
                    FROM keranjang 
                    JOIN produk ON keranjang.id_produk = produk.id 
                    WHERE keranjang.id_user = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>
                                <div class='media'>
                                    <a class='thumbnail' href='#'>
                                        <img class='media-object' src='{$row['gambar']}' alt='Product Image' style='width: 72px; height: 72px;'>
                                    </a>
                                    <div class='media-body'>
                                        <h4 class='media-heading'><a href='#'>{$row['nama_produk']}</a></h4>
                                        <span>Status: </span><span class='text-warning'><strong>In Stock</strong></span>
                                    </div>
                                </div>
                            </td>
                            <td class='text-center'><input type='number' class='form-control quantity-input' value='1' data-price='{$row['harga_produk']}' data-id='{$row['id']}'></td>
                            <td class='text-center'><strong>Rp.{$row['harga_produk']}</strong></td>
                            <td class='text-center total-price' id='total-{$row['id']}'><strong>Rp.{$row['harga_produk']}</strong></td>
                            <td class='text-center'><strong>{$row['tanggal_ditambahkan']}</strong></td>
                            <td class='text-center'>
                                <form action='checkout.php' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='id_produk' value='{$row['id']}'>
                                    <input type='hidden' name='nama_produk' value='{$row['nama_produk']}'>
                                    <input type='hidden' name='harga_produk' value='{$row['harga_produk']}'>
                                    <input type='hidden' name='id_user' value='{$row['id_user']}'>
                                    <input type='hidden' name='nama_lengkap' value='{$user_data['nama_lengkap']}'>
                                    <input type='hidden' name='email' value='{$user_data['email']}'>
                                    <input type='hidden' name='phone' value='{$user_data['phone']}'>
                                    <input type='hidden' name='alamat' value='{$user_data['alamat']}'>
                                    <input type='hidden' name='negara' value='{$user_data['negara']}'>
                                    <input type='hidden' name='kota' value='{$user_data['kota']}'>
                                    <input type='hidden' name='kode_pos' value='{$user_data['kode_pos']}'>
                                    <button type='submit' class='btn btn-success'>Lanjutkan Pembayaran</button>
                                </form>
                                <form action='remove_from_cart.php' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='id_produk' value='{$row['id']}'>
                                    <button type='submit' class='btn btn-danger'>Hapus</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No products found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Update total price based on quantity input
    $(document).on('change', '.quantity-input', function () {
        var price = $(this).data('price');
        var id = $(this).data('id');
        var quantity = $(this).val();
        var totalPrice = price * quantity;

        $('#total-' + id).html('<strong>Rp.' + totalPrice + '</strong>');
    });
</script>
</body>
</html>
