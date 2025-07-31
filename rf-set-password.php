<?php
session_start();

if (!isset($_SESSION['referral_index'], $_SESSION['email'])) {
  header('Location: rf-login.php');
  exit;
}

$index = $_SESSION['referral_index'];
$referrals = json_decode(file_get_contents('refer.json'), true);
$referral = $referrals[$index];
$name = $referral['name'];
$initial = strtoupper(substr($name, 0, 1));
$existingID = $referral['referral_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if ($password === $confirm && strlen($password) >= 4) {
        // Generate referral ID if not already present
        $refID = $existingID ?: 'KG-25-' . $initial . rand(10, 99);

        // Update referral info
        $referrals[$index]['password'] = password_hash($password, PASSWORD_DEFAULT);
        $referrals[$index]['referral_id'] = $refID;

        file_put_contents('refer.json', json_encode($referrals, JSON_PRETTY_PRINT));

        header('Location: rf-dashboard.php');
        exit;
    } else {
        $error = "Passwords must match and be at least 4 characters.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Set Password - Kelvin Graphics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background: #f3e5f5;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
      margin: 0;
    }

    .container {
      max-width: 400px;
      width: 100%;
      background: white;
      padding: 30px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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

    input[type="password"] {
      padding: 14px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1em;
    }

    button {
      padding: 14px;
      background: #6a1b9a;
      color: white;
      font-size: 1em;
      border: none;
      border-radius: 25px;
      cursor: pointer;
    }

    button:hover {
      background: #4a148c;
    }

    .error {
      color: red;
      font-size: 0.95em;
      text-align: center;
      margin-bottom: 15px;
    }

    @media (max-width: 480px) {
      .container {
        padding: 25px 15px;
      }

      input, button {
        font-size: 0.95em;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Set Your Password</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST" autocomplete="off">
      <input type="password" name="password" placeholder="Create password" required>
      <input type="password" name="confirm" placeholder="Confirm password" required>
      <button type="submit">Save & Continue</button>
    </form>
  </div>

</body>
</html>
