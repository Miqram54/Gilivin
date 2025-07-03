<?php
$conn = new mysqli('localhost', 'username', 'password', 'database_name');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['group_chat_messages.php'])) {
    $message = $conn->real_escape_string($_POST['group_chat_messages.php']);
    $sql = "INSERT INTO group_chat_messages (message) VALUES ('$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
