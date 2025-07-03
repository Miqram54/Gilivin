<?php 
session_start();

if (isset($_SESSION['nama_lengkap'])) {
    // echo "Selamat datang, " . $_SESSION['nama_lengkap'] . "!";
} else {
    echo "Anda belum login.";
}
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
$stmt = $conn->prepare("SELECT * FROM produk");
$stmt->execute();
$result = $stmt->get_result();

$products = []; 
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Gilivin - Agriculture</title>
    <link  rel="shortcut icon"  type="image/x-icon" href="logo_web.png" type="image/png">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.css" rel="stylesheet">

    <!-- Jquery UI -->
    <link type="text/css" href="./assets/css/jquery-ui.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon-design-system.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link type="text/css" href="./assets/css/style.css" rel="stylesheet">

 

</head>

<body>
    <?php
    if (isset($_SESSION['nama_lengkap'])) {
        
        $namaLengkap = $_SESSION['nama_lengkap'];

        echo "<script>alert('Selamat datang,  {$namaLengkap}!')</script>";  
              
        
    }
    ?>
    
    <header class="header clearfix">
        <div class="top-bar d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <ul class="top-links contact-info">
                            <li><i class="fa fa-envelope-o"></i> <a href="https://mail.google.com/mail/u/0/#inbox?compose=new">ikaliqram@gmail.com</a></li>
                            <li><i class="fa fa-whatsapp"></i> <a target="_blank" href="https://wa.me/6282190655934"> +62 821-9065-5934 </a></li>
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
                    <div class="col-lg-7 col-12 col-sm-6">
    <form action="search_results.php" method="GET" class="search">
        <div class="input-group w-100">
            <input type="text" name="query" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>

                    <div class="col-lg-2 col-12 col-sm-6">
    <div class="right-icons pull-right d-none d-lg-block">
        <div class="icon-row">
            <div class="single-icon wishlist">
                <a href="cs.php"><i class="bi bi-headset" style="font-size:30px;"></i></a>
                <span class="badge badge-default"></span>
            </div>
            <div class="single-icon wishlist">
                <a href="produkfavorite.php"><i class="fa fa-heart-o fa-2x"></i></a>
                <span class="badge badge-default"></span>
            </div>
        </div>
        <div class="icon-row">
            <div class="single-icon shopping-cart">
                <a href="keranjang.php"><i class="fa fa-shopping-cart fa-2x"></i></a>
                <span class="badge badge-default"></span>
            </div>
            <div class="single-icon shopping-cart">
                <a href="riwayat_pesanan.php"><i class="bi bi-bag-check"></i>
                <span class="badge badge-default"></span>
            </div>
        </div>
    </div>
</div>

<style>
    .right-icons {
        display: flex;
        flex-direction: column;
    }

    .icon-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.single-icon {
    text-align: center;
    padding: 0 5px;
}


    .single-icon i {
        font-size: 30px;
    }

    .fa-heart-o, .fa-shopping-cart {
        font-size: 30px;
    }
</style>

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
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <!-- Link "About" yang membuka modal -->
                        <style>
        /* CSS untuk pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background: white;
            padding: 30px;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: relative;
        }

        .popup-content h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .popup-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }

        .close-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .close-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <nav>
        <ul>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="showPopup()">Tentang</a>
            </li>
        </ul>
    </nav>

    <!-- Pop-up overlay -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <h2>Tentang Gilivin</h2>
            <p>Gilivin adalah website marketplace khusus untuk jual beli alat-alat pertanian, mulai dari alat penggerak utama, alat pengolah tanah, alat tanam, hingga alat pemupukan dan pengendalian hama. Website ini berfungsi sebagai wadah bagi para penjual alat-alat pertanian di Sulawesi Selatan yang ingin memperluas jangkauan pasar mereka untuk meningkatkan omzet penjualan mereka. Selain itu, Gilivin juga memudahkan para petani atau pelanggan yang membutuhkan alat-alat pertanian, tetapi memiliki kendala jarak dengan toko ataupun kendala teknis lainnya yang menyebabkan pelanggan tidak bisa secara langsung membeli alatnya di toko, sehingga website ini menjadi solusi yang tepat untuk masalah tersebut.</p>
            <button class="close-btn" onclick="closePopup()">Close</button>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan pop-up
        function showPopup() {
            document.getElementById("popupOverlay").style.display = "flex";
        }

        // Fungsi untuk menutup pop-up
        function closePopup() {
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>

</body>
</html>

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
    SLIDER
    ------------------------------------------->
    <section class="slider-section pt-4 pb-4">
        <div class="container">
            <div class="slider-inner">
                <div class="row">
                    <div class="col-md-3">
                        <nav class="nav-category">
                           
                            <h2></h2>
                            <ul class="menu-category">
                                <li><a>Gilivin<br>Market place pertanian</a></li>
                                <li><a>~ Terpercaya</a></li>
                                <li><a>~ Barang Original</a></li>
                                <li><a>~ Berkualitas</a></li>
                                <li><a>~ Terbaik</a></li>
                                <li><a>~ Bergaransi Resmi</a></li>
                                <li><a>~ Harga Terjangkau</a></li>
                                <li><a>~ Terlengkap</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-9">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner shadow-sm rounded">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="./assets/img/slides/alat_penggerak2.png" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color: white; font-weight: bold;">Alat Pengerak Utama</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./assets/img/slides/alat_pengolah_tanah.jpg" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color: white; font-weight: bold;">Alat Pengolah Tanah</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./assets/img/slides/alat_penanam_padi.png" alt="Third slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color: white; font-weight: bold;">Alat Tanam</h5>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Slider -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-info mr-4">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="media-body">
                            <h5>Fast Shipping</h5>
                            <p class="text-muted">
                                All you have to do is to bring your passion. We take care of the rest.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                            <i class="fa fa-credit-card-alt"></i>
                        </div>
                        <div class="media-body">
                            <h5>Online Payment</h5>
                            <p class="text-muted">
                                All you have to do is to bring your passion. We take care of the rest.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="media">
                        <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                            <i class="fa fa-refresh"></i>
                        </div>
                        <div class="media-body">
                            <h5>Free Return</h5>
                            <p class="text-muted">
                                All you have to do is to bring your passion. We take care of the rest.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
    .single-product {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        height: 100%; /* Ensures equal height for all products */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-img {
        width: 100%;
        height: 200px; /* Set fixed height for images */
        overflow: hidden;
    }

    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure the images cover the container while keeping aspect ratio */
    }

    .product-content {
        text-align: center;
    }

    .product-content h3 {
        margin-top: 15px;
        font-size: 1.2rem;
    }

    .product-price {
        margin-top: 10px;
        font-size: 1.1rem;
        color: #333;
    }
