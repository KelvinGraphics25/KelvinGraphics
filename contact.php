<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Replace with your WhatsApp number (in international format)
    $phone = "254799800366";  // Example: Replace with your own WhatsApp number

    // Prepare the message to send
    $whatsappMessage = "Hello, my name is $name , Email is $email , $message";

    // Create WhatsApp URL
    $whatsappURL = "https://wa.me/$phone?text=" . urlencode($whatsappMessage);

    // Redirect the user to WhatsApp Web or App with the message
    header("Location: $whatsappURL");
    exit;
}
?>
