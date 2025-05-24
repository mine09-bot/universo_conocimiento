<?php
session_start();
require 'utils.php';
require "config.php";

$correo = isset($_POST['correo']) ? $_POST['correo'] : "";

$paso1 = <<<HTML
    <label for="correo">Escribe tu correo:</label>
    <input type="email" name="correo" required style="width: 300px;">
    <div class="mb-3 mt-4">
        <button class="btn btn-primary " type="submit">Enviar enlace</button>
    </div>
    HTML;

$paso2 = "
        <input type='hidden' name='correo' required style='width: 300px;' value='$correo'>
        <label for='codigo'>Escribe el codigo enviado al correo electrónico:</label>
        <input type='text' name='token' required style='width: 300px;'>
        <div class='mb-3 mt-4'>
            <button class='btn btn-primary ' type='submit'>Validar Código</button>
        </div>
        ";

$paso3 = <<<HTML
            <input type="hidden" name="correo" value="$correo">
            <label for="password">Ingresa la nueva contraseña</label>
            <input type="password" name="pass" required style="width: 300px;">
            <label for="pass-conf">Confirma la nueva contraseña</label>
            <input type="password" name="pass-conf" required style="width: 300px;">
            <div class="mb-3 mt-4">
                <button class="btn btn-primary " type="submit">Restablecer Contraseña</button>
            </div>
            HTML;

$pasoActual = $paso1;

if (isset($_POST['pass'], $_POST['pass-conf'], $_POST['correo'])) {
    //* PASO 3
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $passConf = $_POST['pass-conf'];

    if ($pass === $passConf) {

        $contrasenaEncriptada = md5($pass);

        $instruccion = "UPDATE usuario SET contrasena = :contrasenaEncriptada WHERE usuario.correoElectronico = :correo";
        $query = $connection->prepare($instruccion);
        $query->bindParam(":contrasenaEncriptada", $contrasenaEncriptada, PDO::PARAM_STR);
        $query->bindParam(":correo", $correo, PDO::PARAM_STR);
        $query->execute();




        if ($query->rowCount()) {
            $codigoIngresado = $_POST['token'];

            $instruccion = "DELETE verifpass FROM verifpass
             LEFT JOIN usuario ON verifpass.idUser = usuario.idUsuario
            WHERE verifpass.codigo = :codigo AND usuario.correoElectronico = :correo";
            $borrar = $connection->prepare($instruccion);
            $borrar->bindParam(":codigo", $codigoIngresado, PDO::PARAM_STR);
            $borrar->bindParam(":correo", $correo, PDO::PARAM_STR);

            $borrar->execute();
            $msj = "¡Contraseña actualizada exitosamente!";
            header("Location: login.php");
            exit;
        } else {
            $msj = "No se pudo actualizar la contraseña. Verifica los datos.";
        }
    } else {
        $msj = "La contraseña no coincide.";
        $pasoActual = $paso2;
    }

    //TODO 
    // Verificar que pass y pass-conf coincidan
    // Encriptar pass con MD5
    // Actualizar pass en BDD
    // Eliminar el codigo en verifpass
    // Enviar $msj de exito
    // Enviar al usuario a login.php
} else if (isset($_POST['token'])) {
    //* PASO 2

    $codigoIngresado = $_POST['token'];
    $correo = $_POST['correo'];

    $instruccion = "SELECT verifpass.id, verifpass.timestamp FROM verifpass LEFT JOIN usuario ON verifpass.idUser=usuario.idUsuario WHERE verifpass.codigo = :codigo AND usuario.correoElectronico=:correo";
    $query = $connection->prepare($instruccion);
    $query->bindParam(":codigo", $codigoIngresado, PDO::PARAM_STR);
    $query->bindParam(":correo", $correo, PDO::PARAM_STR);
    $query->execute();
    $tokenData = $query->fetch(PDO::FETCH_ASSOC);

    if ($tokenData) {
        // verificar si el token está vencido
        $fechaToken = strtotime($tokenData['timestamp']);
        $fechaActual = time();
        $minutosPasados = ($fechaActual - $fechaToken) / 3600;

        if ($minutosPasados <= 15) {
            // El código es válido y no ha expirado
            $pasoActual = $paso3;
        } else {
            $msj = "El código ha expirado. Solicita uno nuevo.";
            $pasoActual = $paso2;
        }
    } else {
        $msj = "Código incorrecto. Intenta de nuevo.";
        $pasoActual = $paso2;
    }
} else if (isset($_POST['correo'])) {
    //* PASO 1
    $correo = $_POST['correo'];
    $instruccion = "SELECT * FROM usuario where correoElectronico=:x";

    $query = $connection->prepare($instruccion);
    $query->bindParam("x", $correo, PDO::PARAM_STR);
    $query->execute();
    $respuesta = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica si el correo existe en la base de datos
    if ($respuesta) {
        $usuario = $respuesta['correoElectronico'];
        $idUsuario = $respuesta['idUsuario'];

        if ($usuario) {
            // Generar Token
            $token = rand(100000, 999999);

            // Enviar correo
            $to = $correo;
            $subject = "Recuperar Contraseña";
            $message = "Hola, para restablecer tu contraseña, introduce el siguiente token: $token";
            $headers = "From: Bookia";
            // mail($to, $subject, $message, $headers);


            // Guardar token en BDD
            $query = $connection->prepare("DELETE FROM verifpass WHERE idUser=:idUser");
            $query->bindParam(":idUser", $idUsuario, PDO::PARAM_STR);
            $query->execute();

            $instruccion = "INSERT INTO verifpass(idUser, codigo) VALUES (:idUser, :codigo)";

            $query = $connection->prepare($instruccion);
            $query->bindParam(":idUser", $idUsuario, PDO::PARAM_STR);
            $query->bindParam(":codigo", $token, PDO::PARAM_STR);

            $query->execute();

            $pasoActual = $paso2;
        } else {
            // Correo no existe
            $msj = "El correo no está registrado.";
        }
    }
    // Mostrar mensaje de éxito
    $msj = "Si el correo está registrado, se enviará un enlace para restablecer la contraseña.";
}
?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Recuperar Contraseña'); ?>
</head>

<body>
    <div class="container-md mt-2">
        <form class="row g-1" action="recuperacontrasena.php" method="post">
            <div class="col-6 d-flex flex-column gap-2">
                <img
                    src="assets/images/logo.svg"
                    alt="Bootstrap"
                    width="150"
                    height="150" />
                <h3>¡Recuperar Contraseña!</h3>

                <?php echo $pasoActual; ?>
            </div>
        </form>

    </div>
    <?php
    if (isset($msj)) {
        echo "<script>alert('$msj');</script>";
    }
    ?>
</body>

</html>