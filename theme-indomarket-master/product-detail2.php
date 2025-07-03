<?php 
session_start();

// if (isset($_SESSION['nama_lengkap'])) {
//     echo "Selamat datang, " . $_SESSION['nama_lengkap'] . "!";
// } else {
//     echo "Anda belum login.";
// }
$host = 'localhost'; 
$db = 'user_register'; 
$user = 'root'; 
$pass = ''; // Update with your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gilivin - Agriculture</title>
  
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Jquery UI -->
    <link type="text/css" href="./assets/css/jquery-ui.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon-design-system.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link type="text/css" href="./assets/css/style.css" rel="stylesheet">

    <!-- Optional Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <header class="header clearfix">
        <div class="top-bar d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <ul class="top-links contact-info">
                            <li><i class="fa fa-envelope-o"></i> <a href="https://mail.google.com/mail/u/0/#inbox?compose=new">ikaliqram@gmail.com</a></li>
                            <li><i class="fa fa-whatsapp"></i> <a href="https://wa.me/6282190655934"> +62 821-9065-5934</a></li>
                        </ul>
                    </div>
                    <div class="col-6 text-right">
                        <ul class="top-links account-links">
                        <i class="bi bi-chat-dots"></i> <a href="../realtime-websocket-php-chat-application-main/index.php">Live Chat</a></li>
                            <li><i class="fa fa-user-circle-o"></i> <a href="../eduadmiin/eduadmin-template.multipurposethemes.com/bs4/main/extra_profile.php">My Account</a></li>
                            <li><i class="fa fa-power-off"></i> <a href="../eduadmiin/eduadmin-template.multipurposethemes.com/bs4/main/auth_login.html">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main border-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-12 col-sm-6">
                <a class="navbar-brand mr-lg-5" href="./index.html">
                <img src="../images/Logo_gilivin-removebg-preview.png" alt="GILIVIN Logo" class="logo" style="max-width: 75%; height: auto;">
                </a>
            </div>

            <div class="col-lg-7 col-12 col-sm-6 text-center">
                <marquee behavior="scroll" direction="left" style="color: #32CD32; font-weight: bold; font-size: 1.5em;">
                    GILIVIN &nbsp;Pusat Penjualan Alat Pertanian Terpercaya ~ Original ~ Berkualitas ~ Terbaik ~ Bergaransi Resmi ~ Harga Terjangkau ~ Dan Terlengkap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Butuh Alat Pertanian Yaaaa Di Gilivin Aja
                </marquee>
            </div>
            <div class="col-lg-2 col-12 col-sm-6">
                <div class="right-icons pull-right d-none d-lg-block">
                    <div class="single-icon wishlist">
                        <a href="produkfavorite.php"><i class="fa fa-heart-o fa-2x"></i></a>
                        <span class="badge badge-default"></span>
                    </div>
                    <div class="single-icon shopping-cart">
                        <a href="keranjang.php"><i class="fa fa-shopping-cart fa-2x"></i></a>
                        <span class="badge badge-default"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-main navbar-expand-lg navbar-light border-top border-bottom">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">Menu</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#jenis_produk">Produk</a>
                                <a class="dropdown-item" href="keranjang.php">Keranjang</a>
                                <a class="dropdown-item" href="riwayat_pesanan.php">Riwayat Pesanan</a>
                                <a class="dropdown-item" href="faq.php">FAQ</a>
                            </div>
                        </li>
                    </ul>
                </div> <!-- collapse .// -->
            </div> <!-- container .// -->
        </nav>
    </header>
    <!------------------------------------------
    Page Header
    ------------------------------------------->
    <section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
            </ol>
        </div>
    </section>
    <section class="product-page pb-4 pt-4">
        <div class="container">
        <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
            <div class="row product-detail-inner">
                <div class="col-lg-6 col-md-6 col-12">
                    <div id="product-images" class="carousel slide" data-ride="carousel">
                        <!-- slides -->
                        <div class="carousel-inner">
                            <div class="carousel-item active"> <img src="<?=$row['gambar']?>" alt="Product 1"> </div>
                            <div class="carousel-item"> <img src="<?=$row['gambar']?>" alt="Product 2"> </div>
                            <div class="carousel-item"> <img src="<?=$row['gambar']?>" alt="Product 3"> </div>
                            <div class="carousel-item"> <img src="<?=$row['gambar']?>" alt="Product 4"> </div>
                        </div> <!-- Left right -->
                        <a class="carousel-control-prev" href="#product-images" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#product-images" data-slide="next"> <span class="carousel-control-next-icon"></span> </a><!-- Thumbnails -->
                        <ol class="carousel-indicators list-inline">
                            <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="<?=$row['gambar']?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#product-images"> <img src="<?=$row['gambar']?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#product-images"> <img src="<?=$row['gambar']?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-3" data-slide-to="3" data-target="#product-images"> <img src="<?=$row['gambar']?>" class="img-fluid"> </a> </li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="product-detail">
                        <h2 class="product-name"><?=$row['nama_produk']?></h2>
                        <div class="product-price">
                            <span class="price">Rp. <?=$row['harga']?></span><span class="price-muted">Rp. 500.000.000</span>
                        </div>
                        <div class="product-short-desc">
                            <p style="word-wrap:break-word"><?=$row['deskripsi']?>
                            </p>
                        </div>
                        <div class="product-select">
                            <form>
                                <div class="form-group">
                                   
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control">
                                        <option>Merah Merona</option>
                                        <option>Hijau Mempesona</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="number" class="form-control" value="1"/>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" class="btn btn-primary btn-block add-to-cart" 
                                        data-product_id="<?=$row['id']?>" data-name="<?=$row['nama_produk']?>" data-price="<?=$row['harga']?>" data-user_id="<?=$_SESSION['user_id']?>">Tambah Keranjang</button>
                                    </div>
                                    
                                    <div class="col-md-4">
    <a href="#" class="btn btn-secondary wishlist-btn" 
       data-product_id="<?=$row['id']?>" 
       data-name="<?=$row['nama_produk']?>" 
       data-price="<?=$row['harga']?>" 
       data-user_id="<?=$_SESSION['user_id']?>"><i class="fa fa-heart-o"></i></a>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Event listener untuk tombol wishlist
        $('.wishlist-btn').on('click', function(e) {
            e.preventDefault();
            
            // Ambil data produk dari atribut tombol
            var product_id = $(this).data('product_id');
            var product_name = $(this).data('name');
            var product_price = $(this).data('price');
            var user_id = $(this).data('user_id');
            
            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: 'wishlist_handler.php', // Endpoint yang akan menangani penyimpanan wishlist
                method: 'POST',
                data: {
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    user_id: user_id
                },
                success: function(response) {
                    if (response === 'success') {
                        alert('Produk berhasil ditambahkan ke wishlist!');
                    } else {
                        alert('Gagal menambahkan produk ke wishlist.');
                    }
                }
            });
        });
    });
