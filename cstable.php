<?php 
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_user']) && isset($_POST['respon'])) {
    $keluhan_id = $_POST['id_user']; 
    $respon = $_POST['respon'];

    // Insert response into respon_keluhan
    $stmt = $conn->prepare("INSERT INTO respon_keluhan (keluhan_id, respon) VALUES (?, ?)");
    
    // Bind parameters: 'i' for integer and 's' for string
    $stmt->bind_param("is", $keluhan_id, $respon);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Respon berhasil disimpan untuk keluhan ID: $keluhan_id.</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan respon untuk keluhan ID: $keluhan_id. Error: " . $stmt->error . "</div>";
    }

    // Close the statement
    $stmt->close();
}

// Fetch keluhan
$stmt = $conn->prepare("SELECT * FROM keluhan_cs");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GILIVIN - CS ADMIN</title>

  <!-- Vendors Style-->
  <link rel="stylesheet" href="css/vendors_css.css">
  
  <!-- Style-->  
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skin_color.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    /* Background sawah */
    body {
        background-image: url('../theme-indomarket-master/assets/Premium\ Photo\ _\ Morning\ view\ of\ the\ countryside\ and\ green\ rice\ fields\ under\ the\ mountain\ range\ \(1\).jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .table-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        margin: 20px auto;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar {
        background-color: #6B8E23;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        margin-right: 10px;
    }

    .table {
        margin: 20px 0;
        background-color: #877d19;
        color: white;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    .table thead th {
        background-color: #8FBC8F;
        color: white;
        text-transform: uppercase;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
    }

    .response-form {
        display: flex;
        align-items: center;
    }

    .response-form input[type="text"] {
        flex: 1;
        margin-right: 5px;
        padding: 6px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .response-form .btn-success {
        background-color: #28a745;
        border: none;
    }

    .response-form .btn-success:hover {
        background-color: #218838;
    }

    .alert {
        margin: 10px auto;
        max-width: 90%;
    }
  </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center justify-content-center">
                <img src="../eduadmiin/eduadmin-template.multipurposethemes.com/bs4/images/gilivin2.png" width="70" height="70" class="d-inline-block align-center" alt="">
                <h4 class="m-0 text-center">Keluhan Pengguna</h4>
            </a>
        </div>
    </nav>

    <div class="container table-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Keluhan</th>
                    <th scope="col">Respon</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $no = 1; // Variabel untuk nomor urut

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">' . $no++ . '</th>'; // Menampilkan nomor urut dan menambah 1
            echo '<td>' . htmlspecialchars($row['Nama']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Alamat']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['No_HP']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Keluhan']) . '</td>';
            echo '<td>';
            
            // Form untuk memberikan respon
            echo '<form action="" method="POST" class="response-form">';
            echo '<input type="hidden" name="id_user" value="' . $row['id_user'] . '">';
            echo '<input type="text" name="respon" placeholder="Masukkan Respon" required>';
            echo '<button type="submit" class="btn btn-success">Kirim</button>';
            echo '</form>';
            
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7" class="text-center">No data available</td></tr>';
    }
    ?>
</tbody>

        </table>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>
