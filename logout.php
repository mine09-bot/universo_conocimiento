<?php
session_start();

// Eliminar todas las variables.
$_SESSION = array();

// Borrar las cookies de sesion.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruir la sesion
session_destroy();

// Redirigir a Login
header('Location: login.php');
exit;