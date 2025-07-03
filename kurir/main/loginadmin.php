<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if 'email' and 'password' fields are set in the POST array
    if (isset($_POST['username']) && isset($_POST['password'])) {

        // Database connection details
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

        // Get the form data
        $name = $_POST['username'];
        $password = $_POST['password']; 

        // Prepare the SQL query to prevent SQL Injection
        $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if the user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $db_name, $db_password);
            $stmt->fetch();
            
            // Verify the password
            if ($password == $db_password) {  // Use password_verify() for hashed passwords
                // Successful login, start a session
                $_SESSION['username'] = $name;
                $_SESSION['user_id'] = $id; // Store user ID in session
            

                // // Check if "Remember me" is checked
                // if (isset($_POST['remember_me'])) {
                //     setcookie('nama_lengkap', $name, time() + (86400 * 30), "/"); // 86400 = 1 day
                // }

                // Redirect to userpage.html
                header("Location: ../../../../eduadmiin/index.html");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that email or you are not authorized.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please provide both email and password.";
    }
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: auth_loginadmin.html");
    exit();
}
?>