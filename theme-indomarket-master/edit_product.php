<?php 
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "user_register");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada ID produk yang dikirim untuk edit
$product = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data produk berdasarkan ID untuk edit
    $sql = "SELECT * FROM produk WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit();
    }
}

// Periksa apakah data POST ada untuk tambah/edit
$message = ""; // Tambahkan variabel untuk menyimpan pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null; // ID produk, null jika baru
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi']; // Deskripsi produk
    $tipe_produk = $_POST['tipe_produk']; // Tipe produk

    // Cek apakah gambar di-upload
    $gambar = null;
    if ($_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        // Mendapatkan informasi gambar
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        
        // Cek jika file adalah gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($_FILES["gambar"]["size"] > 5000000) { // batas ukuran file 5MB
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan jenis file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
            $uploadOk = 0;
        }

        // Cek jika $uploadOk di-set ke 0 oleh kesalahan
        if ($uploadOk == 0) {
            echo "Maaf, file tidak di-upload.";
        } else {
            // Jika semua ok, coba upload file
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar = $target_file; // Set gambar dengan path yang baru
            } else {
                echo "Maaf, terjadi kesalahan saat meng-upload file.";
            }
        }
    }

    // Jika gambar tidak di-upload, ambil gambar yang ada (jika edit)
    if (!$gambar && $id) {
        $sql = "SELECT gambar FROM produk WHERE id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $gambar = $row['gambar']; // Ambil gambar lama
        }
    }

    // Jika ID ada, update produk, jika tidak, insert produk baru
    if ($id) {
        $sql = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', deskripsi='$deskripsi', tipe_produk='$tipe_produk', gambar='$gambar' WHERE id='$id'";
        $message = "Produk berhasil diperbarui!";
    } else {
        $sql = "INSERT INTO produk (nama_produk, harga, deskripsi, tipe_produk, gambar) VALUES ('$nama_produk', '$harga', '$deskripsi', '$tipe_produk', '$gambar')";
        $message = "Produk berhasil ditambahkan!";
    }

    if ($conn->query($sql) === TRUE) {
        // Panggil JavaScript untuk menampilkan notifikasi hanya saat produk ditambahkan
        if (!$id) { // Hanya untuk tambah produk baru
            echo "<script>showNotification('$message');</script>";
        }
    } else {
        echo "<div class='notification error'>Error: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product ? 'Edit Produk' : 'Tambah Produk'; ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
           body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="file"], textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        /* CSS untuk modal */
        #notificationModal {
            display: none; /* Awalnya tersembunyi */
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5); /* Latar belakang hitam dengan transparansi */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Mengatur margin */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            border-radius: 8px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
        
</head>
<body>

<div class="container">
    <h1><?php echo $product ? 'Edit Produk' : 'Tambah Produk'; ?></h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id'] ?? ''; ?>">
        
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $product['nama_produk'] ?? ''; ?>" required>
        
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?php echo $product['harga'] ?? ''; ?>" required>

        <label for="deskripsi">Deskripsi Produk:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $product['deskripsi'] ?? ''; ?></textarea>
        
        <label for="tipe_produk">Tipe Produk:</label>
        <select id="tipe_produk" name="tipe_produk" required>
            <option value="Alat penggerak utama" <?php echo ($product['tipe_produk'] ?? '') == 'Alat penggerak utama' ? 'selected' : ''; ?>>Alat penggerak utama</option>
            <option value="Alat pengolah tanah" <?php echo ($product['tipe_produk'] ?? '') == 'Alat pengolah tanah' ? 'selected' : ''; ?>>Alat pengolah tanah</option>
            <option value="Alat tanam" <?php echo ($product['tipe_produk'] ?? '') == 'Alat tanam' ? 'selected' : ''; ?>>Alat tanam</option>
            <option value="Alat pemupukan dan pengendalian hama" <?php echo ($product['tipe_produk'] ?? '') == 'Alat pemupukan dan pengendalian hama' ? 'selected' : ''; ?>>Alat pemupukan dan pengendalian hama</option>
        </select>

        <label for="gambar">Gambar:</label>
        <input type="file" id="gambar" name="gambar">
        <?php if ($product && $product['gambar']): ?>
            <img src="<?php echo $product['gambar']; ?>" alt="Gambar Produk" style="width:100px;">
        <?php endif; ?>
        
        <button type="submit"><?php echo $product ? 'Simpan Perubahan' : 'Tambah Produk'; ?></button>
    </form>
</div>

<!-- Modal untuk notifikasi -->
<div id="notificationModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="notificationMessage"></p>
    </div>
</div>

<script>
    function showNotification(message) {
        document.getElementById('notificationMessage').innerText = message;
        document.getElementById('notificationModal').style.display = 'block';
        
        // Tutup modal setelah 3 detik
        setTimeout(closeModal, 3000);
    }

    function closeModal() {
        document.getElementById('notificationModal').style.display = 'none';
    }
</script>

</body>
</html>
