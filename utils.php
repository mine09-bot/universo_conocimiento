<?php
function verificarSesion() {
    if(!isset($_SESSION['idUsuario'])) {
        header('Location: login.php');
        exit;
    }
}
?>