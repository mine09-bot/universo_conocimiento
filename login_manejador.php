<?php
session_start();

require "config.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST["contrasena"];
$encriptada = md5($contrasena);

$instruccion = "SELECT * FROM usuario where nombreUsuario=:x and contrasena=:y";

$query = $connection->prepare($instruccion);
$query->bindParam("x", $usuario, PDO::PARAM_STR);
$query->bindParam("y", $encriptada, PDO::PARAM_STR);
$query->execute();
$respuesta = $query->fetch(PDO::FETCH_ASSOC);

if ($respuesta) {
    // Existe
    echo "Usuario existe";

    if ($respuesta['bloqueado'] == 0) {


        // Guardar las variables de sesión
        $_SESSION['idUsuario'] = $respuesta['idUsuario'];
        $_SESSION['correoElectronico'] = $respuesta['correoElectronico'];
        $_SESSION['nombre'] = $respuesta['nombre'];
        $_SESSION['apellidoPaterno'] = $respuesta['apellidoPaterno'];
        $_SESSION['apellidoMaterno'] = $respuesta['apellidoMaterno'];
        $_SESSION['facultad'] = $respuesta['idFacultad'];
        $_SESSION['universidad'] = $respuesta['nombreUniversidad'];
        $_SESSION['nivel'] = $respuesta['nivelUsuario']; // 'admin' o 'usuario'


        // Enviar a inicio
        header("Location: inicio.php");
        exit;
    } else {
        $msg = "Usuario bloqueado";
        echo "<script>
    alert('$msg');
    window.location.href='login.php';
    </script>";
    }
} else {
    // No existe
    $msg = "Usuario o contraseña incorrectos";
    echo "<script>
    alert('$msg');
    window.location.href='login.php';
    </script>";
}

$instruccion = "
SELECT u.*, f.nombreFacultades, f.id AS idFacultad
FROM usuario u
JOIN facultades f ON u.idFacultad = f.id
WHERE u.nombreUsuario = :x AND u.contrasena = :y
";
$_SESSION['facultad'] = $respuesta['nombreFacultades'];
