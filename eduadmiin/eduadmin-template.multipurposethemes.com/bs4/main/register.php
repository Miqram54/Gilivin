<?php
// Database configuration
$host = 'localhost'; // or your database host
$db = 'user_register'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = $conn->real_escape_string(trim($_POST['nama_lengkap']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    // Check if email or name already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR nama_lengkap = ?");
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If user with the same email or name exists, display an error
        echo "Error: Email or name is already registered.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header ('location: auth_login.html');
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>