<?php
session_start();

require "config.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST["contrasena"];

$instruccion = "SELECT * FROM usuario where nombreUsuario=:x and contrasena=:y";

$query = $connection->prepare($instruccion);
$query->bindParam("x", $usuario, PDO::PARAM_STR);
$query->bindParam("y", $contrasena, PDO::PARAM_STR);
$query->execute();
$respuesta = $query->fetch(PDO::FETCH_ASSOC);

if ($respuesta) {
    // Existe
    echo "Usuario existe";

    // Guardar las variables de sesión
    $_SESSION['idUsuario'] = $respuesta['idUsuario'];
    $_SESSION['correoElectronico'] = $respuesta['correoElectronico'];
    $_SESSION['nombre'] = $respuesta['nombre'];
    $_SESSION['apellidoPaterno'] = $respuesta['apellidoPaterno'];
    $_SESSION['apellidoMaterno'] = $respuesta['apellidoMaterno'];
    $_SESSION['facultad'] = $respuesta['idFacultad'];


    // Enviar a inicio
    header("Location: inicio.php");
    exit;
} else {
    // No existe
    $msg = "Usuario o contraseña incorrectos";
    echo "<script>
    alert('$msg');
    window.location.href='login.php';
    </script>";
}