</style>

<section class="products-grids trending pb-4" id="jenis_produk">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Produk <br> <br>Alat Penggerak Utama</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <?php
            foreach ($products as $row) {
                if($row['tipe_produk'] == 'Alat penggerak utama') {
        ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.php?id_produk=<?=$row["id"]?>">
                        <img src="<?= $row['gambar'] ?>" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.php?id_produk=<?=$row["id"]?>"><?= $row['nama_produk'] ?></a></h3>
                        <div class="product-price">
                            <span>Rp. <?= $row['harga'] ?></span>
                        </div>
                    </div>
                </div>
            </div>      
        <?php 
                }
            }
        ?>
        </div>
    </div>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Alat Pengolah Tanah</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <?php
            foreach ($products as $row) {
                if($row['tipe_produk'] == 'Alat pengolah tanah') {
        ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.php?id_produk=<?=$row["id"]?>">
                        <img src="<?= $row['gambar'] ?>" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.php?id_produk=<?=$row["id"]?>"><?= $row['nama_produk'] ?></a></h3>
                        <div class="product-price">
                            <span>Rp. <?= $row['harga'] ?></span>
                        </div>
                    </div>
                </div>
            </div>      
        <?php 
                }
            }
        ?>
        </div>
    </div>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Alat Tanam</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <?php
            foreach ($products as $row) {
                if($row['tipe_produk'] == 'Alat tanam') {
        ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.php?id_produk=<?=$row["id"]?>">
                        <img src="<?= $row['gambar'] ?>" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.php?id_produk=<?=$row["id"]?>"><?= $row['nama_produk'] ?></a></h3>
                        <div class="product-price">
                            <span>Rp. <?= $row['harga'] ?></span>
                        </div>
                    </div>
                </div>
            </div>      
        <?php 
                }
            }
        ?>
        </div>
    </div>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Alat Pemupukan dan Pengendalian Hama</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <?php
            foreach ($products as $row) {
                if($row['tipe_produk'] == 'Alat pemupukan dan pengendalian hama') {
        ?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="product-detail.php?id_produk=<?=$row["id"]?>">
                        <img src="<?= $row['gambar'] ?>" class="img-fluid" />
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.php?id_produk=<?=$row["id"]?>"><?= $row['nama_produk'] ?></a></h3>
                        <div class="product-price">
                            <span>Rp. <?= $row['harga'] ?></span>
                        </div>
                    </div>
                </div>
            </div>      
        <?php 
                }
            }
        ?>
        </div>
    </div>
</section>

              
            </div>
        </div>
    </section>
    <section class="mobile-apps pt-5 pb-3 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Download apps</h3>
                    <p>Get an amazing app to make Your life easy</p>
                </div>
                <div class="col-md-6 text-md-right">
                    <a href="#"><img src="./assets/img/appstore.png" height="40"></a>
                    <a href="#"><img src="./assets/img/appstore.png" height="40"></a>
                </div>
            </div> <!-- row.// -->
        </div><!-- container // -->
    </section>
    <footer class="footer bg-success">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo-footer">
                                <i class="fa fa-shopping-bag fa-3x"></i> <span class="logo">GILIVIN</span>
                            </div>
                            <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna
                                eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor,
                                facilisis luctus, metus.</p>
                            <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456
                                        789</a></span></p>
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

    
</body>

</html>


