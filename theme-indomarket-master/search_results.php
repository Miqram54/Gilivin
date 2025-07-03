<?php
// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "user_register");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kata kunci dari query string
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : "";

// Query untuk mencari produk berdasarkan kata kunci
$sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$query%'";

// Eksekusi query
$result = $conn->query($sql);

// Tampilkan hasil pencarian
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../images/stock.jpeg'); /* Replace with your image path */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background image */
            background-attachment: fixed;
            color: #ffffff; /* White text for better contrast */
            font-family: Arial, sans-serif;
        }
        .search-container {
            margin-top: 5rem;
            margin-bottom: 5rem;
            background-color: rgba(52, 58, 64, 0.8); /* Semi-transparent dark overlay */
            border-radius: 10px; /* Rounded corners for the container */
            padding: 20px; /* Padding around the content */
        }
        .search-header {
            background-color: #495057; /* Slightly lighter dark background */
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 2rem;
        }
        .search-header h3 {
            margin: 0;
            font-weight: bold;
            color: #28a745; /* Green color for the query */
        }
        .search-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #6c757d; /* Darker border */
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: #ffffff; /* White background for cards */
        }
        .search-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }
        .badge {
            font-size: 0.85rem;
            margin-top: 10px;
        }
        .alert {
            background-color: #dff0d8; /* Light green alert */
            color: #3c763d; /* Darker green for alert text */
            border: none; /* Remove border for alert */
            border-radius: 5px; /* Rounded corners */
        }
        .alert-heading {
            color: #3c763d; /* Darker green for alert heading */
        }
        .card-title {
            font-weight: bold; /* Bold title */
            color: #343a40; /* Dark gray for title */
        }
        .card-text {
            color: #5a5a5a; /* Dark gray for description */
        }
    </style>
</head>
<body>
<div class="container search-container">
    <?php
    if ($result->num_rows > 0) {
        // Redesigned search header
        echo "<div class='search-header'>";
        echo "<h3>Search Results for: '<span class='text-success'>$query</span>'</h3>";
        echo "</div>";
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
            $product_id = $row["id"]; // Menggunakan nama kolom "id"
            echo "<div class='col-md-4 mb-4'>";
            echo "<a href='product-detail2.php?id=$product_id' class='text-decoration-none'>";
            echo "<div class='card search-card shadow-sm'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row["nama_produk"]) . "</h5>";
            echo "<span class='badge badge-success'>In Stock</span>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning text-center' role='alert'>";
        echo "<h4 class='alert-heading'>No results found!</h4>";
        echo "<p>No products match '<strong>$query</strong>'. Please try another search term.</p>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>


