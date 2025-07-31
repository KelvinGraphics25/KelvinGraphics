<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize inputs
    $name = htmlspecialchars(trim($_POST['fullname']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $timestamp = date('Y-m-d H:i:s');

    if (empty($name) || empty($phone) || empty($email)) {
        http_response_code(400);
        echo "All fields are required.";
        exit;
    }

    // Prepare data to save
    $entry = [
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'timestamp' => $timestamp
    ];

    // Load existing data from JSON file
    $file = 'refer.json';
    $existing = [];

    if (file_exists($file)) {
        $json = file_get_contents($file);
        $existing = json_decode($json, true) ?? [];
    }

    // Add new entry and save back
    $existing[] = $entry;
    file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));

    // ✅ CallMeBot WhatsApp API
    $callmebotPhone = "254799800366"; // Your number (without +)
    $apiKey = "7694151"; // 🔁 Replace with your actual key from CallMeBot

    $message = "🔔 *New KG Referral Request*\n\n👤 Name: $name\n📞 Phone: $phone\n📧 Email: $email\n🕒 Time: $timestamp";
    $encodedMsg = urlencode($message);

    $callmebotURL = "https://api.callmebot.com/whatsapp.php?phone=$callmebotPhone&text=$encodedMsg&apikey=$apiKey";

    // Send WhatsApp notification (non-blocking)
    @file_get_contents($callmebotURL);

    // Respond to frontend
    echo "Success";
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
