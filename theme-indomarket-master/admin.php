<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduadmin-template.multipurposethemes.com/bs4/main/widgets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 01:50:45 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://eduadmin-template.multipurposethemes.com/bs4/images/favicon.ico">

    <title>Gilivin - Admin</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skin_color.css">
    <style>
        /* Webpixels CSS */
        /* Utility and component-centric Design System based on Bootstrap for fast, responsive UI development */
        /* URL: https://github.com/webpixels/css */

        @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css);

        /* Bootstrap Icons */
        @import url("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css");
    </style>

</head>

<body class="hold-transition light-skin sidebar-mini theme-success fixed">

    <!-- Banner -->
    <a href="https://webpixels.io/components?ref=codepen" class="btn w-full btn-success tCrafext-truncate rounded-0 py-2 border-0 position-relative" style="z-index: 1000;">
        <strong>Gilivin:</strong> Pusat Jual Beli Alat Pertanian Terpercaya di Sulawesi Selatan
    </a>

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                    <img src="../eduadmiin/eduadmin-template.multipurposethemes.com/bs4/images/gilivin.png" width="700px" alt="">
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                        <!-- Toggle -->
                        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="laporan_penjualan.php">
                                <i class="bi bi-bar-chart"></i> Laporan Penjualan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cstable.php">
                                <i class="bi bi-chat"></i> Customer Service
                                <span class="badge bg-soft-primary text-success rounded-pill d-inline-flex align-items-center ms-auto"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kelola_produk.php">
                                <i class="bi bi-bookmarks"></i> Kelola Toko
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ulasan.php">
                                <i class="bi bi-envelope-open"></i> Ulasan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="php-socket.php">
                                <i class="bi bi-chat"></i> Chat
                                <span class="badge bg-soft-primary text-success rounded-pill d-inline-flex align-items-center ms-auto"></span>
                            </a>
                            <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        /* Pop-up styling */
        #userModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            max-width: 500px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #userModal.show {
            opacity: 1;
        }

        #userModal .close {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            color: #888;
        }

        #userModal .close:hover {
            color: #333;
        }

        #modalOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .table-container {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .table-container h5 {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        /* Table styling */
        .table thead th {
            background-color: #6c757d;
            color: #fff;
            font-weight: 500;
            border: none;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .table tbody td {
            padding: 12px;
            color: #555;
        }
        
    </style>
</head>

<body>
    <!-- Navigation item for Users -->
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="#" id="usersLink">
                <i class="bi bi-people bi"></i>Users
            </a>
        </li>
    </ul>

    <!-- Pop-up Modal for Users Table -->
    <div id="modalOverlay"></div>
    <div id="userModal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="table-container">
            <h5 class="mb-3">Daftar Pengguna</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Data from PHP will be injected here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Function to open modal and load user data
        document.getElementById("usersLink").addEventListener("click", function (e) {
            e.preventDefault();
            $.ajax({
                url: 'get_users.php', // Create this PHP file to retrieve user data
                type: 'GET',
                success: function (data) {
                    $("#userTableBody").html(data);
                    $("#modalOverlay").show();
                    $("#userModal").addClass('show').show();
                }
            });
        });

        // Function to close modal
        function closeModal() {
            $("#modalOverlay").hide();
            $("#userModal").removeClass('show').hide();
        }
    </script>
</body>

</html>

                    </ul>
                    <!-- Divider -->
                    <hr class="navbar-divider my-55 opacity-20">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                                ADMIN
                                <span class="badge bg-soft-success text-success rounded-pill d-inline-flex align-items-center ms-4">5</span>
                            </div>
                        </li>
                        <li>
                            <!-- Trigger Link for Muhammad Iqram -->
                            <ul>
                                <li>
                                    <a href="#" class="nav-link d-flex align-items-center" onclick="showPopup('popupIqram')">
                                        <div class="me-4">
                                            <div class="position-relative d-inline-block text-white">
                                                <span class="avatar bg-soft-primary text-primary rounded-circle">Iqr</span>
                                                <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-sm font-semibold">Muhammad Iqram</span>
                                            <span class="d-block text-xs text-muted font-regular">Takalar</span>
                                        </div>
                                        <div class="ms-auto"><i class="bi bi-chat"></i></div>
                                    </a>

                                    <!-- Popup for Muhammad Iqram -->
                                    <div class="popup-overlay" id="popupOverlay" style="display: none;"></div>
                                    <div class="popup" id="popupIqram" style="display: none;">
                                        <img src="images/staff-02.jpg" alt="Foto Admin" class="popup-img">
                                        <h2>Biodata Admin</h2>
                                        <p><strong>Nama Lengkap:</strong> Muhammad Iqram</p>
                                        <p><strong>Posisi:</strong> Presiden</p>
                                        <p><strong>Email:</strong> <a href="mailto:gibran123@gmail.com">gibran123@gmail.com</a></p>
                                        <p><strong>Telepon:</strong> +62 812 3456 7890</p>
                                        <p><strong>Alamat:</strong> Jl. Kebangsaan No. 123, Jakarta, Indonesia</p>
                                        <p><strong>Bio:</strong> Seorang profesional IT dengan lebih dari 5 tahun pengalaman dalam manajemen sistem, pengembangan web, dan keamanan siber.</p>
                                        <p><strong>Media Sosial:</strong></p>
                                        <ul class="social-media-list">
                                            <li>LinkedIn: <a href="https://www.linkedin.com/in/budi-santoso" target="_blank">linkedin.com/in/budi-santoso</a></li>
                                            <li>Twitter: <a href="https://twitter.com/budi_santoso" target="_blank">@budi_santoso</a></li>
                                        </ul>
                                        <div class="button-container">
                                            <button class="close-btn" onclick="hidePopup('popupIqram')">Tutup</button>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="#" class="nav-link d-flex align-items-center" onclick="showPopup('popupGibran')">
                                        <div class="me-4">
                                            <div class="position-relative d-inline-block text-white">
                                                <span class="avatar bg-soft-warning text-warning rounded-circle">Gib</span>
                                                <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-sm font-semibold">Muh. Kahlil Gibran</span>
                                            <span class="d-block text-xs text-muted font-regular">Selayar</span>
                                        </div>
                                        <div class="ms-auto"><i class="bi bi-chat"></i></div>
                                    </a>

                                    <!-- Popup for Muh. Kahlil Gibran -->
                                    <div class="popup" id="popupGibran" style="display: none;">
                                        <img src="../images/staff-01.jpg" alt="Foto Admin" class="popup-img">
                                        <h2>Biodata Admin</h2>
                                        <p><strong>Nama Lengkap:</strong> Muh Kahlil Gibran</p>
                                        <p><strong>Posisi:</strong> Wakil Presiden</p>
                                        <p><strong>Email:</strong> <a href="mailto:gibran123@gmail.com">gibran123@gmail.com</a></p>
                                        <p><strong>Telepon:</strong> +62 812 3456 7890</p>
                                        <p><strong>Alamat:</strong> Jl. Kebangsaan No. 123, Jakarta, Indonesia</p>
                                        <p><strong>Media Sosial:</strong></p>
                                        <ul class="social-media-list">
                                            <li>LinkedIn: <a href="https://www.linkedin.com/in/budi-santoso" target="_blank">linkedin.com/in/budi-santoso</a></li>
                                            <li>Twitter: <a href="https://twitter.com/budi_santoso" target="_blank">@budi_santoso</a></li>
                                        </ul>
                                        <div class="button-container">
                                            <button class="close-btn" onclick="hidePopup('popupGibran')">Tutup</button>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="#" class="nav-link d-flex align-items-center" onclick="showPopup('popupVina')">
                                        <div class="me-4">
                                            <div class="position-relative d-inline-block text-white">
                                                <img alt="..." src="https://images.unsplash.com/photo-1610899922902-c471ae684eff?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar rounded-circle">
                                                <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-sm font-semibold">Vina Annisa Sofyan</span>
                                            <span class="d-block text-xs text-muted font-regular">Orang Bone</span>
                                        </div>
                                        <div class="ms-auto"><i class="bi bi-chat"></i></div>
                                    </a>

                                    <!-- Popup for Vina Annisa Sofyan -->
                                    <div class="popup" id="popupVina" style="display: none;">
                                        <img src="images/staff-03.jpg" alt="Foto Admin" class="popup-img">
                                        <h2>Biodata Admin</h2>
                                        <p><strong>Nama Lengkap:</strong> Vina Annisa Sofyan</p>
                                        <p><strong>Posisi:</strong> Manager</p>
                                        <p><strong>Email:</strong> <a href="mailto:vina@example.com">vina@example.com</a></p>
                                        <p><strong>Telepon:</strong> +62 812 3456 7890</p>
                                        <p><strong>Alamat:</strong> Jl. Kebangsaan No. 456, Jakarta, Indonesia</p>
                                        <p><strong>Media Sosial:</strong></p>
                                        <ul class="social-media-list">
                                            <li>LinkedIn: <a href="https://www.linkedin.com/in/vina-annisa" target="_blank">linkedin.com/in/vina-annisa</a></li>
                                            <li>Twitter: <a href="https://twitter.com/vina_annisa" target="_blank">@vina_annisa</a></li>
                                        </ul>
                                        <div class="button-container">
                                            <button class="close-btn" onclick="hidePopup('popupVina')">Tutup</button>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="#" class="nav-link d-flex align-items-center" onclick="showPopup('popupNurhalisa')">
                                        <div class="me-4">
                                            <div class="position-relative d-inline-block text-white">
                                                <span class="avatar bg-soft-warning text-warning rounded-circle">Nhs</span>
                                                <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-danger rounded-circle"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-sm font-semibold">Nurhalisa</span>
                                            <span class="d-block text-xs text-muted font-regular">Saya Maros</span>
                                        </div>
                                        <div class="ms-auto"><i class="bi bi-chat"></i></div>
                                    </a>

                                    <!-- Popup for Nurhalisa -->
                                    <div class="popup" id="popupNurhalisa" style="display: none;">
                                        <img src="images/staff-04.jpg" alt="Foto Admin" class="popup-img">
                                        <h2>Biodata Admin</h2>
                                        <p><strong>Nama Lengkap:</strong> Nurhalisa</p>
                                        <p><strong>Posisi:</strong> Marketing</p>
                                        <p><strong>Email:</strong> <a href="mailto:nurhalisa@example.com">nurhalisa@example.com</a></p>
                                        <p><strong>Telepon:</strong> +62 812 3456 7890</p>
                                        <p><strong>Alamat:</strong> Jl. Kebangsaan No. 789, Jakarta, Indonesia</p>
                                        <p><strong>Media Sosial:</strong></p>
                                        <ul class="social-media-list">
                                            <li>LinkedIn: <a href="https://www.linkedin.com/in/nurhalisa" target="_blank">linkedin.com/in/nurhalisa</a></li>
                                            <li>Twitter: <a href="https://twitter.com/nurhalisa" target="_blank">@nurhalisa</a></li>
                                        </ul>
                                        <div class="button-container">
                                            <button class="close-btn" onclick="hidePopup('popupNurhalisa')">Tutup</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#" class="nav-link d-flex align-items-center" onclick="showPopup('popupIrene')">
                                        <div class="me-4">
                                            <div class="position-relative d-inline-block text-white">
                                                <span class="avatar bg-soft-danger text-danger rounded-circle">Ire</span>
                                                <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="d-block text-sm font-semibold">Irene Boli</span>
                                            <span class="d-block text-xs text-muted font-regular">Makassar</span>
                                        </div>
                                        <div class="ms-auto"><i class="bi bi-chat"></i></div>
                                    </a>

                                    <!-- Popup for Irene Boli -->
                                    <div class="popup" id="popupIrene" style="display: none;">
                                        <img src="images/staff-05.jpg" alt="Foto Admin" class="popup-img">
                                        <h2>Biodata Admin</h2>
                                        <p><strong>Nama Lengkap:</strong> Irene Boli</p>
                                        <p><strong>Posisi:</strong> Asisten Manajer</p>
                                        <p><strong>Email:</strong> <a href="mailto:irene.boli@example.com">irene.boli@example.com</a></p>
                                        <p><strong>Telepon:</strong> +62 812 3456 7890</p>
                                        <p><strong>Alamat:</strong> Jl. Sejahtera No. 101, Makassar, Indonesia</p>
                                        <p><strong>Media Sosial:</strong></p>
                                        <ul class="social-media-list">
                                            <li>LinkedIn: <a href="https://www.linkedin.com/in/irene-boli" target="_blank">linkedin.com/in/irene-boli</a></li>
                                            <li>Twitter: <a href="https://twitter.com/irene_boli" target="_blank">@irene_boli</a></li>
                                        </ul>
                                        <div class="button-container">
                                            <button class="close-btn" onclick="hidePopup('popupIrene')">Tutup</button>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                            <!-- JavaScript functions for handling pop-ups -->
                            <script>
                                function showPopup(popupId) {
                                    // Hide all popups first
                                    const popups = document.querySelectorAll('.popup');
                                    popups.forEach(popup => {
                                        popup.style.display = 'none';
                                    });
                                    // Show the selected popup
                                    document.getElementById(popupId).style.display = 'block';
                                    document.getElementById('popupOverlay').style.display = 'block'; // Show overlay
                                }

                                function hidePopup(popupId) {
                                    // Hide the selected popup
                                    document.getElementById(popupId).style.display = 'none';
                                    document.getElementById('popupOverlay').style.display = 'none'; // Hide overlay
                                }
                            </script>

                            <style>
                                /* CSS for the pop-up overlay and pop-up styles */
                                .popup-overlay {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: rgba(0, 0, 0, 0.7);
                                    z-index: 999;
                                }

                                .popup {
                                    position: fixed;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    background: white;
                                    padding: 20px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                                    z-index: 1000;
                                    width: 400px;
                                    /* Adjust the width as needed */
                                }

                                .popup-img {
                                    width: 100%;
                                    height: auto;
                                }

                                .close-btn {
                                    background-color: #007bff;
                                    color: white;
                                    border: none;
                                    padding: 10px;
                                    cursor: pointer;
                                }
                            </style>

                            <!-- Main content -->
                            <div class=" flex-grow-1 overflow-y-lg-auto">
                                <!-- Header -->
                                <header class="bg-surface-success border-bottom pt-6">
                                    <div class="container-fluid">
                                        <div class="mb-npx">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                                    <!-- Title -->

                                                </div>

                                                <!-- Push content down -->
                                                <div class="mt-auto"></div>
                                                <!-- User (md) -->
                                                <ul class="navbar-nav">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">
                                                            <i class="bi bi-person-square"></i> Account
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/food-funday-master/eduadmiin/eduadmin-template.multipurposethemes.com/bs4/main/auth_loginadmin.html">
                                                            <i class="bi bi-box-arrow-left"></i> Logout
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
        </nav>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-success border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h3 class="h2 mb-15 ls-tight admin-text"> ADMIN </h3>

                                <style>
                                    /* Gaya tambahan untuk mempercantik font */
                                    .admin-text {
                                        font-family: 'Times new roman', sans-serif;
                                        /* Font keren, kamu bisa mengganti dengan font lain */
                                        font-size: 2.5rem;
                                        /* Ukuran font lebih besar agar lebih menonjol */
                                        font-weight: 700;
                                        /* Font yang tebal */
                                        color: green;
                                        /* Warna hijau untuk kata ADMIN */
                                        text-transform: uppercase;
                                        /* Membuat teks menjadi huruf besar */
                                        letter-spacing: 2px;
                                        /* Jarak antar huruf */
                                    }

                                    /* Mengimpor font dari Google Fonts */
                                    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
                                </style>

                            </div>

                        </div>

                    </div>
                </div>
            </header>

            <?php
            // Koneksi ke database
            $host = 'localhost'; // atau alamat host Anda
            $user = 'root'; // ganti dengan username database Anda
            $password = ''; // ganti dengan password database Anda
            $database = 'user_register'; // ganti dengan nama database Anda

            $conn = new mysqli($host, $user, $password, $database);

            // Cek koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mendapatkan total penjualan
            $totalPenjualanQuery = "SELECT SUM(harga) as total_penjualan FROM laporan_penjualan";
            $result = $conn->query($totalPenjualanQuery);
            $totalPenjualan = $result->fetch_assoc()['total_penjualan'];

            // Query untuk mendapatkan jumlah pembeli
            $jumlahPembeliQuery = "SELECT COUNT(DISTINCT nama_lengkap) as jumlah_pembeli FROM laporan_penjualan";
            $result = $conn->query($jumlahPembeliQuery);
            $jumlahPembeli = $result->fetch_assoc()['jumlah_pembeli'];

            // Query untuk mendapatkan jumlah pengguna aplikasi
            $jumlahPenggunaQuery = "SELECT COUNT(*) as jumlah_pengguna FROM users";
            $result = $conn->query($jumlahPenggunaQuery);
            $jumlahPengguna = $result->fetch_assoc()['jumlah_pengguna'];

            // Query untuk mendapatkan tanggal pemesanan terakhir
            $tanggalTerakhirQuery = "SELECT MAX(tanggal_pemesanan) as tanggal_terakhir FROM laporan_penjualan";
            $result = $conn->query($tanggalTerakhirQuery);
            $tanggalTerakhir = $result->fetch_assoc()['tanggal_terakhir'];
            ?>
            <!-- Main -->
            <style>
                .card {
                    height: 180px;
                    /* Menetapkan tinggi card agar sama */
                }

                .row {
                    display: flex;
                    /* Menggunakan flexbox untuk penataan card */
                    flex-wrap: wrap;
                    /* Membungkus card ke baris berikutnya jika diperlukan */
                    justify-content: space-between;
                    /* Menjaga jarak antar card */
                }

                .icon-container {
                    display: flex;
                    /* Menggunakan flexbox untuk ikon */
                    align-items: center;
                    /* Menjaga agar ikon dan teks sejajar secara vertikal */
                    height: 100%;
                    /* Memastikan kontainer ikon memenuhi tinggi card */
                }
            </style>
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Penjualan</span>
                                            <span class="h5 font-bold mb-0">Rp <?php echo number_format($totalPenjualan, 0, ',', '.'); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-success text-success me-2">
                                            <i class="bi bi-arrow-up me-1"></i>13%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Pembeli</span>
                                            <span class="h3 font-bold mb-0"><?php echo $jumlahPembeli; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-success text-success me-2">
                                            <i class="bi bi-arrow-up me-1"></i>30%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Jumlah Pengguna Aplikasi</span>
                                            <span class="h3 font-bold mb-0"><?php echo $jumlahPengguna; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                            <i class="bi bi-arrow-down me-1"></i>-5%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Tanggal Pemesanan Terakhir</span>
                                            <span class="h5 font-bold mb-0"><?php echo date('d-m-Y', strtotime($tanggalTerakhir)); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                                <i class="bi bi-minecart-loaded"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                        <span class="badge badge-pill bg-soft-success text-success me-2">
                                            <i class="bi bi-arrow-up me-1"></i>10%
                                        </span>
                                        <span class="text-nowrap text-xs text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>


            <?php
            // Menutup koneksi
            $conn->close();
            ?>

            <?php
            // Konfigurasi koneksi ke database
            $servername = "localhost"; // atau alamat server database
            $username = "root"; // nama pengguna database
            $password = ""; // kata sandi database
            $dbname = "user_register"; // nama database

            // Membuat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Cek koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mendapatkan data users
            $sql = "SELECT nama_lengkap, email, password, phone, alamat, negara, kota, kode_pos FROM users";
            $result = $conn->query($sql);
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Users</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            </head>

            <body>
                <div class="shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">Pengguna</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Negara</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Kode Pos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    // Output data per baris
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['alamat'] . "</td>";
                                        echo "<td>" . $row['negara'] . "</td>";
                                        echo "<td>" . $row['kota'] . "</td>";
                                        echo "<td>" . $row['kode_pos'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                // Menutup koneksi database
                $conn->close();
                ?>
            </body>

            </html>
            <?php
            // Konfigurasi koneksi ke database
            $servername = "localhost"; // atau alamat server database
            $username = "root"; // nama pengguna database
            $password = ""; // kata sandi database
            $dbname = "user_register"; // nama database

            // Membuat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Cek koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mendapatkan data users
            $sql = "SELECT nama_lengkap, email, password, phone, alamat, negara, kota, kode_pos FROM users";
            $result = $conn->query($sql);
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Users</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <style>
                    /* Gaya tambahan untuk mempercantik tabel */
                    .card-header {
                        background-color: #4e73df;
                        color: white;
                        text-align: center;
                        font-weight: bold;
                    }

                    .table thead th {
                        background-color: #f8f9fc;
                        color: #4e73df;
                        font-weight: bold;
                    }

                    .table-hover tbody tr:hover {
                        background-color: #f1f1f1;
                    }

                    .table-striped tbody tr:nth-of-type(odd) {
                        background-color: #f9f9f9;
                    }

                    .table td,
                    .table th {
                        vertical-align: middle;
                        text-align: center;
                        padding: 10px 20px;
                    }

                    .table-responsive {
                        padding: 15px;
                        max-width: 100%;
                        max-height: 600px;
                        /* Atur tinggi maksimum sesuai kebutuhan */
                        overflow-y: auto;
                        /* Scroll hanya ketika melebihi tinggi */
                    }

                    .table {
                        width: 100%;
                    }
                </style>

                <!-- Page Content overlay -->

                <!-- Vendor JS -->
                <script src="js/vendors.min.js"></script>
                <script src="js/pages/chat-popup.js"></script>
                <script src="../assets/icons/feather-icons/feather.min.js"></script>

                <!-- EduAdmin App -->
                <script src="js/template.js"></script>

                <script src="js/pages/list.js"></script>

</body>

<!-- Mirrored from eduadmin-template.multipurposethemes.com/bs4/main/widgets_list.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Mar 2022 01:50:48 GMT -->

</html>

