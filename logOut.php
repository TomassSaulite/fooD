<?php
session_start(); 
ob_start();
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['action'])
    && $_POST['action'] === 'logOut') {
    logOut();
}

function logOut() {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>