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

// Get the ID from the request
$id_keluhan = $_GET['id'];

// Prepare statement to select data from respon_keluhan
$stmt = $conn->prepare("SELECT * FROM respon_keluhan WHERE keluhan_id = ?"); // Ganti 'id' dengan 'keluhan_id' sesuai dengan kolom yang ada
$stmt->bind_param("i", $id_keluhan); // Pastikan variabel ini konsisten
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['respon']; // Mengirimkan balasan sebagai respons
} else {
    echo "No response found.";
}

// Close connection
$conn->close();
?>
