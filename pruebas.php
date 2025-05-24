<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correoElectronico"];

    // Aquí buscamos al usuario
    $stmt = $connection->prepare("SELECT * FROM usuarios WHERE correoElectronico = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // se envia el c orrero


        header("Location: cambiar_contrasena.php?usuario=" . urlencode($usuario["idUsuario"]));
        exit;
    } else {
        $error = "Correo no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="