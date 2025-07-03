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
            background-image: url('./assets/img/theme/img2.jpg'); /* Ganti dengan path ke gambar latar belakang */
            background-size: cover; /* Menutupi seluruh area */
            background-position: center; /* Menempatkan gambar di tengah */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.9); /* Transparan putih untuk latar belakang kontainer */
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
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        input[type="file"] {
            border: none;
            margin-top: 10px;
        }

        button {
            background-color: #4CAF50; /* Hijau */
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; /* Hijau lebih gelap */
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
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px;
            text-align: center;
            border-radius: 10px;
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
        <input type="hidden" name="id" value="<?php echo $product ? $product['id'] : ''; ?>">
        
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" required value="<?php echo $product ? $product['nama_produk'] : ''; ?>">

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required value="<?php echo $product ? $product['harga'] : ''; ?>">

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required><?php echo $product ? $product['deskripsi'] : ''; ?></textarea>

        <label for="tipe_produk">Tipe Produk:</label>
        <select id="tipe_produk" name="tipe_produk" required>
            <option value="Alat Penggerak Utama" <?php echo isset($product) && $product['tipe_produk'] == 'Alat Penggerak Utama' ? 'selected' : ''; ?>>Alat Penggerak Utama</option>
            <option value="Alat Pengolah Tanah" <?php echo isset($product) && $product['tipe_produk'] == 'Alat Pengolah Tanah' ? 'selected' : ''; ?>>Alat Pengolah Tanah</option>
            <option value="Alat Tanam" <?php echo isset($product) && $product['tipe_produk'] == 'Alat Tanam' ? 'selected' : ''; ?>>Alat Tanam</option>
            <option value="Alat Pemupukan" <?php echo isset($product) && $product['tipe_produk'] == 'Alat Pemupukan' ? 'selected' : ''; ?>>Alat Pemupukan dan Pengendalian Hama</option>
        </select>

        <label for="gambar">Gambar Produk:</label>
        <input type="file" id="gambar" name="gambar">

        <button type="submit"><?php echo $product ? 'Perbarui Produk' : 'Tambah Produk'; ?></button>
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
    }

    function closeModal() {
        document.getElementById('notificationModal').style.display = 'none';
    }

    // Tutup modal saat klik di luar konten modal
    window.onclick = function(event) {
        const modal = document.getElementById('notificationModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
</body>
</html>


