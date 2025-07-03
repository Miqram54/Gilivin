<?php
// Database connection parameters
$servername = "localhost"; // Update with your server name
$username = "your_username"; // Update with your database username
$password = "your_password"; // Update with your database password
$dbname = "user_register"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all records from the wishlist table
$sql = "SELECT * FROM wishlist";
$result = $conn->query($sql);

$wishlist = array();

if ($result->num_rows > 0) {
    // Fetch all results into an array
    while ($row = $result->fetch_assoc()) {
        $wishlist[] = $row;
    }
}

// Return the results as a JSON object
header('Content-Type: application/json');
echo json_encode($wishlist);

// Close the database connection
$conn->close();
?>
