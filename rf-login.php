<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $data = json_decode(file_get_contents('refer.json'), true);

    foreach ($data as $index => $referral) {
        if (
            isset($referral['email'], $referral['phone']) &&
            $referral['email'] === $email &&
            $referral['phone'] === $phone
        ) {
            $_SESSION['referral_index'] = $index;
            $_SESSION['email'] = $email;

            if (isset($referral['password'])) {
                header('Location: rf-dashboard.php');
            } else {
                header('Location: rf-set-password.php');
            }
            exit;
        }
    }
    $error = "Referral not found or not yet approved.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Referral Login - Kelvin Graphics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f3e5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background: white;
      padding: 30px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      color: #6a1b9a;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    input[type="text"],
    input[type="email"] {
      padding: 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1em;
      width: 100%;
    }

    button {
      padding: 14px;
      background: #6a1b9a;
      color: white;
      font-size: 1em;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #4a148c;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
      font-size: 0.95em;
    }

    @media (max-width: 480px) {
      .container {
        padding: 25px 15px;
      }

      input,
      button {
        font-size: 0.95em;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Referral Login</h2>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <input type="email" name="email" placeholder="Enter your email" required />
      <input type="text" name="phone" placeholder="Enter your phone number" required />
      <button type="submit">Login</button>
    </form>
  </div>

</body>
</html>
