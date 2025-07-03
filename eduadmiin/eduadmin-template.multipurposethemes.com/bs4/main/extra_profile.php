<?php
// Start session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection configuration
$host = 'localhost'; // your database host
$db = 'user_register'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data from the database using session user_id
$user_id = $_SESSION['user_id'];
$sql = "SELECT nama_lengkap, email, phone, alamat, kota, negara, kode_pos, gambar FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama_lengkap, $email, $phone, $alamat, $kota, $negara, $kode_pos, $gambar);
$stmt->fetch();
$stmt->close();

// Handle profile update
if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $negara = $_POST['negara'];
    $kode_pos = $_POST['kode_pos'];

    // Handle image upload
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Image uploaded successfully, now update the user profile
                $gambar = $target_file; // Save the file path to the database
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Update user data in the database
    $sql = "UPDATE users SET nama_lengkap = ?, email = ?, phone = ?, alamat = ?, kota = ?, negara = ?, kode_pos = ?, gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $nama_lengkap, $email, $phone, $alamat, $kota, $negara, $kode_pos, $gambar, $user_id);

    if ($stmt->execute()) {
        // Show success message popup using JavaScript
        echo "<script>
                alert('Profil berhasil di-update!');
              </script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img id="profileImage" src="<?php echo (!empty($gambar)) ? htmlspecialchars($gambar) : 'https://bootdey.com/img/Content/avatar/avatar7.png'; ?>" alt="Profile Picture">
                            </div>
                            <h5 class="user-name"><?php echo htmlspecialchars($nama_lengkap); ?></h5>
                            <h6 class="user-email"><?php echo htmlspecialchars($email); ?></h6>
                        </div>
                        <div class="about">
                            <h5>About</h5>
                            <p>Edit your profile details below.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="">
                        <div class="row gutters">
                            <div class="col-xl-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="nama_lengkap">Full Name</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($nama_lengkap); ?>" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="alamat">Street</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="kota">City</label>
                                    <input type="text" class="form-control" id="kota" name="kota" value="<?php echo htmlspecialchars($kota); ?>">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="negara">State</label>
                                    <input type="text" class="form-control" id="negara" name="negara" value="<?php echo htmlspecialchars($negara); ?>">
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="kode_pos">Zip Code</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?php echo htmlspecialchars($kode_pos); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="gambar">Profile Picture</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(this);">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12">
                                <div class="text-right">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/food-funday-master/theme-indomarket-master/index.php'">Kembali</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
