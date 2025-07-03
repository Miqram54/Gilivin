<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "user_register");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data yang dikirim via POST
$id = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];

// Update produk di database
$sql = "UPDATE produk SET nama_produk = '$nama_produk', harga = '$harga', gambar = '$gambar' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil diupdate.";
} else {
    echo "Error: " . $conn->error;
}

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
            xhr.open("POST", "edit_product.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert(xhr.responseText);
                    window.location.reload();  // Refresh halaman untuk melihat perubahan
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


