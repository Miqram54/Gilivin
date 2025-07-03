<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_register"; // Sesuaikan dengan nama database

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data dari request
$user_id = 1; // Anggap user sudah login, bisa menggunakan session untuk mendapatkan user_id yang valid
$message = $_POST['message'];

// Insert pesan ke tabel messages
$sql = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
if ($conn->query($sql) === TRUE) {
  echo "Message sent successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>
  const messageForm = document.getElementById('messageForm');
  const messageInput = document.getElementById('messageInput');
  const chat = document.getElementById('chat');

  messageForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const msgText = messageInput.value;
    if (!msgText) return;

    // Mengirim data ke server menggunakan fetch API
    fetch('save_message.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams({
        'message': msgText
      })
    })
    .then(response => response.text())
    .then(data => {
      console.log(data); // Ini bisa menampilkan pesan dari PHP, apakah sukses atau gagal
      appendMessage('Sajad', 'right', msgText); // Bisa diganti dengan nama pengguna yang sesuai
    })
    .catch(error => console.error('Error:', error));

    messageInput.value = '';
  });

  function appendMessage(name, side, text) {
    const msgHTML = `
      <div class="msg ${side}-msg">
        <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"></div>
        <div class="msg-bubble">
          <div class="msg-info">
            <div class="msg-info-name">${name}</div>
            <div class="msg-info-time">${new Date().toLocaleTimeString()}</div>
          </div>
          <div class="msg-text">${text}</div>
        </div>
      </div>
    `;
    chat.insertAdjacentHTML('beforeend', msgHTML);
    chat.scrollTop = chat.scrollHeight;
  }
</script>
