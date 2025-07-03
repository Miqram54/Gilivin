<?php
if(isset($_POST["submit"])) {
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

    $name = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO `keluhan_cs` (`Nama`, `Alamat`, `Email`, `No_HP`, `Keluhan`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $alamat, $email, $phone, $message);
    $stmt->execute();

    // Indicate that the form has been submitted successfully
    $formSubmitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://eduadmin-template.multipurposethemes.com/bs4/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>GILIVIN - CS</title>

    <link rel="stylesheet" href="css/vendors_css.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skin_color.css">
    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }
        .gradient-brand-color {
            background-image: -webkit-linear-gradient(0deg, #5ee569 1000%, #5ee569 100%);
            background-image: -ms-linear-gradient(0deg, #37ec23 100%, #35b63d 100%);
            color: #fff;
        }
        .contact-info__wrapper {
            overflow: hidden;
            border-radius: .625rem .625rem 0 0
        }

        @media (min-width: 1024px) {
            .contact-info__wrapper {
                border-radius: 0 .625rem .625rem 0;
                padding: 5rem !important
            }
        }

        .contact-info__list span.position-absolute {
            left: 0
        }
        .z-index-101 {
            z-index: 101;
        }
        .list-style--none {
            list-style: none;
        }
        .contact__wrapper {
            background-color: #fff;
            border-radius: 0 0 .625rem .625rem
        }

        @media (min-width: 1024px) {
            .contact__wrapper {
                border-radius: .625rem 0 .625rem .625rem
            }
        }
    </style>
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="container">
        <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
                <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
                    <h3 class="color--white mb-5">Kontak</h3>
                    <ul class="contact-info__list list-style--none position-relative z-index-101">
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-envelope"></i></span> vinaannisa@gmail.com
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-phone"></i></span> +62 812 36578903
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-map-marker-alt"></i></span> Silakan menghubungi tim layanan pelanggan kami.
                            <br> Terima kasih atas pengertian dan kesabaran Anda!
                        </li>
                    </ul>
                    <a href="../theme-indomarket-master/cstampilankeluhan.php" class="btn btn-warning btn-reply">Riwayat</a>
                </div>

                <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">
                    <form action="" method="POST" class="contact-form form-validate" novalidate="novalidate">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="firstName">Nama</label>
                                    <input type="text" class="form-control" id="firstName" name="nama" placeholder="Masukkan nama lengkap anda">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Alamat</label>
                                    <input type="text" class="form-control" id="lastName" name="alamat" placeholder="Masukkan alamat lengkap anda">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan alamat email anda">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">No. Hp</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan NoHp Anda">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="message">Apa yang bisa kami bantu?</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Silahkan ketik pesan anda di sini…"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="submit" class="btn btn-success">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS -->
    <script src="js/vendors.min.js"></script>
    <script src="js/pages/chat-popup.js"></script>

    <script src="../assets/icons/feather-icons/feather.min.js"></script>
    <script src="../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>    

    <!-- EduAdmin App -->
    <script src="js/template.js"></script>

    <script src="js/pages/widgets.js"></script>

    <?php if (isset($formSubmitted) && $formSubmitted): ?>
        <script>
            // Success pop-up message
            alert("Keluhan berhasil dikirim!");
        </script>
    <?php endif; ?>
</body>
</html>
