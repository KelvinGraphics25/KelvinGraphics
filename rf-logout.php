<?php
session_start();
session_destroy();
header('Location: rf-login.php');
exit;
