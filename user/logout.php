<?php
session_start();

$_SESSION = [];
session_unset();
session_destroy();

if (isset($_COOKIE['id'])) {
    setcookie("id", "", time() - 3600, "/surpay_web/user");
}

header("Location: login.php");
exit();
