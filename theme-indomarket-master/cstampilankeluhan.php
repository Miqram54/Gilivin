<?php 
$host = 'localhost'; 
$db = 'vegm1133_gilivin01'; 
$user = 'vegm1133_gilivin01'; 
$pass = 'gilivin01'; // Update with your MySQL password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement to select data from keluhan_cs
$stmt = $conn->prepare("SELECT * FROM keluhan_cs");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint List Table with Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e3f2fd; /* Latar belakang yang lebih alami, biru langit */
      font-family: Arial, sans-serif; /* Font yang lebih modern */
    }
    .mfs-list-table {
      width: 100%;
      margin: 20px 0;
      border-collapse: collapse;
      background-color: #ffffff; /* Latar belakang putih untuk tabel */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
    }
    .mfs-list-table th, .mfs-list-table td {
      padding: 12px;
      text-align: left;
      border: 1px solid #dee2e6; /* Border warna abu-abu muda */
    }
    .mfs-list-table th {
      background-color: #4CAF50; /* Hijau yang segar untuk header */
      color: white; /* Teks putih di header */
      font-weight: bold; /* Teks lebih tebal di header */
    }
    .mfs-list-table tr:nth-child(even) {
      background-color: #f9f9f9; /* Latar belakang untuk baris genap */
    }
    .mfs-list-table tr:hover {
      background-color: #e7f4e4; /* Warna saat hover, hijau muda */
    }
    .mfs-list-table td button {
      background-color: #007bff; /* Warna tombol */
      border: none; /* Tanpa border */
      color: white; /* Teks putih di tombol */
      padding: 5px 10px; /* Padding tombol */
      border-radius: 4px; /* Sudut tombol melengkung */
      cursor: pointer; /* Menunjukkan kursor saat hover */
    }
    .mfs-list-table td button:hover {
      background-color: #0056b3; /* Warna tombol saat hover */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto text-center" href="#">
            <img src="../eduadmiin/eduadmin-template.multipurposethemes.com/bs4/images/gilivin2.png" alt="Logo" width="75" height="75" class="d-inline-block align-text-top">
            <span class="ms-2" style="font-size: 28px; font-weight: bold; color: green;">Riwayat Keluhan</span>
        </a>
    </div>
  </nav>

  <!-- Table -->
  <table class="mfs-list-table">
    <thead>
      <tr>
        <th>ID User</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Keluhan</th>
        <th>Balasan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $row['id_user'] . '</td>';
              echo '<td>' . $row['Nama'] . '</td>';
              echo '<td>' . $row['Alamat'] . '</td>';
              echo '<td>' . $row['Email'] . '</td>';
              echo '<td>' . $row['No_HP'] . '</td>';
              echo '<td>' . $row['Keluhan'] . '</td>';
              echo '<td><button class="btn btn-primary" onclick="openResponse(' . $row['id_user'] . ')">Open</button></td>'; // Ganti 'keluhan_id' sesuai dengan nama kolom ID yang sesuai
              echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="7">No complaints found</td></tr>';
        }
      ?>
    </tbody>
  </table>

  <div id="responseModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Balasan Keluhan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="responseContent">Loading...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function openResponse(keluhan_id) {
      $.ajax({
        url: 'get_response.php', // Ganti dengan nama file PHP untuk mendapatkan balasan
        type: 'GET',
        data: { id: keluhan_id },
        success: function(data) {
          $('#responseContent').html(data); // Menampilkan balasan di modal
          $('#responseModal').modal('show'); // Menampilkan modal
        },
        error: function() {
          $('#responseContent').html('Error retrieving data.');
          $('#responseModal').modal('show');
        }
      });
    }
  </script>

</body>
</html>