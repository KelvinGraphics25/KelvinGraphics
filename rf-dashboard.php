<?php
session_start();
if (!isset($_SESSION['referral_index'], $_SESSION['email'])) {
  header('Location: rf-login.php');
  exit;
}

$data = json_decode(file_get_contents('refer.json'), true);
$index = $_SESSION['referral_index'];
$referral = $data[$index];

$name = $referral['name'];
$refID = $referral['referral_id'] ?? 'Not assigned';
$clients = $referral['clients'] ?? 0;
$commission = $referral['commission'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Referral Dashboard - Kelvin Graphics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * {
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f3e5f5;
      color: #333;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background: #6a1b9a;
      color: white;
      padding: 16px;
      font-size: 1.3em;
      text-align: center;
      font-weight: bold;
    }
    .container {
      max-width: 800px;
      width: 100%;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-y: auto;
    }
    h2 {
      color: #6a1b9a;
      margin-bottom: 20px;
      text-align: center;
    }
    .info-box {
      margin-bottom: 20px;
      padding: 15px 20px;
      background: #f8f2fa;
      border-left: 6px solid #6a1b9a;
      border-radius: 8px;
      width: 100%;
    }
    .info-box strong {
      color: #4a148c;
    }
    .button {
      display: inline-block;
      background: #6a1b9a;
      color: white;
      padding: 12px 24px;
      border-radius: 30px;
      text-decoration: none;
      font-size: 1em;
      margin: 10px;
      text-align: center;
      transition: background 0.3s ease;
    }
    .button:hover {
      background: #4a148c;
    }
    .footer {
      padding: 20px;
      text-align: center;
      background-color: #6a1b9a;
      color: white;
      font-size: 0.9em;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
    .footer a {
      color: #f3e5f5;
    }
    @media (max-width: 600px) {
      .container {
        padding: 20px;
        margin: 0 10px;
      }
    }
  </style>
</head>
<body>

  <div class="navbar">
    KG Referral Dashboard
  </div>

  <div class="container">
    <h2>Welcome, <?= htmlspecialchars($name) ?>!</h2>

    <div class="info-box">
      <strong>Referral ID:</strong> <?= htmlspecialchars($refID) ?>
    </div>

    <div class="info-box">
      <strong>Clients Referred:</strong> <?= htmlspecialchars($clients) ?>
    </div>

    <div class="info-box">
      <strong>Total Commission Earned:</strong> KES <?= number_format($commission, 2) ?>
    </div>

    <a href="https://wa.me/254799800366" class="button">Request Commission</a>
    <a href="rf-logout.php" class="button" style="background:#d32f2f;">Logout</a>
  </div>

  <div class="footer">
    &copy; 2025 Kelvin Graphics. All rights reserved.<br>
    <small>Referral Program | Need help? <a href="https://wa.me/254799800366">Contact Support</a></small>
  </div>

</body>
</html>
