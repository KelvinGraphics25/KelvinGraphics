<?php
$token = "7858403453:AAHOQjbioMKuAOdH6q08RcxkUkni6ctUfZY;
$website = "https://api.telegram.org/bot$token";

$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);

$chat_id = $update["message"]["chat"]["id"];
$text = $update["message"]["text"];

if ($text == "/start") {
    file_get_contents($website . "/sendMessage?chat_id=$chat_id&text=Welcome to Kelvin Kikwa Bot!");
}
?>
