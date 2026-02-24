<?php
session_start();

$_SESSION = [];

if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, '/');
    unset($_COOKIE['remember_me']);
}

session_destroy();

header('Location: /login.php');
exit;
