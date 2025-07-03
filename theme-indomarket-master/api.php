<?php
$host = 'localhost';
$db = 'user_register';
$user = 'root'; // ganti dengan user database anda
$pass = ''; // ganti dengan password database anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];

        if ($action == 'sendMessage') {
            $sender_id = $_POST['sender_id'];
            $receiver_id = $_POST['receiver_id'];
            $message = $_POST['message'];

            $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
            $stmt->execute([$sender_id, $receiver_id, $message]);

            echo json_encode(['status' => 'success']);
        } elseif ($action == 'getMessages') {
            $user_id = $_POST['user_id'];
            $contact_id = $_POST['contact_id'];

            $stmt = $pdo->prepare("
                SELECT * FROM messages 
                WHERE (sender_id = ? AND receiver_id = ?) 
                OR (sender_id = ? AND receiver_id = ?)
                ORDER BY sent_at ASC
            ");
            $stmt->execute([$user_id, $contact_id, $contact_id, $user_id]);
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($messages);
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WhatsApp Clone</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .chat-container {
      width: 400px;
      border: 1px solid #ccc;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .chat-header {
      padding: 15px;
      background-color: #075E54;
      color: white;
      text-align: center;
      font-weight: bold;
    }

    .chat-messages {
      height: 300px;
      padding: 10px;
      overflow-y: scroll;
      background-color: #e5ddd5;
    }

    .chat-messages .message {
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
    }

    .message.sent {
      background-color: #dcf8c6;
      text-align: right;
    }

    .message.received {
      background-color: #fff;
      text-align: left;
    }

    .chat-input {
      display: flex;
      padding: 10px;
      border-top: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    .chat-input input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-right: 10px;
    }

    .chat-input button {
      padding: 10px;
      background-color: #075E54;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="chat-container">
    <div class="chat-header">Chat with User</div>
    <div class="chat-messages" id="chatMessages"></div>
    <div class="chat-input">
      <input type="text" id="messageInput" placeholder="Type a message">
      <button id="sendButton">Send</button>
    </div>
  </div>

  <script>
    const userId = 1; // Sesuaikan dengan user yang sedang login
    const contactId = 2; // Sesuaikan dengan user yang sedang di-chat

    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');

    // Fungsi untuk memuat pesan dari database
    function loadMessages() {
      fetch('api.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `action=getMessages&user_id=${userId}&contact_id=${contactId}`
      })
      .then(response => response.json())
      .then(data => {
        chatMessages.innerHTML = '';
        data.forEach(msg => {
          const messageElement = document.createElement('div');
          messageElement.classList.add('message');
          messageElement.classList.add(msg.sender_id == userId ? 'sent' : 'received');
          messageElement.innerText = msg.message;
          chatMessages.appendChild(messageElement);
        });
        chatMessages.scrollTop = chatMessages.scrollHeight;
      });
    }

    // Fungsi untuk mengirim pesan
    function sendMessage() {
      const message = messageInput.value;
      if (!message) return;

      fetch('api.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `action=sendMessage&sender_id=${userId}&receiver_id=${contactId}&message=${message}`
      })
      .then(response => response.json())
      .then(data => {
        if (data.status == 'success') {
          messageInput.value = '';
          loadMessages(); // Refresh pesan
        }
      });
    }

    sendButton.addEventListener('click', sendMessage);

    // Muat pesan setiap 3 detik untuk update chat secara real-time
    setInterval(loadMessages, 3000);

    // Muat pesan saat pertama kali halaman diakses
    loadMessages();
  </script>

</body>
</html>
