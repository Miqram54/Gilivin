<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk Toko</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            background-color: #343a40;
            color: white;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        td button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #0056b3;
        }

        td img {
            max-width: 100px;
            border-radius: 10px;
        }

        /* Tombol di pojok kanan atas */
        .icon-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .icon-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            width: 40px;
            height: 40px;
        }

        .icon-btn:hover {
            background-color: #218838;
        }

        .icon-btn-secondary {
            background-color: #007bff;
        }

        .icon-btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Kelola Produk Toko</h1>

    <div class="container">
    <div class="icon-buttons">
        <!-- Tombol Tambah Produk dengan Icon Plus -->
        <a class="icon-btn" href="tambah_produk.php" title="Tambah Produk">
            <i class="bi bi-plus"></i>
        </a>

        <!-- Tombol Lihat Pesanan dengan Icon Keranjang -->
        <a class="icon-btn icon-btn-secondary" href="proses_pesanan.php" title="Lihat Pesanan">
            <i class="bi bi-cart"></i>
        </a>
    </div>
</div>

        <!-- Konten lainnya di sini, seperti tabel produk, dll -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openAddForm() {
            // Logika untuk membuka form tambah produk
            alert("Form Tambah Produk akan dibuka.");
        }

        function openOrderPage() {
            // Logika untuk membuka halaman pesanan
            alert("Halaman Pesanan akan dibuka.");
        }
    </script>

</body>
</html>

        <table>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <!-- Data produk akan diisi melalui PHP -->
                <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "root", "", "user_register");

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil data produk dari tabel
                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td><img src='{$row['gambar']}' alt='Gambar Produk'></td>
                            <td>{$row['nama_produk']}</td>
                            <td>Rp {$row['harga']}</td>
                            <td>
                                <button onclick='editProduct({$row['id']}, \"{$row['nama_produk']}\", {$row['harga']}, \"{$row['gambar']}\")'>Edit</button>
                                <button onclick='deleteProduct({$row['id']})' style='background-color: #dc3545;'>Delete</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada produk ditemukan.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

    <script>
        let currentEditId = null;

        // Fungsi untuk membuka form edit
        function editProduct(id, name, price, image) {
            currentEditId = id;
            document.getElementById('productName').value = name;
            document.getElementById('productPrice').value = price;
            document.getElementById('productImage').value = image;
            document.getElementById('editForm').style.display = 'block';
        }

        // Fungsi untuk membuka form tambah produk
        function openAddForm() {
            document.getElementById('addForm').style.display = 'block';
        }

        // Simpan perubahan setelah edit
        function saveEdit() {
            const newName = document.getElementById('productName').value;
            const newPrice = document.getElementById('productPrice').value;
            const newImage = document.getElementById('productImage').value;

            if (newName && newPrice && newImage) {
                // Kirim data edit ke server
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "editt_produk.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(xhr.responseText);
                        window.location.reload();  // Refresh halaman untuk melihat perubahan
                    }
                };
                xhr.send(id=${currentEditId}&nama_produk=${encodeURIComponent(newName)}&harga=${newPrice}&gambar=${encodeURIComponent(newImage)});
            } else {
                alert("Semua field harus diisi.");
            }
        }

        // Fungsi untuk menutup form edit tanpa menyimpan
        function closeEdit() {
            document.getElementById('editForm').style.display = 'none';
        }

        // Fungsi untuk menutup form tambah produk tanpa menyimpan
        function closeAdd() {
            document.getElementById('addForm').style.display = 'none';
        }

        // Tambahkan produk baru
        function addProduct() {
            const newName = document.getElementById('newProductName').value;
            const newPrice = document.getElementById('newProductPrice').value;
            const newImage = document.getElementById('newProductImage').value;

            if (newName && newPrice && newImage) {
                // Kirim data produk baru ke server
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "add_product.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert(xhr.responseText);
                        window.location.reload();  // Refresh halaman untuk melihat produk baru
                    }
                };
                xhr.send(nama_produk=${encodeURIComponent(newName)}&harga=${newPrice}&gambar=${encodeURIComponent(newImage)});
            } else {
                alert("Semua field harus diisi.");
            }
        }
    </script>
    <script>
    // Fungsi untuk menghapus produk
    function deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            // Kirim permintaan DELETE ke server
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_product.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    window.location.reload();  // Refresh halaman setelah penghapusan
                }
            };
            xhr.send(id=${id});
        }
    }
</script>

</body>
</html>

<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "user_register");

// Cek koneksi ke database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data yang dikirim via POST
$id = isset($_POST['id']) ? $_POST['id'] : '';
$nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';
$gambar = isset($_POST['gambar']) ? $_POST['gambar'] : '';

// Validasi data yang dikirim
if (!empty($id) && !empty($nama_produk) && !empty($harga)) {
    // Siapkan query dengan prepared statement
    $sql = "UPDATE produk SET nama_produk = ?, harga = ?, gambar = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter (s: string, i: integer)
        $stmt->bind_param("sssi", $nama_produk, $harga, $gambar, $id);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Produk berhasil diupdate.";
        } else {
            echo "Error saat mengupdate produk: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Error dalam menyiapkan query: " . $conn->error;
    }
} else {
    echo "Data tidak lengkap. Pastikan semua input diisi.";
}

// Tutup koneksi
$conn->close();
?>

<script>
    let currentEditId = null;

    // Fungsi untuk membuka form edit
    function editProduct(id, name, price, image) {
        currentEditId = id;
        document.getElementById('productName').value = name;
        document.getElementById('productPrice').value = price;
        document.getElementById('productImage').value = image;
        document.getElementById('editForm').style.display = 'block';
    }

    // Simpan perubahan setelah edit
    function saveEdit() {
        const newName = document.getElementById('productName').value;
        const newPrice = document.getElementById('productPrice').value;
        const newImage = document.getElementById('productImage').value;

        if (newName && newPrice && newImage) {
            // Kirim data edit ke server
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "editt_produk.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert("Produk berhasil diupdate.");  // Menampilkan pesan berhasil
                    closeEdit();  // Menutup form edit
                }
            };
            xhr.send(`id=${currentEditId}&nama_produk=${encodeURIComponent(newName)}&harga=${newPrice}&gambar=${encodeURIComponent(newImage)}`);
        } else {
            alert("Semua field harus diisi.");
        }
    }

    // Fungsi untuk menutup form edit tanpa menyimpan
    function closeEdit() {
        document.getElementById('editForm').style.display = 'none';
    }
</script>

<!-- Form Edit Produk -->
<div id="editForm" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; box-shadow:0px 0px 15px rgba(0,0,0,0.1);">
    <h3>Edit Produk</h3>
    <div class="mb-3">
        <label for="productName" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="productName">
    </div>
    <div class="mb-3">
        <label for="productPrice" class="form-label">Harga</label>
        <input type="number" class="form-control" id="productPrice">
    </div>
    <div class="mb-3">
        <label for="productImage" class="form-label">URL Gambar</label>
        <input type="text" class="form-control" id="productImage">
    </div>
    <button class="btn btn-primary" onclick="saveEdit()">Simpan</button>
    <button class="btn btn-secondary" onclick="closeEdit()">Batal</button>
</div>





<script>
    // Fungsi untuk menghapus produk
    function deleteProduct(id) {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            // Kirim permintaan DELETE ke server
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_product.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    window.location.reload();  // Refresh halaman setelah penghapusan
                }
            };
            xhr.send(`id=${id}`);
        }
    }
</script>