</script>

                            </form>
                        </div>
                        <div class="product-categories">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="https://www.nicheagriculture.com/agriculture-vs-farming/">Agriculture</a></li>
                                <li><a href="https://www.traknus.co.id/id/news/category/article/best-recommendation-tractors-to-buy-for-your-farm">Traktor</a></li>
                                <li><a href="https://pertanian.sultengprov.go.id/varietas-padi-ramah-lingkungan-gsr/">Padi</a></li>
                                <li><a href="https://bbppmpvbmti.kemdikbud.go.id/main/otomotif/">Otomotif</a></li>
                                <li><a href="https://unm.ac.id/">UNM</a></li>
                            </ul>
                        </div>
                        <div class="product-tags">
                         <ul>
                                <li class="categories-title">Tags :</li>
                                <li><a href="https://www.nicheagriculture.com/agriculture-vs-farming/">Agriculture</a></li>
                                <li><a href="https://www.traknus.co.id/id/news/category/article/best-recommendation-tractors-to-buy-for-your-farm">Traktor</a></li>
                                <li><a href="https://pertanian.sultengprov.go.id/varietas-padi-ramah-lingkungan-gsr/">Padi</a></li>
                                <li><a href="https://bbppmpvbmti.kemdikbud.go.id/main/otomotif/">Otomotif</a></li>
                                <li><a href="https://unm.ac.id/">UNM</a></li>
                            </ul>
                        </div>
                        <div class="product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Ulasan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <p style="word-wrap:break-word"><?= $row['deskripsi'] ?></p>
            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="review-form">
                    <h3>-------------------- >Berikan ulasan tentang produk ini< --------------------</h3>
                    <form id="reviewForm">
                        <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" name="nama_pengguna" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Ulasan</label>
                            <textarea name="ulasan" cols="4" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" name="id_produk" value="<?= $row['id'] ?>" />
                        <button type="button" class="btn btn-primary" onclick="submitReview()">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitReview() {
        // Ambil data dari formulir
        const formData = new FormData(document.getElementById('reviewForm'));

        // Kirim data menggunakan AJAX
        fetch('submit_ulasan.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                alert("Ulasan berhasil dikirim!");
                document.getElementById('reviewForm').reset(); // Reset formulir setelah sukses
            } else {
                alert("Gagal mengirim ulasan. Coba lagi.");
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>


<!-- Tambahkan JavaScript untuk menampilkan pop-up -->
<script>
    // Cek URL untuk melihat apakah ada parameter success
    if (window.location.search.includes('success=true')) {
        alert("Ulasan berhasil dikirim!");
        // Hapus parameter success dari URL setelah ditampilkan
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }}
        ?>
        </div>
    </section>
    <section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Produk Serupa</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <?php
// Query untuk mengambil 4 produk dari tabel produk
$sql = "SELECT * FROM produk LIMIT 4";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Membungkus card dengan div row untuk tata letak grid
    echo '<div class="row">';

    // Loop melalui hasil query
    while ($row = $result->fetch_assoc()) {
        // Setiap produk menggunakan col-* untuk tata letak grid
        echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">'; // Ukuran kolom responsif untuk berbagai perangkat
        echo '    <div class="card single-product h-100 d-flex flex-column align-items-center">'; // h-100 untuk tinggi sama, align-items-center untuk konten tengah
        echo '        <div class="product-img w-100">'; // w-100 agar gambar memenuhi card
        echo '            <a href="product-detail.php?id_produk=' . $row["id"] . '">';
        echo '                <img src="' . $row["gambar"] . '" class="card-img-top img-fluid" alt="' . $row["nama_produk"] . '" />'; // Tambahkan alt untuk SEO
        echo '            </a>';
        echo '        </div>';
        echo '        <div class="card-body product-content text-center w-100 d-flex flex-column">'; // flex-column untuk mengatur nama dan harga
        echo '            <h5 class="card-title mt-2"><a href="product-detail.php?id=' . $row["id"] . '">' . $row["nama_produk"] . '</a></h5>';
        echo '            <p class="card-text product-price mt-auto mb-2">Rp. ' . number_format($row["harga"], 0, ',', '.') . '</p>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }

    echo '</div>'; // Menutup div row
} else {
    echo "Tidak ada produk yang ditemukan.";
}

// Tutup koneksi
$conn->close();
?>

        </div>
    </div>
</section>

    <footer class="footer bg-success">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo-footer">
                                <i class=""></i> <span class="logo">GILIVIN</span>
                            </div>
                            <p class="text">Temukan solusi terbaik untuk kebutuhan Anda! GILIVIN siap memberikan hasil maksimal, kini dengan harga spesial!</p>
                            <p class="call">Info Lebih Lanjut<span><a href="tel:123456789">+6285761057732
                                        </a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Services</h4>
                            <ul>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Get In Touch</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>NO. 342 - London Oxford Street.</li>
                                    <li>012 United Kingdom.</li>
                                    <li>info@indomarket.com</li>
                                    <li>+032 3456 7890</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-flickr"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-inner border-top">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p>Copyright © 2021 <a href="http://indokoding.net" target="_blank">IndoKoding.net</a> -
                                    All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right pull-right">
                                <ul class="payment-cards">
                                    <li><i class="fa fa-cc-paypal"></i></li>
                                    <li><i class="fa fa-cc-amex"></i></li>
                                    <li><i class="fa fa-cc-mastercard"></i></li>
                                    <li><i class="fa fa-cc-stripe"></i></li>
                                    <li><i class="fa fa-cc-visa"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Core -->
    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/core/jquery-ui.min.js"></script>

    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Argon JS -->
    <script src="./assets/js/argon-design-system.js"></script>

    <!-- Main JS-->
    <script src="./assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                var productName = $(this).data('name');
                var product_id = $(this).data('product_id');
                var productPrice = $(this).data('price');
                var user_id = $(this).data('user_id');
        
                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php', // Ganti dengan path yang benar untuk file PHP
                    data: {
                        name: productName,
                        product_id: product_id,
                        price: productPrice,
                        user_id: user_id
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            });
        });
        </script>
        </script>
        
</body>
<style>
.right-icons .single-icon i {
    font-size: 2em; /* Sama dengan ukuran fa-2x */
}

.right-icons .single-icon {
    display: inline-block;
    margin: 0 10px;
    position: relative;
}

.badge-default {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.8em;
}
</style>

