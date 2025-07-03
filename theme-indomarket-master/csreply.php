<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      background-color: #f5e0e5 !important;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .contact-form-wrapper {
      padding: 100px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .contact-form {
      padding: 30px 40px;
      background-color: #ffffff;
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
    }

    .contact-form .form-text-area {
      background-color: #f0f4f5;
      height: auto;
      padding-left: 16px;
      resize: none;
      border: none;
      pointer-events: none; /* Disable editing */
    }

    .contact-form .title {
      text-align: center;
      font-size: 24px;
      font-weight: 500;
    }

    .contact-form .description {
      color: #aeb4b9;
      font-size: 14px;
      text-align: center;
    }

    .contact-form .logout-button {
      text-align: center;
      margin-top: 20px;
    }

    .logout-button a {
      border: none;
      border-radius: 4px;
      background-color: #f23292;
      color: white;
      text-transform: uppercase;
      padding: 10px 60px;
      font-weight: 500;
      letter-spacing: 2px;
      cursor: pointer;
      text-decoration: none;
    }

    .logout-button a:hover {
      background-color: #d30069;
    }
  </style>
</head>
<body>

  <div class="contact-form-wrapper">
    <form action="#" class="contact-form">
      <h5 class="title">CS REPLY</h5>
      <p class="description">Berikut adalah balasan dari customer services tentang keluhan anda</p>
      <div>
        <p class="form-control rounded border-white mb-3 form-text-area" rows="5" cols="30">
          <!-- Here you can display the message -->
          Ini adalah pesan balasan dari customer service mengenai keluhan anda.
        </p>
      </div>
      <div class="logout-button">
        <a href="logout_page.php">Logout</a> <!-- Ganti 'logout_page.php' dengan halaman logout yang diinginkan -->
      </div>
    </form>
  </div>

</body>
</html>
